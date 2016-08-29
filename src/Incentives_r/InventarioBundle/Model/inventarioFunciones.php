<?php

// src/My/RecipesBundle/Model/LastRecipes.php
namespace Incentives\InventarioBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;
use Incentives\InventarioBundle\Entity\InventarioHistorico;
use Doctrine\ORM\EntityManager;

class inventarioFunciones
{
    private $repository;
    protected $emg;

    public function __construct(EntityManager $entityManager) {
        $this->emg = $entityManager;
    }

    public function insertar($inventario)
    {
        $inventarioH = new InventarioHistorico();

  		$inventarioH->setInventario($inventario);
  		$inventarioH->setRedencion($inventario->getRedencion());
  		$inventarioH->setProducto($inventario->getProducto());
  		$inventarioH->setPlanilla($inventario->getPlanilla());
  		$inventarioH->setSalio($inventario->getSalio());
  		$inventarioH->setOrden($inventario->getOrden());
  		$inventarioH->setIngreso($inventario->getIngreso());
  		$inventarioH->setFechaEntrada($inventario->getFechaEntrada());
  		$inventarioH->setFechaSalida($inventario->getFechaSalida());
  		$inventarioH->setFechaModificacion($inventario->getFechaModificacion());
  		$inventarioH->setUsuario($inventario->getUsuario());
  		$inventarioH->setObservacion($inventario->getObservacion());
  		$inventarioH->setCodigo($inventario->getCodigo());
  		$inventarioH->setOrdenProducto($inventario->getOrdenProducto());
  		$inventarioH->setValorCompra($inventario->getValorCompra());

        $this->emg->persist($inventarioH);
        $this->emg->flush();
    }
}

?>
