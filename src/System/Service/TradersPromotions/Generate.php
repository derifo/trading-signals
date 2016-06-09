<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 15/05/2016
 * Time: 11:33
 */

namespace System\Service\TradersPromotions;

use Doctrine\Bundle\DoctrineBundle\Registry;
use System\Entity\Deals;
use System\Entity\SyncedTraders;
use System\Entity\TradersPromotions;

class Generate {

    /**
     * @var $doctrine Registry
     */
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function generateCode($synced_trader_id, $deal_id)
    {
        /**
         * @var $trader SyncedTraders
         */
        $trader = $this->doctrine
            ->getRepository('System:SyncedTraders')
            ->find($synced_trader_id);

        if ( ! $trader) return 'MISSING OR INVALID TRADER';
        /**
         * @var $deal Deals
         */
        $deal = $this->doctrine
            ->getRepository('System:Deals')
            ->find($deal_id);

        $code = $trader->getOriginId().$trader->getMerchant()->getTag().$deal->getId();
        $code = md5($code);

        $traderPromotion = $this->doctrine
            ->getRepository('System:TradersPromotions')
            ->findOneBy([ 'promotionCode' => $code, 'used' => 0 ]);

        if ( ! $traderPromotion)
        {
            $traderPromotion = new TradersPromotions();

            $traderPromotion
                ->setDeal($deal)
                ->setSyncedTrader($trader)
                ->setPromotionCode($code)
                ->setUsed(0)
                ->setCreated(new \DateTime());

            $em = $this->doctrine->getManager();
            $em->persist($traderPromotion);
            $em->flush();
        }

        return $code;
    }

    public function generateCodes(array $synced_trader_ids, $deal_id)
    {
        $synced_trader_ids = $this->sanitizeTradersByDeal($synced_trader_ids);

        $codes = [];
        foreach($synced_trader_ids as $synced_trader_id)
        {
            $codes[] = [
                'synced_trader_id' => $synced_trader_id,
                'code' => $this->generateCode($synced_trader_id, $deal_id)
            ];
        }

        return $codes;
    }

    public function sanitizeTradersByDeal(array $synced_trader_ids)
    {
        return $synced_trader_ids;
    }
}