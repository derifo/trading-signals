<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 15/05/2016
 * Time: 11:33
 */

namespace System\Service\Merchants;

use Doctrine\Bundle\DoctrineBundle\Registry;
use System\Entity\MerchantsSignals;
use System\Entity\MerchantsSyncSettings;
use System\Entity\SyncedTraders;
use System\Helpers\Arr;
use System\Helpers\Date;
use System\Service\Integration\AdaptersContainer;

class SyncTraders {

    /**
     * @var $doctrine Registry
     */
    private $doctrine;

    /**
     * @var $adapters AdaptersContainer
     */
    private $adapters;

    public function __construct(Registry $doctrine, AdaptersContainer $adapters)
    {
        $this->doctrine = $doctrine;
        $this->adapters = $adapters;
    }

    public function syncMerchantTraders(MerchantsSyncSettings $merchantsSyncSettings)
    {
        $em = $this->doctrine->getManager();

        $syncedTradersRepo = $this->doctrine->getRepository('System:SyncedTraders');

        $current_sync = $merchantsSyncSettings->getLastSyncDate();
        $current_sync->setTimestamp($current_sync->getTimestamp() + ($merchantsSyncSettings->getSyncInterval() * Date::MINUTE));
        $last_sync = NULL;
        $traders = $this->adapters
            ->getAdapter($merchantsSyncSettings->getMerchant())
            ->getTraders([ 'from' => $current_sync->format('Y-m-d H:i:s') ]);

        $traders = Arr::get($traders, 'traders');

        if ( ! $traders) return;
        foreach($traders as $api_trader)
        {
            $duplicate = $syncedTradersRepo
                ->findOneBy([ 'merchant' => $merchantsSyncSettings->getMerchant(), 'originId' => Arr::get($api_trader, 'id') ]);

            if ($duplicate) continue;

            $trader = new SyncedTraders();
            $trader
                ->setMerchant($merchantsSyncSettings->getMerchant())
                ->setOriginId(Arr::get($api_trader, 'id'))
                ->setRegistrationDate(Arr::get($api_trader, 'registration_date'))
                ->setFtdDate(Arr::get($api_trader, 'ftd_date'))
                ->setBalance(Arr::get($api_trader, 'balance'))
                ->setName(Arr::get($api_trader, 'first_name').' '.Arr::get($api_trader, 'last_name') ?: NULL)
                ->setSyncedDate(new \DateTime());
            
            $last_sync = Arr::get($api_trader, 'registration_date');
            $em->persist($trader);
        }

        $merchantsSyncSettings->setLastSyncDate($last_sync ?: $merchantsSyncSettings->getLastSyncDate());
        $em->persist($merchantsSyncSettings);

        $em->flush();
    }

    public function syncAllTraders()
    {
        $merchantsSyncSettings = $this->doctrine->getRepository('System:MerchantsSyncSettings')->findAll();

        foreach($merchantsSyncSettings as $merchantsSyncSetting)
        {
            $this->syncMerchantTraders($merchantsSyncSetting);
        }
    }
}