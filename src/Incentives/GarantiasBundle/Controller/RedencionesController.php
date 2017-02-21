<?php

namespace Incentives\GarantiasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\GarantiasBundle\Entity\Novedades;
use Incentives\InventarioBundle\Entity\Despachos;
use Incentives\RedencionesBundle\Entity\Redencionesenvios;
use Incentives\GarantiasBundle\Form\Type\NovedadType;
use Incentives\GarantiasBundle\Form\Type\EnvioType;
use Incentives\GarantiasBundle\Form\Type\NovedadaccionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RedencionesController extends Controller
{

    public function listadoAction()
    {
        $em = $this->getDoctrine()->getManager();

        //Consultar puntos redimidos
        $qb = $em->createQueryBuilder();            
        $qb->select('p','count(r) total','e');
        $qb->from('IncentivesCatalogoBundle:Programa','p');
        $qb->leftJoin('p.participantes', 'pt');
        $qb->leftJoin('p.estado', 'e');
        $qb->leftJoin('pt.redencion', 'r');
        $qb->groupBy('p.id');
        $programas = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        //echo "<pre>";print_r($programas); echo "</pre>";exit;  

        foreach($programas as $key => $value){
            
            $qb = $em->createQueryBuilder();            
            $qb->select('count(r) total');
            $qb->from('IncentivesRedencionesBundle:Redenciones','r');
            $qb->leftJoin('r.participante', 'pt');
            $qb->where('pt.programa='.$value[0]['id'].' AND r.redencionestado=1');
            $qb->groupBy('pt.programa');
            $pendientes = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            
        }
        
       // echo "<pre>"; print_r($programas); echo "</pre>";exit;
        
        return $this->render('IncentivesGarantiasBundle:Redenciones:listado.html.twig', 
            array('programas' => $programas));
    }

    public function listadoprogramaAction($programa)
    {
        $em = $this->getDoctrine()->getManager();
            //Consultar puntos redimidos
            $qb = $em->createQueryBuilder();            
            $qb->select('r','pr','pp','p','c','ct','envio','estado','pt');
            $qb->from('IncentivesRedencionesBundle:Redenciones','r');
            $qb->leftJoin('r.premio', 'pr');
            $qb->leftJoin('pr.premiosproductos', 'pp');
            $qb->leftJoin('pp.producto', 'p');
            $qb->leftJoin('pr.categoria', 'ct');
            $qb->leftJoin('pr.catalogos', 'c');
            $qb->leftJoin('r.participante', 'pt');
            $qb->leftJoin('r.redencionesenvios', 'envio');
            $qb->leftJoin('r.redencionestado', 'estado');
            //$qb->leftJoin('r.inventario', 'i');
            //$qb->leftJoin('i.guia', 'guia');
            //$qb->leftJoin('r.ordenesProducto', 'op');
            //$qb->leftJoin('op.ordenesCompra', 'oc');
            //$qb->leftJoin('oc.proveedor', 'pv');
            
            $str_filtro = 'pt.programa = '.$programa;
            $qb->where($str_filtro);
            $redenciones = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            $programas = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($programa);

        return $this->render('IncentivesGarantiasBundle:Redenciones:listadoprograma.html.twig', 
            array( 'programa' => $programas, 'redencion' => $redenciones));
    }

    public function datosredencionAction($redencion)
    {
        $em = $this->getDoctrine()->getManager();

        $redencionD = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($redencion);
        $datosenvio = $em->getRepository('IncentivesRedencionesBundle:Redencionesenvios')->findByRedencion($redencion);

        return $this->render('IncentivesGarantiasBundle:Redenciones:datos.html.twig', 
            array( 'datosenvio' => $datosenvio, 'redencion' => $redencionD));
    }


    public function novedadAction(Request $request, $redencion)
    {
        $em = $this->getDoctrine()->getManager();

        $novedad = new Novedades();
        $redencionD = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($redencion);
        $form = $this->createForm(NovedadType::class, $novedad);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $pro = $request->request->all()['novedad'];

                $redencionN = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($redencion);
                $novedad->setRedencion($redencionD);
                $estado = $em->getRepository('IncentivesGarantiasBundle:Novedadesestado')->find(1);
                $novedad->setEstado($estado);
                $tipo = $em->getRepository('IncentivesGarantiasBundle:Novedadestipo')->find($pro['tipo']);
                $novedad->setTipo($tipo);
                $novedad->setFecha(new \DateTime());
                $novedad->setObservacion($pro['observacion']);
                $em->persist($novedad);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'La novedad se registro correctamente.');
            }
        }            

        return $this->render('IncentivesGarantiasBundle:Redenciones:novedad.html.twig', array(
            'form' => $form->createView(),'redencion' => $redencionD,
        ));
    }

    public function novedadesaccionAction(Request $request, $novedad)
    {
        $em = $this->getDoctrine()->getManager();

        $novedadD = $em->getRepository('IncentivesGarantiasBundle:Novedades')->find($novedad);
        
        $redencionId = $novedadD->getRedencion()->getId();
        $redencionD = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($redencionId);

        $datosenvio = $em->getRepository('IncentivesRedencionesBundle:Redencionesenvios')->findByRedencion($redencionId);
        $imagen = $em->getRepository('IncentivesCatalogoBundle:Imagenproducto')->findBy(array('producto' => $redencionD->getPremio()->getPremiosProductos()[0]->getProducto()->getId(), 'estado' => 1));

        $form = $this->createForm(NovedadaccionType::class, $novedadD);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                
                $pro = $request->request->all()['novedadaccion'];
                
                $redencionN = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($redencionD->getId());
                $redencionProductosN = $em->getRepository('IncentivesRedencionesBundle:RedencionesProductos')->findByRedencion($redencionD->getId());
                $novedadD->setRedencion($redencionD);
                $tipo = $em->getRepository('IncentivesGarantiasBundle:Novedadestipo')->find($pro['accion']);
                $novedadD->setTipo($tipo);
                $novedadD->setFecha(new \DateTime());
                $novedadD->setObservacion($pro['observacionaccion']);
                
                if($pro['accion']==1){
                    $estadoN = $em->getRepository('IncentivesGarantiasBundle:Novedadesestado')->find(1);
                    $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('2');
                    $redencionN->setRedencionestado($estado);
                    $redencionProductosN[0]->setEstado($estado);
                    $em->persist($redencionN);
                    $em->persist($redencionProductosN[0]);
                }elseif($pro['accion']==2){
                    $estadoN = $em->getRepository('IncentivesGarantiasBundle:Novedadesestado')->find(2);
                    $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('4');
                    $redencionN->setRedencionestado($estado);
                    $redencionProductosN[0]->setEstado($estado);
                    $em->persist($redencionProductosN[0]);
                }

                $novedadD->setEstado($estadoN);
                $em->persist($novedadD);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'La accion a realizar se registro correctamente.');
            }
        }           

        return $this->render('IncentivesGarantiasBundle:Redenciones:novedadaccion.html.twig', array(
            'form' => $form->createView(),'redencion' => $redencionD, 'datosenvio' => $datosenvio[0], 'imagen' => $imagen
        ));
    }


    public function novedadeslistadoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $novedades = $em->getRepository('IncentivesGarantiasBundle:Novedades')->findAll();

        return $this->render('IncentivesGarantiasBundle:Redenciones:listadonovedades.html.twig', 
            array( 'novedades' => $novedades));
    }

    public function recompraslistadoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $novedades = $em->getRepository('IncentivesGarantiasBundle:Novedades')->findBy(array('estado' => 1, 'accion' => 1));

        return $this->render('IncentivesGarantiasBundle:Redenciones:listadorecompras.html.twig', 
            array( 'novedades' => $novedades));
    }

    public function aprobacionrecompraAction(Request $request, $novedad)
    {
        $em = $this->getDoctrine()->getManager();

        $novedadD = $em->getRepository('IncentivesGarantiasBundle:Novedades')->find($novedad);
        $redencionD = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($novedadD->getRedencion()->getId());          

	$qb = $em->createQueryBuilder();   
        $qb->select('i');
        $qb->from('IncentivesInventarioBundle:Inventario','i');
        $str_filtro = 'i.redencion = '.$redencionD->getId();
        $qb->where($str_filtro);
        $qb->orderBy('i.id', 'DESC');
        $qb->setMaxResults(1);
        $InventarioD = $qb->getQuery()->getOneOrNullResult();
        
        if(isset($InventarioD)){
            $InventarioD->setPlanilla(null);
            $InventarioD->setSalio(null);
            $em->persist($InventarioD);
        }    

        return $this->render('IncentivesGarantiasBundle:Redenciones:aprobacionrecompra.html.twig', array(
            'redencion' => $redencionD, 'novedad' => $novedadD
        ));
    }

    public function aprobarrecompraAction(Request $request, $novedad)
    {
        $em = $this->getDoctrine()->getManager();

        $novedadD = $em->getRepository('IncentivesGarantiasBundle:Novedades')->find($novedad);
        $redencionD = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($novedadD->getRedencion()->getId());
        $redencionProductosD = $em->getRepository('IncentivesRedencionesBundle:RedencionesProductos')->findByRedencion($novedadD->getRedencion()->getId());
                    
        $em = $this->getDoctrine()->getManager();
        // realiza alguna acción, tal como guardar la tarea en la base de datos
        $estado = $em->getRepository('IncentivesGarantiasBundle:Novedadesestado')->find(2);
        $novedadD->setEstado($estado);
        $em->persist($novedadD);

        $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('2');
        $redencionD->setRedencionestado($estado);
        $redencionProductosD[0]->setEstado($estado);

        $em->persist($redencionD);
        $em->persist($redencionProductosD[0]);
                
        $em->flush();          

        return $this->redirect($this->generateUrl('garantiasrecompras_listado'));
    }

    public function cancelarrecompraAction(Request $request, $novedad)
    {
        $em = $this->getDoctrine()->getManager();

        $novedadD = $em->getRepository('IncentivesGarantiasBundle:Novedades')->find($novedad);
        $redencionD = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($novedadD->getRedencion()->getId());
                    
        $em = $this->getDoctrine()->getManager();
        // realiza alguna acción, tal como guardar la tarea en la base de datos
        $estado = $em->getRepository('IncentivesGarantiasBundle:Novedadesestado')->find(5);
        $novedadD->setEstado($estado);
        $em->persist($novedadD);

        $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find(7);
        $redencionD->setRedencionestado($estado);
        $em->persist($redencionD);
                
         $em->flush();          

        return $this->redirect($this->generateUrl('garantiasrecompras_listado'));
    }

    public function reenvioslistadoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $novedades = $em->getRepository('IncentivesGarantiasBundle:Novedades')->findAll();

        return $this->render('IncentivesGarantiasBundle:Redenciones:listadoreenvios.html.twig', 
            array( 'novedades' => $novedades));
    }


    public function envioedicionAction(Request $request, $redencion)
    {
        $em = $this->getDoctrine()->getManager();

        //$redencionE = $em->getRepository('IncentivesRedencionesBundle:Redencionesenvios')->findBy(array("id" => $redencion), array());

    	$qb = $em->createQueryBuilder();            
    	$qb->select('r');
        $qb->from('IncentivesRedencionesBundle:Redencionesenvios','r');
        $str_filtro = 'r.redencion = '.$redencion;
        $qb->where($str_filtro);
        $qb->orderBy('r.id', 'DESC');
        $qb->setMaxResults(1);
        $redencionE = $qb->getQuery()->getOneOrNullResult();

    	$redencionD = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($redencionE->getRedencion()->getId());

        $form = $this->createForm(EnvioType::class, $redencionE);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $pro = $request->request->all()['envio'];
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                $redencionE->setCiudadNombre($pro['ciudadNombre']);
                $redencionE->setDireccion($pro['direccion']);
                $redencionE->setBarrio($pro['barrio']);
                $redencionE->setTelefono($pro['telefono']);
		        $redencionE->setCelular($pro['celular']);
	        	$redencionE->setDepartamentoNombre($pro['departamentoNombre']);

	        	$redencionE->setNombreContacto($pro['nombreContacto']);
	        	$redencionE->setDocumentoContacto($pro['documentoContacto']);
              	$redencionE->setCiudadContacto($pro['ciudadContacto']);
                $redencionE->setDireccionContacto($pro['direccionContacto']);
                $redencionE->setBarrioContacto($pro['barrioContacto']);
                $redencionE->setTelefonoContacto($pro['telefonoContacto']);
              	$redencionE->setCelularContacto($pro['celularContacto']);
              	$redencionE->setDepartamentoContacto($pro['departamentoContacto']);

                $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find("4");
                $redencionD->setRedencionestado($estado);
                
                $em->persist($redencionE);
                $em->persist($redencionD);
                
            	$qb->select('i');
                $qb->from('IncentivesInventarioBundle:Inventario','i');
                $str_filtro = 'i.redencion = '.$redencion;
                $qb->where($str_filtro);
                $qb->orderBy('i.id', 'DESC');
                $qb->setMaxResults(1);
                $InventarioD = $qb->getQuery()->getOneOrNullResult();
        
                if(isset($InventarioD)){
                    $InventarioD->setPlanilla(null);
                    $InventarioD->setSalio(null);
                    
                    $em->persist($InventarioD);
                }    
                
                //ingresar nuevo despacho
                
                //traer los datos de envio para el despacho
                $despacho = new Despachos();
                            
                //Traer los ultimos datos de envio
                $qb = $em->createQueryBuilder();            
                $qb->select('e');
                $qb->from('IncentivesRedencionesBundle:RedencionesEnvios','e');
                $str_filtro = 'e.id ='.$redencionE->getId();
                $qb->where($str_filtro);
                $datosEnvio = $qb->getQuery()->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
                    
                $despacho->setDocumento($datosEnvio['documento']);
                $despacho->setNombre($datosEnvio['nombre']);
                $despacho->setObservaciones($datosEnvio['observaciones']);
                $despacho->setCiudadNombre($datosEnvio['ciudadNombre']);
                $despacho->setDireccion($datosEnvio['direccion']);
                $despacho->setBarrio($datosEnvio['barrio']);
                $despacho->setTelefono($datosEnvio['telefono']);
                $despacho->setCelular($datosEnvio['celular']);
                $despacho->setDepartamentoNombre($datosEnvio['departamentoNombre']);
                $despacho->setNombreContacto($datosEnvio['nombreContacto']);
                $despacho->setDocumentoContacto($datosEnvio['documentoContacto']);
                $despacho->setCiudadContacto($datosEnvio['ciudadContacto']);
                $despacho->setDireccionContacto($datosEnvio['direccionContacto']);
                $despacho->setBarrioContacto($datosEnvio['barrioContacto']);
                $despacho->setTelefonoContacto($datosEnvio['telefonoContacto']);
                $despacho->setCelularContacto($datosEnvio['celularContacto']);
                $despacho->setDepartamentoContacto($datosEnvio['departamentoContacto']);
                $despacho->setRedencion($redencionD);
                $despacho->setProducto($redencionD->getPremio()->getPremiosproductos()[0]->getProducto());
                //$despacho->setOrdenProducto($InventarioD()->getOrdenproducto());
                $despacho->setCantidad(1);
                
                //Almacenar Historico
                $InventarioD->setDespacho($despacho);
                $em->persist($InventarioD);
                $em->persist($despacho);
                
                $em->flush();
            }
        }           

        return $this->render('IncentivesGarantiasBundle:Redenciones:edicionenvio.html.twig', array(
            'form' => $form->createView(), 'envio' => $redencionE, 'redencion' => $redencionD,
        ));
    }
}
