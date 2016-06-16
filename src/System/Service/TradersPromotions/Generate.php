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
use System\Entity\MerchantsTraders;
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

    public function generateCode($trader, $deal, $verify = TRUE, $flush = TRUE)
    {
        if (is_numeric($trader))
        {
            /**
             * @var $trader MerchantsTraders
             */
            $trader = $this->doctrine
                ->getRepository('System:MerchantsTraders')
                ->find($trader);

            if ( ! $trader) return NULL;
        }


        if (is_numeric($deal))
        {
            /**
             * @var $deal Deals
             */
            $deal = $this->doctrine
                ->getRepository('System:Deals')
                ->find($deal);

            if ( ! $deal) return NULL;
        }


        $code = $trader->getOriginId().$trader->getMerchant()->getTag().$deal->getId();

        $code = md5($code);

        if ($verify)
        {
            $traderPromotion = $this->doctrine
                ->getRepository('System:TradersPromotions')
                ->findOneBy([ 'promotionCode' => $code, 'used' => 0 ]);

            if ($traderPromotion) return $traderPromotion->getPromotionCode();
        }

        $traderPromotion = new TradersPromotions();

        $traderPromotion
            ->setDeal($deal)
            ->setMerchantTrader($trader)
            ->setPromotionCode($code)
            ->setUsed(0)
            ->setCreated(new \DateTime());

        $em = $this->doctrine->getManager();
        $em->persist($traderPromotion);

        if ($flush)
        {
            $em->flush();
        }

        return $code;
    }

    public function generateCodes($synced_trader_ids, $deal_id, $merchant_id = NULL)
    {
        if ( ! $synced_trader_ids && $merchant_id)
        {
            $synced_trader_ids = $this->doctrine
                ->getRepository('System:MerchantsTraders')
                ->findBy([ 'merchant' => $merchant_id ]);
        }

        $deal_id = $this->doctrine->getRepository('System:Deals')->find($deal_id);

        $synced_trader_ids = $this->sanitizeTradersByDeal($synced_trader_ids);

        $codes = [];
        foreach($synced_trader_ids as $synced_trader_id)
        {
            $codes[] = [
                'synced_trader_id' => is_numeric($synced_trader_id) ? $synced_trader_id : $synced_trader_id->getId(),
                'code' => $this->generateCode($synced_trader_id, $deal_id, FALSE, FALSE)
            ];
        }

        $this->doctrine->getManager()->flush();

        return $codes;
    }

    public function sanitizeTradersByDeal(array $synced_trader_ids)
    {
        return $synced_trader_ids;
    }
}