<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 15/05/2016
 * Time: 11:33
 */

namespace System\Service\Signals;

use Doctrine\Bundle\DoctrineBundle\Registry;
use System\Entity\Merchants;
use System\Entity\MerchantsSignals;
use System\Entity\Signals;
use System\Entity\Traders;
use System\Entity\Trades;
use System\Helpers\Arr;
use System\Service\Integration\AdaptersContainer;
use System\Service\Traders\Crud;

class Buy {

    /**
     * @var $doctrine Registry
     */
    private $doctrine;

    /**
     * @var $adapters AdaptersContainer
     */
    private $adapters;

    /**
     * @var $traders_crud Crud
     */
    private $traders_crud;

    public function __construct(Registry $doctrine, AdaptersContainer $adapters, Crud $traders_crud)
    {
        $this->doctrine = $doctrine;
        $this->adapters = $adapters;
        $this->traders_crud = $traders_crud;
    }

    public function buySignal($trader_id, $signal_id, $options)
    {
        $em = $this->doctrine->getManager();

        /**
         * @var $trader Traders
         */
        $trader = $this->doctrine
            ->getRepository('System:Traders')
            ->find($trader_id);

        /**
         * @var $merchant Merchants
         */
        $merchant = $trader->getMerchant();

        /**
         * @var $signal Signals
         */
        $signal = $this->doctrine
            ->getRepository('System:Signals')
            ->find($signal_id);

        /**
         * @var $merchant_signal MerchantsSignals
         */
        $merchant_signal = $this->doctrine
            ->getRepository('System:MerchantsSignals')
            ->findOneBy([ 'merchant' => $merchant, 'signal' => $signal ]);

        $data = [
            'trader_id' => $trader->getId(),
            'option_id' => $merchant_signal->getMerchantOptionId(),
            'direction' => $signal->getDirection(),
            'amount' => Arr::get($options, 'amount', $merchant->getMinTradeAmount())
        ];

        $results = $this->adapters
            ->getAdapter($merchant)
            ->addTrade($data);
        
        if (Arr::get($results, 'status'))
        {
            $open_trade_status = $this->doctrine->getRepository('System:TradesStatuses')
                ->find(1);

            $trade = new Trades();
            $trade->setCreated(new \DateTime())
                ->setMerchantSignal($merchant_signal)
                ->setTrader($trader)
                ->setTradeStatus($open_trade_status)
                ->setMerchantTradeId(Arr::get($results, 'trade_id'))
                ->setAmount(Arr::get($data, 'amount'))
                ->setEntryRate(round(Arr::get($results, 'entry_rate', 0.00), 2))
                ->setProfit(round(Arr::get($results, 'profit')))
                ->setBuyDate(new \DateTime())
                ->setExpiryDate($merchant_signal->getExpires())
                ->setScoring($signal->getScore());

            $em->persist($trade);
            $em->flush();
        }

        // Update customer balance from the integration
        $this->traders_crud->updateBalance($trader);

        return $results;
    }
}