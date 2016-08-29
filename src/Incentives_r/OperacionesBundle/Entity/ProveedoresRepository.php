<?php

namespace Incentives\OperacionesBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ProveedoresRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM IncentivesOperacionesBundle:Proveedores p ORDER BY p.nombre ASC')
            ->getResult();
    }
}