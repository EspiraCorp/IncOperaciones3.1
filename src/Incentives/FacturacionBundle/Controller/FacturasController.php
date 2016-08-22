<?php

namespace Incentives\FacturacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Incentives\FacturacionBundle\Entity\Factura;
use Incentives\FacturacionBundle\Entity\FacturaDetalle;
use Incentives\FacturacionBundle\Entity\FacturaProductos;
use Incentives\FacturacionBundle\Entity\FacturaLogistica;
use Incentives\FacturacionBundle\Form\Type\FacturaType;
use Incentives\FacturacionBundle\Form\Type\FacturaLogisticaType;
use Incentives\FacturacionBundle\Form\Type\FacturaGenerarType;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Cell_DataValidation;
use PHPExcel_Style_Fill;

use Dompdf\Dompdf;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FacturasController extends Controller
{

	public function listadoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder()
            ->select('p','c','e')
            ->from('IncentivesCatalogoBundle:Programa','p')
            ->leftJoin('p.cliente', 'c')
            ->leftJoin('p.estado', 'e');

        $listado = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        foreach ($listado as $listProg => $listValue) {
            # code...
            $qb = $em->createQueryBuilder()
                ->select('MAX(f.fechaFin) fecha')
                ->from('IncentivesFacturacionBundle:Factura','f')
                ->where("f.programa=".$listValue['id']);

            $fecha = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            if($fecha[0]['fecha']){
              $listado[$listProg]['fechaFactura'] = $fecha[0]['fecha'];  
            }else{
                $listado[$listProg]['fechaFactura'] = "";
            }
        }

        return $this->render('IncentivesFacturacionBundle:Facturas:listado.html.twig', 
            array('listado' => $listado));
    }

    public function facturasprogramaAction($programa)
    {
        $repository = $this->getDoctrine()
            ->getRepository('IncentivesFacturacionBundle:Factura');

        $listado= $repository->findByPrograma($programa);
        
        $repository = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Programa');

        $programa = $repository->find($programa);

        return $this->render('IncentivesFacturacionBundle:Facturas:facturasprograma.html.twig', 
            array('listado' => $listado, 'programa' => $programa));
    }


    public function nuevaAction(Request $request, $programa)
    {        
        $em = $this->getDoctrine()->getManager();
        $facturas = $em->getRepository('IncentivesFacturacionBundle:Factura')->findAll();
        $factura = new Factura();
        $detalle = new FacturaDetalle();

        $form = $this->createForm(new FacturaType(array('programa' => $programa), $factura));
        
        $programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($programa);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            $pro=($request->request->get('factura'));

            if ($form->isValid()) {
                // realiza alguna acción, tal como guardar la tarea en la base de datos

                $id=($request->request->get('programa'));
                
                $ordenes = $em->getRepository('IncentivesFacturacionBundle:Factura')->findAll();
                
                $factura->setPrograma($programa);
                $pais = $em->getRepository('IncentivesOperacionesBundle:Pais')->find($pro["pais"]);
                $factura->setPais($pais);
                $factura->setNumero(str_pad(count($ordenes)+1, 3, '0', STR_PAD_LEFT)."-".date_create("now")->format('y'));
                $factura->setFecha(date_create($pro["fecha"]));
                $factura->setFechaInicio(date_create($pro["fechaInicio"]));
                $factura->setFechafin(date_create($pro["fechaFin"]));
                $periodo = $em->getRepository('IncentivesFacturacionBundle:Periodos')->find($pro["periodo"]);	
				$factura->setPeriodo($periodo);

                $em->persist($factura);
                $em->flush();
                
                $incluyeLogistica= 0;
                if(isset($pro["logistica"])) $incluyeLogistica = $pro["logistica"];
                $incluyePremios= 0;
                if(isset($pro["premios"])) $incluyePremios = $pro["premios"];
                $incluyeRequisiciones= 0;
                if(isset($pro["requisiciones"])) $incluyeRequisiciones = $pro["requisiciones"];
				
				$fechaInicio = strtotime('-1 day', strtotime($pro["fechaInicio"]));
				$fechaInicio = date('Y-m-d', $fechaInicio);

                if($incluyePremios==1){
                    if($incluyeLogistica==1){
                        //FACTURAR PREMIOS CON LOGISTICA SEGUN FORMULAS DE NEGOCIACION
                        
                        //CONTAR CANTIDADES POR PRODUCTO Y PRECIOS
                        $qb = $em->createQueryBuilder(); 
                        $qb->select('count(r) as total','p.id','pc.id productocatalogo','p.nombre','pc.precio','pc.incremento','pc.logistica');
                        $qb->from('IncentivesRedencionesBundle:Redenciones','r');
                        $qb->leftJoin('r.participante', 'pt');
                        $qb->leftJoin('r.productocatalogo', 'pc');
                        $qb->leftJoin('pc.catalogos', 'c');
                        $qb->leftJoin('pc.producto', 'p');
                        $qb->groupBy('p.id');
                        $str_filtro = "pt.programa=".$programa->getId()." AND r.redencionestado IN (2,3,4,5,6) AND r.fecha>='".$fechaInicio."'  AND r.fecha<='".$pro["fechaFin"]."' AND r.facturaProducto IS NULL AND c.pais=".$pro["pais"];
                        $qb->where($str_filtro);
                        //echo $qb->getDql(); exit;
                        $ProductosFactura = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

                        //echo "<pre>"; print_r($ProductosFactura); echo "</pre>"; exit;
                    
                        $ip = 0;

                        //Crear detalle factura
                        foreach($ProductosFactura as $keyProd => $valueProd){
                            
                            //
                            $cantidad = $valueProd['total'];
                            $precioVenta = $valueProd['precio'];
                            $incremento = $valueProd['incremento'];
                            $logistica = $valueProd['logistica'];
                            
                            $valorVenta = ($precioVenta/(1-($incremento/100))) + $logistica;
                            $valorTotal = $valorVenta * $cantidad;
                            
                            $Productos = new FacturaProductos();
                            $Productos->setFactura($factura);
                            $Infoproducto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($valueProd['id']);
                            $Productos->setProducto($Infoproducto);
                            $Productos->setCantidad($valueProd['total']);
                            $Productos->setValorUnitario($valorVenta);
                            $Productos->setValorTotal($valorTotal);
                            //$Productos->setValorRentabilidad(0);
                            $Productos->setDescripcion($valueProd['nombre']);
                            $em->persist($Productos);
                            
                            $em->flush();

                            $ip++;
                        }

                        $ProductosFac = $em->getRepository('IncentivesFacturacionBundle:FacturaProductos')->findByFactura($factura->getId());

                        $qb = $em->createQueryBuilder(); 
                        $qb->select('fp');
                        $qb->from('IncentivesFacturacionBundle:FacturaProductos','fp');
                        $str_filtro = "fp.factura=".$factura->getId();
                        $qb->where($str_filtro);
                        $ProductosFac = $qb->getQuery()->getResult();
                        
                        foreach($ProductosFac as $keyProd => $valueProd){

                        //ACTUALIZAR REDENCIONES CON FACTURA Y DETALLE FACTURA
                            $qb = $em->createQueryBuilder(); 
                            $qb->select('r');
                            $qb->from('IncentivesRedencionesBundle:Redenciones','r');
                            $qb->leftJoin('r.historico', 'rh');
                            $qb->leftJoin('r.participante', 'pt');
                            $qb->leftJoin('r.productocatalogo', 'pc');
                            $qb->leftJoin('pc.catalogos', 'c');
                            $str_filtro = "pt.programa=".$programa->getId()." AND r.redencionestado IN (2,3,4,5,6) AND r.fecha>='".$fechaInicio."'  AND r.fecha<='".$pro["fechaFin"]."' AND r.facturaProducto IS NULL AND pc.producto=".$valueProd->getProducto()->getId()." AND c.pais=".$pro["pais"];
                            $qb->where($str_filtro);
                            //echo $qb->getDql(); exit;
                            $RedencionesFactura = $qb->getQuery()->getResult();

                            foreach($RedencionesFactura as $KeyRedencion => $valueRedencion){
                                $valueRedencion->setFacturaproducto($valueProd);
                                $em->persist($valueRedencion);
                            }
                            $em->flush();
                        }
                    }else{
                        
                        //FACTURAR PREMIOS SIN LOGISTICA SEGUN FORMULAS DE NEGOCIACION
                    
                        //CONTAR CANTIDADES POR PRODUCTO Y PRECIOS
                        $qb = $em->createQueryBuilder(); 
                        $qb->select('count(r) as total','p.id','pc.id productocatalogo','p.nombre','pc.precio','pc.incremento','pc.logistica');
                        $qb->from('IncentivesRedencionesBundle:Redenciones','r');
                        $qb->leftJoin('r.participante', 'pt');
                        $qb->leftJoin('r.productocatalogo', 'pc');
                        $qb->leftJoin('pc.catalogos', 'c');
                        $qb->leftJoin('pc.producto', 'p');
                        $qb->groupBy('p.id');
                        $str_filtro = "pt.programa=".$programa->getId()." AND r.redencionestado IN (2,3,4,5,6) AND r.fecha>='".$fechaInicio."'  AND r.fecha<='".$pro["fechaFin"]."' AND r.facturaProducto IS NULL AND c.pais=".$pro["pais"];
                        $qb->where($str_filtro);
                        $ProductosFactura = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
                        $ip = 0;

                        //Crear detalle factura
                        foreach($ProductosFactura as $keyProd => $valueProd){

                            $ip++;
                            
                            //
                            $cantidad = $valueProd['total'];
                            $precioVenta = $valueProd['precio'];
                            $incremento = $valueProd['incremento'];
                            $logistica = $valueProd['logistica'];
                            
                            $valorVenta = ($precioVenta/(1-($incremento/100)));
                            $valorTotal = $valorVenta * $cantidad;
                            
                            $Productos = new FacturaProductos();
                            $Productos->setFactura($factura);
                            $Infoproducto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($valueProd['id']);
                            $Productos->setProducto($Infoproducto);
                            $Productos->setCantidad($valueProd['total']);
                            $Productos->setValorUnitario($valorVenta);
                            $Productos->setValorTotal($valorTotal);
                            //$Productos->setValorRentabilidad(0);
                            $Productos->setDescripcion($valueProd['nombre']);
                            $em->persist($Productos);
                            
                            //ACTUALIZAR REDENCIONES CON FACTURA Y DETALLE FACTURA
                            $qb = $em->createQueryBuilder(); 
                            $qb->select('rh','r');
                            $qb->from('IncentivesRedencionesBundle:Redenciones','r');
                            $qb->leftJoin('r.participante', 'pt');
                            $qb->leftJoin('r.productocatalogo', 'pc');
							$qb->leftJoin('pc.catalogos', 'c');
                            $str_filtro = "pt.programa=".$programa->getId()." AND r.redencionestado IN (2,3,4,5,6) AND r.fecha>='".$fechaInicio."'  AND r.fecha<='".$pro["fechaFin"]."' AND r.facturaProducto IS NULL AND r.productocatalogo=".$valueProd['productocatalogo'];
                            $qb->where($str_filtro);
                            $RedencionesFactura = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
                
                            foreach($RedencionesFactura as $KeyRedencion => $valueRedencion){
                                $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($valueRedencion['redencion']['id']);
                                $redencion->setFacturaProducto($Productos);
                                $em->persist($redencion);
                            }
                        }
                                            
                        //BUSCAR GUIAS ASOCIADAS SIN FACTURAR
                        //CONTAR CANTIDADES POR PRODUCTO Y PRECIOS
                        $qb = $em->createQueryBuilder(); 
                        $qb->select('SUM(g.valor) as total');
                        $qb->from('IncentivesRedencionesBundle:Redenciones','r');
                        $qb->leftJoin('r.inventario', 'i');
                        $qb->leftJoin('i.guia', 'g');
                        $qb->leftJoin('r.participante', 'pt');
                        $str_filtro = "pt.programa=".$programa->getId()." AND r.redencionestado IN (2,3,4,5,6) AND r.fecha>='".$fechaInicio."'  AND r.fecha<='".$pro["fechaFin"]."' AND g.facturalogistica IS NULL";
                        $qb->where($str_filtro);
                        $LogisticaFactura = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
                        
                        foreach($LogisticaFactura as $keyLog=> $valueLog){
                            
                            if($valueLog['total']>0){

                                $Logistica = new FacturaLogistica();
                                $Logistica->setFactura($factura);
                                $Logistica->setCantidad(1);
                                $Logistica->setValorUnitario($valueLog['total']);
                                $Logistica->setValorTotal($valueLog['total']);
                                //$Productos->setValorRentabilidad(0);
                                $Logistica->setDescripcion("LOGISTICA ENVIOS VARIOS");
                                $em->persist($Logistica);
                                
                                //ACTUALIZAR GUIAS CON FACTURA Y DETALLE FACTURA
                                $qb = $em->createQueryBuilder(); 
                                $qb->select('rh','r','i','g');
                                $qb->from('IncentivesRedencionesBundle:Redenciones','r');
                                $qb->leftJoin('r.inventario', 'i');
                                $qb->leftJoin('i.guia', 'g');
                                $qb->leftJoin('r.participante', 'pt');
                                $str_filtro = "pt.programa=".$programa->getId()." AND r.redencionestado IN (2,3,4,5,6) AND r.fecha>='".$fechaInicio."'  AND r.fecha<='".$pro["fechaFin"]."' AND g.facturalogistica IS NULL";
                                $qb->where($str_filtro);
                                $GuiasFactura = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
                    
                                foreach($GuiasFactura as $KeyGuias => $ValueGuias){
                                    foreach($ValueGuias['redencion']['inventario'] as $keyInv => $valueInv){
                                        foreach($valueInv['guia'] as $keyG => $valueG){
                                            $guia = $em->getRepository('IncentivesRedencionesBundle:GuiaEnvio')->find($valueG['id']);
                                            $guia->setFacturaLogistica($Logistica);
                                            $em->persist($guia);
                                        }  
                                    }
                                }
                            }
        
                        }

                    }
                }

                if($incluyeRequisiciones==1){

                    if($incluyeLogistica==1){
                        //Requisiciones
                        //CONTAR CANTIDADES POR PRODUCTO Y PRECIOS
                        $qb = $em->createQueryBuilder(); 
                        $qb->select('op','oc','p');
                        $qb->from('IncentivesOrdenesBundle:OrdenesProducto','op');
                        $qb->leftJoin('op.ordenesCompra', 'oc');
                        $qb->leftJoin('op.producto', 'p');
                        $str_filtro = "op.programa=".$programa->getId()." AND oc.fechaCreacion>='".$pro["fechaInicio"]."' AND oc.fechaCreacion<='".$pro["fechaFin"]."'";
                        $qb->where($str_filtro);
                        $ProductosFactura = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
                        $ip=0;

                        //Crear detalle factura
                        foreach($ProductosFactura as $keyProd => $valueProd){
                            
                            $ip++;
                            //
                            $cantidad = $valueProd['cantidad'];
                            $valorVenta = $valueProd['valorunidad'];
                            $productoId = $valueProd['producto']['id'];
                            $valorTotal = $valorVenta * $cantidad;
                            
                            $Productos = new FacturaProductos();
                            $Productos->setFactura($factura);
                            $Infoproducto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($productoId);
                            $Productos->setProducto($Infoproducto);
                            $Productos->setCantidad($cantidad);
                            $Productos->setValorUnitario($valorVenta);
                            $Productos->setValorTotal($valorTotal);
                            //$Productos->setValorRentabilidad(0);
                            $Productos->setDescripcion($valueProd['producto']['nombre']);
                            $em->persist($Productos);
                            
                            $em->flush();
                        }
                    }else{
                        //Requisiciones
                        //CONTAR CANTIDADES POR PRODUCTO Y PRECIOS
                        $qb = $em->createQueryBuilder(); 
                        $qb->select('op','oc','p');
                        $qb->from('IncentivesOrdenesBundle:OrdenesProducto','op');
                        $qb->leftJoin('op.ordenesCompra', 'oc');
                        $qb->leftJoin('op.producto', 'p');
                        $str_filtro = "op.programa=".$programa->getId()." AND oc.fechaCreacion>='".$pro["fechaInicio"]."' AND oc.fechaCreacion<='".$pro["fechaFin"]."'";
                        $qb->where($str_filtro);
                        $ProductosFactura = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
                        $ip=0;

                        //Crear detalle factura
                        foreach($ProductosFactura as $keyProd => $valueProd){
                            
                            $ip++;
                            //
                            $cantidad = $valueProd['cantidad'];
                            $valorVenta = $valueProd['valorunidad'];
                            $productoId = $valueProd['producto']['id'];
                            $valorTotal = $valorVenta * $cantidad;
                            
                            $Productos = new FacturaProductos();
                            $Productos->setFactura($factura);
                            $Infoproducto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($productoId);
                            $Productos->setProducto($Infoproducto);
                            $Productos->setCantidad($cantidad);
                            $Productos->setValorUnitario($valorVenta);
                            $Productos->setValorTotal($valorTotal);
                            //$Productos->setValorRentabilidad(0);
                            $Productos->setDescripcion($valueProd['producto']['nombre']);
                            $em->persist($Productos);
                            
                            $em->flush();
                        }

                        //Buscar logisica registrada en planillas de requisiciones
                        //BUSCAR GUIAS ASOCIADAS SIN FACTURAR
                        //CONTAR CANTIDADES POR PRODUCTO Y PRECIOS
                        $qb = $em->createQueryBuilder(); 
                        $qb->select('cl','p');
                        $qb->from('IncentivesInventarioBundle:CostosLogistica','cl');
                        $qb->leftJoin('cl.planilla', 'p');
                        $str_filtro = "p.programa=".$programa->getId()." AND p.fecha>='".$pro["fechaInicio"]."'  AND p.fecha<='".$pro["fechaFin"]."' AND cl.facturalogistica IS NULL";
                        $qb->where($str_filtro);
                        $CostosLogistica = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
                        
                        foreach($CostosLogistica as $keyLog=> $valueLog){
                         
                            $Logistica = new FacturaLogistica();
                            $Logistica->setFactura($valueLog['cantidad']);
                            $Logistica->setCantidad($valueLog['cantidad']);
                            $Logistica->setValorUnitario($valueLog['valorUnitario']);
                            $Logistica->setValorTotal($valueLog['valorTotal']);
                            //$Productos->setValorRentabilidad(0);
                            $Logistica->setDescripcion($valueLog['descripcion']);
                            $em->persist($Logistica);
                        }
                    }

                }

                if($ip>0){

                    $pdf = $this->pdfAction($factura->getId());
                    if($incluyePremios==1) $excel = $this->detallePremiosAction($factura->getId());
                    
                    $this->get('session')->getFlashBag()->add('notice', 'La factura con numero '.$factura->getNumero().' se creo correctamente');
                }else{
                    
                    $em->remove($factura);
                    $em->flush();

                    $this->get('session')->getFlashBag()->add('warning', 'No se encontraron datos para facturar');
                }
                
                return $this->redirect($this->generateUrl('facturas_listado').'/'.$id);
            }
        }
        
        //Buscar ultima fecha de facturacion
        $qb = $em->createQueryBuilder(); 
        $qb->select('MAX(f.fechaFin) fecha');
        $qb->from('IncentivesFacturacionBundle:Factura','f');
        $str_filtro = "f.programa=".$programa->getId();
        $qb->where($str_filtro);
        $fechaInicio = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $fechaInicio = $fechaInicio[0]['fecha'];
        $fechaInicio = strtotime ( '+1 day' , strtotime($fechaInicio) ) ;
        
        if($fechaInicio=="0000-00-00" && $fechaInicio==""){
            $fechaInicio = $programa->getFechainicio()->format('Y-m-d');
        }
        
        $fechaFin = strtotime ( '+1 month', $fechaInicio ) ;
        $fechaFin = strtotime ( '-1 day' , $fechaFin ) ;

        $fechaFin = date ( 'Y-m-d' , $fechaFin );
        $fecha = date('Y-m-d');
        
        return $this->render('IncentivesFacturacionBundle:Facturas:nueva.html.twig', array(
            'form' => $form->createView(), 'programa' => $programa, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin, 'fecha' => $fecha
        ));
    }

    public function generarNuevaAction(Request $request, $programa)
    {        
        $em = $this->getDoctrine()->getManager();
        $facturas = $em->getRepository('IncentivesFacturacionBundle:Factura')->findAll();
        $factura = new Factura();

        $form = $this->createForm(FacturaGenerarType::class, $factura);

        $id = $programa;          

        return $this->render('IncentivesFacturacionBundle:Facturas:generar.html.twig', array(
            'form' => $form->createView(), 'programa' => $id
        ));
    }

    public function datosAction($id)
    {   

        $repositoryf = $this->getDoctrine()
            ->getRepository('IncentivesFacturacionBundle:Factura');

        $repositoryP = $this->getDoctrine()
            ->getRepository('IncentivesFacturacionBundle:FacturaProductos');
            
        $repositoryL = $this->getDoctrine()
            ->getRepository('IncentivesFacturacionBundle:FacturaLogistica');

        $factura = $repositoryf->find($id);
        $productos = $repositoryP->findByFactura($id);
        $logistica = $repositoryL->findByFactura($id);

        return $this->render('IncentivesFacturacionBundle:Facturas:datos.html.twig', 
            array('factura' => $factura, 'productos' => $productos, 'logistica' => $logistica));
    }


    public function generarpremiosAction($id)
    {   

        //id del programar a facturar
        $em = $this->getDoctrine()->getManager();

        //Revisar que redenciones estan libres para el programa
        $qb = $em->createQueryBuilder()
            ->select('r')
            ->from('IncentivesRedencionesBundle:Redenciones','r')
            ->where('pr.programa = :id AND r.factura is NULL')
            ->Join('r.participante', 'pr')          
            ->setParameters(array(
                'id'=> $id,                
            ));
        $listado = $qb->getQuery()->getResult();

        foreach ($listado as $key => $value) {
            # code...
            echo $descripcion = $value->getProductoCatalogo()->getProducto()->getNombre();
            $valor = $value->getordenesProducto()->getvalorUnidad();
            $factura = $value->getordenesProducto()->getvalorUnidad();
            $tipo = $value->getordenesProducto()->getvalorUnidad();
            $area = $value->getordenesProducto()->getvalorUnidad();
            $redencion = $value->getordenesProducto()->getvalorUnidad();
            $cantidad = $value->getordenesProducto()->getvalorUnidad();
        }

        /*return $this->render('IncentivesFacturacionBundle:Facturas:datos.html.twig', 
            array('factura' => $factura, 'detalle'=>$detalle));*/
    }


    public function generarAction($id,$periodo)
    {   

        //id del programar a facturar
        $pro=($request->request->get('factura'));

        $em = $this->getDoctrine()->getManager();

        $programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($id);
        $periodo = $em->getRepository('IncentivesFacturacionBundle:Periodos')->find($pro["periodo"]);
        $facturas = $em->getRepository('IncentivesFacturacionBundle:Factura')->findAll();

        //Crear factura
        $factura = new Factura();
        $factura->setPeriodo($periodo);
        $factura->setPrograma($programa);
        $factura->setNumero(str_pad(count($facturas)+1, 3, '0', STR_PAD_LEFT)."-".date_create("now")->format('y'));
        $factura->setFecha(date_create($pro["fecha"]));
        $em->persist($factura);
        $em->flush();

        //Facturar Presupuestos
        $presupuestos = $em->getRepository('IncentivesFacturacionBundle:Presupuestos')->findByPrograma($id);

        foreach ($presupuestos as $key => $value) {
            # code...
            if($value->getArea()->getId()!=4){
                $facturaDetalle = new FacturaDetalle;
                $facturaDetalle->setCantidad(1);
                $facturaDetalle->setDescripcion($value->getArea()->getNombre());
                $facturaDetalle->setValorUnitario($value->getMensual());
                $facturaDetalle->setValorTotal($value->getMensual());
                $facturaDetalle->setFactura($factura);
                $facturaDetalle->setTipo($value->getTipo());
                $facturaDetalle->setArea($value->getArea());

                $em->persist($facturaDetalle);
                $em->flush();
            }
        }

        //Facturar Premios
        //Revisar que redenciones estan libres para el programa
        $qb = $em->createQueryBuilder()
            ->select('r')
            ->from('IncentivesRedencionesBundle:Redenciones','r')
            ->where('pr.programa = :id AND r.factura is NULL AND r.redencionestado=5')
            ->Join('r.participante', 'pr')          
            ->setParameters(array(
                'id'=> $id,                
            ));
        $listado = $qb->getQuery()->getResult();

        $totalPremios = 0;
        foreach ($listado as $key => $value) {
            $facturaPremios = new FacturaPremios;
            $facturaPremios->setCantidad(1);
            $facturaPremios->setDescripcion($value->getProductocatalogo()->getProducto()->getNombre());
            $facturaPremios->setValorUnitario($value->getordenesProducto()->getvalorUnidad());
            $facturaPremios->setValorTotal($value->getordenesProducto()->getvalorUnidad());
            $facturaPremios->setFactura($factura);
            $facturaPremios->setProducto($value->getProductocatalogo()->getProducto());

            $totalPremios += $value->getordenesProducto()->getvalorUnidad();

            $value->setFactura($factura);
            $em->persist($value);
            $em->persist($facturaPremios);
            $em->flush();
        }


        $areaOperaciones = $em->getRepository('IncentivesFacturacionBundle:Areas')->find(4);
        //Totalizar premio y guardar en detalle
        $facturaDetalle = new FacturaDetalle;
        $facturaDetalle->setCantidad(1);
        $facturaDetalle->setDescripcion("Premios sin logistica");
        $facturaDetalle->setValorUnitario($totalPremios);
        $facturaDetalle->setValorTotal($totalPremios);
        $facturaDetalle->setFactura($factura);
        $facturaDetalle->setArea($areaOperaciones);
        $em->persist($facturaDetalle);
        $em->flush();

        //Facturar Logistica
        //Revisar que redenciones estan libres para el programa
        $qb = $em->createQueryBuilder()
            ->select('g')
            ->from('IncentivesRedencionesBundle:GuiaEnvio','g')
            ->Join('g.inventario', 'i')
            ->Join('i.redencion', 'r') 
            ->Join('r.participante', 'pr')          
            ->where('pr.programa = :id AND g.factura is NULL')
            ->setParameters(array(
                'id'=> $id,                
            ));
        $listado = $qb->getQuery()->getResult();

        $totalLogistica = 0;
        foreach ($listado as $key => $value) {
            # code...

            $facturaLogistica = new FacturaLogistica;
            $facturaLogistica->setCantidad(1);
            $facturaLogistica->setDescripcion("Guia ".$value->getGuia());
            $facturaLogistica->setValorUnitario($value->getValor());
            $facturaLogistica->setValorTotal($value->getValor());
            $facturaLogistica->setFactura($factura);
            $facturaLogistica->setGuia($value);

            $totalLogistica += $value->getValor();

            $value->setFactura($factura);
            $em->persist($value);
            $em->persist($facturaLogistica);
            $em->flush();
        }

        //Totalizar guias y guardar en detalle
        //Totalizar premio y guardar en detalle
        $facturaDetalle = new FacturaDetalle;
        $facturaDetalle->setCantidad(1);
        $facturaDetalle->setDescripcion("Logistica");
        $facturaDetalle->setValorUnitario($totalLogistica);
        $facturaDetalle->setValorTotal($totalLogistica);
        $facturaDetalle->setFactura($factura);
        $facturaDetalle->setArea($areaOperaciones);
        $em->persist($facturaDetalle);
        $em->flush();

        return $this->redirect($this->generateUrl('factura_pdf').'/'.$factura->getid());
    }

    public function pdfAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $repositoryf = $this->getDoctrine()
            ->getRepository('IncentivesFacturacionBundle:Factura');

        $repositoryp = $this->getDoctrine()
            ->getRepository('IncentivesFacturacionBundle:FacturaProductos');

        $repositoryl = $this->getDoctrine()
            ->getRepository('IncentivesFacturacionBundle:FacturaLogistica');

        $factura = $repositoryf->find($id);
        $productos = $repositoryp->findByFactura($id);
        $logistica = $repositoryl->findByFactura($id);

        $html = $this->render('IncentivesFacturacionBundle:Facturas:pdf.html.twig', 
            array('factura' => $factura,'productos'=>$productos, 'logistica'=>$logistica));

        $uploadDir=dirname($this->container->getParameter('kernel.root_dir')).'/web/Facturas/';

        $dompdf = new DOMPDF();
        $dompdf->load_html($html,'UTF-8');
        $dompdf->render();
        $pdf = $dompdf->output();
        file_put_contents($uploadDir.$factura->getNumero().".pdf", $pdf);
        $factura->setRutapdf($uploadDir.$factura->getNumero().".pdf");
        $em->persist($factura);
        $em->flush();

        return $this->redirect($this->generateUrl('factura_datos').'/'.$id);

    }

    public function pdfPremiosAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $repositoryf = $this->getDoctrine()
            ->getRepository('IncentivesFacturacionBundle:Factura');

        $repositoryd = $this->getDoctrine()
            ->getRepository('IncentivesFacturacionBundle:FacturaDetalle');

        $factura = $repositoryf->find($id);
        $detalle = $repositoryd->findByFactura($id);

        //Listar redenciones

        //Recorrer redenciones  y buscar valores de compras

            //cruzar como premios


            //recorrer inventarios y guias

            //cruzar como logistica


        $html = $this->render('IncentivesFacturacionBundle:FacturasPremios:pdf.html.twig', 
            array('factura' => $factura, 'detalle'=>$detalle));

        $uploadDir=dirname($this->container->getParameter('kernel.root_dir')).'/web/bundles/FacturacionBundle/Facturas/';

        $dompdf = new DOMPDF();
        $dompdf->load_html(utf8_decode($html));
        $dompdf->render();
        $pdf = $dompdf->output();
        file_put_contents($uploadDir.$factura->getNumero().".pdf", $pdf);
        $orden->setRutapdf($uploadDir.$factura->getNumero().".pdf");
        $em->flush();

        return $uploadDir.$factura->getNumero().".pdf";

    }

    public function detallePremiosAction($id)
    {
            // Create new PHPExcel object
            $PHPexcel = new PHPExcel();
            // Set document properties
            $PHPexcel->setActiveSheetIndex(0);
            $em = $this->getDoctrine()->getManager();
        
            $PHPexcel ->getActiveSheet()
                        ->setCellValue('A1','Id')
                        ->setCellValue('B1','Fecha Redencion')
                        ->setCellValue('C1','Fecha Autorizacion')
                        ->setCellValue('D1','Fecha Modificacion')
                        ->setCellValue('E1','Redimido Por')
                        ->setCellValue('F1','Codigo Redencion')
                        ->setCellValue('G1','Nombre Participante')
                        ->setCellValue('H1','Cedula participante')
                        ->setCellValue('I1','Departamento')
                        ->setCellValue('J1','Ciudad')
                        ->setCellValue('K1','Puntos')
                        ->setCellValue('L1','Producto')
                        ->setCellValue('M1','Sku')
                        ->setCellValue('N1','Categoria')
                        ->setCellValue('O1','Valor Venta')
                        ->setCellValue('P1','Semaforo')
                        ->setCellValue('Q1','Nombre Contacto')
                        ->setCellValue('R1','Documento Contacto')
                        ->setCellValue('S1','Direccion Contacto')
                        ->setCellValue('T1','Telefono Contacto')
                        ->setCellValue('U1','Fecha Despacho');
        
            //MEGA QUERY

            $em = $this->getDoctrine()->getManager();
            //Consultar puntos redimidos
            $qb = $em->createQueryBuilder();            
            $qb->select('r','pt','pc','pd','ct','envio','i','guia','estado','op','oc','pv','ig','fp');
            
            $qb->from('IncentivesRedencionesBundle:Redenciones','r');
            $qb->leftJoin('r.productocatalogo', 'pc');
            $qb->leftJoin('pc.producto', 'pd');
            $qb->leftJoin('pd.categoria', 'ct');
            $qb->leftJoin('pc.catalogos', 'c');
            $qb->leftJoin('r.participante', 'pt');
            $qb->leftJoin('r.redencionesenvios', 'envio');
            $qb->leftJoin('r.redencionestado', 'estado');
            $qb->leftJoin('r.inventario', 'i');
            $qb->leftJoin('r.facturaProducto', 'fp');
            $qb->leftJoin('i.inventarioguia', 'ig');
            $qb->leftJoin('ig.guia', 'guia');
            $qb->leftJoin('r.ordenesProducto', 'op');
            $qb->leftJoin('op.ordenesCompra', 'oc');
            $qb->leftJoin('oc.proveedor', 'pv');
            $qb->orderBy('r.fecha', 'ASC');
            
            $str_filtro = 'fp.factura='.$id;
            $str_filtro .= " AND r.redencionestado != 7";
            $qb->where($str_filtro);
            $redenciones = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            //echo "<pre>";print_r($redenciones); exit;
            
            $fil=2;
            foreach($redenciones as $key => $value){              

                $guiaP = "";
                $Operador="";

				$valorVenta = $value['valorCompra']/(1-($value['incremento']/100)) + $value['logistica'];

                //Redencion, participante, producto
                $PHPexcel->getActiveSheet()
                        ->setCellValueByColumnAndRow(0, $fil, $value['id'])
                        ->setCellValueByColumnAndRow(1, $fil, $value['fecha']->format('Y-m-d'))
                        //
                        ->setCellValueByColumnAndRow(4, $fil, $value['redimidopor'])
                        ->setCellValueByColumnAndRow(5, $fil, $value['codigoredencion'])
                        ->setCellValueByColumnAndRow(6, $fil, $value['participante']['nombre'])
                        ->setCellValueByColumnAndRow(7, $fil, $value['participante']['documento'])
                        ->setCellValueByColumnAndRow(8, $fil, $value['participante']['nombre'])
                        ->setCellValueByColumnAndRow(9, $fil, $value['puntos'])
                        ->setCellValueByColumnAndRow(10, $fil, $value['productocatalogo']['producto']['codEAN'])
                        ->setCellValueByColumnAndRow(11, $fil, $value['productocatalogo']['producto']['nombre'])
                        ->setCellValueByColumnAndRow(12, $fil, $value['productocatalogo']['producto']['codInc'])
                        ->setCellValueByColumnAndRow(13, $fil, $value['productocatalogo']['producto']['categoria']['nombre'])
                        ->setCellValueByColumnAndRow(14, $fil, $valorVenta)
                        ->setCellValueByColumnAndRow(15, $fil, $value['redencionestado']['nombre']);

                
                if(isset($value['fechaModificacion']) && $value['fechaModificacion']!="0000-00-00") $PHPexcel->getActiveSheet()->setCellValueByColumnAndRow(3, $fil, $value['fechaModificacion']->format('Y-m-d'));
                
                if($value['fechaAutorizacion']!= null) $PHPexcel->getActiveSheet()->setCellValueByColumnAndRow(2, $fil, $value['fechaAutorizacion']->format('Y-m-d'));
                if($value['fechaDespacho']!= null) $PHPexcel->getActiveSheet()->setCellValueByColumnAndRow(16, $fil, $value['fechaDespacho']->format('Y-m-d'));

                 $strGuias = "";
                 $strOperador = "";

                //Otros
                    if($value['otros']!=""){
                        $iR = 17;
                        $otrosR = explode(";", $value['otros']);
                        foreach ($otrosR as $keyR) {
                            $iR++;
                            $valueR = explode(":", $keyR);
                            $PHPexcel ->getActiveSheet()->setCellValueByColumnAndRow($iR, 1, $valueR[0]);
                            $PHPexcel ->getActiveSheet()->setCellValueByColumnAndRow($iR, $fil, $valueR[1]);
                        }
                    }
                
                $fil++;

            }

            $factura = $em->getRepository('IncentivesFacturacionBundle:Factura')->find($id);

            $objWriter = new PHPExcel_Writer_Excel2007($PHPexcel); 
            $objWriter->save('DetalleFactura_'.$factura->getNumero().'.xlsx');  //send it to user, of course you can save it to disk also!
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
            $filename = 'DetalleFactura_'.$factura->getNumero().'.xlsx';
            $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
            $filePath = $basePath.'/'.$filename; 

    }
    
    public function generarSegmentadoAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        
        //Redenciones pendientes por facturacion
        $qb = $em->createQueryBuilder(); 
        $qb->select('count(r) as total','pg.nombre programa','pg.id idprograma','ps.nombre pais','ps.id idpais','MIN(r.fecha) fechaInicio','MAX(r.fecha) fechaFin');
        $qb->from('IncentivesRedencionesBundle:Redenciones','r');
        $qb->leftJoin('r.productocatalogo', 'pc');
        $qb->leftJoin('pc.catalogos', 'c');
        $qb->leftJoin('c.programa', 'pg');
        $qb->leftJoin('c.pais', 'ps');
        $qb->groupBy('pg.id', 'ps.id');
        $str_filtro = "r.redencionestado IN (2,3,4,5,6) AND r.facturaProducto IS NULL AND r.fecha>='2015-12-01'";
        $qb->where($str_filtro);
        //echo $qb->getDql(); exit;
        $Redenciones = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        //echo "<pre>"; print_r($Redenciones); echo "</pre>"; exit;

        //Requisiciones pendientes por facturacion
        $qb = $em->createQueryBuilder(); 
        $qb->select('count(cp) as total', 'p.nombre programa','p.id idPrograma');
        $qb->from('IncentivesSolicitudesBundle:CotizacionProducto','cp');
        $qb->leftJoin('cp.cotizacion', 'c');
        $qb->leftJoin('c.solicitud', 's');
        $qb->leftJoin('s.programa', 'p');
        $qb->groupBy('p.id');
        $str_filtro = "cp.facturaProducto IS NULL AND cp.estado in (2,6,5)";
        $qb->where($str_filtro);
        $Requisiciones = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        //echo "<pre>"; print_r($Requisiciones); echo "</pre>"; exit;
        
        //Logistica pendientes por facturacion
        //Buscar logisica registrada en planillas de requisiciones
        $qb = $em->createQueryBuilder(); 
        $qb->select('count(cl) as total','ps.nombre pais', 'ps.id idpais', 'p.nombre programa','p.id idPrograma');
        $qb->from('IncentivesInventarioBundle:CostosLogistica','cl');
        $qb->leftJoin('cl.planilla', 'pl');
        $qb->leftJoin('pl.solicitud', 's');
        $qb->leftJoin('pl.pais', 'ps');
        $qb->leftJoin('s.programa', 'p');
        $qb->groupBy('p.id');
        $str_filtro = "cl.facturalogistica IS NULL";
        $qb->where($str_filtro);
        $Logistica = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        //echo "<pre>"; print_r($Logistica); echo "</pre>"; exit;

        return $this->render('IncentivesFacturacionBundle:Facturas:generarsegmentado.html.twig', 
            array('redenciones' => $Redenciones, 'requisiciones' => $Requisiciones, 'logisticas' => $Logistica));
    }

   public function detalleSolicitudesAction($id)
    {
            // Create new PHPExcel object
            $PHPexcel = new PHPExcel();
            // Set document properties
            $PHPexcel->setActiveSheetIndex(0);
            $em = $this->getDoctrine()->getManager();
        
            $PHPexcel ->getActiveSheet()
                        ->setCellValue('A1','Id')
                        ->setCellValue('B1','Fecha Solicitud')
                        ->setCellValue('C1','Fecha Aprobación')
                        ->setCellValue('D1','Fecha Modificación')
                        ->setCellValue('E1','Solicitante')
                        ->setCellValue('F1','Solicitud')
                        ->setCellValue('G1','Cotización')
                        ->setCellValue('H1','Requisición')
                        ->setCellValue('I1','Cantidad')
                        ->setCellValue('J1','Sku')
                        ->setCellValue('K1','Producto')
                        ->setCellValue('L1','Marca')
                        ->setCellValue('M1','Referencia')
                        ->setCellValue('N1','Valor Venta');

            $em = $this->getDoctrine()->getManager();
            
            //Consultar producos de cotizaciones
            $qb = $em->createQueryBuilder();            
            $qb->select('cp','pd','c','s','u');
            
            $qb->from('IncentivesSolicitudesBundle:CotizacionProducto','cp');
            $qb->leftJoin('cp.producto', 'pd');
            $qb->leftJoin('cp.facturaProducto', 'fp');
            $qb->leftJoin('cp.cotizacion', 'c');
            $qb->leftJoin('c.solicitud', 's');
            $qb->leftJoin('s.solicitante', 'u');
            $qb->orderBy('s.fechaSolicitud', 'ASC');
            
            $str_filtro = 'fp.factura='.$id;
            $qb->where($str_filtro);
            $productosCotizacion = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            //echo "<pre>";print_r($productosCotizacion); exit;
            
            $fil=2;
            foreach($productosCotizacion as $key => $value){              

                $guiaP = "";
                $Operador="";

				$valorVenta = $value['cantidad']*($value['valorunidad']/(1-($value['incremento']/100)) + $value['logistica']);

                //Redencion, participante, producto
                $PHPexcel->getActiveSheet()
                        ->setCellValueByColumnAndRow(0, $fil, $value['id'])
                        ->setCellValueByColumnAndRow(1, $fil, $value['cotizacion']['solicitud']['fechaSolicitud']->format('d/m/Y'))
                        //
                        ->setCellValueByColumnAndRow(4, $fil, $value['cotizacion']['solicitud']['solicitante']['nombre'])
                        ->setCellValueByColumnAndRow(5, $fil, $value['cotizacion']['solicitud']['id'])
                        ->setCellValueByColumnAndRow(6, $fil, $value['cotizacion']['consecutivo'])
                        ->setCellValueByColumnAndRow(8, $fil, $value['cantidad'])
                        ->setCellValueByColumnAndRow(9, $fil, $value['producto']['codInc'])
                        ->setCellValueByColumnAndRow(10, $fil, $value['producto']['nombre'])
                        ->setCellValueByColumnAndRow(11, $fil, $value['producto']['marca'])
                        ->setCellValueByColumnAndRow(12, $fil, $value['producto']['referencia'])
                        ->setCellValueByColumnAndRow(13, $fil, $valorVenta);

                
                if(isset($value['fechaModificacion']) && $value['fechaModificacion']!="0000-00-00") $PHPexcel->getActiveSheet()->setCellValueByColumnAndRow(3, $fil, $value['fechaModificacion']->format('Y-m-d'));
                
                //if($value['fechaAutorizacion']!= null) $PHPexcel->getActiveSheet()->setCellValueByColumnAndRow(2, $fil, $value['fechaAutorizacion']->format('Y-m-d'));
                
                $fil++;

            }
            
            //Consultar producos de cotizaciones
            $qb = $em->createQueryBuilder();            
            $qb->select('rp','pd','r','s','u');
            
            $qb->from('IncentivesSolicitudesBundle:RequisicionProducto','rp');
            $qb->leftJoin('rp.producto', 'pd');
            $qb->leftJoin('rp.facturaProducto', 'fp');
            $qb->leftJoin('rp.requisicion', 'r');
            $qb->leftJoin('r.solicitud', 's');
            $qb->leftJoin('s.solicitante', 'u');
            $qb->orderBy('s.fechaSolicitud', 'ASC');
            
            $str_filtro = 'fp.factura='.$id;
            $qb->where($str_filtro);
            $productosRequisicion = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            //echo "<pre>";print_r($productosRequisicion); exit;
            
            foreach($productosRequisicion as $key => $value){              

                $guiaP = "";
                $Operador="";

				$valorVenta = $value['cantidad']*($value['valorunidad']/(1-($value['incremento']/100)) + $value['logistica']);

                //Redencion, participante, producto
                $PHPexcel->getActiveSheet()
                        ->setCellValueByColumnAndRow(0, $fil, $value['id'])
                        ->setCellValueByColumnAndRow(1, $fil, $value['requisicion']['solicitud']['fechaSolicitud']->format('d/m/Y'))
                        //
                        ->setCellValueByColumnAndRow(4, $fil, $value['requisicion']['solicitud']['solicitante']['nombre'])
                        ->setCellValueByColumnAndRow(5, $fil, $value['requisicion']['solicitud']['id'])
                        ->setCellValueByColumnAndRow(7, $fil, $value['requisicion']['consecutivo'])
                        ->setCellValueByColumnAndRow(8, $fil, $value['cantidad'])
                        ->setCellValueByColumnAndRow(9, $fil, $value['producto']['codInc'])
                        ->setCellValueByColumnAndRow(10, $fil, $value['producto']['nombre'])
                        ->setCellValueByColumnAndRow(11, $fil, $value['producto']['marca'])
                        ->setCellValueByColumnAndRow(12, $fil, $value['producto']['referencia'])
                        ->setCellValueByColumnAndRow(13, $fil, $valorVenta);

                
                if(isset($value['fechaModificacion']) && $value['fechaModificacion']!="0000-00-00") $PHPexcel->getActiveSheet()->setCellValueByColumnAndRow(3, $fil, $value['fechaModificacion']->format('Y-m-d'));
                
                //if($value['fechaAutorizacion']!= null) $PHPexcel->getActiveSheet()->setCellValueByColumnAndRow(2, $fil, $value['fechaAutorizacion']->format('Y-m-d'));
                
                $fil++;

            }

            $factura = $em->getRepository('IncentivesFacturacionBundle:Factura')->find($id);

            $objWriter = new PHPExcel_Writer_Excel2007($PHPexcel); 
            $objWriter->save('DetalleFactura_'.$factura->getNumero().'.xlsx');  //send it to user, of course you can save it to disk also!
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
            $filename = 'DetalleFactura_'.$factura->getNumero().'.xlsx';
            $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
            $filePath = $basePath.'/'.$filename; 

    }
    
    public function redencionesGenerarAction(Request $request)
    {        
        $em = $this->getDoctrine()->getManager();
        
        $pais = intval($request->get('pais'));
        $programa = intval($request->get('programa'));
        
        $facturas = $em->getRepository('IncentivesFacturacionBundle:Factura')->findAll();
        $factura = new Factura();
        $detalle = new FacturaDetalle();

        $form = $this->createForm(new FacturaType(array('programa' => $programa), $factura));
        
        $programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($programa);
        $pais = $em->getRepository('IncentivesOperacionesBundle:Pais')->find($pais);
                    
        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            $pro=($request->request->get('factura'));
            
            if ($form->isValid()) {
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                
                $ordenes = $em->getRepository('IncentivesFacturacionBundle:Factura')->findAll();
                
                $factura->setPrograma($programa);
                $factura->setPais($pais);
                $factura->setNumero(str_pad(count($ordenes)+1, 3, '0', STR_PAD_LEFT)."-".date_create("now")->format('y'));
                $factura->setFecha(date_create($pro["fecha"]));
                $factura->setFechaInicio(date_create($pro["fechaInicio"]));
                $factura->setFechafin(date_create($pro["fechaFin"]));
                $periodo = $em->getRepository('IncentivesFacturacionBundle:Periodos')->find($pro["periodo"]);	
				$factura->setPeriodo($periodo);

                $em->persist($factura);
                $em->flush();
                
                $incluyeLogistica= 0;
                if(isset($pro["logistica"])) $incluyeLogistica = $pro["logistica"];
                $incluyePremios= 0;
                if(isset($pro["premios"])) $incluyePremios = $pro["premios"];
                $incluyeRequisiciones= 0;
                if(isset($pro["requisiciones"])) $incluyeRequisiciones = $pro["requisiciones"];
				
				$fechaInicio = strtotime('-1 day', strtotime($pro["fechaInicio"]));
				$fechaInicio = date('Y-m-d', $fechaInicio);

                //FACTURAR PREMIOS CON LOGISTICA SEGUN FORMULAS DE NEGOCIACION
                        
                //CONTAR CANTIDADES POR PRODUCTO Y PRECIOS
                $qb = $em->createQueryBuilder(); 
                $qb->select('count(r) as total','p.id','pc.id productocatalogo','p.nombre','r.valorCompra','r.incremento','r.logistica');
                $qb->from('IncentivesRedencionesBundle:Redenciones','r');
                $qb->leftJoin('r.participante', 'pt');
                $qb->leftJoin('r.productocatalogo', 'pc');
                $qb->leftJoin('pc.catalogos', 'c');
                $qb->leftJoin('pc.producto', 'p');
                $qb->groupBy('p.id');
                $qb->addGroupBy('r.valorCompra');
                $str_filtro = "pt.programa=".$programa->getId()." AND r.redencionestado IN (2,3,4,5,6) AND r.fecha>='".$fechaInicio."'  AND r.fecha<='".$pro["fechaFin"]."' AND r.facturaProducto IS NULL AND c.pais=".$pais->getId();
                $qb->where($str_filtro);
                //echo $qb->getDql(); exit;
                $ProductosFactura = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

                //echo "<pre>"; print_r($ProductosFactura); echo "</pre>"; exit;
                
                $ip = 0;

                //Crear detalle factura
                foreach($ProductosFactura as $keyProd => $valueProd){
                    
                    $cantidad = $valueProd['total'];
                    $precioVenta = $valueProd['valorCompra'];
                    $incremento = $valueProd['incremento'];
                    $logistica = $valueProd['logistica'];
                    
                    $valorVenta = ($precioVenta/(1-($incremento/100))) + $logistica;
                    $valorTotal = $valorVenta * $cantidad;
                    
                    $Productos = new FacturaProductos();
                    $Productos->setFactura($factura);
                    $Infoproducto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($valueProd['id']);
                    $Productos->setProducto($Infoproducto);
                    $Productos->setCantidad($valueProd['total']);
                    $Productos->setValorUnitario($valorVenta);
                    $Productos->setValorTotal($valorTotal);
                    //$Productos->setValorRentabilidad(0);
                    $Productos->setDescripcion($valueProd['nombre']);
                    $em->persist($Productos);
                            
                    $em->flush();

                    $ip++;
                }

                $ProductosFac = $em->getRepository('IncentivesFacturacionBundle:FacturaProductos')->findByFactura($factura->getId());

                $qb = $em->createQueryBuilder(); 
                $qb->select('fp');
                $qb->from('IncentivesFacturacionBundle:FacturaProductos','fp');
                $str_filtro = "fp.factura=".$factura->getId();
                $qb->where($str_filtro);
                $ProductosFac = $qb->getQuery()->getResult();
                        
                foreach($ProductosFac as $keyProd => $valueProd){

                    //ACTUALIZAR REDENCIONES CON FACTURA Y DETALLE FACTURA
                    $qb = $em->createQueryBuilder(); 
                    $qb->select('r');
                    $qb->from('IncentivesRedencionesBundle:Redenciones','r');
                    $qb->leftJoin('r.historico', 'rh');
                    $qb->leftJoin('r.participante', 'pt');
                    $qb->leftJoin('r.productocatalogo', 'pc');
                    $qb->leftJoin('pc.catalogos', 'c');
                    $str_filtro = "pt.programa=".$programa->getId()." AND r.redencionestado IN (2,3,4,5,6) AND r.fecha>='".$fechaInicio."'  AND r.fecha<='".$pro["fechaFin"]."' AND r.facturaProducto IS NULL AND pc.producto=".$valueProd->getProducto()->getId()." AND c.pais=".$pais->getId();
                    $qb->where($str_filtro);
                    //echo $qb->getDql(); exit;
                    $RedencionesFactura = $qb->getQuery()->getResult();

                    foreach($RedencionesFactura as $KeyRedencion => $valueRedencion){
                        $valueRedencion->setFacturaproducto($valueProd);
                        $em->persist($valueRedencion);
                    }
                    
                    $em->flush();
                }

                if($ip>0){

                    $pdf = $this->pdfAction($factura->getId());
                    $excel = $this->detallePremiosAction($factura->getId());
                    
                    $this->get('session')->getFlashBag()->add('notice', 'La factura con numero '.$factura->getNumero().' se creo correctamente');
                }else{
                    
                    $em->remove($factura);
                    $em->flush();

                    $this->get('session')->getFlashBag()->add('warning', 'No se encontraron datos para facturar');
                }
                
                return $this->redirect($this->generateUrl('facturas_listado').'/'.$programa->getId());
            }
        }
        
        //Buscar ultima fecha de facturacion
        $qb = $em->createQueryBuilder(); 
        $qb->select('MAX(f.fechaFin) fecha');
        $qb->from('IncentivesFacturacionBundle:Factura','f');
        $str_filtro = "f.programa=".$programa->getId();
        $qb->where($str_filtro);
        $fechaInicio = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $fechaInicio = $fechaInicio[0]['fecha'];
        $fechaInicio = strtotime ( '+1 day' , strtotime($fechaInicio) ) ;
        
        if($fechaInicio=="0000-00-00" && $fechaInicio==""){
            $fechaInicio = $programa->getFechainicio()->format('Y-m-d');
        }
        
        $fechaFin = strtotime ( '+1 month', $fechaInicio ) ;
        $fechaFin = strtotime ( '-1 day' , $fechaFin ) ;

        $fechaFin = date ( 'Y-m-d' , $fechaFin );
        $fecha = date('Y-m-d');
        
        return $this->render('IncentivesFacturacionBundle:Facturas:nuevaRedenciones.html.twig', array(
            'form' => $form->createView(), 'programa' => $programa, 'pais' => $pais, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin, 'fecha' => $fecha
        ));
    }
    
    public function requisicionesGenerarAction(Request $request)
    {        
        $em = $this->getDoctrine()->getManager();
        
        $pais = 1;
        $programa = intval($request->get('programa'));
        
        $facturas = $em->getRepository('IncentivesFacturacionBundle:Factura')->findAll();
        $factura = new Factura();
        $detalle = new FacturaDetalle();

        $form = $this->createForm(new FacturaType(array('programa' => $programa), $factura));
        
        $programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($programa);
        $pais = $em->getRepository('IncentivesOperacionesBundle:Pais')->find($pais);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            $pro=($request->request->get('factura'));

            if ($form->isValid()) {

                $id=($request->request->get('programa'));
                
                $ordenes = $em->getRepository('IncentivesFacturacionBundle:Factura')->findAll();
                
                $factura->setPrograma($programa);
                $pais = $em->getRepository('IncentivesOperacionesBundle:Pais')->find(1);
                $factura->setPais($pais);
                $factura->setNumero(str_pad(count($ordenes)+1, 3, '0', STR_PAD_LEFT)."-".date_create("now")->format('y'));
                $factura->setFecha(date_create($pro["fecha"]));
                $factura->setFechaInicio(date_create($pro["fechaInicio"]));
                $factura->setFechafin(date_create($pro["fechaFin"]));
                $periodo = $em->getRepository('IncentivesFacturacionBundle:Periodos')->find($pro["periodo"]);	
				$factura->setPeriodo($periodo);

                $em->persist($factura);
                $em->flush();
                
                $incluyeLogistica= 0;
                if(isset($pro["logistica"])) $incluyeLogistica = $pro["logistica"];
				
				$fechaInicio = strtotime('-1 day', strtotime($pro["fechaInicio"]));
				$fechaInicio = date('Y-m-d', $fechaInicio);
				
				$ip = 0;
				
                        //Cotizaciones
                        //CONTAR CANTIDADES POR PRODUCTO Y PRECIOS
                        $qb = $em->createQueryBuilder(); 
                        $qb->select('cp','c','p');
                        $qb->from('IncentivesSolicitudesBundle:CotizacionProducto','cp');
                        $qb->leftJoin('cp.cotizacion', 'c');
                        $qb->leftJoin('c.solicitud', 's');
                        $qb->leftJoin('cp.producto', 'p');
                        $str_filtro = "cp.facturaProducto IS NULL AND cp.estado in (2,6,5) AND s.estado IN (2,3,5) AND s.programa=".$programa->getId()." AND s.fechaSolicitud>='".$pro["fechaInicio"]."' AND s.fechaSolicitud<='".$pro["fechaFin"]."'";
                        $qb->where($str_filtro);
                        $ProductosFactura = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

                        //Crear detalle factura
                        foreach($ProductosFactura as $keyProd => $valueProd){
                            
                            $ip++;
                            //
                            $cantidad = $valueProd['cantidad'];
                            $valorVenta = $valueProd['valorunidad']/(1-($valueProd['incremento']/100)) + $valueProd['logistica'];
                            $productoId = $valueProd['producto']['id'];
                            $valorTotal = $valorVenta * $cantidad;
                            
                            $Productos = new FacturaProductos();
                            $Productos->setFactura($factura);
                            $Infoproducto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($productoId);
                            $Productos->setProducto($Infoproducto);
                            $Productos->setCantidad($cantidad);
                            $Productos->setValorUnitario($valorVenta);
                            $Productos->setValorTotal($valorTotal);
                            $Productos->setDescripcion($valueProd['producto']['nombre']);
                            $em->persist($Productos);
                            
                            $productoCotizacion = $em->getRepository('IncentivesSolicitudesBundle:CotizacionProducto')->find($valueProd['id']);
                            $productoCotizacion->setFacturaProducto($Productos);
                            $em->persist($productoCotizacion);
                            
                            $em->flush();
                        }
                        
                        //Requisicones
                        //CONTAR CANTIDADES POR PRODUCTO Y PRECIOS
                        $qb = $em->createQueryBuilder(); 
                        $qb->select('rp','r','p');
                        $qb->from('IncentivesSolicitudesBundle:RequisicionProducto','rp');
                        $qb->leftJoin('rp.requisicion', 'r');
                        $qb->leftJoin('r.solicitud', 's');
                        $qb->leftJoin('rp.producto', 'p');
                        $str_filtro = "rp.facturaProducto IS NULL AND s.programa=".$programa->getId()." AND s.fechaSolicitud>='".$pro["fechaInicio"]."' AND s.fechaSolicitud<='".$pro["fechaFin"]."'";
                        $qb->where($str_filtro);
                        $ProductosFactura = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

                        //Crear detalle factura
                        foreach($ProductosFactura as $keyProd => $valueProd){
                            
                            $ip++;
                            //
                            $cantidad = $valueProd['cantidad'];
                            $valorVenta = $valueProd['valorunidad'];
                            $productoId = $valueProd['producto']['id'];
                            $logistica = $valueProd['logistica'];
                            $valorTotal = $valorVenta * $cantidad;
                            
                            if($incluyeLogistica==1){
                                $valorTotal += $valorTotal + ($logistica*$cantidad);
                            }
                            
                            $Productos = new FacturaProductos();
                            $Productos->setFactura($factura);
                            $Infoproducto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($productoId);
                            $Productos->setProducto($Infoproducto);
                            $Productos->setCantidad($cantidad);
                            $Productos->setValorUnitario($valorVenta);
                            $Productos->setValorTotal($valorTotal);
                            $Productos->setDescripcion($valueProd['producto']['nombre']);
                            $em->persist($Productos);
                            
                            
                            $productoRequisicion = $em->getRepository('IncentivesSolicitudesBundle:RequisicionProducto')->find($valueProd['id']);
                            $productoRequisicion->setFacturaProducto($Productos);
                            $em->persist($productoRequisicion);
                            
                            $em->flush();
                        }

			//Logistica
                        //CONSULTAR LOGISTICAS CONSOLIDADAS DE COTIZACIONES APROBADAS
                        $qb = $em->createQueryBuilder(); 
                        $qb->select('c');
                        $qb->from('IncentivesSolicitudesBundle:Cotizacion','c');
                        $qb->leftJoin('c.solicitud', 's');
                        $str_filtro = "c.facturaLogistica IS NULL AND c.logistica IS NOT NULL AND c.logistica!=0 AND s.estado IN (2,3,5) AND s.programa=".$programa->getId()." AND s.fechaSolicitud>='".$pro["fechaInicio"]."' AND s.fechaSolicitud<='".$pro["fechaFin"]."'";
                        $qb->where($str_filtro);
                        $Logistica = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

                        //Crear detalle factura
                        foreach($Logistica as $keyL => $valueL){
                            
                            $ip++;
                            
                            $FacturaLogistica = new FacturaLogistica();
                            $FacturaLogistica->setFactura($factura);
                            $FacturaLogistica->setCantidad(1);
                            $FacturaLogistica->setValorUnitario($valueL['logistica']);
                            $FacturaLogistica->setValorTotal($valueL['logistica']);
                            $FacturaLogistica->setDescripcion("Cotización ".$valueL['id']);
                            $em->persist($FacturaLogistica);
                            
                            $cotizacion = $em->getRepository('IncentivesSolicitudesBundle:Cotizacion')->find($valueL['id']);
                            $cotizacion->setFacturaLogistica($FacturaLogistica);
                            $em->persist($cotizacion);
                            
                            $em->flush();
                        }
                        				
				if($ip>0){

                    $pdf = $this->pdfAction($factura->getId());
                    $excel = $this->detalleSolicitudesAction($factura->getId());

                    $this->get('session')->getFlashBag()->add('notice', 'La factura con número '.$factura->getNumero().' se creo correctamente');
                }else{
                    
                    $em->remove($factura);
                    $em->flush();

                    $this->get('session')->getFlashBag()->add('warning', 'No se encontraron datos para facturar');
                }
                
                //return $this->redirect($this->generateUrl('facturas_listado').'/'.$id);
            
            }
        }
        
        //Buscar ultima fecha de facturacion
        $qb = $em->createQueryBuilder(); 
        $qb->select('MAX(f.fechaFin) fecha');
        $qb->from('IncentivesFacturacionBundle:Factura','f');
        $str_filtro = "f.programa=".$programa->getId();
        $qb->where($str_filtro);
        $fechaInicio = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $fechaInicio = $fechaInicio[0]['fecha'];
        $fechaInicio = strtotime ( '+1 day' , strtotime($fechaInicio) ) ;
        
        if($fechaInicio=="0000-00-00" && $fechaInicio==""){
            $fechaInicio = $programa->getFechainicio()->format('Y-m-d');
        }
        
        $fechaFin = strtotime ( '+1 month', $fechaInicio ) ;
        $fechaFin = strtotime ( '-1 day' , $fechaFin ) ;

        $fechaFin = date ( 'Y-m-d' , $fechaFin );
        $fecha = date('Y-m-d');
        
        return $this->render('IncentivesFacturacionBundle:Facturas:nuevaRequisiciones.html.twig', array(
            'form' => $form->createView(), 'programa' => $programa, 'pais' => $pais, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin, 'fecha' => $fecha
        ));
    }
    
    public function agregarLogisticaAction(Request $request, $id)
    {        
        $em = $this->getDoctrine()->getManager();
        $logistica = new FacturaLogistica();

        $form = $this->createForm(FacturaLogisticaType::class, $logistica);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                
                $id=($request->request->get('id'));
                $pro=($request->request->get('facturalogistica'));
                
                $factura = $em->getRepository('IncentivesFacturacionBundle:Factura')->find($id);
                $logistica->setCantidad($pro["cantidad"]);
                $logistica->setValorUnitario($pro["valorUnitario"]);
                $logistica->setValortotal($pro["valorUnitario"]*$pro["cantidad"]);
                $logistica->setDescripcion($pro["descripcion"]);
                $logistica->setFactura($factura);

                $em->persist($logistica);
                $em->flush();

                $this->pdfAction($id);

                return $this->redirect($this->generateUrl('factura_datos').'/'.$id);

            }
        }           

        return $this->render('IncentivesFacturacionBundle:Facturas:agregarlogistica.html.twig', array(
            'form' => $form->createView(), 'id' => $id
        ));
    }
}
