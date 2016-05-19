<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 15/05/2016
 * Time: 11:33
 */

namespace System\Service\Signals;

use Doctrine\Bundle\DoctrineBundle\Registry;
use System\Entity\MerchantsSignals;
use System\Entity\Signals;
use System\Helpers\Arr;
use System\Helpers\Date;
use System\Service\Integration\AdaptersContainer;

class Archive {

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

    public function archiveAllOpenTrades()
    {
        $em = $this->doctrine->getManager();

        $signals = $this->doctrine->getRepository('System:Signals')
            ->findBy([ 'active' => 1 ]);

        /**
         * @var $signal Signals
         */
        foreach($signals as $signal)
        {
            $max_timestamp = $signal->getMaxExpires()->getTimestamp() + ($signal->getExpiresFlexAfter() * Date::MINUTE);
            if ($max_timestamp > time())
            {
                $signal->setActive(0);
                $em->persist($signal);
            }
        }

        $em->flush();
    }
}