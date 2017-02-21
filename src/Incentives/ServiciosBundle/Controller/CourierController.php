<?php

namespace Incentives\ServiciosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

class CourierController extends Controller
{

// obtiene el valor de un parámetro $_GET
        $parametros = $request->query->get('parametros');
        $parametros = json_decode(urldecode($parametros));

        $idCatalogo = $parametros->catalogo;

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();            
        $qb->select('c.id,c.nombre');
        $qb->from('IncentivesCatalogoBundle:Premios','pr');
        $qb->leftJoin('pr.categoria', 'c');
        $str_filtro = 'pr.estado = 1 AND pr.aproboOperaciones = 1 AND pr.aproboComercial = 1 AND pr.aproboDirector = 1 AND pr.aproboCliente = 1 AND pr.catalogos = :id_catalogo';
        $qb->where($str_filtro);
        $qb->groupBy('c.id');
        $qb->setParameter('id_catalogo', $idCatalogo);

        $categorias = $qb->getQuery()->getResult();

        $listado = json_encode($categorias);

        echo $listado;
      
        $response = new Response();
        return $response->send();

}

