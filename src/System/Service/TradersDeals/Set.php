<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 15/05/2016
 * Time: 11:33
 */

namespace System\Service\TradersDeals;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;
use System\Entity\Deals;
use System\Entity\Traders;
use System\Entity\TradersDeals;
use System\Entity\TradersPromotions;
use System\Helpers\Arr;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use System\Helpers\Date;

class Set {

    /**
     * @var $doctrine Registry
     */
    private $doctrine;
    

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function addDealToTraders($traders, $deal)
    {
        $traders = $this->doctrine
            ->getRepository('System:Traders')
            ->findBy([ 'id' => $traders ]);

        /**
         * @var $trader Traders
         */
        foreach($traders as $trader)
        {
            $this->addDealToTrader($trader, $deal);
        }

        return [
            'status' => 1
        ];
    }

    public function addDealToTrader($trader, $deal)
    {
        /**
         * @var $trader Traders
         */
        if (is_numeric($trader))
        {
            $trader = $this->doctrine
                ->getRepository('Traders:System')
                ->find($trader);
        }

        /**
         * @var $deal Deals
         */
        if (is_numeric($deal))
        {
            $deal = $this->doctrine
                ->getRepository('System:Deals')
                ->find($deal);
        }

        $em = $this->doctrine->getManager();
        $traders_deals_statuses_repo = $this->doctrine->getRepository('System:TradersDealsStatuses');

        $trader_deals = $this->doctrine
            ->getRepository('System:TradersDeals')
            ->findBy([ 'trader' => $trader ]);

        $trader_deal = new TradersDeals();

        /**
         * @var $start \DateTime
         */
        $start = $this->getLastDealExpires($trader_deals);

        $expires = clone $start;
        $expires = $expires->setTimestamp($expires->getTimestamp() + Date::DAY * $deal->getDuration());

        $trader_deal
            ->setDeal($deal)
            ->setTrader($trader)
            ->setDealStarted($start)
            ->setDealExpires($expires)
            ->setTraderDealStatus($traders_deals_statuses_repo->find($this->hasActiveDeal($trader_deals) ? 2 : 1));

        $em->persist($trader_deal);
        $em->flush();

        return [
            'trader' => $trader,
            'deal' => $deal,
            'trader_deal' => $trader_deal
        ];
    }

    private function hasActiveDeal($tradersDeals)
    {
        /**
         * @var $traderDeal TradersDeals
         */
        foreach($tradersDeals as $traderDeal)
        {
            if ($traderDeal->getTraderDealStatus()->getId() == 1)
            {
                return TRUE;
            }
        }

        return FALSE;
    }

    private function getLastDealExpires($tradersDeals)
    {
        $lastExpires = new \DateTime();
        /**
         * @var $traderDeal TradersDeals
         */
        foreach($tradersDeals as $traderDeal)
        {
            if ($traderDeal->getDealExpires()->getTimestamp() > $lastExpires->getTimestamp())
            {
                $lastExpires = $traderDeal->getDealExpires();
            }
        }

        return $lastExpires;
    }
}