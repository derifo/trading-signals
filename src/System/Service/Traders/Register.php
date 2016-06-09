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

    public function __construct(Registry $doctrine, $encoder)
    {
        $this->doctrine = $doctrine;
        $this->encoder = $encoder;
    }

    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function register()
    {
        /**
         * @var $promotion TradersPromotions
         */
        $promotion = $this->doctrine
            ->getRepository('System:TradersPromotions')
            ->findOneBy([ 'used' => 0, 'code' => Arr::get($this->data, 'code') ]);

        if ( ! $promotion) throw new PreconditionFailedHttpException('Invalid Promotion Code');

        $synced_trader = $promotion->getSyncedTrader();
        $trader = $this->doctrine->getRepository('System:Traders')
            ->findOneBy([
                'originId' => $synced_trader->getOriginId(),
                'merchant' => $synced_trader->getMerchant()
            ]);

        if ($trader) throw new PreconditionFailedHttpException('Duplicate Registration');

        $trader = new Traders();

        $encoded_password = $this->encoder->encodePassword($trader, Arr::get($this->data, 'password'));

        $trader
            ->setBalance($synced_trader->getBalance())
            ->setActive(1)
            ->setCountry(NULL)
            ->setMerchant($synced_trader->getMerchant())
            ->setEmail(Arr::get($this->data, 'email'))
            ->setPassword($encoded_password)
            ->setCreated(new \DateTime());

        $em = $this->doctrine->getManager();

        $em->persist($trader);
        $em->flush();

        return [
            'status' => 1,
            'trader' => $trader
        ];
    }
}