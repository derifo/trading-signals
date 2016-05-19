<?php
namespace System\Repository;

use Doctrine\ORM\EntityRepository;
use System\Helpers\Arr;

class CrudRepository extends EntityRepository {

    /**
     * @param $trader_id
     * @return array
     */
    public function crudFindAll($filters, $settings)
    {
        $qb = $this->createQueryBuilder('entity');

        foreach($filters as $field => $value)
        {
            if (is_array($value))
            {
                $qb->andWhere('entity.'.$field.' IN :'.$field)
                    ->setParameter($field, $value);
            }
            else
            {
                $qb->andWhere('entity.'.$field.' = :'.$field)
                    ->setParameter($field, $value);
            }
        }

        if (Arr::get($settings, 'limit'))
        {
            $qb->setMaxResults(Arr::get($settings, 'limit'));
        }

        if (Arr::get($settings, 'offset'))
        {
            $qb->setFirstResult(Arr::get($settings, 'offset'));
        }

        return $qb->getQuery()->execute();
    }
}