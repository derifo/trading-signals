<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 15/05/2016
 * Time: 11:33
 */

namespace System\Service\Merchants;

use Doctrine\Bundle\DoctrineBundle\Registry;
use System\Entity\Merchants;
use System\Entity\MerchantsSignals;
use System\Entity\Signals;
use System\Entity\Traders;
use System\Entity\Trades;
use System\Helpers\Arr;
use System\Service\Integration\AdaptersContainer;

class Promotion {

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

    public function SyncTradersPromotions()
    {
        $merchants = $this->doctrine->getRepository('System:Merchants')
            ->findBy([ 'active' => 1 ]);

        /**
         * @var $merchant Merchants
         */
        foreach($merchants as $merchant)
        {
            $traders = $this->adapters
                ->getAdapter($merchant)
                ->getTraders([ 'from' => '5 days ago' ]);

            $traders = Arr::get($traders, 'traders');

            print_r($traders[0]); die;
        }
    }

    public function getTraderPromotion($merchant_trader_id)
    {
        
    }
}