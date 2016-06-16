<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 15/05/2016
 * Time: 11:33
 */

namespace System\Service\Trades;

use Doctrine\Bundle\DoctrineBundle\Registry;
use System\Entity\Merchants;
use System\Entity\MerchantsSignals;
use System\Entity\Signals;
use System\Entity\Traders;
use System\Entity\Trades;
use System\Helpers\Arr;
use System\Helpers\Date;
use System\Service\Integration\AdaptersContainer;

class Archive {

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

        $trades = $this->doctrine->getRepository('System:Trades')
            ->findBy([ 'tradeStatus' => 1 ]);

        $win_status = $this->doctrine->getRepository('System:TradesStatuses')
            ->find(2);

        $lose_status = $this->doctrine->getRepository('System:TradesStatuses')
            ->find(3);

        /**
         * @var $trade Trades
         */
        foreach($trades as $trade)
        {
            if($trade->getExpiryDate()->getTimestamp() < time())
            {
                $merchant_trade = $this->adapters
                    ->getAdapter($trade->getTrader()->getMerchantTrader()->getMerchant())
                    ->getTrade($trade->getMerchantTradeId());

                if (Arr::get($merchant_trade, 'trade_status') == 'won')
                {
                    $trade->setTradeStatus($win_status);
                }
                else if (Arr::get($merchant_trade, 'trade_status') == 'lost')
                {
                    $trade->setTradeStatus($lose_status);
                }
                else
                {
                    return;
                }

                $trade->setPayout(Arr::get($merchant_trade, 'payout'));
                $em->persist($trade);
            }
        }

        $em->flush();
    }
}