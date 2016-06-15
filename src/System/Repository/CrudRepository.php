<?php
namespace System\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use System\Helpers\Arr;

class CrudRepository extends EntityRepository {

    /**
     * @param $trader_id
     * @return array
     */
    public function crudFindAll($filters, $settings)
    {
        $qb = $this->createQueryBuilder('entity');

        $this->addFilters($qb, $filters);
        $this->addSettings($qb, $settings);

        return $qb->getQuery()->execute();
    }

    protected function addFilters(QueryBuilder &$qb, array $filters = [])
    {
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
    }
    
    protected function addSettings(QueryBuilder &$qb, array $settings = [])
    {
        if (Arr::get($settings, 'limit'))
        {
            $qb->setMaxResults(Arr::get($settings, 'limit'));
        }

        if (Arr::get($settings, 'offset'))
        {
            $qb->setFirstResult(Arr::get($settings, 'offset'));
        }

        if (Arr::get($settings, 'order') && is_array(Arr::get($settings, 'order')))
        {
            $order = Arr::get($settings, 'order');

            if ($this->eligibleField(Arr::get($order, 0)))
            {
                $qb->addOrderBy('entity.'.Arr::get($order, 0), Arr::get($order, 1, 'ASC'));
            }
        }
    }

    private function eligibleField($field)
    {
        $fields = $this->getClassMetadata()->fieldMappings;

        return Arr::get($fields, $field);
    }
}