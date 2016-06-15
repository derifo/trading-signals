<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 15/05/2016
 * Time: 11:33
 */

namespace Traders\Service\Traders;

use Doctrine\Bundle\DoctrineBundle\Registry;
use System\Entity\Merchants;
use System\Entity\MerchantsSignals;
use System\Entity\Signals;
use System\Entity\Traders;
use System\Entity\Trades;
use System\Helpers\Arr;
use System\Service\Integration\AdaptersContainer;

class Statistics {

    /**
     * @var $doctrine Registry
     */
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param Traders $trader
     */
    public function getTradesStatistics(Traders $trader)
    {
        $stats = $this->doctrine->getRepository('System:Traders')
            ->getTradesStatistics($trader->getId()) ?: [];

        return array_merge([
            'balance' => $trader->getMerchantTrader()->getBalance(),
            'investment' => 0,
            'potential_profit' => 0,
            'wins'  => 0,
            'loses' => 0,
            'open'  => 0
        ], $stats);

    }
}