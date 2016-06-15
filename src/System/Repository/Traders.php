<?php
namespace System\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use System\Helpers\Arr;

class Traders extends CrudRepository {

    /**
     * @param $trader_id
     * @return array
     */
    public function getTradesStatistics($trader_id)
    {
        $qb = $this->createQueryBuilder('entity');

        $qb->select([
            'SUM(CASE WHEN t.tradeStatus = 2 THEN 1 ELSE 0 END) as wins',
            'SUM(CASE WHEN t.tradeStatus = 3 THEN 1 ELSE 0 END) as loses',
            'SUM(CASE WHEN t.tradeStatus = 1 THEN 1 ELSE 0 END) as open',
            'SUM(CASE WHEN t.tradeStatus = 1 THEN t.amount ELSE 0 END) as investment',
            'SUM(CASE WHEN t.tradeStatus = 1 THEN t.amount * t.profit / 100 ELSE 0 END) as potential_profit',
            'COUNT(t.id) as total_trades'
        ]);

        $qb->innerJoin('System:Trades', 't', 'WITH', 't.trader = entity.id')
            ->groupBy('t.trader');

        $qb->andWhere('entity.id = :trader_id')
            ->setParameter('trader_id', $trader_id);

        return Arr::get($qb->getQuery()->getArrayResult(), 0);
    }

    /**
     * @param $merchant
     * @param array $filters
     * @param array $settings
     * @return ArrayCollection
     */
    public function getTradersByMerchant($merchant, array $filters = [], array $settings = [])
    {
        $qb = $this->createQueryBuilder('entity');

        $qb->innerJoin('System:MerchantsTraders', 'mt', 'WITH', 'mt.id = entity.merchantTrader')
            ->andWhere('mt.merchant = :merchant')
            ->setParameter('merchant', is_numeric($merchant) ? $merchant : $merchant->getId());


        $this->addFilters($qb, $filters);
        $this->addFilters($qb, $settings);

        return $qb->getQuery()->execute();
    }

    /**
     * @param $merchant
     * @param array $filters
     * @param array $settings
     * @return ArrayCollection
     */
    public function getTradersBreakdown($merchant, array $filters = [], array $settings = [])
    {
        $qb = $this->createQueryBuilder('entity');

        $qb->select([
            'entity.id',
            'merchant_traders.originId as origin_id',
            'merchant_traders.name',
            'countries.title as country',
            'COUNT(DISTINCT trades.id) as total_trades',
            'SUM(DISTINCT trades.amount) as trades_amount',
            'deals.title as current_deal',
            'entity.created',
            'merchant_traders.balance',
            'traders_deals.dealExpires as deal_expires',
            'traders_deals.dealStarted as deal_started',
        ]);

        $qb->innerJoin('System:MerchantsTraders', 'merchant_traders', 'WITH', 'merchant_traders.id = entity.merchantTrader');
        $qb->leftJoin('System:Trades', 'trades', 'WITH', 'trades.trader = entity.id');
        $qb->innerJoin('System:TradersDeals', 'traders_deals', 'WITH', 'entity.id = traders_deals.trader');
        $qb->innerJoin('System:Deals', 'deals', 'WITH', 'traders_deals.deal = deals.id');
        $qb->innerJoin('System:Countries', 'countries', 'WITH', 'merchant_traders.country = countries.id');

        $qb->addGroupBy('entity.id');
        $qb->addGroupBy('trades.trader');

        $qb->andWhere('traders_deals.traderDealStatus = 1');

        $qb->andWhere('merchant_traders.merchant = :merchant')
            ->setParameter('merchant', is_numeric($merchant) ? $merchant : $merchant->getId());

        return $qb->getQuery()->getArrayResult();
    }
}

