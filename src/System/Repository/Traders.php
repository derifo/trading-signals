<?php
namespace System\Repository;

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

}