<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 10/05/2016
 * Time: 12:37
 */

namespace System\Service\Integration\Adapters;

use System\Helpers\Arr;
use Doctrine\Bundle\DoctrineBundle\Registry;

class SpotOptionAdapter extends AdapterBase {

    public function getTrader($trader_id)
    {
        $trader = $this->requestAPI([
            'MODULE'       => 'Customer',
            'COMMAND'      => 'view',
            'api_username' => $this->merchant->getApiParam2(),
            'api_password' => $this->merchant->getApiParam3(),
            'FILTER'     => [ 'id' => $trader_id ]
        ]);

        if($error = $this->checkError($trader))
        {
            return [
                'status' => FALSE,
                'error'  => $error
            ];
        }

        $trader = Arr::get(array_values(Arr::get($trader, 'Customer')), 0);

        return [
            'status'    => TRUE,
            'trader_id' => $trader_id,
            'balance'   => Arr::get($trader, 'accountBalance'),
        ];
    }

    public function getTraderTrades($trader_id)
    {
        $trades = $this->requestAPI([
            'MODULE'       => 'Positions',
            'Command'      => 'View',
            'api_username' => $this->merchant->getApiParam2(),
            'api_password' => $this->merchant->getApiParam3(),
            'FILTERS'     => [ 'customerId' => $trader_id ]
        ]);

        if($error = $this->checkError($trades))
        {
            return [
                'status' => FALSE,
                'error'  => $error
            ];
        }

        $trades = $this->convertTrades($trades);

        return [
            'status'    => TRUE,
            'trader_id' => $trader_id,
            'trades' => $trades
        ];
    }

    public function addTrade(array $data)
    {
        return [
            'success' => TRUE
        ];
    }

    private function convertTrades($trades)
    {
        $converted = [];
        foreach($trades as $trade)
        {
            $converted[] = $trade;
        }

        return $converted;
    }

    private function checkError($response)
    {
        if($err = Arr::get($response, 'error', Arr::get($response, 'errors')))
        {
            $err = Arr::get($err, 0, $err);

            return $err ?: 'UNKNOWN';
        }
        else
        {
            return FALSE;
        }
    }

    private function requestAPI($data)
    {
        $ch = curl_init($this->merchant->getApiParam1());

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_TIMEOUT, 6);

        $results = curl_exec($ch);
        $error = curl_error($ch);

        if ($results)
        {
            $xml = simplexml_load_string($results, "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xml);
            $results = json_decode($json,TRUE);
        }

        return $error ? [ 'error' => $error ] : $results;
    }
}