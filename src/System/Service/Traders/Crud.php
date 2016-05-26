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

    public function updateBalance(Traders $trader)
    {
        $em = $this->doctrine->getManager();

        $results = $this->adapters
            ->getAdapter($trader->getMerchant())
            ->getTrader($trader->getOriginId());

        $trader->setBalance(Arr::get($results, 'balance', $trader->getBalance()));

        $em->persist($trader);
        $em->flush();
    }
}