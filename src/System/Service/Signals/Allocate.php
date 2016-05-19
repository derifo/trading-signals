<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 15/05/2016
 * Time: 11:33
 */

namespace System\Service\Signals;

use Doctrine\Bundle\DoctrineBundle\Registry;
use System\Entity\Assets;
use System\Entity\Merchants;
use System\Entity\MerchantsSignals;
use System\Entity\Signals;
use System\Helpers\Arr;
use System\Service\Integration\Adapters\AdapterBase;
use System\Service\Integration\AdaptersContainer;

class Allocate {

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

    public function allocateAll()
    {
        date_default_timezone_set('UTC');

        $signals = $this->doctrine->getRepository('System:Signals')->findBy([ 'active' => 1 ]);
        $merchants = $this->doctrine->getRepository('System:Merchants')->findBy([ 'active' => 1 ]);
        $em = $this->doctrine->getManager();

        /**
         * @var $merchant Merchants
         */
        foreach($merchants as $merchant)
        {
            /**
             * @var $signal Signals
             */
            foreach($signals as $signal)
            {
                /**
                 * @var $asset Assets
                 */
                $asset = $signal->getAsset();

                /**
                 * @var $adapter AdapterBase
                 */
                $adapter = $this->adapters->getAdapter($merchant);

                $expiry_timestamp = $signal->getMaxExpires()->getTimestamp();
                $expiry_timestamp += $signal->getExpiresFlexAfter() * 60;

                $filters = [
                    'max_expires' => date('Y-m-d H:i:s', $expiry_timestamp)
                ];

                $options = $adapter->getOptions($asset->getTitle(), $filters);
                $options_index = [];
                foreach($options as $option)
                {
                    $close_rate = $signal->getMaxExpires()->getTimestamp() - $option['expires'];
                    $close_rate = round($close_rate / 60);

                    if ($close_rate > 0 && $signal->getExpiresFlexBefore() > $close_rate)
                    {
                        // Valid option
                        $options_index[$close_rate] = $option;
                    }
                    else if ($close_rate < 0 && $signal->getExpiresFlexAfter() > ($close_rate * -1))
                    {
                        // Valid option
                        $options_index[$close_rate * -1] = $option;
                    }
                }

                ksort($options_index);
                $option = Arr::get(array_values($options_index), 0);

                if ($option)
                {
                    $merchant_signal = $this->doctrine->getRepository('System:MerchantsSignals')
                        ->findOneBy([ 'signal' => $signal, 'merchant' => $merchant, 'active' => 1 ]);

                    if ( ! $merchant_signal)
                    {
                        $merchant_signal = new MerchantsSignals();
                    }

                    $date = new \DateTime();
                    $date->setTimestamp($option['expires']);
                    $merchant_signal
                        ->setMerchant($merchant)
                        ->setSignal($signal)
                        ->setMerchantOptionId($option['option_id'])
                        ->setExpires($date)
                        ->setActive(1)
                        ->setCreated(new \DateTime());

                    $em->persist($merchant_signal);
                }
            }
        }

        $em->flush();
    }
}