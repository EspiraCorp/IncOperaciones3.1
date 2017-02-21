<?php

namespace Incentives\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\CatalogoBundle\Entity\Programa;
use Incentives\CatalogoBundle\Form\Type\ProgramaType;
use Incentives\CatalogoBundle\Entity\Catalogos;
use Incentives\CatalogoBundle\Entity\Intervalos;
use Incentives\CatalogoBundle\Entity\Promociones;
use Incentives\CatalogoBundle\Form\Type\IntervalosType;
use Incentives\CatalogoBundle\Form\Type\CatalogosType;
use Incentives\CatalogoBundle\Form\Type\CatalogosnuevoType;
use Incentives\CatalogoBundle\Form\Type\ProductoType;
use Incentives\CatalogoBundle\Form\Type\PromocionesType;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Cell_DataValidation;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Style_Fill;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PromocionesController extends Controller
{

    public function nuevoAction(Request $request, $premio)
    {
        $em = $this->getDoctrine()->getManager();
        $promocion = new Promociones();
        $form = $this->createForm(PromocionesType::class);      
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $pro= $request->request->all()['promociones'];
                //print_r($pro); exit;

                $premio = $em->getRepository('IncentivesCatalogoBundle:Premios')->find($premio);
                $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);

                $promocion->setNombre($pro['nombre']);
                $promocion->setDescripcion($pro['descripcion']);
                $promocion->setCantidad($pro['cantidad']);
                $promocion->setDisponibles($pro['cantidad']);
                $promocion->setPuntos($pro['puntos']);
                $promocion->setFechaInicio(new \DateTime($pro['fechaInicio']));
                $promocion->setFechaFin(new \DateTime($pro['fechaFin']));
                $promocion->setPremio($premio);
                $promocion->setEstado($estado);

                $em->persist($promocion);

                $em->flush();

                return $this->redirect($this->generateUrl('promociones_datos').'/'.$promocion->getId());
            }
        }          
        
        return $this->render('IncentivesCatalogoBundle:Promociones:nuevo.html.twig', array(
                'form' => $form->createView(), 'premio'=>$premio ));
    }

    public function editarAction(Request $request, $promocion)
    {
        $em = $this->getDoctrine()->getManager();
        $promocion = $em->getRepository('IncentivesCatalogoBundle:Promociones')->find($promocion);
        $form = $this->createForm(PromocionesType::class, $promocion);      
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $pro= $request->request->all()['promociones'];
                //print_r($pro); exit;

                $promocion->setNombre($pro['nombre']);
                $promocion->setDescripcion($pro['descripcion']);
                $promocion->setCantidad($pro['cantidad']);
                $promocion->setPuntos($pro['puntos']);
                $disponibles = $pro['cantidad'] - $promocion->getRedimidos();;
                $promocion->setDisponibles($disponibles);
                $promocion->setFechaInicio(new \DateTime($pro['fechaInicio']));
                $promocion->setFechaFin(new \DateTime($pro['fechaFin']));

                $em->persist($promocion);

                $em->flush();

                return $this->redirect($this->generateUrl('promociones_datos').'/'.$promocion->getId());
            }
        }          
        
        return $this->render('IncentivesCatalogoBundle:Promociones:editar.html.twig', array(
                'form' => $form->createView(), 'promocion'=>$promocion ));
    }

    public function datosAction($promocion)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQueryBuilder()
                ->select('promo','pr','prp','p','ct','e') 
                ->from('IncentivesCatalogoBundle:Promociones', 'promo')
                ->leftJoin('promo.premio','pr')
                ->leftJoin('pr.premiosproductos','prp')
                ->leftJoin('prp.producto','p')
                ->leftJoin('pr.catalogos','ct')
                ->leftJoin('promo.estado','e')
                ->where('promo.id='.$promocion);

        $promocion = $query->getQuery()->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        //echo "<pre>"; print_r($promocion); echo "</pre>"; exit;
        return $this->render('IncentivesCatalogoBundle:Promociones:datos.html.twig', 
            array('promocion' => $promocion));
    }


    public function listadoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Catalogos');

        $listado= $repository->findAll();

        $query = $em->createQueryBuilder()
                ->select('c','p','cl') 
                ->from('IncentivesCatalogoBundle:Catalogos', 'c')
                ->leftJoin('c.programa','p')
                ->leftJoin('p.cliente','cl')
                ->orderBy("c.id");

        if ($this->get('security.authorization_checker')->isGranted('ROLE_CLI')) {
            $cliente =  $this->getUser()->getCliente()->getId();
            $condicion = " cl.id=".$cliente;
            $query->where($condicion);
        }

        $listado = $query->getQuery()->getResult();

        return $this->render('IncentivesCatalogoBundle:Catalogos:listado.html.twig', 
            array('listado' => $listado));
    }


    public function listadoCatalogoAction($catalogo)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQueryBuilder()
                ->select('promo','pr','prp','p','e') 
                ->from('IncentivesCatalogoBundle:Promociones', 'promo')
                ->leftJoin('promo.premio','pr')
                ->leftJoin('pr.premiosproductos','prp')
                ->leftJoin('prp.producto','p')
                ->leftJoin('promo.estado','e')
                ->orderBy("promo.estado");

        $promociones = $query->getQuery()->getResult();

        return $this->render('IncentivesCatalogoBundle:Promociones:listadoCatalogo.html.twig', 
            array('promociones' => $promociones, 'catalogo' => $catalogo));
    }

    public function estadoAction($promocion)
    {
        $em = $this->getDoctrine()->getManager();

        $promocion = $em->getRepository('IncentivesCatalogoBundle:Promociones')->find($promocion);

        if ($promocion->getEstado()->getId() == 1){
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(2);
            $promocion->setEstado($estado);
            
        }else{

            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
            $promocion->setEstado($estado);
        
        }

        $em->persist($promocion);
        $em->flush();
       
        return $this->redirect($this->generateUrl('promociones_datos').'/'.$promocion->getId());
    }
    
}

