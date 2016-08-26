<?php

namespace Incentives\RedencionesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\RedencionesBundle\Entity\Redenciones;
use Incentives\RedencionesBundle\Entity\Redencionesestado;
use Incentives\RedencionesBundle\Entity\RedencionesHistorico;
use Incentives\RedencionesBundle\Entity\Redencionesenvios;
use Incentives\CatalogoBundle\Entity\Programa;
use Incentives\RedencionesBundle\Form\Type\RedencionProductoType;
use Incentives\RedencionesBundle\Form\Type\JustificacionEnvioType;
use Incentives\GarantiasBundle\Form\Type\EnvioType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Cell_DataValidation;
use PHPExcel_Style_Fill;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Connection;

ini_set('memory_limit', '-1');

class RedencionController extends Controller
{
    /**
     * @Route("/redencion/nueva")
     * @Template()
     */
    public function nuevaAction()
    {
    }

    /**
     * @Route("/redenciones")
     * @Template()
     */
    public function listadoAction()
    {
        $em = $this->getDoctrine()->getManager();

        //Consultar puntos redimidos
        $qb = $em->createQueryBuilder();            
        $qb->select('p','count(r) total');
        $qb->from('IncentivesCatalogoBundle:Programa','p');
	$qb->leftJoin('p.participantes', 'pt');
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
            
            if(isset($pendientes[0])){
                $programas[$key]['pendientes'] = $pendientes[0]['total'];
            }else{
                $programas[$key]['pendientes'] = 0;                
            }

	    $qb = $em->createQueryBuilder();            
            $qb->select('count(r) total');
            $qb->from('IncentivesRedencionesBundle:Redenciones','r');
    	    $qb->leftJoin('r.participante', 'pt');
    	    $qb->where('pt.programa='.$value[0]['id'].' AND r.redencionestado=7');
    	    $qb->groupBy('pt.programa');
            $canceladas = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            
            if(isset($canceladas[0])){
                $programas[$key]['canceladas'] = $canceladas[0]['total'];
            }else{
                $programas[$key]['canceladas'] = 0;                
            }
            
            
            $qb = $em->createQueryBuilder();            
            $qb->select('MAX(r.fechaModificacion) fechaModificacion');
            $qb->from('IncentivesRedencionesBundle:Redencioneshistorico','r');
    	    $qb->leftJoin('r.participante', 'pt');
    	    $qb->where('pt.programa='.$value[0]['id'].' AND r.redencionestado=2');
    	    $qb->groupBy('pt.programa');
            $fecha = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            
            if(isset($fecha[0])){
                $programas[$key]['fecha'] = $fecha[0]['fechaModificacion'];
            }else{
                $programas[$key]['fecha'] = null;                
            }
        }
        
       // echo "<pre>"; print_r($programas); echo "</pre>";exit;
        
        return $this->render('IncentivesRedencionesBundle:Redencion:listado.html.twig', 
            array('programas' => $programas));
    }

    /**
     * @Route("/redencion/estado/{id}")
     * @Template()
     */
    public function estadoAction($accion, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $arreglo=explode(",",$id);
        foreach ($arreglo as $key => $value) {
            if ($value!=""){
                $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($value);
                if ($accion=='autorizar'){
                    $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find("2");
                    $redencion->setRedencionestado($estado);
                    $redencion->setFechaAutorizacion(new \DateTime("now"));

                    //Guardar precios
                    $productoCatalogo = $em->getRepository('IncentivesCatalogoBundle:Productocatalogo')->find($redencion->getProductocatalogo()->getId());
                    $redencion->setValorCompra($productoCatalogo->getPrecio());
                    $redencion->setIncremento($productoCatalogo->getIncremento());
                    $redencion->setLogistica($productoCatalogo->getLogistica());

                }elseif($accion=='cancelar'){
                    $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find("7");
                    $redencion->setRedencionestado($estado);
                }       
                $em->flush();

                $redencionH = $this->get('incentives_redenciones');
                $redencionH->insertar($redencion);
            }
        }
        return $this->redirect($this->generateUrl('redenciones_datos').'/'
            .$redencion->getProductocatalogo()->getCatalogos()->getPrograma()->getId());
    }

     public function datosAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $session = $this->get('session');
         
        $page = $request->get('page');
        if(!$page) $page= 1;
            
        if($pro = $request->request->get('redenciones')){
            $page = 1;
            $session->set('filtros_redenciones', $pro);
        }
        
        $sqlFiltro = "";

        if($filtros = $session->get('filtros_redenciones')){
           
           foreach($filtros as $Filtro => $valueF){
               
               if($valueF!=""){
                   if($Filtro=="nombre"  || $Filtro=="documento"){
                        $sqlFiltro .= " AND pt.".$Filtro." LIKE '%".$valueF."%'";
                   }elseif($Filtro=="producto"){
                        $sqlFiltro .= " AND p.nombre  LIKE '%".$valueF."%'";;
                   }elseif($Filtro=="catalogo"){
                        $sqlFiltro .= " AND pc.catalogos=".$valueF;
                   }elseif($Filtro=="puntos"){
                        $sqlFiltro .= " AND r.puntos=".$valueF."";
                   }else{
                        $sqlFiltro .= " AND r.".$Filtro." LIKE '%".$valueF."%'";
                   }
               }
           } 
        }
            
        $sqlFiltro = "pt.programa=".$id." AND r.redencionestado=1 ".$sqlFiltro;

        $query = $em->createQueryBuilder()
            ->select('r','pt', 'pc','p','c') 
            ->from('IncentivesRedencionesBundle:Redenciones', 'r')
            ->leftJoin('r.participante','pt')
		    ->leftJoin('r.productocatalogo', 'pc')
		    ->leftJoin('pc.producto', 'p')
		    ->leftJoin('pc.catalogos', 'c')
		    ->where($sqlFiltro);
		    
		if($request->get('sort')){
		    $query->orderBy($request->get('sort'), $request->get('direction'));    
	    }
	    
	    $arrayFiltro['programa'] = $id;
        $catalogos = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->findBy($arrayFiltro);
		   
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $page/*page number*/,
            40 /*limit per page*/
        );

        return $this->render('IncentivesRedencionesBundle:Redencion:datos.html.twig', 
            array( 'id'=>$id, 'redenciones'=>$pagination, 'catalogos' => $catalogos, 'filtros' => $filtros));
    }

    public function listadoprogramaAction($programa, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $session = $this->get('session');
         
        $page = $request->get('page');
        if(!$page) $page= 1;
            
        if($pro = $request->request->get('redenciones')){
            $page = 1;
            $session->set('filtros_redencionesgeneral', $pro);
        }
        
        $sqlFiltro = "";

        if($filtros = $session->get('filtros_redencionesgeneral')){
           
           foreach($filtros as $Filtro => $valueF){
               
               if($valueF!=""){
                   if($Filtro=="nombre"  || $Filtro=="documento"){
                        $sqlFiltro .= " AND pt.".$Filtro." LIKE '%".$valueF."%'";
                   }elseif($Filtro=="producto"){
                        $sqlFiltro .= " AND p.nombre  LIKE '%".$valueF."%'";;
                   }elseif($Filtro=="puntos"){
                        $sqlFiltro .= " AND r.puntos=".$valueF."";
                   }elseif($Filtro=="guia"){
                        $sqlFiltro .= " AND g.".$Filtro." LIKE '%".$valueF."%'";
                   }elseif($Filtro=="redencionestado"){
                        $sqlFiltro .= " AND e.id=".$valueF;
                   }else{
                        $sqlFiltro .= " AND r.".$Filtro." LIKE '%".$valueF."%'";
                   }
               }
           } 
        }
            
        $sqlFiltro = "pt.programa=".$programa." AND r.redencionestado!=7 ".$sqlFiltro;

        $query = $em->createQueryBuilder()
            ->select('r','pt', 'pc', 'p', 'e', 'i', 'g', 'dg','d') 
            ->from('IncentivesRedencionesBundle:Redenciones', 'r')
            ->leftJoin('r.participante','pt')
		    ->leftJoin('r.productocatalogo', 'pc')
		    ->leftJoin('pc.producto', 'p')
		    ->leftJoin('r.redencionestado', 'e')
		    ->leftJoin('r.inventario', 'i')
		    ->leftJoin('r.despacho', 'd')
		    ->leftJoin('d.despachoguia', 'dg')
            ->leftJoin('dg.guia', 'g')
		    ->where($sqlFiltro);
		    
		$minimo = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
		//echo "<pre>"; print_r($minimo); echo "</pre>"; exit;
		    
		if($request->get('sort')){
		    $query->orderBy($request->get('sort'), $request->get('direction'));    
	    }
		   
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $page/*page number*/,
            40 /*limit per page*/
        );

        
        $redencion = new Redenciones();
        $form =$this->get('form.factory')->createNamedBuilder('redenciones', FormType::class,  null, array(
                ))
            ->add('redencionestado', EntityType::class, array(
                'class' => 'IncentivesRedencionesBundle:Redencionesestado',
                'choice_label' => 'nombre',
                //'empty_value' => 'Seleccione',
                'required' => false,
        ))
        ->getForm();


        return $this->render('IncentivesRedencionesBundle:Redencion:listadoprograma.html.twig', 
            array( 'programa' => $programa, 'redenciones' => $pagination, 'filtros' => $filtros, 'form' => $form->createView()));
    }
    
    public function exportarv2Action($programa)
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
                        ->setCellValue('I1','Nombre envio')
                        ->setCellValue('J1','Documento envio')
                        ->setCellValue('K1','Telefono envio')
                        ->setCellValue('L1','Celular envio')
                        ->setCellValue('M1','Direccion envio')
                        ->setCellValue('N1','Barrio envio')
                        ->setCellValue('O1','Departamento')
                        ->setCellValue('P1','Ciudad')
                        ->setCellValue('Q1','Puntos')
                        ->setCellValue('R1','Codigo EAN')
                        ->setCellValue('S1','Producto')
                        ->setCellValue('T1','Sku')
                        ->setCellValue('U1','Categoria')
                        ->setCellValue('V1','Proveedor Principal')
                        ->setCellValue('W1','Proveedor OC')
                        ->setCellValue('X1','Costo OC')
                        ->setCellValue('Y1','Valor Venta')
                        ->setCellValue('Z1','Valor Mercado')
			->setCellValue('AA1','Valor Consignacion')
                        ->setCellValue('AB1','Orden de compra')
                        ->setCellValue('AC1','Guia')
                        ->setCellValue('AD1','Operador')
                        ->setCellValue('AE1','Semaforo')
			->setCellValue('AF1','Nombre Contacto')
                        ->setCellValue('AG1','Documento Contacto')
                        ->setCellValue('AH1','Direccion Contacto')
                        ->setCellValue('AI1','Telefono Contacto')
                        //->setCellValue('AJ1','Fecha Despacho')
                        ->setCellValue('AK1','Planilla')
                        ->setCellValue('AL1','Factura');
        
            //MEGA QUERY

            $em = $this->getDoctrine()->getManager();
            $em->getConnection()->getConfiguration()->setSQLLogger(null);
            //Consultar puntos redimidos
            $qb = $em->createQueryBuilder();            
            $qb->select('r','pt','pc','pd','ct','envio','i','guia','estado','op','oc','pv','ig','pl','fp','f');
            /*$qb->addSelect('(SELECT COALESCE(Max(his.fecha))
                FROM IncentivesRedencionesBundle:RedencionesHistorico his
                WHERE his.redencion = r.id) modificacion'
            );*/
            $qb->from('IncentivesRedencionesBundle:Redenciones','r');
            $qb->leftJoin('r.productocatalogo', 'pc');
            $qb->leftJoin('pc.producto', 'pd');
            $qb->leftJoin('pd.categoria', 'ct');
            $qb->leftJoin('pc.catalogos', 'c');
            $qb->leftJoin('r.participante', 'pt');
            $qb->leftJoin('r.redencionesenvios', 'envio');
            $qb->leftJoin('r.redencionestado', 'estado');
            $qb->leftJoin('r.facturaProducto', 'fp');
            $qb->leftJoin('fp.factura', 'f');
            $qb->leftJoin('r.inventario', 'i');
            $qb->leftJoin('i.inventarioguia', 'ig');
            $qb->leftJoin('i.planilla', 'pl');
            $qb->leftJoin('ig.guia', 'guia');
            $qb->leftJoin('r.ordenesProducto', 'op');
            $qb->leftJoin('op.ordenesCompra', 'oc');
            $qb->leftJoin('oc.proveedor', 'pv');
            $qb->orderBy('r.fecha', 'ASC');
            
            //$qb->leftJoin('r.historico', 'historico', 'WITH', 'historico.redencionestado = 2');
            //$qb->leftJoin('pd.productoprecio', 'precio', 'WITH', 'precio.principal = 1');
            //$qb->leftJoin('precio.proveedor', 'precioproveedor');
            
            $str_filtro = 'pt.programa = '.$programa;
            $str_filtro .= " AND r.redencionestado != 7";
            
			if($programa==11) $str_filtro .= " AND r.id >= 18000";
			
            //$qb->setMaxResults('2000');
            //$str_filtro .= ' AND r.id > 19000';
            $qb->where($str_filtro);
			$query = $qb->getQuery();
			$query->useQueryCache(false);
			$query->useResultCache(false);
            $redenciones = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            //echo "<pre>";print_r(count($redenciones)); exit;
            
            $fil=2;
            foreach($redenciones as $key => $value){              

                $guiaP = "";
                $Operador="";

                //Redencion, participante, producto
                $PHPexcel->getActiveSheet()
                        ->setCellValueByColumnAndRow(0, $fil, $value['id'])
                        ->setCellValueByColumnAndRow(1, $fil, $value['fecha']->format('Y-m-d'))
                        //->setCellValueByColumnAndRow(3, $fil, $value['fechaModificacion']->format('Y-m-d'))
                        ->setCellValueByColumnAndRow(4, $fil, $value['redimidopor'])
                        ->setCellValueByColumnAndRow(5, $fil, $value['codigoredencion'])
                        ->setCellValueByColumnAndRow(6, $fil, $value['participante']['nombre'])
                        ->setCellValueByColumnAndRow(7, $fil, $value['participante']['documento'])
                        ->setCellValueByColumnAndRow(8, $fil, $value['participante']['nombre'])
                        ->setCellValueByColumnAndRow(9, $fil, $value['participante']['documento'])
                        ->setCellValueByColumnAndRow(16, $fil, $value['puntos'])
                        ->setCellValueByColumnAndRow(17, $fil, $value['productocatalogo']['producto']['codEAN'])
                        ->setCellValueByColumnAndRow(18, $fil, $value['productocatalogo']['producto']['nombre'])
                        ->setCellValueByColumnAndRow(19, $fil, $value['productocatalogo']['producto']['codInc'])
                        ->setCellValueByColumnAndRow(20, $fil, $value['productocatalogo']['producto']['categoria']['nombre'])
                        ->setCellValueByColumnAndRow(26, $fil, $value['valor'])
                        ->setCellValueByColumnAndRow(30, $fil, $value['redencionestado']['nombre']);

                
                //if(isset($value['fechaModificacion']) && $value['fechaModificacion']!="0000-00-00") $PHPexcel->getActiveSheet()->setCellValueByColumnAndRow(3, $fil, $value['fechaModificacion']->format('Y-m-d'));
                
                if($value['fechaAutorizacion']!= null) $PHPexcel->getActiveSheet()->setCellValueByColumnAndRow(2, $fil, $value['fechaAutorizacion']->format('Y-m-d'));
                //if($value['fechaDespacho']!= null) $PHPexcel->getActiveSheet()->setCellValueByColumnAndRow(35, $fil, $value['fechaDespacho']->format('Y-m-d'));
                /*if(isset($value['productoprecio'][0])){
                    $PHPexcel ->getActiveSheet()
                         ->setCellValueByColumnAndRow(21, $fil, $value['productoprecio'][0]['proveedor']['nombre'])
                         ->setCellValueByColumnAndRow(25, $fil, $value['productoprecio'][0]['precio']);
                }*/

		//if($value['fechaAutorizacion']!=null && $value['fechaAutorizacion']->format('Y-m-d')!="-0001-11-30") $PHPexcel->getActiveSheet()->setCellValueByColumnAndRow(2, $fil, $value['fechaAutorizacion']->format('Y-m-d'));
                 
                 //Envio
                 if(isset($value['redencionesenvios'][0])){
                    $PHPexcel ->getActiveSheet()
                        ->setCellValueByColumnAndRow(10, $fil, $value['redencionesenvios'][0]['telefono'])
                        ->setCellValueByColumnAndRow(11, $fil, $value['redencionesenvios'][0]['celular'])
                        ->setCellValueByColumnAndRow(12, $fil, $value['redencionesenvios'][0]['direccion'])
                        ->setCellValueByColumnAndRow(13, $fil, $value['redencionesenvios'][0]['barrio'])
                        ->setCellValueByColumnAndRow(14, $fil, $value['redencionesenvios'][0]['departamentoNombre'])
                        ->setCellValueByColumnAndRow(15, $fil, $value['redencionesenvios'][0]['ciudadNombre'])
		            	->setCellValueByColumnAndRow(31, $fil, $value['redencionesenvios'][0]['nombreContacto'])
                        ->setCellValueByColumnAndRow(32, $fil, $value['redencionesenvios'][0]['documentoContacto'])
                        ->setCellValueByColumnAndRow(33, $fil, $value['redencionesenvios'][0]['direccionContacto'])
                        ->setCellValueByColumnAndRow(34, $fil, $value['redencionesenvios'][0]['telefonoContacto']);
                 }
                 
		if($value['redencionestado']['id'] > 3 && !isset($value['ordenesProducto'])){
			$PHPexcel->getActiveSheet()
        	                    ->setCellValueByColumnAndRow(27, $fil, "Inventario");

		} 

                 //OC
                 if(isset($value['ordenesProducto'])){
                
                     $PHPexcel ->getActiveSheet()
                            ->setCellValueByColumnAndRow(22, $fil, $value['ordenesProducto']['ordenesCompra']['proveedor']['nombre'])
                            ->setCellValueByColumnAndRow(23, $fil, $value['ordenesProducto']['valorunidad'])
                            ->setCellValueByColumnAndRow(27, $fil, $value['ordenesProducto']['ordenesCompra']['consecutivo']);
                            
                    $precioV = $value['ordenesProducto']['valorunidad'] * (1 + $value['productocatalogo']['producto']['incremento']/100) + $value['productocatalogo']['producto']['logistica'];  
                    $PHPexcel ->getActiveSheet()->setCellValueByColumnAndRow(24, $fil, $precioV);


                 }
                 
                 $strGuias = "";
                 $strOperador = "";
                 $planilla = "";
                 $factura = "";

                //Guias 
                
                if(isset($value['inventario'])){
                    foreach($value['inventario'] as $keyI => $valueI){
                        $planilla .=  $valueI['planilla']['id'].",";
                        foreach($valueI['inventarioguia'] as $keyG => $valueG){
                            $strGuias .=  $valueG['guia']['guia'].",";
                            $strOperador .=  $valueG['guia']['operador'].",";
                        }
                    }

                   $PHPexcel ->getActiveSheet()
                                    ->setCellValueByColumnAndRow(28, $fil, $strGuias)
                                    ->setCellValueByColumnAndRow(29, $fil, $strOperador)
                                    ->setCellValueByColumnAndRow(36, $fil, $planilla);     
                }

                if(isset($value['facturaProducto'])){
						$factura = $value['facturaProducto']['factura']['numero'];
				}
                $PHPexcel ->getActiveSheet()->setCellValueByColumnAndRow(37, $fil, $factura);
                //Otros
                    if($value['otros']!=""){
                        $iR = 38;
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

            $objWriter = new PHPExcel_Writer_Excel2007($PHPexcel); 
            $objWriter->save('Redenciones_programa.xlsx');  //send it to user, of course you can save it to disk also!
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
            $filename = 'Redenciones_programa.xlsx';
            $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
            $filePath = $basePath.'/'.$filename; 
             
            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
            return $response;

    }
    
    
    public function exportarOldAction($programa)
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
                        ->setCellValue('I1','Nombre envio')
                        ->setCellValue('J1','Documento envio')
                        ->setCellValue('K1','Telefono envio')
                        ->setCellValue('L1','Celular envio')
                        ->setCellValue('M1','Direccion envio')
                        ->setCellValue('N1','Barrio envio')
                        ->setCellValue('O1','Departamento')
                        ->setCellValue('P1','Ciudad')
                        ->setCellValue('Q1','Puntos')
                        ->setCellValue('R1','Codigo EAN')
                        ->setCellValue('S1','Producto')
                        ->setCellValue('T1','Sku')
                        ->setCellValue('U1','Categoria')
                        ->setCellValue('V1','Proveedor Principal')
                        ->setCellValue('W1','Proveedor OC')
                        ->setCellValue('X1','Costo OC')
                        ->setCellValue('Y1','Valor Venta')
                        ->setCellValue('Z1','Valor Mercado')
			->setCellValue('AA1','Valor Consignacion')
                        ->setCellValue('AB1','Orden de compra')
                        ->setCellValue('AC1','Guia')
                        ->setCellValue('AD1','Operador')
                        ->setCellValue('AE1','Semaforo')
			->setCellValue('AF1','Nombre Contacto')
                        ->setCellValue('AG1','Documento Contacto')
                        ->setCellValue('AH1','Direccion Contacto')
                        ->setCellValue('AI1','Telefono Contacto');

            $em = $this->getDoctrine()->getManager();
            //Consultar puntos redimidos
            $qb1 = $em->createQueryBuilder();            
            $qb1->select('r');
            $qb1->from('IncentivesRedencionesBundle:Redenciones','r');
            $qb1->leftJoin('r.productocatalogo', 'pc');
            $qb1->leftJoin('pc.catalogos', 'c');
            $str_filtro = 'c.programa = '.$programa;
            $str_filtro .= " AND r.redencionestado != 7";
            $qb1->where($str_filtro);
            $redenciones = $qb1->getQuery()->getResult();

            $fil=2;
            foreach($redenciones as $key => $value){              

                $redencionesEnvios = $value->getRedencionesenvios();

                //Fecha de autorizacion
                $qb = $em->createQueryBuilder();            
                $qb->select('r');
                $qb->from('IncentivesRedencionesBundle:RedencionesHistorico','r');
                $str_filtro = 'r.redencion = '.$value->getId();
                $str_filtro .= " AND r.redencionestado = 2";
                $qb->where($str_filtro);
                $qb->orderBy('r.id', 'DESC');
                $qb->setMaxResults(1);
                $autorizacion = $qb->getQuery()->getOneOrNullResult();
                if(isset($autorizacion)) $fechaAut = $autorizacion->getFecha()->format('Y-m-d'); else $fechaAut ="";

                //Ultima modificacion
                /*$qb = $em->createQueryBuilder();            
                $qb->select('r');
                $qb->from('IncentivesRedencionesBundle:RedencionesHistorico','r');
                $str_filtro = 'r.redencion = '.$value->getId();
                $qb->where($str_filtro);
                $qb->orderBy('r.fecha', 'DESC');
                $qb->setMaxResults(1);
                $modificacion = $qb->getQuery()->getOneOrNullResult();*/
                $fechaMod ="";
                //if(isset($autorizacion)) $fechaMod = $modificacion->getFecha()->format('Y-m-d'); else $fechaMod ="";

                //Buscar los proveedores para cada producto
                 $qb = $em->createQueryBuilder()
                     ->select('precio')
                     ->from('IncentivesCatalogoBundle:Productoprecio','precio')
                     ->Join('precio.proveedor', 'pro')
                     ->Join('precio.producto', 'pr')
                     ->setMaxResults(1)
                     ->where('precio.principal = 1 AND pr.id='.$value->getProductocatalogo()->getProducto()->getId());
                $proveedorP = $qb->getQuery()->getOneOrNullResult();

                $proveedorPP = "";
                $precioP = "";
                $precioV = "";
                //armar el arreglo de proveedores - productos
                if(isset($proveedorP)){
                  $proveedorPP = $proveedorP->getProveedor()->getNombre();
                  $precioP = $proveedorP->getPrecio();
                  //$precioV = $proveedorP->getPrecio() * (1 + $proveedorP->getProducto()->getIncremento()/100) + $proveedorP->getProducto()->getLogistica();
                }

                $ordenC="";
		if($value->getRedencionestado()->getId() > 3) $ordenC = "Inventario";
                if($value->getOrdenesProducto()) $ordenC = $value->getOrdenesProducto()->getOrdenesCompra()->getConsecutivo();

                $guiaP = "";
                
                /*if(isset($value->getOrdenesProducto())){
                    $guias = $value->getOrdenesProducto()->getGuiaEnvio();
                    $guiaP = $guias[0]->getGuia();
                } */

                $Operador="";

                /*if($guias = $value->getOrdenesProducto()){
                    $guias = $value->getOrdenesProducto()->getGuiaEnvio();
                    if(isset($guias[0])){
                        $guiaP = $guias[0]->getGuia();
                        if($guias[0]->getOperador()) $Operador = $guias[0]->getOperador();
                        
                    } 

                }*/

		if($value->getInventario()){
                    $inventario = $value->getInventario();
                    if(isset($inventario[0])){
                       $guias = $inventario[0]->getGuia();
                        if(isset($guias[0])){
                            $guiaP = $guias[0]->getGuia();
                            if($guias[0]->getOperador()) $Operador = $guias[0]->getOperador();
                        } 
                    } 
                }

                $PHPexcel ->getActiveSheet()
                        ->setCellValueByColumnAndRow(0, $fil, $value->getId())
                        ->setCellValueByColumnAndRow(1, $fil, $value->getFecha()->format('Y-m-d'))
                        ->setCellValueByColumnAndRow(2, $fil, $fechaAut)
                        ->setCellValueByColumnAndRow(3, $fil, $fechaMod)
                        ->setCellValueByColumnAndRow(4, $fil, $value->getRedimidopor())
                        ->setCellValueByColumnAndRow(5, $fil, $value->getCodigoredencion())
                        ->setCellValueByColumnAndRow(6, $fil, $value->getParticipante()->getNombre())
                        ->setCellValueByColumnAndRow(7, $fil, $value->getParticipante()->getDocumento())
                        ->setCellValueByColumnAndRow(8, $fil, $value->getParticipante()->getNombre())
                        ->setCellValueByColumnAndRow(9, $fil, $value->getParticipante()->getDocumento())
                        ->setCellValueByColumnAndRow(10, $fil, $redencionesEnvios[0]->getTelefono())
                        ->setCellValueByColumnAndRow(11, $fil, $redencionesEnvios[0]->getCelular())
                        ->setCellValueByColumnAndRow(12, $fil, $redencionesEnvios[0]->getDireccion())
                        ->setCellValueByColumnAndRow(13, $fil, $redencionesEnvios[0]->getBarrio())
                        ->setCellValueByColumnAndRow(14, $fil, $redencionesEnvios[0]->getDepartamentoNombre())
                        ->setCellValueByColumnAndRow(15, $fil, $redencionesEnvios[0]->getCiudadNombre())
                        ->setCellValueByColumnAndRow(16, $fil, $value->getPuntos())
                        ->setCellValueByColumnAndRow(17, $fil, $value->getProductocatalogo()->getProducto()->getId())
                        ->setCellValueByColumnAndRow(18, $fil, $value->getProductocatalogo()->getProducto()->getNombre())
                        ->setCellValueByColumnAndRow(19, $fil, $value->getProductocatalogo()->getProducto()->getcodInc())
                        ->setCellValueByColumnAndRow(20, $fil, $value->getProductocatalogo()->getProducto()->getCategoria()->getNombre())
                        ->setCellValueByColumnAndRow(21, $fil, $proveedorPP)
                        ->setCellValueByColumnAndRow(24, $fil, $precioV)
                        ->setCellValueByColumnAndRow(25, $fil, $precioP)
                        ->setCellValueByColumnAndRow(26, $fil, $value->getValor())
                        ->setCellValueByColumnAndRow(27, $fil, $ordenC)
                        ->setCellValueByColumnAndRow(28, $fil, $guiaP)
                        ->setCellValueByColumnAndRow(29, $fil, $Operador)
                        ->setCellValueByColumnAndRow(30, $fil, $value->getRedencionestado()->getNombre())
			->setCellValueByColumnAndRow(31, $fil, $redencionesEnvios[0]->getNombreContacto())
                        ->setCellValueByColumnAndRow(32, $fil, $redencionesEnvios[0]->getDocumentoContacto())
                        ->setCellValueByColumnAndRow(33, $fil, $redencionesEnvios[0]->getDireccionContacto())
                        ->setCellValueByColumnAndRow(34, $fil, $redencionesEnvios[0]->getTelefonoContacto());

                        if($value->getOrdenesProducto()){
                            $PHPexcel->getActiveSheet()->setCellValueByColumnAndRow(22, $fil, $value->getOrdenesProducto()->getOrdenescompra()->getProveedor()->getNombre())
                                ->setCellValueByColumnAndRow(23, $fil, $value->getOrdenesProducto()->getValorunidad());

                            $precioV = $value->getOrdenesProducto()->getValorunidad() * (1 + $proveedorP->getProducto()->getIncremento()/100) + $proveedorP->getProducto()->getLogistica();  
                            $PHPexcel ->getActiveSheet()->setCellValueByColumnAndRow(24, $fil, $precioV);
                        }


                        if($value->getOtros()!=""){
                            $iR = 34;
                            $otrosR = explode(";", $value->getOtros());

                            foreach ($otrosR as $keyR) {
                                $iR++;
                                $valueR = explode(":", $keyR);
                                $PHPexcel ->getActiveSheet()->setCellValueByColumnAndRow($iR, 1, $valueR[0]);
                                $PHPexcel ->getActiveSheet()->setCellValueByColumnAndRow($iR, $fil, $valueR[1]);
                            }
                        }
                $fil++;

                /*if($otros!=""){
                    
                    $otros = explode(";", $otros);
                
                    foreach($otros as $keyO){
                        $camposO = explode(":", $keyO);
                            $redencionesP[$key][$camposO[0]] = $camposO[1];
                    }
                }*/

            }


            /*$conn = $this->get('database_connection'); 
            
            $nom_prog = $conn->fetchColumn('SELECT nombre FROM Programa WHERE id ='.$programa, array(1), 0);                    

            $Descarga->getActiveSheet()
                        ->setCellValue('A1','Participante')
                        ->setCellValue('B1','Cedula')
                        ->setCellValue('C1','Producto')
                        ->setCellValue('D1','Referencia')
                        ->setCellValue('E1','Marca')
                        ->setCellValue('F1','CODINC')
                        ->setCellValue('G1','Descripción')
                        ->setCellValue('H1','Programa')
                        ->setCellValue('I1','Codigo Redención')
                        ->setCellValue('J1','Estado Historico')
                        ->setCellValue('K1','Fecha')
                        ->setCellValue('L1','Observación Historico')
                        ->setCellValue('M1','Estado')
                        ->setCellValue('N1','Fecha');
            $fil=2;
            
            
            //print_r($redencion);
            
            if($redencion!=null) {
                foreach ($redencion as $key => $value) {
                    //print($value->getParticipante()->getNombre());
                    $fecha__=array();
                    foreach ($value->getFecha() as $clave => $valor) {
                        array_push($fecha__, $valor);
                    }
                    $fecha_1 = $fecha__[0];
                    //print($fecha__[0]);
                        
                    $redencion_hist = $em->getRepository('IncentivesRedencionesBundle:RedencionesHistorico')->findByRedencion($value->getId());
                    
                    
                    foreach ($redencion_hist as $key2 => $value2) {
                        $fecha_h=array();
                        foreach ($value2->getFecha() as $clave2 => $valor2) {
                            array_push($fecha_h, $valor2);
                        }
                        $fecha_2 = $fecha_h[0];

                        $Descarga->getActiveSheet()
                            ->setCellValue('A'.$fil, $value->getParticipante()->getNombre())
                            ->setCellValue('B'.$fil, $value->getParticipante()->getDocumento())
                            ->setCellValue('C'.$fil, $value->getProductocatalogo()->getProducto()->getNombre())
                            ->setCellValue('D'.$fil, $value->getProductocatalogo()->getProducto()->getReferencia())
                            ->setCellValue('E'.$fil, $value->getProductocatalogo()->getProducto()->getMarca())
                            ->setCellValue('F'.$fil, $value->getProductocatalogo()->getProducto()->getCodInc())
                            ->setCellValue('G'.$fil, $value->getProductocatalogo()->getProducto()->getDescripcion())
                            ->setCellValue('H'.$fil, $nom_prog)
                            ->setCellValue('I'.$fil, $value->getId())
                            ->setCellValue('M'.$fil, $value->getRedencionestado()->getNombre())
                            ->setCellValue('N'.$fil, $fecha_1);

                        $Descarga->getActiveSheet()
                            ->setCellValue('J'.$fil, $value2->getRedencionestado()->getNombre())
                            ->setCellValue('K'.$fil, $fecha_2)
                            ->setCellValue('L'.$fil, $value2->getObservacion());
                        
                        $fil+=1;                        
                    }   
                }
            }*/
            
                
            $objWriter = new PHPExcel_Writer_Excel2007($PHPexcel); 
            $objWriter->save('Redenciones_programa.xlsx');  //send it to user, of course you can save it to disk also!
             // prepare BinaryFileResponse
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
            $filename = 'Redenciones_programa.xlsx';
            $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
            $filePath = $basePath.'/'.$filename; 
             
            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
            return $response;

    }
    

    public function semaforoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($id);
        $participantes = $em->getRepository('IncentivesRedencionesBundle:Participantes')->findByPrograma($programa);
        $redenciones = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->findByParticipante($participantes);
        $historico = $em->getRepository('IncentivesRedencionesBundle:RedencionesHistorico')->findByParticipante($participantes);
        $max=count($redenciones);
        $dias=array_fill(0, $max+1, array_fill(0, 9, 0));
        $fecha=date_create("now");
        $i=0;
        foreach ($redenciones as $key => $value) {
            $dias[$value->getId()]=explode(",",$this->diferenciaAction($value->getId()));
            $i++;
        }

        return $this->render('IncentivesRedencionesBundle:Redencion:semaforo.html.twig', 
            array( 'id'=>$id, 'programa'=>$programa, 'redenciones'=>$redenciones, 'historico'=>$historico, 'dias'=>$dias));
    }

    public function diferenciaAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $historico = $em->getRepository('IncentivesRedencionesBundle:RedencionesHistorico')->findByRedencion($id);
        $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($id);
        $dias=array_fill(0, 7, 0);
        $fecha=date_create("now");
        if ($redencion!=null){
            $programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($redencion->getParticipante()->getPrograma()->getId());
            $participante = $em->getRepository('IncentivesRedencionesBundle:Participantes')->find($redencion->getParticipante()->getId());
                     
            foreach ($historico as $key => $value) {
                $inicio=$em->getRepository('IncentivesRedencionesBundle:RedencionesHistorico')->findOneByRedencion($value->getRedencion());
                $dias[0]=$inicio->getFecha()->format("Y-m-d");
                for ($i=$inicio->getFecha(); $i < $fecha ; date_modify($i, '+1 day')) { 
                    if ($value->getFecha()<=$i){
                        switch ($value->getRedencionestado()->getId()) {
                            case '1':
                                    $dias[1]++;
                                break;
                            case '2':
                                    $dias[2]++;
                                break;
                            case '3':
                                    $dias[3]++;
                                break;
                            case '4':
                                    $dias[4]++;
                                break;
                            case '5':
                                    $dias[5]++;
                                break;
                            case '6':
                                    $dias[6]++;
                                break;
                            default:
                                break;
                        }
                    }                
                }
            }

            if ($dias[1]-$dias[2]-$dias[3]-$dias[4]-$dias[5]-$dias[6]>=0){
                $dias[1]=$dias[1]-$dias[2]-$dias[3]-$dias[4]-$dias[5]-$dias[6];
            }
            if ($dias[2]-$dias[3]-$dias[4]-$dias[5]-$dias[6]>=0){
                $dias[2]=$dias[2]-$dias[3]-$dias[4]-$dias[5]-$dias[6];
            }
            if ($dias[3]-$dias[4]-$dias[5]-$dias[6]>=0){
                $dias[3]=$dias[3]-$dias[4]-$dias[5]-$dias[6];
            }
            if ($dias[4]-$dias[5]-$dias[6]>=0){
                $dias[4]=$dias[4]-$dias[5]-$dias[6];
            }
            if ($dias[5]-$dias[6]>=0){
                $dias[5]=$dias[5]-$dias[6];
            }
        }
        return implode(",",$dias);
    }

    public function datosredencionAction($redencion)
    {
        $em = $this->getDoctrine()->getManager();

        $redencionD = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($redencion);
        $historico = $em->getRepository('IncentivesRedencionesBundle:Redencioneshistorico')->findByRedencion($redencion);
        $datosenvio = $em->getRepository('IncentivesRedencionesBundle:Redencionesenvios')->findByRedencion($redencion);
        $imagen = $em->getRepository('IncentivesCatalogoBundle:Imagenproducto')->findBy(array('producto' => $redencionD->getProductocatalogo()->getProducto()->getId(), 'estado' => 1));

        return $this->render('IncentivesRedencionesBundle:Redencion:datosredencion.html.twig', 
            array( 'datosenvio' => $datosenvio[0], 'historico' => $historico, 'redencion' => $redencionD, 'imagen' => $imagen));
    }


    public function listadoTotalPassOldNewAction($programa)
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
                        ->setCellValue('I1','Nombre envio')
                        ->setCellValue('J1','Documento envio')
                        ->setCellValue('K1','Telefono envio')
                        ->setCellValue('L1','Celular envio')
                        ->setCellValue('M1','Direccion envio')
                        ->setCellValue('N1','Barrio envio')
                        ->setCellValue('O1','Departamento')
                        ->setCellValue('P1','Ciudad')
                        ->setCellValue('Q1','Puntos')
                        ->setCellValue('R1','Codigo EAN')
                        ->setCellValue('S1','Producto')
                        ->setCellValue('T1','Sku')
                        ->setCellValue('U1','Categoria')
                        ->setCellValue('V1','Proveedor Principal')
                        ->setCellValue('W1','Proveedor OC')
                        ->setCellValue('X1','Costo OC')
                        ->setCellValue('Y1','Valor Venta')
                        ->setCellValue('Z1','Valor Mercado')
			->setCellValue('AA1','Valor Consignacion')
			->setCellValue('AB1','Orden Compra')
                        ->setCellValue('AC1','Codigo TP')
                        ->setCellValue('AD1','Mensaje TP')
                        ->setCellValue('AE1','Semaforo')
			->setCellValue('AF1','Nombre Contacto')
                        ->setCellValue('AG1','Documento Contacto')
                        ->setCellValue('AH1','Direccion Contacto')
                        ->setCellValue('AI1','Telefono Contacto');
        
            //MEGA QUERY

            $em = $this->getDoctrine()->getManager();
            //Consultar puntos redimidos
            $qb = $em->createQueryBuilder();            
            $qb->select('r','pt','pc','pd','ct','envio','i','guia','estado','op','oc','pv');
            /*$qb->addSelect('(SELECT COALESCE(Max(his.fecha))
                FROM IncentivesRedencionesBundle:RedencionesHistorico his
                WHERE his.redencion = r.id) modificacion'
            );*/
            $qb->from('IncentivesRedencionesBundle:Redenciones','r');
            $qb->leftJoin('r.productocatalogo', 'pc');
            $qb->leftJoin('pc.producto', 'pd');
            $qb->leftJoin('pd.categoria', 'ct');
            $qb->leftJoin('pc.catalogos', 'c');
            $qb->leftJoin('r.participante', 'pt');
            $qb->leftJoin('r.redencionesenvios', 'envio');
            $qb->leftJoin('r.redencionestado', 'estado');
            $qb->leftJoin('r.inventario', 'i');
            $qb->leftJoin('i.guia', 'guia');
            $qb->leftJoin('r.ordenesProducto', 'op');
            $qb->leftJoin('op.ordenesCompra', 'oc');
            $qb->leftJoin('oc.proveedor', 'pv');
	    $qb->leftJoin('pd.productoprecio', 'pp');
            
            //$qb->leftJoin('r.historico', 'historico', 'WITH', 'historico.redencionestado = 2');
            //$qb->leftJoin('pd.productoprecio', 'precio', 'WITH', 'precio.principal = 1');
            //$qb->leftJoin('precio.proveedor', 'precioproveedor');
            
            $str_filtro = 'pt.programa = '.$programa;
            $str_filtro .= " AND pp.proveedor = 327  AND r.redencionestado != 7";
            $qb->where($str_filtro);
            $redenciones = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            //echo "<pre>";print_r($redenciones); exit;
            
            $fil=2;
            foreach($redenciones as $key => $value){              

                $guiaP = "";
                $Operador="";

                //Redencion, participante, producto
                $PHPexcel ->getActiveSheet()
                        ->setCellValueByColumnAndRow(0, $fil, $value['id'])
                        ->setCellValueByColumnAndRow(1, $fil, $value['fecha']->format('Y-m-d'))
                        //->setCellValueByColumnAndRow(2, $fil, $value['autorizacion']->format('Y-m-d'))
                        //->setCellValueByColumnAndRow(3, $fil, $value['modificacion'])
                        ->setCellValueByColumnAndRow(4, $fil, $value['redimidopor'])
                        ->setCellValueByColumnAndRow(5, $fil, $value['codigoredencion'])
                        ->setCellValueByColumnAndRow(6, $fil, $value['participante']['nombre'])
                        ->setCellValueByColumnAndRow(7, $fil, $value['participante']['documento'])
                        ->setCellValueByColumnAndRow(8, $fil, $value['participante']['nombre'])
                        ->setCellValueByColumnAndRow(9, $fil, $value['participante']['documento'])
                        ->setCellValueByColumnAndRow(16, $fil, $value['puntos'])
                        ->setCellValueByColumnAndRow(17, $fil, $value['productocatalogo']['producto']['codEAN'])
                        ->setCellValueByColumnAndRow(18, $fil, $value['productocatalogo']['producto']['nombre'])
                        ->setCellValueByColumnAndRow(19, $fil, $value['productocatalogo']['producto']['codInc'])
                        ->setCellValueByColumnAndRow(20, $fil, $value['productocatalogo']['producto']['categoria']['nombre'])
                        ->setCellValueByColumnAndRow(26, $fil, $value['valor'])
			->setCellValueByColumnAndRow(28, $fil, $value['totalPass'])
                        ->setCellValueByColumnAndRow(29, $fil, $value['mensajeTotalPass'])
                        ->setCellValueByColumnAndRow(30, $fil, $value['redencionestado']['nombre']);
                        
                /*if(isset($value['productoprecio'][0])){
                    $PHPexcel ->getActiveSheet()
                         ->setCellValueByColumnAndRow(21, $fil, $value['productoprecio'][0]['proveedor']['nombre'])
                         ->setCellValueByColumnAndRow(25, $fil, $value['productoprecio'][0]['precio']);
                }*/
                 
                 //Envio
                 if(isset($value['redencionesenvios'][0])){
                    $PHPexcel ->getActiveSheet()
                        ->setCellValueByColumnAndRow(10, $fil, $value['redencionesenvios'][0]['telefono'])
                        ->setCellValueByColumnAndRow(11, $fil, $value['redencionesenvios'][0]['celular'])
                        ->setCellValueByColumnAndRow(12, $fil, $value['redencionesenvios'][0]['direccion'])
                        ->setCellValueByColumnAndRow(13, $fil, $value['redencionesenvios'][0]['barrio'])
                        ->setCellValueByColumnAndRow(14, $fil, $value['redencionesenvios'][0]['departamentoNombre'])
                        ->setCellValueByColumnAndRow(15, $fil, $value['redencionesenvios'][0]['ciudadNombre'])
		            	->setCellValueByColumnAndRow(31, $fil, $value['redencionesenvios'][0]['nombreContacto'])
                        ->setCellValueByColumnAndRow(32, $fil, $value['redencionesenvios'][0]['documentoContacto'])
                        ->setCellValueByColumnAndRow(33, $fil, $value['redencionesenvios'][0]['direccionContacto'])
                        ->setCellValueByColumnAndRow(34, $fil, $value['redencionesenvios'][0]['telefonoContacto']);
                 }
                 
                 //OC
                 if(isset($value['ordenesProducto'])){
                
                     $PHPexcel ->getActiveSheet()
                            ->setCellValueByColumnAndRow(22, $fil, $value['ordenesProducto']['ordenesCompra']['proveedor']['nombre'])
                            ->setCellValueByColumnAndRow(23, $fil, $value['ordenesProducto']['valorunidad'])
                            ->setCellValueByColumnAndRow(27, $fil, $value['ordenesProducto']['ordenesCompra']['consecutivo']);
                            
                    $precioV = $value['ordenesProducto']['valorunidad'] * (1 + $value['productocatalogo']['producto']['incremento']/100) + $value['productocatalogo']['producto']['logistica'];  
                    $PHPexcel ->getActiveSheet()->setCellValueByColumnAndRow(24, $fil, $precioV);


                 }
                
                //Otros
                    if($value['otros']!=""){
                        $iR = 34;
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

            $objWriter = new PHPExcel_Writer_Excel2007($PHPexcel); 
            $objWriter->save('Redenciones_TotalPass.xlsx');  //send it to user, of course you can save it to disk also!
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
            $filename = 'Redenciones_TotalPass.xlsx';
            $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
            $filePath = $basePath.'/'.$filename; 
             
            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
            return $response;

    }


	public function listadoTotalPassOldAction($programa)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQueryBuilder()
            ->select('r redenciones','pc productocatalogo', 'pp productoprecio', 'participante', 'e redencionestado') 
            ->from('IncentivesRedencionesBundle:Redenciones', 'r')
            ->leftJoin('r.productocatalogo','pc')
            ->leftJoin('r.redencionestado', 'e')
		    ->leftJoin('pc.producto', 'p')
		    ->leftJoin('p.productoprecio', 'pp')
		    ->leftJoin('r.participante', 'participante')
            ->groupBy('r.id')
            ->where('pp.proveedor = 327 AND participante.programa ='.$programa);

        $redenciones = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    //print_r($redenciones);exit;

        return $this->render('IncentivesRedencionesBundle:Redencion:listadototalpass.html.twig', 
            array('redenciones' => $redenciones, 'programa' => $programa));
    }
    
    public function programastotalpassOoldAction()
    {
        $em = $this->getDoctrine()->getManager();

        $programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->findAll();
        $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->findAll();
        $estado= $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->findAll();
        $max=0;
        foreach ($programa as $key => $value) {
            $max=max($max, $value->getId());
        }
        $listado=array_fill(0, $max+1, array_fill(0, 9, 0));
        $fechas=array_fill(0, $max+1, date_create('2000-01-01'));
        foreach ($programa as $key => $value) {
            foreach ($redencion as $keys => $valued) {
                if ($value->getId()==$valued->getProductocatalogo()->getCatalogos()->getPrograma()->getId()){
                    if (date_diff($fechas[$value->getId()], $valued->getFecha()) and $valued->getRedencionestado()->getId()!=1 and $valued->getRedencionestado()->getId()!=7){
                        $fechas[$value->getId()]=$valued->getFecha();
                    }
                    $listado[$value->getId()][0]++;
                    foreach ($estado as $keyestado => $valueestado) {
                        if ($valued->getRedencionestado()->getId()==$valueestado->getId()){
                            $listado[$value->getId()][$valueestado->getId()]++;
                        }
                    }
                }
            }
        }

        return $this->render('IncentivesRedencionesBundle:Redencion:programastotalpass.html.twig', 
            array('listado' => $listado, 'programa' => $programa, 'redencion' => $redencion, 'fechas' => $fechas));
    }
    

        public function programastotalpassAction()
    {
        $em = $this->getDoctrine()->getManager();

        //Consultar puntos redimidos
        $qb = $em->createQueryBuilder();            
        $qb->select('p','count(r) total');
        $qb->from('IncentivesCatalogoBundle:Programa','p');
        $qb->leftJoin('p.participantes', 'pt');
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
            
            if(isset($pendientes[0])){
                $programas[$key]['pendientes'] = $pendientes[0]['total'];
            }else{
                $programas[$key]['pendientes'] = 0;                
            }
            
            
            $qb = $em->createQueryBuilder();            
            $qb->select('MAX(r.fechaModificacion) fechaModificacion');
            $qb->from('IncentivesRedencionesBundle:Redencioneshistorico','r');
            $qb->leftJoin('r.participante', 'pt');
            $qb->where('pt.programa='.$value[0]['id'].' AND r.redencionestado=2');
            $qb->groupBy('pt.programa');
            $fecha = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            
            if(isset($fecha[0])){
                $programas[$key]['fecha'] = $fecha[0]['fechaModificacion'];
            }else{
                $programas[$key]['fecha'] = null;                
            }
        }
        
       // echo "<pre>"; print_r($programas); echo "</pre>";exit;
        
        return $this->render('IncentivesRedencionesBundle:Redencion:programastotalpass.html.twig', 
            array('programas' => $programas));
    } 
    
    public function exportarTotalPassOldAction($programa)
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
                        ->setCellValue('I1','Nombre envio')
                        ->setCellValue('J1','Documento envio')
                        ->setCellValue('K1','Telefono envio')
                        ->setCellValue('L1','Celular envio')
                        ->setCellValue('M1','Direccion envio')
                        ->setCellValue('N1','Barrio envio')
                        ->setCellValue('O1','Departamento')
                        ->setCellValue('P1','Ciudad')
                        ->setCellValue('Q1','Puntos')
                        ->setCellValue('R1','Codigo EAN')
                        ->setCellValue('S1','Producto')
                        ->setCellValue('T1','Sku')
                        ->setCellValue('U1','Categoria')
                        ->setCellValue('V1','Proveedor Principal')
                        ->setCellValue('W1','Proveedor OC')
                        ->setCellValue('X1','Costo OC')
                        ->setCellValue('Y1','Valor Venta')
                        ->setCellValue('Z1','Valor Mercado')
			->setCellValue('AA1','Valor Consignacion')
                        ->setCellValue('AB1','Orden de compra')
                        ->setCellValue('AC1','CodigoM TP')
                        ->setCellValue('AD1','ensaje TP')
                        ->setCellValue('AE1','Semaforo')
			->setCellValue('AF1','Nombre Contacto')
                        ->setCellValue('AG1','Documento Contacto')
                        ->setCellValue('AH1','Direccion Contacto')
                        ->setCellValue('AI1','Telefono Contacto');

            $em = $this->getDoctrine()->getManager();
            //Consultar puntos redimidos
            $qb1 = $em->createQueryBuilder();            
            $qb1->select('r');
            $qb1->from('IncentivesRedencionesBundle:Redenciones','r');
            $qb1->leftJoin('r.productocatalogo', 'pc');
            $qb1->leftJoin('pc.catalogos', 'c');
	    $qb1->leftJoin('pc.producto', 'p');
	    $qb1->leftJoin('p.productoprecio', 'pp');
            $str_filtro = 'pp.proveedor = 327 AND c.programa = '.$programa;
            $str_filtro .= " AND r.redencionestado != 7";

            $qb1->where($str_filtro);
            $redenciones = $qb1->getQuery()->getResult();

            $fil=2;
            foreach($redenciones as $key => $value){              

                $redencionesEnvios = $value->getRedencionesenvios();

                //Fecha de autorizacion
                $qb = $em->createQueryBuilder();            
                $qb->select('r');
                $qb->from('IncentivesRedencionesBundle:RedencionesHistorico','r');
                $str_filtro = 'r.redencion = '.$value->getId();
                $str_filtro .= " AND r.redencionestado = 2";
                $qb->where($str_filtro);
                $qb->orderBy('r.id', 'DESC');
                $qb->setMaxResults(1);
                $autorizacion = $qb->getQuery()->getOneOrNullResult();
                if(isset($autorizacion)) $fechaAut = $autorizacion->getFecha()->format('Y-m-d'); else $fechaAut ="";

                //Ultima modificacion
                $qb = $em->createQueryBuilder();            
                $qb->select('r');
                $qb->from('IncentivesRedencionesBundle:RedencionesHistorico','r');
                $str_filtro = 'r.redencion = '.$value->getId();
                $qb->where($str_filtro);
                $qb->orderBy('r.fecha', 'DESC');
                $qb->setMaxResults(1);
                $modificacion = $qb->getQuery()->getOneOrNullResult();
                if(isset($autorizacion)) $fechaMod = $modificacion->getFecha()->format('Y-m-d'); else $fechaMod ="";

                //Buscar los proveedores para cada producto
                 $qb = $em->createQueryBuilder()
                     ->select('precio')
                     ->from('IncentivesCatalogoBundle:Productoprecio','precio')
                     ->Join('precio.proveedor', 'pro')
                     ->Join('precio.producto', 'pr')
                     ->setMaxResults(1)
                     ->where('precio.principal = 1 AND pr.id='.$value->getProductocatalogo()->getProducto()->getId());
                $proveedorP = $qb->getQuery()->getOneOrNullResult();

                $proveedorPP = "";
                $precioP = "";
                $precioV = "";
                //armar el arreglo de proveedores - productos
                if(isset($proveedorP)){
                  $proveedorPP = $proveedorP->getProveedor()->getNombre();
                  $precioP = $proveedorP->getPrecio();
                  //$precioV = $proveedorP->getPrecio() * (1 + $proveedorP->getProducto()->getIncremento()/100) + $proveedorP->getProducto()->getLogistica();
                }

                $ordenC="";
                if($value->getOrdenesProducto()) $ordenC = $value->getOrdenesProducto()->getOrdenesCompra()->getConsecutivo();

                $Operador="";

                $PHPexcel ->getActiveSheet()
                        ->setCellValueByColumnAndRow(0, $fil, $value->getId())
                        ->setCellValueByColumnAndRow(1, $fil, $value->getFecha()->format('Y-m-d'))
                        ->setCellValueByColumnAndRow(2, $fil, $fechaAut)
                        ->setCellValueByColumnAndRow(3, $fil, $fechaMod)
                        ->setCellValueByColumnAndRow(4, $fil, $value->getRedimidopor())
                        ->setCellValueByColumnAndRow(5, $fil, $value->getCodigoredencion())
                        ->setCellValueByColumnAndRow(6, $fil, $value->getParticipante()->getNombre())
                        ->setCellValueByColumnAndRow(7, $fil, $value->getParticipante()->getDocumento())
                        ->setCellValueByColumnAndRow(8, $fil, $value->getParticipante()->getNombre())
                        ->setCellValueByColumnAndRow(9, $fil, $value->getParticipante()->getDocumento())
                        ->setCellValueByColumnAndRow(10, $fil, $redencionesEnvios[0]->getTelefono())
                        ->setCellValueByColumnAndRow(11, $fil, $redencionesEnvios[0]->getCelular())
                        ->setCellValueByColumnAndRow(12, $fil, $redencionesEnvios[0]->getDireccion())
                        ->setCellValueByColumnAndRow(13, $fil, $redencionesEnvios[0]->getBarrio())
                        ->setCellValueByColumnAndRow(14, $fil, $redencionesEnvios[0]->getDepartamentoNombre())
                        ->setCellValueByColumnAndRow(15, $fil, $redencionesEnvios[0]->getCiudadNombre())
                        ->setCellValueByColumnAndRow(16, $fil, $value->getPuntos())
                        ->setCellValueByColumnAndRow(17, $fil, $value->getProductocatalogo()->getProducto()->getId())
                        ->setCellValueByColumnAndRow(18, $fil, $value->getProductocatalogo()->getProducto()->getNombre())
                        ->setCellValueByColumnAndRow(19, $fil, $value->getProductocatalogo()->getProducto()->getcodInc())
                        ->setCellValueByColumnAndRow(20, $fil, $value->getProductocatalogo()->getProducto()->getCategoria()->getNombre())
                        ->setCellValueByColumnAndRow(21, $fil, $proveedorPP)
                        ->setCellValueByColumnAndRow(24, $fil, $precioV)
                        ->setCellValueByColumnAndRow(25, $fil, $precioP)
                        ->setCellValueByColumnAndRow(26, $fil, $value->getValor())
                        ->setCellValueByColumnAndRow(27, $fil, $ordenC)
                        ->setCellValueByColumnAndRow(28, $fil, $value->getTotalPass())
                        ->setCellValueByColumnAndRow(29, $fil, $value->getMensajeTotalPass())
                        ->setCellValueByColumnAndRow(30, $fil, $value->getRedencionestado()->getNombre())
			            ->setCellValueByColumnAndRow(31, $fil, $redencionesEnvios[0]->getNombreContacto())
                        ->setCellValueByColumnAndRow(32, $fil, $redencionesEnvios[0]->getDocumentoContacto())
                        ->setCellValueByColumnAndRow(33, $fil, $redencionesEnvios[0]->getDireccionContacto())
                        ->setCellValueByColumnAndRow(34, $fil, $redencionesEnvios[0]->getTelefonoContacto());

                        if($value->getOrdenesProducto()){
                            $PHPexcel->getActiveSheet()->setCellValueByColumnAndRow(22, $fil, $value->getOrdenesProducto()->getOrdenescompra()->getProveedor()->getNombre())
                                ->setCellValueByColumnAndRow(23, $fil, $value->getOrdenesProducto()->getValorunidad());

                            $precioV = $value->getOrdenesProducto()->getValorunidad() * (1 + $proveedorP->getProducto()->getIncremento()/100) + $proveedorP->getProducto()->getLogistica();  
                            $PHPexcel ->getActiveSheet()->setCellValueByColumnAndRow(24, $fil, $precioV);
                        }


                        if($value->getOtros()!=""){
                            $iR = 34;
                            $otrosR = explode(";", $value->getOtros());

                            foreach ($otrosR as $keyR) {
                                $iR++;
                                $valueR = explode(":", $keyR);
                                $PHPexcel ->getActiveSheet()->setCellValueByColumnAndRow($iR, 1, $valueR[0]);
                                $PHPexcel ->getActiveSheet()->setCellValueByColumnAndRow($iR, $fil, $valueR[1]);
                            }
                        }
                $fil++;

            }


            
                
            $objWriter = new PHPExcel_Writer_Excel2007($PHPexcel); 
            $objWriter->save('Redenciones_programa.xlsx');  //send it to user, of course you can save it to disk also!
             // prepare BinaryFileResponse
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
            $filename = 'Redenciones_TotalPass.xlsx';
            $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
            $filePath = $basePath.'/'.$filename; 
             
            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
            return $response;

   }
   
   
    public function listadoTotalPassAction($programa){
    
        $fp = fopen('php://temp','r+');

        // Header
        $row = array(
            'Id','Fecha Redencion','Fecha Autorizacion','Fecha Modificacion','Redimido Por','Codigo Redencion','Nombre Participante'
            ,'Cedula participante','Nombre envio','Documento envio','Telefono envio','Celular envio','Direccion envio','Barrio envio'
            ,'Departamento','Ciudad','Puntos','Codigo EAN','Producto','Sku','Categoria','Proveedor Principal','Proveedor OC','Costo OC'
            ,'Valor Venta','Valor Mercado','Valor Consignacion','Orden de compra','Codigo TP','Mensaje TP','Semaforo','Nombre Contacto'
            ,'Documento Contacto','Direccion Contacto','Telefono Contacto');
        
 //print_r($redenciones); exit;       
        fputcsv($fp,$row);
        
        $em = $this->getDoctrine()->getManager();
            //Consultar puntos redimidos
            $qb = $em->createQueryBuilder();            
            $qb->select('r','pt','pc','pd','estado','ct','oc','pv','c');
            $qb->from('IncentivesRedencionesBundle:Redenciones','r');
            $qb->leftJoin('r.productocatalogo', 'pc');
            $qb->leftJoin('pc.producto', 'pd');
            $qb->leftJoin('pd.categoria', 'ct');
            $qb->leftJoin('pc.catalogos', 'c');
            $qb->leftJoin('r.participante', 'pt');
            $qb->leftJoin('r.redencionestado', 'estado');
            $qb->leftJoin('r.ordenesProducto', 'op');
            $qb->leftJoin('op.ordenesCompra', 'oc');
            $qb->leftJoin('oc.proveedor', 'pv');
            
            $str_filtro = 'pt.programa = '.$programa;
            //$str_filtro .= " AND pp.proveedor = 327  AND r.redencionestado != 7";
            $qb->where($str_filtro);
            $redenciones = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
 //print_r($redenciones); exit;
            foreach($redenciones as $key => $value){              

                $guiaP = "";
                $Operador="";
                
                $row = array();
                //Redencion, participante, producto
                $row[] = $value['id'];
                $row[] = $value['fecha']->format('Y-m-d');
                $row[] = "";
                $row[] = "";
                $row[] = $value['redimidopor'];
                $row[] = $value['codigoredencion'];
                $row[] = $value['participante']['nombre'];
                $row[] = $value['participante']['documento'];
                $row[] = $value['participante']['nombre'];
                $row[] = $value['participante']['documento'];
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                
                $row[] = $value['puntos'];
                $row[] = $value['productocatalogo']['producto']['codEAN'];
                $row[] = $value['productocatalogo']['producto']['nombre'];
                $row[] = $value['productocatalogo']['producto']['codInc'];
                $row[] = $value['productocatalogo']['producto']['categoria']['nombre'];
                $row[] = "";
                
                if(isset($value['ordenesProducto'])){
                    $row[] = $value['ordenesProducto']['ordenesCompra']['proveedor']['nombre'];
                    $row[] = $value['ordenesProducto']['valorunidad'];
                    $precioV = $value['ordenesProducto']['valorunidad'] * (1 + $value['productocatalogo']['producto']['incremento']/100) + $value['productocatalogo']['producto']['logistica'];  
                    $row[] = $precioV;
                }else{
                     $row[] = "";
                     $row[] = "";
                     $row[] = "";
                     $row[] = "";
                 }
                
                
                $row[] = $value['valor'];
                //OC
                 if(isset($value['ordenesProducto'])){
                     $row[] = $value['ordenesProducto']['ordenesCompra']['consecutivo'];
                 }else{
                     $row[] = "";
                 }
                 
                $row[] = $value['totalPass'];
                $row[] = $value['mensajeTotalPass'];
                $row[] = $value['redencionestado']['nombre'];

                 //Envio
                $row[] = "";
                $row[] = "";
                $row[] = "";
                $row[] = "";
                 
                fputcsv($fp,$row);

            }
        
        rewind($fp);
        $csv = stream_get_contents($fp);
        fclose($fp);
        
        $filename = 'Redenciones_TotalPass.xls';
        $response = new Response($csv);
    
        $response->headers->set('Content-Type', "text/csv");
        $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $filename));
    
        return $response;
    }

    public function editarProductoAction(Request $request, $redencion)
    {
        $em = $this->getDoctrine()->getManager();

        //Determinar Catalogo
        $query = $em->createQueryBuilder()
                ->select('pc','c') 
                ->from('IncentivesCatalogoBundle:Productocatalogo', 'pc')
                ->leftJoin('pc.redencion','r')
                ->leftJoin('pc.catalogos','c')
                ->where("r.id=".$redencion);

        $catalogo = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        $id_catalogo = $catalogo[0]['catalogos']['id'];

        $redencionD = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($redencion);
        $form = $this->createForm(new RedencionProductoType(array('id_catalogo'=>$id_catalogo)), $redencionD);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $pro = $request->request->all()['redencion_producto'];
                // realiza alguna acción, tal como guardar la tarea en la base de datos

                $productoD = $em->getRepository('IncentivesCatalogoBundle:Productocatalogo')->find($pro['productocatalogo']);

                $redencionD->setProductocatalogo($productoD);
                
                //Guardar precios
                $redencionD->setValorCompra($productoD->getPrecio());
                $redencionD->setIncremento($productoD->getIncremento());
                $redencionD->setLogistica($productoD->getLogistica());
                    
                $em->persist($redencionD);
                $em->flush();
                
                return $this->redirect($this->generateUrl('redenciones_datosredencion').'/'
            .$redencion);
            }
        }

        return $this->render('IncentivesRedencionesBundle:Redencion:editarproducto.html.twig', array(
            'form' => $form->createView(),'redencion' => $redencion,
        ));
    }

    public function justificacionAction(Request $request, $id, $planilla)
    {
        $em = $this->getDoctrine()->getManager();

        $redencionD = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($id);
        $form = $this->createForm(JustificacionEnvioType::class, $redencionD);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $pro = $request->request->all()['justificacion'];
                // realiza alguna acción, tal como guardar la tarea en la base de datos

                $justificacionD = $em->getRepository('IncentivesRedencionesBundle:Justificacion')->find($pro['justificacion']);

                $redencionD->setJustificacion($justificacionD);
                $redencionD->setObservacionJustificacion($pro['observacionJustificacion']);
                $em->persist($redencionD);
                $em->flush();
                
                return $this->redirect($this->generateUrl('planillas_datos').'/'
            .$planilla);
            }
        }

        return $this->render('IncentivesRedencionesBundle:Redencion:justificacion.html.twig', array(
            'form' => $form->createView(),'redencion' => $redencionD, 'planilla' => $planilla
        ));
    }
    
    public function exportarAction($programa)
    {         
			
            $fp = fopen('php://temp','r+');

			// Header
			$row = array(
						'Id','Fecha Redencion','Fecha Autorizacion','Fecha Modificacion','Redimido Por','Codigo Redencion',
                        'Nombre Participante','Cedula participante','Nombre envio','Documento envio','Telefono envio','Celular envio','Direccion envio',
                        'Barrio envio','Departamento','Ciudad','Puntos','Codigo EAN','Producto','Sku','Categoria','Proveedor Principal','Proveedor OC',
                        'Costo OC','Valor Venta','Valor Mercado','Valor Consignacion','Orden de compra','Fecha Orden Compra','Guia','Operador','Semaforo','Nombre Contacto',
                        'Documento Contacto','Direccion Contacto','Telefono Contacto','Fecha Despacho','Planilla','Factura','Fecha Entrega');
			
	 //print_r($redenciones); exit;       
			//fputcsv($fp,$row);
            
            $query = "SELECT r.id,r.fecha,r.fechaModificacion,r.redimidopor,r.codigoredencion,r.puntos,r.valor,r.fechaAutorizacion,r.fechaDespacho,
                            r.fechaEntrega, r.redencionestado_id estado_id,r.valorCompra,r.incremento,r.logistica,
                            envio.nombre nombre_envio,envio.documento documento_envio,envio.nombreContacto,envio.telefonoContacto,envio.direccionContacto,envio.documentoContacto,
                            envio.telefono,envio.barrio,envio.direccion,envio.celular,envio.departamentoNombre,envio.ciudadNombre,
                            pd.codEAN,pd.nombre producto,pd.codInc,ct.nombre categoria,pt.nombre participante,pt.documento,estado.nombre estado,
                            pv.nombre proveedor, op.valorunidad, oc.consecutivo ordencompra, oc.fechaCreacion fechaOrden,
                            pl.id planilla,f.numero factura, r.otros
                    	FROM Redenciones r 
                    	LEFT JOIN Productocatalogo as pc ON r.productocatalogo_id=pc.id 
                    	LEFT JOIN Producto pd ON pc.producto_id=pd.id
                    	LEFT JOIN Categoria ct ON pd.categoria_id=ct.id
                    	LEFT JOIN Catalogos c ON pc.catalogos_id=c.id
                    	LEFT JOIN Participantes pt ON r.participante_id=pt.id
                    	LEFT JOIN Redencionesenvios envio ON envio.redencion_id=r.id
                    	LEFT JOIN Redencionesestado estado ON r.redencionestado_id=estado.id
                    	LEFT JOIN Inventario i ON i.redencion_id=r.id
                    	/*LEFT JOIN InventarioGuia ig ON ig.inventario_id=i.id
                    	LEFT JOIN GuiaEnvio guia ON guia.id=ig.guia_id*/
                    	LEFT JOIN Planilla pl ON pl.id=i.planilla_id
                    	LEFT JOIN OrdenesProducto op ON r.ordenesproducto_id=op.id
                    	LEFT JOIN OrdenesCompra oc ON op.ordenescompra_id=oc.id
                    	LEFT JOIN Proveedores pv ON oc.proveedor_id=pv.id
                    	LEFT JOIN FacturaProductos fp ON r.facturaProducto_id=fp.id
                    	LEFT JOIN Factura f ON fp.factura_id=f.id";

            $str_filtro = ' WHERE pt.programa_id = '.$programa;
            $str_filtro .= " AND r.redencionestado_id != 7";
            $str_filtro .= " GROUP BY r.id  ORDER BY r.fecha ASC";
            
            $conn = $this->get('database_connection'); 
            $redenciones = $conn->fetchAll($query.$str_filtro);

			//echo "<pre>"; print_r($redenciones); echo "</pre>"; exit;
               
            $ir = 0;
            foreach($redenciones as $key => $value){              
               
               if($ir==0){
					if($value['otros']!=""){
						$otrosR = explode(";", $value['otros']);
						foreach ($otrosR as $keyR) {
							$valueR = explode(":", $keyR);
							$row[] = eregi_replace("[\n|\r|\n\r]", '', $valueR[0]);
						}
					}
				   
					fputcsv($fp,$row,';');
				}
               
                $ir++;
               
                $row = array();
                //Redencion, participante, producto
						$row[] = $value['id'];//1
						$row[] = $value['fecha'];//2
						$row[] = $value['fechaAutorizacion'];//3
						$row[] = $value['fechaModificacion'];//4
						$row[] = $value['redimidopor'];//5
						$row[] = $value['codigoredencion'];//6
						$row[] = utf8_decode($value['participante']);//7
						$row[] = $value['documento'];//8
						$row[] = utf8_decode($value['nombre_envio']);//9
						$row[] = $value['documento_envio'];//10
						$row[] = utf8_decode($value['telefono']);//11
						$row[] = utf8_decode($value['celular']);//12
						$row[] = utf8_decode($value['direccion']);//13
						$row[] = utf8_decode($value['barrio']);//14
						$row[] = utf8_decode($value['departamentoNombre']);//15
						$row[] = utf8_decode($value['ciudadNombre']);//16
						
						$row[] = $value['puntos'];//17
						$row[] = $value['codEAN'];//18
						$row[] = utf8_decode($value['producto']);//19
						$row[] = $value['codInc'];//20
						$row[] = utf8_decode($value['categoria']);//21
						$row[] = "";//22
						

						$row[] = utf8_decode($value['proveedor']);//23
						$row[] = $value['valorunidad'];//24
						$precioV = $value['valorunidad'] * (1 + $value['incremento']/100) + $value['logistica'];  
						$row[] = $precioV;//25
						
						$row[] = "";//26
						
						$row[] = $value['valor'];//27
						
						if($value['estado_id'] > 3 && $value['ordencompra']==""){
							$row[] = "Inventario";//28
                            $row[] = "";//28
						}else{
							//OC
							$row[] = $value['ordencompra'];//28
                            $row[] = $value['fechaOrden'];//29
						}
						
					    //consultar guias
					    $query = "SELECT g.operador,g.guia
                        	FROM DespachoGuia as dg
                        	JOIN Despachos as d ON dg.despacho_id=d.id
                        	JOIN GuiaEnvio as g ON g.id=dg.guia_id";
    
                        $str_filtro = ' WHERE d.redencion_id = '.$value['id'];
                        
                        $conn = $this->get('database_connection'); 
                        $guiasResult = $conn->fetchAll($query.$str_filtro);
                        
                        $guias = array();
                        $opeador = array();
                        foreach($guiasResult as $keyG => $valueG){
                            $guias[]= $valueG['guia'];
                            $opeador[]= $valueG['operador'];
                        }
                        
                        $guias = implode(" / ", $guias);
                        $opeador = implode(" / ", $opeador);
            
						$row[] = utf8_decode($guias);//29 guias
						$row[] = utf8_decode($opeador);//30 operador
						
						$row[] = $value['estado'];//31 estado
					
						//Envio
						$row[] = utf8_decode($value['nombreContacto']);//32
						$row[] = utf8_decode($value['documentoContacto']);//33
						$row[] = utf8_decode($value['direccionContacto']);//34
						$row[] = utf8_decode($value['telefonoContacto']);//35
						
						$row[] = $value['fechaDespacho'];//36
						
						$row[] = $value['planilla'];//37
						$row[] = $value['factura'];//38
						$row[] = $value['fechaEntrega'];//39
						
						if($value['otros']!=""){
							$otrosR = explode(";", $value['otros']);
							foreach ($otrosR as $keyR) {
								//$iR++;
								$valueR = explode(":", $keyR);
								$row[] = eregi_replace("[\n|\r|\n\r]", '', utf8_decode($valueR[1]));
							}
						}
						 
						fputcsv($fp,$row,';');
            }

			rewind($fp);
			$csv = stream_get_contents($fp);
			fclose($fp);
			
			$filename = 'Redenciones_'.$programa.'.csv';
			$response = new Response($csv);
			
			$response->headers->set('Content-Type', "text/csv");
			$response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $filename));            
			
            return $response;

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
                $pro = $request->request->all()['envios'];
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
                
                $em->persist($redencionE);
                
                $em->flush();
            }
        }           

        return $this->render('IncentivesRedencionesBundle:Redencion:edicionenvio.html.twig', array(
            'form' => $form->createView(), 'envio' => $redencionE, 'redencion' => $redencionD,
        ));
    }
    
    
    public function exportarCompletoAction()
    {         
			
            $fp = fopen('php://temp','r+');

			// Header
			$row = array(
						'Id','Fecha Redencion','Fecha Autorizacion','Fecha Modificacion','Progama','Codigo Redencion',
                        'Nombre Participante','Cedula participante','Nombre envio','Documento envio','Telefono envio','Celular envio','Direccion envio',
                        'Barrio envio','Departamento','Ciudad','Puntos','Codigo EAN','Producto','Sku','Categoria','Proveedor Principal','Proveedor OC',
                        'Costo OC','Valor Venta','Valor Mercado','Valor Consignacion','Orden de compra','Fecha Orden Compra','Guia','Operador','Semaforo','Nombre Contacto',
                        'Documento Contacto','Direccion Contacto','Telefono Contacto','Fecha Despacho','Planilla','Factura','Fecha Entrega');
			
            //print_r($redenciones); exit;       
			//fputcsv($fp,$row);
            
            $query = "SELECT r.id,r.fecha,r.fechaModificacion,r.redimidopor,r.codigoredencion,r.puntos,r.valor,r.fechaAutorizacion,r.fechaDespacho,
                            r.fechaEntrega, r.redencionestado_id estado_id,r.valorCompra,r.incremento,r.logistica,
                            envio.nombre nombre_envio,envio.documento documento_envio,envio.nombreContacto,envio.telefonoContacto,envio.direccionContacto,envio.documentoContacto,
                            envio.telefono,envio.barrio,envio.direccion,envio.celular,envio.departamentoNombre,envio.ciudadNombre,
                            pd.codEAN,pd.nombre producto,pd.codInc,ct.nombre categoria,pt.nombre participante,pt.documento,estado.nombre estado,
                            pv.nombre proveedor, op.valorunidad, oc.consecutivo ordencompra,oc.fechaCreacion fechaOrden,
                            pl.id planilla,f.numero factura, r.otros, pg.nombre programa
                    	FROM Redenciones r 
                    	LEFT JOIN Productocatalogo as pc ON r.productocatalogo_id=pc.id 
                    	LEFT JOIN Producto pd ON pc.producto_id=pd.id
                    	LEFT JOIN Categoria ct ON pd.categoria_id=ct.id
                    	LEFT JOIN Catalogos c ON pc.catalogos_id=c.id
                    	LEFT JOIN Participantes pt ON r.participante_id=pt.id
                    	LEFT JOIN Programa pg ON pt.programa_id=pg.id
                    	LEFT JOIN Redencionesenvios envio ON envio.redencion_id=r.id
                    	LEFT JOIN Redencionesestado estado ON r.redencionestado_id=estado.id
                    	LEFT JOIN Inventario i ON i.redencion_id=r.id
                    	LEFT JOIN Planilla pl ON pl.id=i.planilla_id
                    	LEFT JOIN OrdenesProducto op ON r.ordenesproducto_id=op.id
                    	LEFT JOIN OrdenesCompra oc ON op.ordenescompra_id=oc.id
                    	LEFT JOIN Proveedores pv ON oc.proveedor_id=pv.id
                    	LEFT JOIN FacturaProductos fp ON r.facturaProducto_id=fp.id
                    	LEFT JOIN Factura f ON fp.factura_id=f.id";

        $session = $this->get('session');
    
        $sqlFiltro = "";

        if($filtros = $session->get('filtros_redencionescompleto')){
           
           foreach($filtros as $Filtro => $valueF){
               
               if($valueF!=""){
                   if($Filtro=="nombre"  || $Filtro=="documento"){
                        $sqlFiltro .= " AND pt.".$Filtro." LIKE '%".$valueF."%'";
                   }elseif($Filtro=="producto"){
                        $sqlFiltro .= " AND pc.nombre  LIKE '%".$valueF."%'";;
                   }elseif($Filtro=="puntos"){
                        $sqlFiltro .= " AND r.puntos=".$valueF."";
                   }elseif($Filtro=="redencionestado"){
                        $sqlFiltro .= " AND estado.id=".$valueF;
                   }
               }
           } 
        }
            
        if(!isset($sqlFiltro) || $sqlFiltro=="") $sqlFiltro = " AND r.redencionestado_id=4 ";

            $str_filtro = " WHERE pc.id!=2505 ".$sqlFiltro;
            $str_filtro .= " GROUP BY r.id  ORDER BY r.fecha ASC";
            
            $conn = $this->get('database_connection'); 
            $redenciones = $conn->fetchAll($query.$str_filtro, array(1), 0);

			//echo "<pre>"; print_r($redenciones); echo "</pre>"; exit;
               
            $ir = 0;
            foreach($redenciones as $key => $value){              
               
               if($ir==0){
				   
					fputcsv($fp,$row,';');
				}
				
                $ir++;
               
                $row = array();
                //Redencion, participante, producto
						$row[] = $value['id'];//1
						$row[] = $value['fecha'];//2
						$row[] = $value['fechaAutorizacion'];//3
						$row[] = $value['fechaModificacion'];//4
						$row[] = $value['programa'];//5
						$row[] = $value['codigoredencion'];//6
						$row[] = utf8_decode($value['participante']);//7
						$row[] = $value['documento'];//8
						$row[] = utf8_decode($value['nombre_envio']);//9
						$row[] = $value['documento_envio'];//10
						$row[] = utf8_decode($value['telefono']);//11
						$row[] = utf8_decode($value['celular']);//12
						$row[] = utf8_decode($value['direccion']);//13
						$row[] = utf8_decode($value['barrio']);//14
						$row[] = utf8_decode($value['departamentoNombre']);//15
						$row[] = utf8_decode($value['ciudadNombre']);//16
						
						$row[] = $value['puntos'];//17
						$row[] = $value['codEAN'];//18
						$row[] = utf8_decode($value['producto']);//19
						$row[] = $value['codInc'];//20
						$row[] = utf8_decode($value['categoria']);//21
						$row[] = "";//22
						

						$row[] = utf8_decode($value['proveedor']);//23
						$row[] = $value['valorunidad'];//24
						$precioV = $value['valorunidad'] * (1 + $value['incremento']/100) + $value['logistica'];  
						$row[] = $precioV;//25
						
						$row[] = "";//26
						
						$row[] = $value['valor'];//27
						
						if($value['estado_id'] > 3 && $value['ordencompra']==""){
							$row[] = "Inventario";//28
							$row[] = "";//29

						}else{
							//OC
							$row[] = $value['ordencompra'];//28
							$row[] = $value['fechaOrden'];//29
						}
						
					    //consultar guias
					    $query = "SELECT g.operador,g.guia
                        	FROM DespachoGuia as dg
                        	JOIN Despachos as d ON dg.despacho_id=d.id
                        	JOIN GuiaEnvio as g ON g.id=dg.guia_id";
    
                        $str_filtro = ' WHERE d.redencion_id = '.$value['id'];
                        
                        $conn = $this->get('database_connection'); 
                        $guiasResult = $conn->fetchAll($query.$str_filtro, array(1), 0);
                        
                        $guias = array();
                        $opeador = array();
                        foreach($guiasResult as $keyG => $valueG){
                            $guias[]= $valueG['guia'];
                            $opeador[]= $valueG['operador'];
                        }
                        
                        $guias = implode(" / ", $guias);
                        $opeador = implode(" / ", $opeador);
            
						$row[] = utf8_decode($guias);//30 guias
						$row[] = utf8_decode($opeador);//31 operador
						
						$row[] = $value['estado'];//32 estado
					
						//Envio
						$row[] = utf8_decode($value['nombreContacto']);//33
						$row[] = utf8_decode($value['documentoContacto']);//34
						$row[] = utf8_decode($value['direccionContacto']);//35
						$row[] = utf8_decode($value['telefonoContacto']);//36
						
						$row[] = $value['fechaDespacho'];//37
						
						$row[] = $value['planilla'];//38
						$row[] = $value['factura'];//39
						$row[] = $value['fechaEntrega'];//40
						 
						fputcsv($fp,$row,';');
            }

			rewind($fp);
			$csv = stream_get_contents($fp);
			fclose($fp);
			
			$filename = 'Redenciones.csv';
			$response = new Response($csv);
			
			$response->headers->set('Content-Type', "text/csv");
			$response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $filename));            
			
            return $response;

    }
    
    public function listadoCompletoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $session = $this->get('session');
         
        $page = $request->get('page');
        if(!$page) $page= 1;
            
        if($pro = $request->request->get('redenciones')){
            $page = 1;
            $session->set('filtros_redencionescompleto', $pro);
        }
        
        $sqlFiltro = "";

        if($filtros = $session->get('filtros_redencionescompleto')){
           
           foreach($filtros as $Filtro => $valueF){
               
               if($valueF!=""){
                   if($Filtro=="nombre"  || $Filtro=="documento"){
                        $sqlFiltro .= " AND pt.".$Filtro." LIKE '%".$valueF."%'";
                   }elseif($Filtro=="producto"){
                        $sqlFiltro .= " AND p.nombre  LIKE '%".$valueF."%'";;
                   }elseif($Filtro=="puntos"){
                        $sqlFiltro .= " AND r.puntos=".$valueF."";
                   }elseif($Filtro=="guia"){
                        $sqlFiltro .= " AND g.".$Filtro." LIKE '%".$valueF."%'";
                   }elseif($Filtro=="redencionestado"){
                        $sqlFiltro .= " AND e.id=".$valueF;
                   }else{
                        $sqlFiltro .= " AND r.".$Filtro." LIKE '%".$valueF."%'";
                   }
               }
           } 
        }
        
        if(!isset($sqlFiltro) || $sqlFiltro=="") $sqlFiltro = "pc.id!=2505 AND r.redencionestado=4 "; else $sqlFiltro = " pc.id!=2505 ".$sqlFiltro;

        $query = $em->createQueryBuilder()
            ->select('r','pt', 'pc', 'p', 'e', 'i', 'g', 'dg','d') 
            ->from('IncentivesRedencionesBundle:Redenciones', 'r')
            ->leftJoin('r.participante','pt')
		    ->leftJoin('r.productocatalogo', 'pc')
		    ->leftJoin('pc.producto', 'p')
		    ->leftJoin('r.redencionestado', 'e')
		    ->leftJoin('r.inventario', 'i')
		    ->leftJoin('r.despacho', 'd')
		    ->leftJoin('d.despachoguia', 'dg')
            ->leftJoin('dg.guia', 'g')
		    ->where($sqlFiltro);
		    
		//$minimo = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
		//echo "<pre>"; print_r($minimo); echo "</pre>"; exit;
		    
		if($request->get('sort')){
		    $query->orderBy($request->get('sort'), $request->get('direction'));    
	    }
		   
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $page/*page number*/,
            40 /*limit per page*/
        );

        
        $redencion = new Redenciones();
        $form =$this->get('form.factory')->createNamedBuilder('redenciones', 'form',  null, array(
                ))
            ->add('redencionestado', EntityType::class, array(
                'class' => 'IncentivesRedencionesBundle:Redencionesestado',
                'choice_label' => 'nombre',
                //'empty_value' => 'Seleccione',
                'required' => false,
        ))
        ->getForm();


        return $this->render('IncentivesRedencionesBundle:Redencion:listadoCompleto.html.twig', 
            array( 'redenciones' => $pagination, 'filtros' => $filtros, 'form' => $form->createView()));
    }
       
}
