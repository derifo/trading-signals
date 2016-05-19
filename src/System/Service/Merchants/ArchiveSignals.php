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
use System\Helpers\Arr;
use System\Helpers\Date;
use System\Service\Integration\AdaptersContainer;

class ArchiveSignals {

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

    public function archiveAllOpenTrades()
    {
        $em = $this->doctrine->getManager();

        $merchants_signals = $this->doctrine->getRepository('System:MerchantsSignals')
            ->findBy([ 'active' => 1 ]);

        /**
         * @var $merchant_signal MerchantsSignals
         */
        foreach($merchants_signals as $merchant_signal)
        {
            if ($merchant_signal->getExpires()->getTimestamp() < time())
            {
                $merchant_signal->setActive(0);
                $em->persist($merchant_signal);
            }
        }

        $em->flush();
    }
}