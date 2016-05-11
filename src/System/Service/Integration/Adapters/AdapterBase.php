<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 10/05/2016
 * Time: 12:37
 */

namespace System\Service\Integration\Adapters;

use Doctrine\Bundle\DoctrineBundle\Registry;

abstract class AdapterBase {

    protected $doctrine;

    protected $merchant;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public final function setMerchant($merchant)
    {
        if(is_numeric($merchant))
        {
            $merchant = $this->doctrine->getRepository('System:Merchants')
                ->find($merchant);
        }

        $this->merchant = $merchant;

        return $this;
    }

    public function getTrader($trader_id) {}

    public function getTraderTrades($trader_id) {}

    public function addTrade(array $data) {}
}