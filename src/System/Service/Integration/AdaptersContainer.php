<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 10/05/2016
 * Time: 12:37
 */

namespace System\Service\Integration;

use Doctrine\Bundle\DoctrineBundle\Registry;
use System\Service\Integration\Adapters\AdapterBase;

class AdaptersContainer {

    private $container;

    public function __construct($container)
    {
        $this->container = $container;

    }

    /**
     * @param $merchant
     * @return AdapterBase
     */
    public function getAdapter($merchant)
    {
        return $this->container
            ->get('adapters.'.$merchant->getIntegration()->getAdapter())
            ->setMerchant($merchant);
    }
}