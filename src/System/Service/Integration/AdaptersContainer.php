<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 10/05/2016
 * Time: 12:37
 */

namespace System\Service\Integration;

use Doctrine\Bundle\DoctrineBundle\Registry;

class AdaptersContainer {

    private $container;

    public function __construct($container)
    {
        $this->container = $container;

    }

    public function getAdapter($merchant)
    {
        return $this->container
            ->get('adapters.'.$merchant->getIntegration()->getAdapter())
            ->setMerchant($merchant);
    }
}