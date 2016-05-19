<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 15/05/2016
 * Time: 11:33
 */

namespace System\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;

class BaseCrud {

    /**
     * @var $doctrine Registry
     */
    private $doctrine;

    const ENTITY = FALSE;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    
    public function findAll($filters, $settings)
    {
        return $this->doctrine->getRepository(static::ENTITY)
            ->crudFindAll($filters, $settings);
    }
    
    public function find()
    {
        
    }
    
    public function save()
    {
        
    }
    
    public function delete()
    {
        
    }
}