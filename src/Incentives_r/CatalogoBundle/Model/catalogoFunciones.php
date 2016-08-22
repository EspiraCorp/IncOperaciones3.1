<?php

// src/My/RecipesBundle/Model/LastRecipes.php
namespace Incentives\CatalogoBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;
use Incentives\CatalogoBundle\Entity\ProductocatalogoHistorico;
use Doctrine\ORM\EntityManager;

class catalogoFunciones
{
    private $repository;
    protected $emg;

    public function __construct(EntityManager $entityManager) {
        $this->emg = $entityManager;
    }

    public function historico($premio)
    {
        $premioH = new ProductocatalogoHistorico();

  		$premioH->setProductocatalogo($premio);
  		$premioH->setActivo($premio->getActivo());
  		$premioH->setAgotado($premio->getAgotado());
  		$premioH->setProducto($premio->getProducto());
  		$premioH->setCatalogos($premio->getCatalogos());
  		$premioH->setCategoria($premio->getCategoria());

  		$premioH->setPuntos($premio->getPuntos());
  		$premioH->setPrecio($premio->getPrecio());
  		$premioH->setIncremento($premio->getIncremento());
  		$premioH->setLogistica($premio->getLogistica());
  		
  		$premioH->setPuntosTemporal($premio->getPuntosTemporal());
  		$premioH->setPrecioTemporal($premio->getPrecioTemporal());
  		$premioH->setIncrementoTemporal($premio->getIncrementoTemporal());
  		$premioH->setLogisticaTemporal($premio->getLogisticaTemporal());
  		
  		$premioH->setAproboOperaciones($premio->getAproboOperaciones());
  		$premioH->setAproboComercial($premio->getAproboComercial());
  		$premioH->setAproboDirector($premio->getAproboDirector());
  		$premioH->setAproboCliente($premio->getAproboCliente());
  		
  		$premioH->setOperacionesUsuario($premio->getOperacionesUsuario());
  		$premioH->setComercialUsuario($premio->getComercialUsuario());
  		$premioH->setDirectorUsuario($premio->getDirectorUsuario());
  		$premioH->setClienteUsuario($premio->getClienteUsuario());
  		
  		$premioH->setUsuario($premio->getUsuario());
  		$premioH->setFechaModificacion($premio->getFechaModificacion());
        
        $this->emg->persist($premioH);
        $this->emg->flush();
    }
}

?>
