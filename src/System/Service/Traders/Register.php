<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 15/05/2016
 * Time: 11:33
 */

namespace System\Service\Traders;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;
use System\Entity\Traders;
use System\Entity\TradersPromotions;
use System\Helpers\Arr;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use System\Service\TradersDeals\Set;
use Traders\Security\TradersLogin;

class Register {

    /**
     * @var $doctrine Registry
     */
    private $doctrine;

    /**
     * @var $data array
     */
    private $data;

    private $encoder;

    /**
     * @var $traders_deals Set
     */
    private $traders_deals;

    /**
     * @var $traders_deals TradersLogin
     */
    private $traders_login;

    public function __construct(Registry $doctrine, $encoder, Set $traders_deals, TradersLogin $traders_login)
    {
        $this->doctrine = $doctrine;
        $this->encoder = $encoder;
        $this->traders_deals = $traders_deals;
        $this->traders_login = $traders_login;
    }

    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    public function register()
    {
        /**
         * @var $promotion TradersPromotions
         */
        $promotion = $this->doctrine
            ->getRepository('System:TradersPromotions')
            ->findOneBy([ 'used' => 0, 'promotionCode' => Arr::get($this->data, 'code') ]);

        if ( ! $promotion) throw new PreconditionFailedHttpException('Invalid Promotion Code');

        $merchant_trader = $promotion->getMerchantTrader();
        $trader = $this->doctrine->getRepository('System:Traders')
            ->findOneBy([ 'merchantTrader' => $merchant_trader ]);

        if ($trader) throw new PreconditionFailedHttpException('Duplicate Registration');

        $trader = new Traders();

        $encoded_password = $this->encoder->encodePassword($trader, Arr::get($this->data, 'password'));

        $trader
            ->setMerchantTrader($merchant_trader)
            ->setEmail(Arr::get($this->data, 'email'))
            ->setPassword($encoded_password)
            ->setCreated(new \DateTime());

        $promotion->setUsed(1);

        $em = $this->doctrine->getManager();

        $merchant_trader->setPromoted(1);

        $em->persist($trader);
        $em->persist($merchant_trader);
        $em->persist($promotion);
        $em->flush();

        $this->traders_deals->addDealToTrader($trader, $promotion->getDeal());
        $this->traders_login->setTraderToken($trader);

        return [
            'status' => 1,
            'trader' => $trader
        ];
    }
}