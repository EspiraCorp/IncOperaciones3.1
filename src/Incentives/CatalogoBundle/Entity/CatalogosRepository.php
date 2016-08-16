<?php

namespace Incentives\CatalogoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CatalogosRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM IncentivesCatalogoBundle:Catalogos c ORDER BY c.nombre ASC')
		    ->setParameter('estado_id', '0')
            ->getResult();
    }
}

