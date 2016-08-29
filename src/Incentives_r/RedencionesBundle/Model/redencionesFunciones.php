<?php

// src/My/RecipesBundle/Model/LastRecipes.php
namespace Incentives\RedencionesBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;
use Incentives\RedencionesBundle\Entity\RedencionesHistorico;
use Doctrine\ORM\EntityManager;

class redencionesFunciones
{
    private $repository;
    protected $emg;

    public function __construct(EntityManager $entityManager) {
        $this->emg = $entityManager;
    }

    public function insertar($redencion)
    {
        $redencionH = new RedencionesHistorico();

  		$redencionH->setParticipante($redencion->getParticipante());
        $redencionH->setProductocatalogo($redencion->getProductocatalogo());
        $redencionH->setRedencionestado($redencion->getRedencionestado());
        $redencionH->setCodigoredencion($redencion->getCodigoredencion());
        $redencionH->setFecha($redencion->getFecha());
        $redencionH->setFechaAutorizacion($redencion->getFechaAutorizacion());
        $redencionH->setFechaModificacion($redencion->getFechaModificacion());
        $redencionH->setValor($redencion->getValor());
        $redencionH->setRedencion($redencion);
        $redencionH->setOrdenesProducto($redencion->getOrdenesProducto());
        $redencionH->setObservacion($redencion->getObservacion());
        $this->emg->persist($redencionH);
        $this->emg->flush();
    }
}

?>
