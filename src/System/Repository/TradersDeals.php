<?php
namespace System\Repository;

use Doctrine\ORM\EntityRepository;
use System\Helpers\Arr;

class TradersDeals extends CrudRepository {

    public function getTraderDealsBreakdown($trader = NULL)
    {
        $qb = $this->createQueryBuilder('entity');

        $qb->select([
            'entity.id',
            'deals.title as deal',
            'entity.dealStarted',
            'entity.dealExpires',
            'deals.monthlyFee',
            'deals.signalCost',
            'COUNT(DISTINCT trades.id) as total_trades',
            'SUM(DISTINCT trades.amount) as total_amount',
            'traders_deals_statuses.id as deal_status_id',
            'traders_deals_statuses.title as deal_status'
        ]);

        $qb->innerJoin('System:Deals', 'deals', 'WITH', 'entity.deal = deals.id');
        $qb->leftJoin('System:Trades', 'trades', 'WITH', 'trades.traderDeal = entity.id');
        $qb->innerJoin('System:TradersDealsStatuses', 'traders_deals_statuses', 'WITH', 'traders_deals_statuses.id = entity.traderDealStatus');

        $qb->groupBy('entity.id');

        $qb->addOrderBy('entity.traderDealStatus', 'ASC');
        $qb->addOrderBy('entity.dealExpires', 'ASC');

        $qb->andWhere('entity.trader = :trader')
            ->setParameter('trader', $trader);

        return $qb->getQuery()->getArrayResult();
    }
}