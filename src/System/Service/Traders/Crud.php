<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 15/05/2016
 * Time: 11:33
 */

namespace System\Service\Traders;

use Doctrine\Bundle\DoctrineBundle\Registry;
use System\Entity\Merchants;
use System\Entity\MerchantsSignals;
use System\Entity\Signals;
use System\Entity\Traders;
use System\Entity\Trades;
use System\Helpers\Arr;
use System\Helpers\Date;
use System\Service\BaseCrud;
use System\Service\Integration\AdaptersContainer;

class Crud extends BaseCrud {

    const ENTITY = 'System:Traders';

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
        parent::__construct($doctrine);

        $this->doctrine = $doctrine;
        $this->adapters = $adapters;
    }

    public function getTradersByMerchant($merchant, array $filters = [], array $settings = [])
    {
        return $this->doctrine
            ->getRepository(self::ENTITY)
            ->getTradersByMerchant($merchant, $filters, $settings);
    }


    public function getTradersBreakdown($merchant, array $filters = [], array $settings = [])
    {
        return $this->doctrine
            ->getRepository(self::ENTITY)
            ->getTradersBreakdown($merchant, $filters, $settings);
    }

    public function updateBalance(Traders $trader)
    {
        $merchant_trader = $trader->getMerchantTrader();

        $em = $this->doctrine->getManager();

        $results = $this->adapters
            ->getAdapter($merchant_trader->getMerchant())
            ->getTrader($merchant_trader->getOriginId());

        $merchant_trader->setBalance(Arr::get($results, 'balance', $merchant_trader->getBalance()));

        $em->persist($merchant_trader);
        $em->flush();
    }
}