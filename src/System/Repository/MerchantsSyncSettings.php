<?php
namespace System\Repository;

use Doctrine\ORM\EntityRepository;
use System\Helpers\Arr;

class MerchantsSyncSettings extends CrudRepository {

    public function findByActiveMerchants()
    {
        $qb = $this->createQueryBuilder('entity');

        $qb->innerJoin('System:Merchants', 'm', 'WITH', 'm.id = entity.merchant')
            ->andWhere('m.active = 1');

        return $qb->getQuery()->execute();
    }
}