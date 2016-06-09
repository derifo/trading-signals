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
use System\Helpers\Date;

class SpotOptionAdapter extends AdapterBase {

    public function getTrader($trader_id)
    {
        $trader = $this->requestAPI([
            'MODULE'       => 'Customer',
            'COMMAND'      => 'view',
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

    public function getTraders(array $options = [])
    {
        $data = [
            'MODULE'       => 'Customer',
            'COMMAND'      => 'view'
        ];

        if (Arr::get($options, 'from'))
        {
            $data['FILTER']['regTime']['min'] = Arr::get($options, 'from');
        }

        if (Arr::get($options, 'to'))
        {
            $data['FILTER']['regTime']['max'] = Arr::get($options, 'to');
        }

        $traders = $this->requestAPI($data);

        if($error = $this->checkError($traders))
        {
            return [
                'status' => FALSE,
                'error'  => $error
            ];
        }

        $traders = array_values(Arr::get($traders, 'Customer'));

        foreach($traders as &$trader)
        {
            $trader = [
                'id' => Arr::get($trader, 'id'),
                'first_name' => Arr::get($trader, 'FirstName'),
                'last_name' => Arr::get($trader, 'LastName'),
                'registration_date' => new \DateTime(Arr::get($trader, 'regTime')),
                'ftd_date' => Arr::get($trader, 'firstDepositDate') == '0000-00-00 00:00:00' ? NULL
                    : new \DateTime(Arr::get($trader, 'firstDepositDate')),
                'email' => Arr::get($trader, 'email'),
                'phone' => Arr::get($trader, 'phoneNumber'),
                'is_ftd' => Arr::get($trader, 'firstDepositDate') != '0000-00-00 00:00:00' ? 1 : 0,
                'balance' => Arr::get($trader, 'accountBalance', 0)
            ];
        }

        return [
            'status'    => TRUE,
            'traders' => $traders
        ];
    }

    public function getOptions($asset, array $custom_filters)
    {
        $asset = $this->getAssets([ 'asset' => $asset ]);
        $asset = Arr::get(Arr::get($asset, 'assets'), 0);

        if ( ! $asset) return [];

        $filters = [
            'assetId' => $asset['id'],
            'VIPGroup' => 'Regular',
            'endDate' => [ 'min' => date('Y-m-d H:i:s', time() + Date::HOUR) ],
            'status' => 'open'
        ];

        if(Arr::get($custom_filters, 'max_expires'))
        {
            $filters['endDate']['max'] = date('Y-m-d H:i:s', strtotime(Arr::get($custom_filters, 'max_expires')));
        }

        $options = $this->requestAPI(array_merge($filters, [
            'MODULE'       => 'Options',
            'COMMAND'      => 'view',
            'FILTER' => $filters
        ]), 1);

        $options = array_values(Arr::get($options, 'Options', []));

        foreach($options as $k => &$option)
        {
            if ( ! Arr::get($option, 'isActive')) unset($options[$k]);

            $option = [
                'option_id' => $option['id'],
                'expires' => strtotime($option['endDate']),
                'expires_date' => date('Y-m-d H:i:s', strtotime($option['endDate']))
            ];
        }

        return $options;
    }

    public function getAssets($custom_filters = [])
    {
        $filters = [
            'isTradeable' => 1,
            'type' => [ 'currencies', 'commodities', 'indices', 'stocks', 'pairs' ]
        ];

        if (Arr::get($custom_filters, 'asset'))
        {
            $filters['name'] = Arr::get($custom_filters, 'asset');
        }

        $assets = $this->requestAPI([
            'MODULE'       => 'Assets',
            'COMMAND'      => 'view',
            'FILTER' => $filters
        ]);

        if($error = $this->checkError($assets))
        {
            return [
                'status' => FALSE,
                'error'  => $error
            ];
        }

        $assets = array_values(Arr::get($assets, 'Assets'));

        return [
            'status'    => TRUE,
            'assets'   => $assets,
        ];
    }

    public function getTraderTrades($trader_id)
    {
        $trades = $this->requestAPI([
            'MODULE'       => 'Positions',
            'Command'      => 'View',
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
        $request_data = [
            'position' => Arr::get($data, 'direction') ? 'call' : 'put',
            'customerId' => Arr::get($data, 'trader_id'),
            'optionId' => Arr::get($data, 'option_id'),
            'amount' => Arr::get($data, 'amount'),
            'MODULE'       => 'Positions',
            'COMMAND'      => 'add'
        ];

        $trade = $this->requestAPI($request_data);
        if($error = $this->checkError($trade))
        {
            return [
                'status' => FALSE,
                'error'  => $error
            ];
        }

        $trade = Arr::get($trade, 'Positions');

        return [
            'status'    => TRUE,
            'trade_id' => Arr::get($trade, 'data_id'),
            'entry_rate' => Arr::get($trade, 'data_rate'),
            'profit' => Arr::get($trade, 'data_opprofit')
        ];
    }

    public function getTrade($trade_id)
    {
        $request_data = [
            'MODULE'  => 'Positions',
            'COMMAND' => 'view',
            'FILTER'  => [ 'id' => $trade_id ]
        ];

        $trade = $this->requestAPI($request_data);

        if($error = $this->checkError($trade))
        {
            return [
                'status' => FALSE,
                'error'  => $error
            ];
        }

        $trade = Arr::get($trade, 'Positions');
        $trade = Arr::get(array_values($trade), 0);
        
        return [
            'status' => TRUE,
            'trade_status' => Arr::get($trade, 'status'),
            'payout' => Arr::get($trade, 'payout')
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
        $data = array_merge($data, [
            'jsonResponse' => 'true',
            'api_username' => $this->merchant->getApiParam2(),
            'api_password' => $this->merchant->getApiParam3(),
        ]);

        $ch = curl_init($this->merchant->getApiParam1());

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_TIMEOUT, 6);

        $results = curl_exec($ch);
        $error = curl_error($ch);

        $array_results = @json_decode($results ,TRUE);

        if ( ! $array_results)
        {
            $error = 'INVALID_JSON';
        }

        return $error ? [ 'error' => $error ] : Arr::get($array_results, 'status');
    }
}