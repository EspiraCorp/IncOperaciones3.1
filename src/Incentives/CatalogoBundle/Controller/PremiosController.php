<?php

namespace Incentives\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\CatalogoBundle\Entity\Catalogos;
use Incentives\CatalogoBundle\Entity\Producto;
use Incentives\CatalogoBundle\Entity\Premios;
use Incentives\CatalogoBundle\Entity\PremiosProductos;
use Incentives\CatalogoBundle\Entity\Productoprecio;
use Incentives\CatalogoBundle\Form\Type\FiltrosProductoType;
use Incentives\CatalogoBundle\Form\Type\ProductoType;
use Incentives\CatalogoBundle\Form\Type\PremiosType;
use Incentives\CatalogoBundle\Form\Type\FiltroPremiosType;
use Incentives\CatalogoBundle\Form\Type\CombosType;
use Incentives\CatalogoBundle\Form\Type\CombosEditarType;
use Incentives\CatalogoBundle\Form\Type\PremiosProductosType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Incentives\OperacionesBundle\Entity\Excel;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Cell_DataValidation;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Style_Fill;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

ini_set('memory_limit','512M');

class PremiosController extends Controller
{
    

    public function nuevoDesdeProductoAction(Request $request, $producto)
    {
        $em = $this->getDoctrine()->getManager();
        $premio = new Premios();

        $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($producto);

        $form = $this->createForm(PremiosType::class, $premio);
        
        if ($request->isMethod('POST')) {
           
               //$form->handleRequest($request);
               //if ($form->isValid()) {
                
                $pro = $request->request->all()['premios'];

                $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($pro['catalogos']);
                $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($pro['categoria']);
                $estado = $em->getRepository('IncentivesCatalogoBundle:EstadoCatalogo')->find(1);
                // realiza alguna acción, tal como guardar la tarea en la base de datos

                $puntos = $this->calcularPuntos($pro['precioTemporal'], $pro['incrementoTemporal'], $pro['logisticaTemporal'], $pro['puntosTemporal'], $pro['catalogos']);

                $premio->setCatalogos($catalogo);
                $premio->setCategoria($categoria);
                $premio->setPuntosTemporal(($puntos) ? $puntos : 0 );
                $premio->setPrecioTemporal($pro['precioTemporal']);
                $premio->setEstado($estado);
                $premio->setIncrementoTemporal($pro['incrementoTemporal']);
                $premio->setLogisticaTemporal($pro['logisticaTemporal']);

                $premio->setNombre($producto->getNombre());
                $premio->setDescripcion($producto->getDescripcion());
                $premio->setMarca($producto->getMarca());
                $premio->setReferencia($producto->getReferencia());
                $premio->setCodigo($producto->getCodInc());

                $qb = $em->createQueryBuilder()
                        ->select('i') 
                        ->from('IncentivesCatalogoBundle:ImagenProducto', 'i')
                        ->where('i.producto='.$producto->getId().' AND i.estado=1')
                        ->setMaxResults(1);
                if($ImagenProducto = $qb->getQuery()->getOneOrNullResult()) $premio->setImagen($ImagenProducto->getPath());
                  
                $premioProducto = new PremiosProductos();
                $premioProducto->setPremio($premio);
                $premioProducto->setProducto($producto);
                $premioProducto->setEstado($estado);

                $em->persist($premio);
                $em->persist($premioProducto);                            
                $em->flush();
                //probar el redirect en la verison 2.3 y hacer el ajsutepara la 2.7
                return $this->redirect($this->generateUrl('producto_datos')."/".$producto->getId());
                //}

        }

        return $this->render('IncentivesCatalogoBundle:Premios:nuevoDesdeProducto.html.twig', array(
                'form' => $form->createView(), 'producto' => $producto->getId(),
        ));
    }

    public function editarDesdeProductoAction(Request $request, $premio, $producto)
    {
        $em = $this->getDoctrine()->getManager();
        $premioEditar = $em->getRepository('IncentivesCatalogoBundle:Premios')->find($premio);
        
        $form = $this->createForm(PremiosType::class, $premioEditar);
        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

                $pro = $request->request->all()['premios'];
                $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($pro['categoria']);
                    
                $puntos = $this->calcularPuntos($pro['precioTemporal'], $pro['incrementoTemporal'], $pro['logisticaTemporal'], $pro['puntosTemporal'], $premioEditar->getCatalogos()->getId());

                $premioEditar->setCategoria($categoria);
                $premioEditar->setPuntosTemporal($puntos);
                $premioEditar->setPrecioTemporal($pro['precioTemporal']);
                $premioEditar->setIncrementoTemporal($pro['incrementoTemporal']);
                $premioEditar->setLogisticaTemporal($pro['logisticaTemporal']);

                $premioEditar->setEstadoAprobacion(NULL);
                      
                $em->persist($premioEditar);                    
                $em->flush();

                return $this->redirect($this->generateUrl('producto_datos').'/'.$producto);
        }

        return $this->render('IncentivesCatalogoBundle:Premios:editarDesdeProducto.html.twig', array(
                'form' => $form->createView(), 'premio' => $premioEditar, 'producto' => $producto
        ));
    }

    public function estadoDesdeProductoAction($premio, $producto)
    {
        $em = $this->getDoctrine()->getManager();

        $premio = $em->getRepository('IncentivesCatalogoBundle:Premios')->find($premio);

        if ($premio->getEstado()->getId()==1){

            $estado = $em->getRepository('IncentivesCatalogoBundle:Estadocatalogo')->find("2");
            $premio->setEstado($estado);
            $premio->setEstadoAprobacion(NULL);
            $premio->setFechaInactivacion(new \DateTime("now"));
        
        }else{

            $estado = $em->getRepository('IncentivesCatalogoBundle:Estadocatalogo')->find("1");
            $premio->setEstado($estado);

        }   
        $em->flush();
        
        return $this->redirect($this->generateUrl('producto_datos', array('id' => $producto)));
    }


    public function nuevoAction(Request $request, $producto, $catalogo)
    {
        $em = $this->getDoctrine()->getManager();
        $premios = new Premios();

        $datosProducto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($producto);

        $form = $this->createForm(PremiosType::class, $premios);
        
        if ($request->isMethod('POST')) {
           
                $form->handleRequest($request);
                
                if ($form->isValid()) {
            
                    $pro = $request->request->all()['premios'];
                    $catalogoP = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($catalogo);
                    $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($pro['categoria']);

                    $puntos = $this->calcularPuntos($pro['precioTemporal'], $pro['incrementoTemporal'], $pro['logisticaTemporal'], $pro['puntosTemporal'], $catalogoP->getId());

                    //$premios->setProducto($datosProducto);
                    $premios->setCatalogos($catalogoP);
                    $premios->setCategoria($categoria);
                    $premios->setPuntosTemporal($puntos);
                    $premios->setPrecioTemporal($pro['precioTemporal']);
                    $estado = $em->getRepository('IncentivesCatalogoBundle:Estadocatalogo')->find("1");
                    $premios->setEstado($estado);
                    $premios->setIncrementoTemporal($pro['incrementoTemporal']);
                    $premios->setLogisticaTemporal($pro['logisticaTemporal']);

                    $premios->setNombre($datosProducto->getNombre());
                    $premios->setDescripcion($datosProducto->getDescripcion());
                    $premios->setMarca($datosProducto->getMarca());
                    $premios->setReferencia($datosProducto->getReferencia());
                    $premios->setCodigo($datosProducto->getCodInc());

                    $qb = $em->createQueryBuilder()
                            ->select('i') 
                            ->from('IncentivesCatalogoBundle:ImagenProducto', 'i')
                            ->where('i.id='.$datosProducto->getId().' AND i.estado=1')
                            ->setMaxResults(1);
                    $ImagenProducto = $qb->getQuery()->getOneOrNullResult();
                    $premios->setImagen($ImagenProducto->getPath());

                    if(isset($pro["agotado"]) && $pro["agotado"]==1) $agotado = 1; else $agotado = 0;
                    $premios->setAgotado($agotado);
                      
                    $premioProducto = new PremiosProductos();
                    $premioProducto->setPremio($premios);
                    $premioProducto->setProducto($datosProducto);
                    $premioProducto->setEstado($estado);

                    $em->persist($premios);
                    $em->persist($premioProducto);
                    $em->flush();

                   return $this->redirect($this->generateUrl('premios_maestro'));
                }

        }

        return $this->render('IncentivesCatalogoBundle:Premios:nuevo.html.twig', array(
                'form' => $form->createView(), 'producto' => $producto, 'catalogo' => $catalogo,
        ));
    }


    public function editarAction(Request $request, $premio)
    {
        $em = $this->getDoctrine()->getManager();
        $premiosEditar = $em->getRepository('IncentivesCatalogoBundle:Premios')->find($premio);

        $form = $this->createForm(PremiosType::class, $premiosEditar);


        if ($request->isMethod('POST')) {
                
                $idCatalogo = $premiosEditar->getCatalogos()->getId();
                
                    $pro = $request->request->all()['premios'];
                    $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($pro['categoria']);
                    
                    $puntos = $this->calcularPuntos($pro['precioTemporal'], $pro['incrementoTemporal'], $pro['logisticaTemporal'], $pro['puntosTemporal'], $idCatalogo);
                     
                    $premiosEditar->setPuntosTemporal($puntos);
                    $premiosEditar->setPrecioTemporal($pro['precioTemporal']);
                    $premiosEditar->setCategoria($categoria);
                    $premiosEditar->setIncrementoTemporal($pro['incrementoTemporal']);
                    $premiosEditar->setLogisticaTemporal($pro['logisticaTemporal']);

            if(isset($pro["agotado"]) && $pro["agotado"]==1) $agotado = 1; else $agotado = 0;   
                    $premiosEditar->setAgotado($agotado);

                    $premiosEditar->setEstadoAprobacion(NULL);
                      
                    $em->persist($premiosEditar);                            
                    $em->flush();
                //probar el redirect en la verison 2.3 y hacer el ajsutepara la 2.7
                   return $this->redirect($this->generateUrl('premios_maestro'));

        }

        return $this->render('IncentivesCatalogoBundle:Premios:editar.html.twig', array(
                'form' => $form->createView(), 'premio' => $premiosEditar->getId(),
        ));
    }

    public function estadoAction($premio)
    {
        $em = $this->getDoctrine()->getManager();

        $premio = $em->getRepository('IncentivesCatalogoBundle:Premios')->find($premio);

        if ($premio->getEstado()->getId()==1){

            $estado = $em->getRepository('IncentivesCatalogoBundle:Estadocatalogo')->find("2");
            $premio->setEstado($estado);
            $premio->setEstadoAprobacion(NULL);
            $premio->setFechaInactivacion(new \DateTime("now"));
        
        }else{

            $estado = $em->getRepository('IncentivesCatalogoBundle:Estadocatalogo')->find("1");
            $premio->setEstado($estado);

        }   
        $em->flush();
        
        return $this->redirect($this->generateUrl('premios_maestro'));
    }

    /**
     * @Route("/premios/datos/{id}")
     * @Template()
     */
    public function datosAction($premio)
    {
        $em = $this->getDoctrine()->getManager();

        $repositorypr = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Premios');
        $premio = $repositorypr->find($premio);
        
        $qb = $em->createQueryBuilder()
                ->select('p producto','ct','e') 
                ->from('IncentivesCatalogoBundle:Producto', 'p')
                ->leftJoin('p.premiosproductos','pp')
                ->leftJoin('pp.premio','pr')
                ->leftJoin('p.categoria','ct')
                ->leftJoin('p.estado','e')
                ->where('pr.id='.$premio->getId().' AND pp.estado=1');
        $productos = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        //echo "<pre>"; print_r($productos); echo "</pre>"; exit;

        return $this->render('IncentivesCatalogoBundle:Premios:datos.html.twig', 
            array('premio' => $premio, 'productos'=>$productos));
    }


    public function maestroAction(Request $request)
    {
            $form = $this->createForm(ProductoType::class);
            
            $em = $this->getDoctrine()->getManager();

            $programas = $em->getRepository('IncentivesCatalogoBundle:Programa')->findAll();
            
            $session = $this->get('session');
            
            $page = $request->get('page');
            if(!$page) $page= 1;
            
            if($pro=($request->request->get('producto'))){
                $page = 1;
                $session->set('filtros_maestro', $pro);
            }

            $arrayFiltro = array();

            $sqlFiltro = "";

            if($filtros = $session->get('filtros_maestro')){
               
               foreach($filtros as $Filtro => $valueF){
                   
                   if($valueF!=""){
                       if($Filtro=="categoria"){
                            $sqlFiltro .= " AND c.id=".$valueF."";
                       }elseif($Filtro=="puntos_min"){
                            $sqlFiltro .= " AND pr.puntos >= ".$valueF."";
                       }elseif($Filtro=="puntos_max"){
                            $sqlFiltro .= " AND pr.puntos <= ".$valueF."";
                       }elseif($Filtro=="catalogo"){

                           if($valueF[0]!=""){
                               foreach($valueF as $keyKF => $valueKF){
                                   $valuek[] = $valueKF;
                                }
                                $valueF = implode($valuek,",");

                                $arrayFiltro['id'] = $valuek;
                                $sqlFiltro .= " AND pr.catalogos in (".$valueF.")";
                            }
                       }elseif($Filtro=="estado"){
                            $sqlFiltro .= " AND e.id=".$valueF."";
                       }else{
                            $sqlFiltro .= " AND p.".$Filtro." LIKE '%".$valueF."%'";
                       }
                       
                   }
               } 
                
            }

            $sqlFiltro = 'p.tipo=2 '.$sqlFiltro;

            $query = $em->createQueryBuilder()
                ->select('p producto','pp precio', 'c categoria','e estado', 'ppr', 'i','ct','pr') 
                ->from('IncentivesCatalogoBundle:Producto', 'p')
                ->leftJoin('p.productoprecio','pp')
                ->leftJoin('p.imagenproducto','i', "WITH", "i.estado=1")
                ->leftJoin('p.categoria', 'c')
                ->leftJoin('p.premiosproductos', 'ppr')
                ->leftJoin('ppr.premio', 'pr')
                ->leftJoin('pr.catalogos', 'ct')
                ->leftJoin('p.estado', 'e')
                ->where($sqlFiltro)
                ->setMaxResults(100);
            $categorias = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            //echo "<pre>"; print_r($categorias); echo "</pre>"; exit;
            if($request->get('sort')){
                $query->orderBy($request->get('sort'), $request->get('direction'));    
            }

            $arrayFiltro['estado'] = 1;
            $catalogos = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->findBy($arrayFiltro);

            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query,
                $page/*page number*/,
                50 /*limit per page*/
            );
            
        return $this->render('IncentivesCatalogoBundle:Premios:maestro.html.twig', 
            array('productos' => $pagination, 'catalogos' => $catalogos, 'form' => $form->createView()));
    }

    public function importarAction(Request $request, $id)
    {
        $excelForm = new Excel();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder($excelForm)
            ->setMethod('POST')
            ->add('excel', FileType::class)
            ->add('cargar', SubmitType::class)
            ->getForm();

        $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($id);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            $excel = $form['excel']->getData();

            $objPHPExcel = PHPExcel_IOFactory::load($excel);
            
            $worksheet  = $objPHPExcel->setActiveSheetIndex('0');
            $ultimaFila = $worksheet->getHighestRow(); // e.g. 10

            //$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            $sheetData = $objPHPExcel->getActiveSheet()->rangeToArray("A1:N".$ultimaFila,false,false,false);

            $ok=0;
            $fila=0;
            $sku = array();
            $error = 0;
            $listaErrores="";

            //validacion de duplicados y no existentes
            foreach ($sheetData as $row) {
                $puntos=0;

                if($fila > 0 && $fila <= $ultimaFila && trim($row[0])!=""){

                    $qb = $em->createQueryBuilder();            
                    $qb->select('p');
                    $qb->from('IncentivesCatalogoBundle:Producto','p');
                    $qb->where("p.codInc LIKE '".trim($row[0])."' ");
                    $qb->orderBy("p.id","DESC");
                    $qb->setMaxResults(1);
                    $producto= $qb->getQuery()->getOneOrNullResult();

                    if(!$producto || in_array($row[0], $sku)){
                        $error++;
                        $listaErrores .= $row[0].",";
                    }

                    $sku[] = $row[0];
                }

                $fila++;
            }

            if($error==0){
            
                $fila=0;
                foreach ($sheetData as $row) {
                    $puntos=0;
                    if($fila > 0 && $fila <= $ultimaFila && trim($row[0])!=""){

                        //$producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->findOneByCodInc($row[0]);

                        $qb = $em->createQueryBuilder();            
                        $qb->select('p');
                        $qb->from('IncentivesCatalogoBundle:Producto','p');
                        $qb->where("p.codInc LIKE '".trim($row[0])."' ");
                        $qb->orderBy("p.id","DESC");
                        $qb->setMaxResults(1);
                        $producto= $qb->getQuery()->getOneOrNullResult();

                        $estado = $row[8]."";
                        $categoria = $row[7]."";

                        //$estado = explode(" ", $row[8]);
                        //$categoria = explode(" ", $row[7]);

                        if($producto && isset($estado) && $estado!=""){
                            
                            $precio = $row[10];
                            $incremento = $row[11];
                            $logistica = $row[12];
                            //$tipo_actual = explode(" ", $row[9]);
                            $tipo_actual = $row[9];
                            $puntaje = $row[13];

                            $puntos = $this->calcularPuntos($precio, $incremento, $logistica, $puntaje, $id);

                            $qb = $em->createQueryBuilder();            
                            $qb->select('pr');
                            $qb->from('IncentivesCatalogoBundle:Premios','pr');
                            $qb->Join('pr.premiosproductos','prp');
                            $qb->where('prp.producto = :id_producto AND pr.catalogos = :id_catalogo');
                            $qb->setParameter('id_producto', $producto->getId());
                            $qb->setParameter('id_catalogo', $id);
                            $qb->setMaxResults(1);

                            if(!($premio = $qb->getQuery()->getOneOrNullResult())){

                                $premio = new Premios();
                                $premioProducto = new PremiosProductos();

                            }else{

                                $qb = $em->createQueryBuilder();            
                                $qb->select('prp');
                                $qb->from('IncentivesCatalogoBundle:PremiosProductos','prp');
                                $qb->where('prp.premio = '.$premio->getId());
                                $qb->setMaxResults(1);
                                $premioProducto = $qb->getQuery()->getOneOrNullResult();

                            }

                            $premio->setCatalogos($catalogo);
                            $categoriaP = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($categoria);
                            $premio->setCategoria($categoriaP);
                            $estado = $em->getRepository('IncentivesCatalogoBundle:Estadocatalogo')->find($estado);
                            $premio->setEstado($estado);
                            $premio->setPuntosTemporal($puntos);
                            $premio->setPrecioTemporal($precio);
                            $premio->setIncrementoTemporal($incremento);
                            $premio->setLogisticaTemporal($logistica);
                            $premio->setEstadoAprobacion(NULL);
                            //$productocatalogo->setActualizacion($tipo_actual);
                            //$productocatalogo->setAproboOperaciones(NULL);
                            //$productocatalogo->setAproboComercial(NULL);
                            //$productocatalogo->setAproboDirector(NULL);
                            //$productocatalogo->setAproboCliente(NULL);

                            ///print_r($premioProducto->getId()); exit;
                            
                            $premioProducto->setPremio($premio);
                            $premioProducto->setProducto($producto);

                            $em->persist($premio);
                            $em->persist($premioProducto);
                            $em->flush();

                            $ok++;
                        }
                    }
                    
                    $fila++;
                }
                $this->get('session')->getFlashBag()->add(
                    'warning',
                    'Se agregaron/actualizaron '.$ok.' premios al catalogo.'
                    );
           }else{
                 $this->get('session')->getFlashBag()->add(
                'warning',
                'Error con los siguientes productos :'.$listaErrores
                );
            }
           //return $this->redirect($this->generateUrl('catalogo_datos'));

        }



        return $this->render('IncentivesCatalogoBundle:Premios:importar.html.twig', array(
            'form' => $form->createView(), 'id' => $id
        ));

    }

    public function exportarAction($id)
    {
    
            // Create new PHPExcel object
            $Descarga = new PHPExcel();

            // Set document properties
            $Descarga->setActiveSheetIndex(0);
    
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder(); 
            $qb->select('c');
            $qb->from('IncentivesOperacionesBundle:Categoria','c');
            $categorias = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            $estado_array[] = '1 - Activo';
            $estado_array[] = '0 - Inactivo';

            $actual_array[] = '1 - Automatico';
            $actual_array[] = '0 - Manual';

            $arryaCategorias = array();
            foreach($categorias as $keyCat => $valueCat){
                $arryaCategorias[] = $valueCat['id']." - ".$valueCat['nombre'];
                
            }
            
            $qb = $em->createQueryBuilder();
            $qb->select('pr','pp','p','pe','pre','c','cat');
            $qb->from('IncentivesCatalogoBundle:Premios','pr');
            $qb->leftJoin('pr.premiosproductos','pp');
            $qb->leftJoin('pr.estado','pre');
            $qb->leftJoin('pp.producto','p');
            $qb->leftJoin('pr.categoria','c');
            $qb->leftJoin('p.categoria','cat');
            $qb->leftJoin('p.estado','pe');
            $str_filtro = 'pr.catalogos = '.$id;   
            $qb->where($str_filtro);
            $productocatalogo = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            
            $Descarga->getActiveSheet()
                        ->setCellValue('A1','CodInc')
                        ->setCellValue('B1','Nombre')
                        ->setCellValue('C1','Referencia')
                        ->setCellValue('D1','Marca')
                        ->setCellValue('E1','Descripción')
                        ->setCellValue('F1','Categoria')
                        ->setCellValue('G1','Estado Producto')
                        ->setCellValue('H1','Subcategoria')
                        ->setCellValue('I1','Estado Catalogo')
                        ->setCellValue('J1','Actualizacion')
                        ->setCellValue('K1','Precio Actual')
                        ->setCellValue('L1','Incremento Actual')
                        ->setCellValue('M1','Logistica Actual')
                        ->setCellValue('N1','Puntos Actual')
                        ->setCellValue('O1','valor Venta Actual')
                        ->setCellValue('P1','Precio Nuevo')
                        ->setCellValue('Q1','Incremento Nuevo')
                        ->setCellValue('R1','Logistica Nuevo')
                        ->setCellValue('S1','Puntos Nuevo')
                        ->setCellValue('T1','Valor Venta Nuevo')
                        ->setCellValue('U1','Fecha Inactivacion');
            $fil=2;
            
            foreach ($productocatalogo as $key => $value) {

                    $Descarga->getActiveSheet()->getRowDimension($fil)->setRowHeight('45');    
                    $Descarga->getActiveSheet()->getColumnDimension('L')->setWidth(10);

                    if($value['actualizacion'] == 1) $actual = "1 - Manual"; else  $actual = "0 - Automatica";
                    if($value['estado']['id'] == 1) $estad = "1 - Activo"; else  $estad = "0 - Inactivo";

                    $valorVenta = ($value['precio']/(1-$value['incremento']/100))+$value['logistica'];
                    $valorVentaTemp = ($value['precioTemporal']/(1-$value['incrementoTemporal']/100))+$value['logisticaTemporal'];

                    $Descarga->getActiveSheet()
                            ->setCellValue('A'.$fil, $value['premiosproductos'][0]['producto']['codInc'])
                            ->setCellValue('B'.$fil, $value['premiosproductos'][0]['producto']['nombre'])
                            ->setCellValue('C'.$fil, $value['premiosproductos'][0]['producto']['referencia'])
                            ->setCellValue('D'.$fil, $value['premiosproductos'][0]['producto']['marca'])
                            ->setCellValue('E'.$fil, $value['premiosproductos'][0]['producto']['descripcion'])
                            ->setCellValue('G'.$fil, $value['premiosproductos'][0]['producto']['estado']['id'])
                            ->setCellValue('H'.$fil, "")     //$fechact[0]);
                            ->setCellValue('I'.$fil, $estad)
                            ->setCellValue('J'.$fil, $actual)
                            ->setCellValue('K'.$fil, $value['precio'])
                            ->setCellValue('L'.$fil, $value['incremento'])
                            ->setCellValue('M'.$fil, $value['logistica'])
                            ->setCellValue('N'.$fil, $value['puntos'])
                            ->setCellValue('O'.$fil, $valorVenta)
                            ->setCellValue('P'.$fil, $value['precioTemporal'])
                            ->setCellValue('Q'.$fil, $value['incrementoTemporal'])
                            ->setCellValue('R'.$fil, $value['logisticaTemporal'])
                            ->setCellValue('S'.$fil, $value['puntosTemporal'])
                            ->setCellValue('T'.$fil, $valorVentaTemp);
                    if($value['fechaInactivacion'] !== NULL) $Descarga->getActiveSheet()->setCellValue('U'.$fil, $value['fechaInactivacion']->format('Y-m-d'));
                            
            
                            $objValidation = $Descarga->getActiveSheet()->getCell('H'.$fil)->getDataValidation();
                            $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                            $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                            $objValidation->setAllowBlank(false);
                            $objValidation->setShowInputMessage(true);
                            $objValidation->setShowErrorMessage(true);
                            $objValidation->setShowDropDown(true);
                            $objValidation->setErrorTitle('Error de entrada.');
                            $objValidation->setError('Este valor no esta en la lista.');
                            $objValidation->setPromptTitle('Seleccione uno de la lista.');
                            $objValidation->setPrompt('Por favor seleccione uno de la lista.');
                            $objValidation->setFormula1('"' . implode(",", $arryaCategorias) . '"');
                            
                            $objValidation = $Descarga->getActiveSheet()->getCell('I'.$fil)->getDataValidation();
                            $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                            $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                            $objValidation->setAllowBlank(false);
                            $objValidation->setShowInputMessage(true);
                            $objValidation->setShowErrorMessage(true);
                            $objValidation->setShowDropDown(true);
                            $objValidation->setErrorTitle('Error de entrada.');
                            $objValidation->setError('Este valor no esta en la lista.');
                            $objValidation->setPromptTitle('Seleccione uno de la lista.');
                            $objValidation->setPrompt('Por favor seleccione uno de la lista.');
                            $objValidation->setFormula1('"' . implode(",", $estado_array) . '"');

                            $objValidation = $Descarga->getActiveSheet()->getCell('J'.$fil)->getDataValidation();
                            $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                            $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                            $objValidation->setAllowBlank(false);
                            $objValidation->setShowInputMessage(true);
                            $objValidation->setShowErrorMessage(true);
                            $objValidation->setShowDropDown(true);
                            $objValidation->setErrorTitle('Error de entrada.');
                            $objValidation->setError('Este valor no esta en la lista.');
                            $objValidation->setPromptTitle('Seleccione uno de la lista.');
                            $objValidation->setPrompt('Por favor seleccione uno de la lista.');
                            $objValidation->setFormula1('"' . implode(",", $actual_array) . '"');


                            if(null == $value['categoria']) $Descarga->getActiveSheet()->setCellValue('H'.$fil, 'Nulo');
                            else $Descarga->getActiveSheet()->setCellValue('H'.$fil, $value['categoria']['id']." - ".$value['categoria']['nombre']);
            
                            if(null == $value['premiosproductos'][0]['producto']['categoria']) $Descarga->getActiveSheet()->setCellValue('F'.$fil, 'Nulo');
                            else $Descarga->getActiveSheet()->setCellValue('F'.$fil, $value['premiosproductos'][0]['producto']['categoria']['id']." - ".$value['premiosproductos'][0]['producto']['categoria']['nombre']);
            

                $fil++;
            }
                
            $objWriter = new PHPExcel_Writer_Excel2007($Descarga); 
            $objWriter->save('Formato_Catologo.xlsx');  //send it to user, of course you can save it to disk also!
             // prepare BinaryFileResponse
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
            $filename = 'Productos_Catalogo.xlsx';
            $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
            $filePath = $basePath.'/'.$filename; 
             
            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
            return $response;

    }

    public function exportarCombosAction($id)
    {
    
            // Create new PHPExcel object
            $Descarga = new PHPExcel();

            // Set document properties
            $Descarga->setActiveSheetIndex(0);
    
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder(); 
            $qb->select('c');
            $qb->from('IncentivesOperacionesBundle:Categoria','c');
            $categorias = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            $estado_array[] = '1 - Activo';
            $estado_array[] = '0 - Inactivo';

            $actual_array[] = '1 - Automatico';
            $actual_array[] = '0 - Manual';

            $arryaCategorias = array();
            foreach($categorias as $keyCat => $valueCat){
                $arryaCategorias[] = $valueCat['id']." - ".$valueCat['nombre'];
                
            }
            exit;
            $qb = $em->createQueryBuilder();
            $qb->select('pr','pp','p','pe','pre','c','cat');
            $qb->from('IncentivesCatalogoBundle:Premios','pr');
            $qb->leftJoin('pr.premiosproductos','pp');
            $qb->leftJoin('pr.estado','pre');
            $qb->leftJoin('pp.producto','p');
            $qb->leftJoin('pr.categoria','c');
            $qb->leftJoin('p.categoria','cat');
            $qb->leftJoin('p.estado','pe');
            $str_filtro = 'pr.catalogos = '.$id;   
            $qb->where($str_filtro);
            $productocatalogo = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            
            $Descarga->getActiveSheet()
                        ->setCellValue('A1','Id')
                        ->setCellValue('B1','Nombre')
                        ->setCellValue('C1','Referencia')
                        ->setCellValue('D1','Marca')
                        ->setCellValue('E1','Descripción')
                        ->setCellValue('F1','Imagen')
                        ->setCellValue('G1','Categoria')
                        ->setCellValue('H1','Estado')
                        ->setCellValue('I1','Precio Actual')
                        ->setCellValue('J1','Incremento Actual')
                        ->setCellValue('K1','Logistica Actual')
                        ->setCellValue('L1','Puntos Actual')
                        ->setCellValue('M1','Precio Nuevo')
                        ->setCellValue('N1','Incremento Nuevo')
                        ->setCellValue('O1','Logistica Nuevo')
                        ->setCellValue('P1','Puntos Nuevo')
                        ->setCellValue('Q1','Valor Venta Nuevo')
                        ->setCellValue('R1','Fecha Inactivacion');
            $fil=2;
            
            foreach ($productocatalogo as $key => $value) {

                    $Descarga->getActiveSheet()->getRowDimension($fil)->setRowHeight('45');    
                    $Descarga->getActiveSheet()->getColumnDimension('L')->setWidth(10);

                    if($value['actualizacion'] == 1) $actual = "1 - Manual"; else  $actual = "0 - Automatica";
                    if($value['estado']['id'] == 1) $estad = "1 - Activo"; else  $estad = "0 - Inactivo";

                    $valorVenta = ($value['precio']/(1-$value['incremento']/100))+$value['logistica'];
                    $valorVentaTemp = ($value['precioTemporal']/(1-$value['incrementoTemporal']/100))+$value['logisticaTemporal'];

                    $Descarga->getActiveSheet()
                            ->setCellValue('A'.$fil, $value['premiosproductos'][0]['producto']['codInc'])
                            ->setCellValue('B'.$fil, $value['premiosproductos'][0]['producto']['nombre'])
                            ->setCellValue('C'.$fil, $value['premiosproductos'][0]['producto']['referencia'])
                            ->setCellValue('D'.$fil, $value['premiosproductos'][0]['producto']['marca'])
                            ->setCellValue('E'.$fil, $value['premiosproductos'][0]['producto']['descripcion'])
                            ->setCellValue('G'.$fil, $value['premiosproductos'][0]['producto']['estado']['id'])
                            ->setCellValue('H'.$fil, "")     //$fechact[0]);
                            ->setCellValue('I'.$fil, $estad)
                            ->setCellValue('J'.$fil, $actual)
                            ->setCellValue('K'.$fil, $value['precio'])
                            ->setCellValue('L'.$fil, $value['incremento'])
                            ->setCellValue('M'.$fil, $value['logistica'])
                            ->setCellValue('N'.$fil, $value['puntos'])
                            ->setCellValue('O'.$fil, $valorVenta)
                            ->setCellValue('P'.$fil, $value['precioTemporal'])
                            ->setCellValue('Q'.$fil, $value['incrementoTemporal'])
                            ->setCellValue('R'.$fil, $value['logisticaTemporal'])
                            ->setCellValue('S'.$fil, $value['puntosTemporal'])
                            ->setCellValue('T'.$fil, $valorVentaTemp);
                    if($value['fechaInactivacion'] !== NULL) $Descarga->getActiveSheet()->setCellValue('U'.$fil, $value['fechaInactivacion']->format('Y-m-d'));
                            
            
                            $objValidation = $Descarga->getActiveSheet()->getCell('H'.$fil)->getDataValidation();
                            $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                            $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                            $objValidation->setAllowBlank(false);
                            $objValidation->setShowInputMessage(true);
                            $objValidation->setShowErrorMessage(true);
                            $objValidation->setShowDropDown(true);
                            $objValidation->setErrorTitle('Error de entrada.');
                            $objValidation->setError('Este valor no esta en la lista.');
                            $objValidation->setPromptTitle('Seleccione uno de la lista.');
                            $objValidation->setPrompt('Por favor seleccione uno de la lista.');
                            $objValidation->setFormula1('"' . implode(",", $arryaCategorias) . '"');
                            
                            $objValidation = $Descarga->getActiveSheet()->getCell('I'.$fil)->getDataValidation();
                            $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                            $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                            $objValidation->setAllowBlank(false);
                            $objValidation->setShowInputMessage(true);
                            $objValidation->setShowErrorMessage(true);
                            $objValidation->setShowDropDown(true);
                            $objValidation->setErrorTitle('Error de entrada.');
                            $objValidation->setError('Este valor no esta en la lista.');
                            $objValidation->setPromptTitle('Seleccione uno de la lista.');
                            $objValidation->setPrompt('Por favor seleccione uno de la lista.');
                            $objValidation->setFormula1('"' . implode(",", $estado_array) . '"');

                            $objValidation = $Descarga->getActiveSheet()->getCell('J'.$fil)->getDataValidation();
                            $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                            $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                            $objValidation->setAllowBlank(false);
                            $objValidation->setShowInputMessage(true);
                            $objValidation->setShowErrorMessage(true);
                            $objValidation->setShowDropDown(true);
                            $objValidation->setErrorTitle('Error de entrada.');
                            $objValidation->setError('Este valor no esta en la lista.');
                            $objValidation->setPromptTitle('Seleccione uno de la lista.');
                            $objValidation->setPrompt('Por favor seleccione uno de la lista.');
                            $objValidation->setFormula1('"' . implode(",", $actual_array) . '"');


                            if(null == $value['categoria']) $Descarga->getActiveSheet()->setCellValue('H'.$fil, 'Nulo');
                            else $Descarga->getActiveSheet()->setCellValue('H'.$fil, $value['categoria']['id']." - ".$value['categoria']['nombre']);
            
                            if(null == $value['premiosproductos'][0]['producto']['categoria']) $Descarga->getActiveSheet()->setCellValue('F'.$fil, 'Nulo');
                            else $Descarga->getActiveSheet()->setCellValue('F'.$fil, $value['premiosproductos'][0]['producto']['categoria']['id']." - ".$value['premiosproductos'][0]['producto']['categoria']['nombre']);
            

                $fil++;
            }
                
            $objWriter = new PHPExcel_Writer_Excel2007($Descarga); 
            $objWriter->save('Formato_Catologo.xlsx');  //send it to user, of course you can save it to disk also!
             // prepare BinaryFileResponse
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
            $filename = 'Productos_Catalogo.xlsx';
            $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
            $filePath = $basePath.'/'.$filename; 
             
            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
            return $response;

    }


    public function formatoCambiosAction($id)
    {
    
            // Create new PHPExcel object
            $Descarga = new PHPExcel();

            // Set document properties
            $Descarga->setActiveSheetIndex(0);
    
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder(); 
            $qb->select('c');
            $qb->from('IncentivesOperacionesBundle:Categoria','c');
            $categorias = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            $estado_array[] = '1 - Activo';
            $estado_array[] = '0 - Inactivo';

            $arryaCategorias = array();
            foreach($categorias as $keyCat => $valueCat){
                $arryaCategorias[] = $valueCat['id']." - ".$valueCat['nombre'];
                
            }
            
            $qb = $em->createQueryBuilder();
            $qb->select('pr','pp','p','pre','pe','c','cat','ac','ad','ao','acom');
            $qb->from('IncentivesCatalogoBundle:Premios','pr');
            $qb->leftJoin('pr.premiosproductos','pp');
            $qb->leftJoin('pp.producto','p');
            $qb->leftJoin('pr.categoria','c');
            $qb->leftJoin('p.categoria','cat');
            $qb->leftJoin('pr.estado','pre');
            $qb->leftJoin('p.estado','pe');
            $qb->leftJoin('pr.aproboCliente','ac');
            $qb->leftJoin('pr.aproboDirector','ad');
            $qb->leftJoin('pr.aproboOperaciones','ao');
            $qb->leftJoin('pr.aproboComercial','acom');
            $str_filtro = 'pr.catalogos = '.$id.' AND p.estado=1 AND pr.estado=1 AND pr.aproboDirector=1';   
            $qb->where($str_filtro);
            $productocatalogo = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            
            $Descarga->getActiveSheet()
                        ->setCellValue('A1','CodInc')
                        ->setCellValue('B1','Nombre')
                        ->setCellValue('C1','Referencia')
                        ->setCellValue('D1','Marca')
                        ->setCellValue('E1','Descripción')
                        ->setCellValue('F1','Subcategoria')
                        ->setCellValue('G1','Estado Catalogo')
                        ->setCellValue('H1','Aprobación')
                        ->setCellValue('I1','Precio Nuevo')
                        ->setCellValue('J1','Puntos Nuevos')
                        ->setCellValue('K1','Precio Anterior')
                        ->setCellValue('L1','Puntos Anterior')
                        ->setCellValue('M1','Cambio')
                        ->setCellValue('N1','Variacion');
            $fil=2;
            
            foreach ($productocatalogo as $key => $value) {

                    $Descarga->getActiveSheet()->getRowDimension($fil)->setRowHeight('45');     //->getColumnDimension('P')->setWidth(17.43); //original width of column A
                    $Descarga->getActiveSheet()->getColumnDimension('L')->setWidth(10);

                    if($value['estado']['id'] == 1 && $value['premiosproductos'][0]['producto']['estado']['id'] == 1) $estad = "1 - Activo"; else  $estad = "0 - Inactivo";
                    //echo "<pre>"; print_r($value); echo "</pre>"; exit;
                    if($value['aproboCliente']['id'] == 1 && $value['aproboComercial']['id'] ==1 && $value['aproboOperaciones']['id'] == 1 && $value['aproboDirector']['id'] == 1){
                        $aprobacion = "Aprobado"; 
                    } elseif($value['aproboCliente']['id'] == 2 || $value['aproboComercial']['id'] == 2 || $value['aproboOperaciones']['id'] == 2 || $value['aproboDirector']['id'] == 2) {
                        $aprobacion = "Rechazado";
                    }else{
                        $aprobacion = "Por Aprobar";
                    }  

                    $precio = ($value['precioTemporal']/(1-($value['incrementoTemporal']/100)))+$value['logisticaTemporal'];                    
                    
                    $precioAnterior = "";
                    $puntosAnterior = "";
                    $cambio = "";
                    $variacion = "";
                    
                    //comparar con el registro inmediatamente anterior
                    if(isset($value['precio'])){
                        
                        $precioAnterior = ($value['precio']/(1-($value['incremento']/100)))+$value['logistica'];
                        $puntosAnterior = $value['puntos'];
                        
                        if($precioAnterior>0) $variacion = (($precio - $precioAnterior)/$precioAnterior) * 100;

                        if($precio > $precioAnterior){
                            $cambio = "Incremento";
                        }elseif($precio == $precioAnterior){
                            $cambio = "Se mantiene";
                        }elseif($precio < $precioAnterior){
                            $cambio = "Bajo";
                        }
                    } 

                    $Descarga->getActiveSheet()
                            ->setCellValue('A'.$fil, $value['premiosproductos'][0]['producto']['codInc'])
                            ->setCellValue('B'.$fil, $value['premiosproductos'][0]['producto']['nombre'])
                            ->setCellValue('C'.$fil, $value['premiosproductos'][0]['producto']['referencia'])
                            ->setCellValue('D'.$fil, $value['premiosproductos'][0]['producto']['marca'])
                            ->setCellValue('E'.$fil, $value['premiosproductos'][0]['producto']['descripcion'])
                            ->setCellValue('F'.$fil, $value['categoria']['nombre'])
                            ->setCellValue('G'.$fil, $estad)
                            ->setCellValue('H'.$fil, $aprobacion)
                            ->setCellValue('I'.$fil, $precio)
                            ->setCellValue('J'.$fil, $value['puntosTemporal'])
                            ->setCellValue('K'.$fil, $precioAnterior)
                            ->setCellValue('L'.$fil, $puntosAnterior)
                            ->setCellValue('M'.$fil, $cambio)
                            ->setCellValue('N'.$fil, $variacion);

                $fil++;
            }
                
            $objWriter = new PHPExcel_Writer_Excel2007($Descarga); 
            $objWriter->save('Cambios_Catologo.xlsx');  //send it to user, of course you can save it to disk also!
             // prepare BinaryFileResponse
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
            $filename = 'Cambios_Catologo.xlsx';
            $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
            $filePath = $basePath.'/'.$filename; 
             
            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
            return $response;

    }


    public function calcularPuntos($precio, $incremento, $logistica, $puntaje, $id){

        $em = $this->getDoctrine()->getManager();

        $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($id);

        if($catalogo->getCatalogotipo()->getId()==3){
            $puntos = $puntaje;
        }elseif($catalogo->getCatalogotipo()->getId()==1){
            $valorPunto = $catalogo->getValorpunto();
            $puntos = round(@((($precio/(1-($incremento/100)))+$logistica)/$valorPunto));
        }elseif($catalogo->getCatalogotipo()->getId()==2){

            $valorventa = ($precio/(1-($incremento/100)))+$logistica;

            $puntos = 0;

            //consulta intervalos

            $qb = $em->createQueryBuilder();
            $qb->select('i');
            $qb->from('IncentivesCatalogoBundle:Intervalos','i');
            $str_filtro = "i.catalogos=".$id." AND i.minimo<=".$valorventa." AND i.maximo>".$valorventa;
            $qb->where($str_filtro);
            $resultado = $qb->getQuery()->getOneOrNullResult();

            if(isset($resultado) && $resultado->getPuntos()>0){
                $valorPunto = $resultado->getPuntos();
                $puntos = round($valorventa/$valorPunto);
            }
           
        }
        
        return $puntos;

    }
    
     public function recalcularCatalogoAction($id){

        $em = $this->getDoctrine()->getManager();

        $productoCatalogo = $em->getRepository('IncentivesCatalogoBundle:Premios')->findBy(array('catalogos' => $id));

        foreach($productoCatalogo as $keyCat => $valueCat){
            
            //Puntos Aprobados
            $puntos = $this->calcularPuntos($valueCat->getPrecio(), $valueCat->getIncremento(), $valueCat->getLogistica(), 0, $id);
                    $valueCat->setPuntos($puntos);
                  
                    //Puntos por Aprobar
                    $puntosTemp = $this->calcularPuntos($valueCat->getPrecioTemporal(), $valueCat->getIncrementoTemporal(), $valueCat->getLogisticaTemporal(), 0, $id);
                    $valueCat->setPuntosTemporal($puntosTemp);
                  
                    $em->persist($valueCat);
                    $em->flush();
        }
        
        $this->get('session')->getFlashBag()->add('notice','Puntajes recalculados.');
        
        return $this->redirect($this->generateUrl('catalogo_datos').'/'.$id);
    }


    public function formatoAction()
    {
    
            // Create new PHPExcel object
            $Descarga = new PHPExcel();

            // Set document properties
            $Descarga->setActiveSheetIndex(0);
    
            $em = $this->getDoctrine()->getManager();
    
            $qb = $em->createQueryBuilder(); 
            $qb->select('c');
            $qb->from('IncentivesOperacionesBundle:Categoria','c');
            $categorias = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            $arrayCategorias = array();
            foreach($categorias as $keyCat => $valueCat){
                $arrayCategorias[] = $valueCat['id']." - ".$valueCat['nombre'];
                
            }
            
            $qb = $em->createQueryBuilder(); 
            $qb->select('p producto','c','e');
            $qb->from('IncentivesCatalogoBundle:Producto','p');
            $qb->leftJoin('p.categoria', 'c');
            $qb->leftJoin('p.estado', 'e');
            
            $str_filtro = 'p.estado = 1';
            $str_filtro .= ' AND p.tipo = 2';
            $qb->where($str_filtro);
            
            $producto = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            $Descarga->getActiveSheet()
                        ->setCellValue('A1','CodInc')
                        ->setCellValue('B1','Nombre')
                        ->setCellValue('C1','Referencia')
                        ->setCellValue('D1','Marca')
                        ->setCellValue('E1','Descripción')
                        ->setCellValue('F1','Categoria')
                        ->setCellValue('G1','Estado Producto')
                        ->setCellValue('H1','Subcategoria')
                        ->setCellValue('I1','Estado Catalogo***')
                        //->setCellValue('J1','Puntos***')
                        ->setCellValue('J1','Actualizacion***')
                        ->setCellValue('K1','Precio***')
                        ->setCellValue('L1','Incremento***')
                        ->setCellValue('M1','Logistica***')
                        ->setCellValue('N1','Puntos')
                        ->setCellValue('O1','Precio Nuevo')
                        ->setCellValue('P1','Incremento Nuevo')
                        ->setCellValue('Q1','Logistica Nuevo')
                        ->setCellValue('R1','Puntos Nuevo');
                        
                        $Descarga->getActiveSheet()->getStyle('I1')->applyFromArray(
                            array(
                                'fill' => array(
                                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                    'color' => array('rgb' => 'FFFF00')
                                )
                            )
                        );
                        $Descarga->getActiveSheet()->getStyle('J1')->applyFromArray(
                            array(
                                'fill' => array(
                                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                    'color' => array('rgb' => 'FFFF00')
                                )
                            )
                        );
                        $Descarga->getActiveSheet()->getStyle('K1')->applyFromArray(
                            array(
                                'fill' => array(
                                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                    'color' => array('rgb' => 'FFFF00')
                                )
                            )
                        );
                        $Descarga->getActiveSheet()->getStyle('L1')->applyFromArray(
                            array(
                                'fill' => array(
                                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                    'color' => array('rgb' => 'FFFF00')
                                )
                            )
                        );
                        $Descarga->getActiveSheet()->getStyle('M1')->applyFromArray(
                            array(
                                'fill' => array(
                                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                    'color' => array('rgb' => 'FFFF00')
                                )
                            )
                        );
                        
            $fil=2;
            
            $estado_array[] = '1 - Activo';
            $estado_array[] = '0 - Inactivo';

            $actual_array[] = '1 - Automatico';
            $actual_array[] = '0 - Manual';

            foreach ($producto as $key => $value) {
              //  $value = $value[0];
//print_r($value); exit;
                //$categ_ = $conn->fetchColumn('SELECT categoria_id FROM Producto WHERE id = '.$value->getId(), array(1), 0);
                
                /*$fechcre=array();
                foreach ($value->getFechacreacion() as $clave => $valor) {;
                    array_push($fechcre, $valor);
                }
                
                $fechact=array();
                foreach ($value->getFechaactualizacion() as $clave => $valor) {
                    array_push($fechact, $valor);
                    
                }*/
                
                $Descarga->getActiveSheet()
                        ->setCellValue('A'.$fil, $value['producto']['codInc'])
                        ->setCellValue('B'.$fil, $value['producto']['nombre'])
                        ->setCellValue('C'.$fil, $value['producto']['referencia'])
                        ->setCellValue('D'.$fil, $value['producto']['marca'])
                        ->setCellValue('E'.$fil, $value['producto']['descripcion'])
                        ->setCellValue('G'.$fil, $value['producto']['estado']['nombre'])
                        ->setCellValue('H'.$fil, "")     //$fechact[0]);
                        ->setCellValue('I'.$fil, '');
                 //$Descarga->setCellValue('J'.$fil, '');

                        $objValidation = $Descarga->getActiveSheet()->getCell('I'.$fil)->getDataValidation();
                        $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                        $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                        $objValidation->setAllowBlank(false);
                        $objValidation->setShowInputMessage(true);
                        $objValidation->setShowErrorMessage(true);
                        $objValidation->setShowDropDown(true);
                        $objValidation->setErrorTitle('Error de entrada.');
                        $objValidation->setError('Este valor no esta en la lista.');
                        $objValidation->setPromptTitle('Seleccione uno de la lista.');
                        $objValidation->setPrompt('Por favor seleccione uno de la lista.');
                        $objValidation->setFormula1('"' . implode(",", $estado_array) . '"');

                        $objValidation = $Descarga->getActiveSheet()->getCell('J'.$fil)->getDataValidation();
                        $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                        $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                        $objValidation->setAllowBlank(false);
                        $objValidation->setShowInputMessage(true);
                        $objValidation->setShowErrorMessage(true);
                        $objValidation->setShowDropDown(true);
                        $objValidation->setErrorTitle('Error de entrada.');
                        $objValidation->setError('Este valor no esta en la lista.');
                        $objValidation->setPromptTitle('Seleccione uno de la lista.');
                        $objValidation->setPrompt('Por favor seleccione uno de la lista.');
                        $objValidation->setFormula1('"' . implode(",", $actual_array) . '"');
                        
                        $objValidation = $Descarga->getActiveSheet()->getCell('H'.$fil)->getDataValidation();
                        $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                        $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                        $objValidation->setAllowBlank(false);
                        $objValidation->setShowInputMessage(true);
                        $objValidation->setShowErrorMessage(true);
                        $objValidation->setShowDropDown(true);
                        $objValidation->setErrorTitle('Error de entrada.');
                        $objValidation->setError('Este valor no esta en la lista.');
                        $objValidation->setPromptTitle('Seleccione uno de la lista.');
                        $objValidation->setPrompt('Por favor seleccione uno de la lista.');
                        $objValidation->setFormula1('"' . implode(",", $arrayCategorias) . '"');

                        if(null == $value['producto']['categoria']) $Descarga->getActiveSheet()->setCellValue('F'.$fil, 'Nulo');
                        else $Descarga->getActiveSheet()->setCellValue('F'.$fil, $value['producto']['categoria']['id']." - ".$value['producto']['categoria']['nombre']);
                $fil+=1;
            }
            
            $objWriter = new PHPExcel_Writer_Excel2007($Descarga); 
            $objWriter->save('Formato_Catologo.xlsx');  //send it to user, of course you can save it to disk also!
             // prepare BinaryFileResponse
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
            $filename = 'Formato_Catologo.xlsx';
            $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
            $filePath = $basePath.'/'.$filename; 
             
            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
            return $response;

    }


    public function nuevoComboAction(Request $request, $catalogo)
    {
        $em = $this->getDoctrine()->getManager();
        $premio = new Premios();

        $form = $this->createForm(CombosType::class, $premio);
        
        if ($request->isMethod('POST')) {
           
               $form->handleRequest($request);
               //if ($form->isValid()) {
                
                if(null !== $premio->getImagen()) $imagenCombo = $premio->getImagen();

                $pro = $request->request->all()['combos'];

                //echo "<pre>"; print_r($pro); echo "</pre>"; exit;

                $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($catalogo);
                $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($pro['categoria']);
                $estado = $em->getRepository('IncentivesCatalogoBundle:EstadoCatalogo')->find(1);
                // realiza alguna acción, tal como guardar la tarea en la base de datos

                $puntos = $this->calcularPuntos($pro['precioTemporal'], $pro['incrementoTemporal'], $pro['logisticaTemporal'], $pro['puntosTemporal'], $catalogo->getId());

                $premio = new Premios();

                $premio->setCatalogos($catalogo);
                $premio->setCategoria($categoria);
                $premio->setPuntosTemporal(($puntos) ? $puntos : 0 );
                $premio->setPrecioTemporal($pro['precioTemporal']);
                $premio->setEstado($estado);
                $premio->setIncrementoTemporal($pro['incrementoTemporal']);
                $premio->setLogisticaTemporal($pro['logisticaTemporal']);

                if(isset($pro['nombre']) && $pro['nombre']!="") $premio->setNombre($pro['nombre']);
                if(isset($pro['marca']) && $pro['marca']!="") $premio->setMarca($pro['marca']);
                if(isset($pro['referencia']) && $pro['referencia']!="") $premio->setReferencia($pro['referencia']);
                if(isset($pro['descripcion']) && $pro['descripcion']!="") $premio->setDescripcion($pro['descripcion']);


                $em->persist($premio);
                $em->flush();

                if(isset($imagenCombo) && null !== $imagenCombo){

                    //$form->handleRequest($request);
                    //print_r($form['imagen']->getData()); exit;
                    //Imagen
                    $file = $imagenCombo;
                    
                    //Tamaño de imagen
                    $original_info = getimagesize($file);
                    $original_w = $original_info[0];
                    $original_h = $original_info[1];
                    list($width,$height)=getimagesize($file);
                    $extension = $file->guessExtension();
                    //echo $file->getPath(); exit;
                    if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
                      echo 'Extensión invalida.';
                    } else {
                   
                      $size=filesize($file);
         
                      if ($size > 1500*1024)
                      {
                        echo "Supero limite de tamaño de archivo.";
                        $errors=1;
                      } else {

                        $uploadDir = 'Combos/';

                        if (!file_exists($uploadDir)) {
                            mkdir($uploadDir, 0777);
                        }

                        if($extension=="jpg" || $extension=="jpeg" )
                        {
                          $original_img = imagecreatefromjpeg($file);
                        }
                        else if($extension=="png")
                        {
                          $original_img = imagecreatefrompng($file);
                        }
                        else
                        {
                          $original_img = imagecreatefromgif($file);
                        }

                        $nombreArchivo = $premio->getId().'.jpg';
                        $file1 = $uploadDir.$nombreArchivo;

                        $newwidth = 300;
                        $newheight = ($original_h/$original_w)*$newwidth;
                        $tmp = imagecreatetruecolor($newwidth,$newheight);
                        imagecopyresampled($tmp,$original_img,0,0,0,0,$newwidth,$newheight,$width,$height);
                        imagejpeg($tmp,$file1,100);

                        $premio->setImagen($file1);
                        }
                    }//Imagen


                }

                $em->persist($premio);
                $em->flush();

                if(isset($pro['premiosproductos'])){

                    foreach ($pro['premiosproductos'] as $keyP => $valueP) {
                        # code...
                        $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($valueP);

                        $premioProducto = new PremiosProductos();
                        $premioProducto->setPremio($premio);
                        $premioProducto->setProducto($producto);
                        $em->persist($premioProducto);
                        $em->flush();
                    }
                }
                
                //probar el redirect en la verison 2.3 y hacer el ajsutepara la 2.7
                return $this->redirect($this->generateUrl('premios_datos')."/".$premio->getId());
                //}

        }

        return $this->render('IncentivesCatalogoBundle:Premios:nuevoCombo.html.twig', array(
                'form' => $form->createView(), 'catalogo' => $catalogo
        ));
    }

    public function listadoAction(Request $request, $catalogo)
    {
        $form = $this->createForm(FiltroPremiosType::class);

        $em = $this->getDoctrine()->getManager();
     
        $session = $this->get('session');
            
        $page = $request->get('page');
        if(!$page) $page= 1;
            
        if($pro = $request->request->get('filtro_premios')){
            $page = 1;
            $session->set('filtro_premios', $pro);
        }



        $condicionesFiltro = "";

        if($filtros = $session->get('filtro_premios')){
               
               foreach($filtros as $Filtro => $valueF){
                   
                   if($valueF!=""){
                       if($Filtro=="categoria"){
                            $condicionesFiltro .= " AND c.id=".$valueF."";
                       }elseif($Filtro=="estado"){
                            $condicionesFiltro .= " AND i.estado=".$valueF."";
                       }elseif($Filtro=="precio"){
                            $condicionesFiltro .= " AND pc.precio=".$valueF."";
                       }else{
                            $condicionesFiltro .= " AND pr.".$Filtro." LIKE '%".$valueF."%'";
                       }
                       
                   };
               } 
         }

        $query = $em->createQueryBuilder()
                ->select('pr','pp','p','i','c','e','ep','promo')
                ->from('IncentivesCatalogoBundle:Premios', 'pr')
                ->leftJoin('pr.premiosproductos','pp')
                ->leftJoin('pp.producto','p')
                ->leftJoin('pr.categoria','c')
                ->leftJoin('pr.estado','e')
                ->leftJoin('pr.estadoAprobacion','ep')
                ->leftJoin('p.imagenproducto','i','WITH','i.estado=1')
                ->leftJoin('pr.promocion','promo','WITH','promo.estado=1')
                ->orderBy("pr.puntos");

        $condiciones = "pr.catalogos=".$catalogo." AND pr.estado = 1 AND p.estado=1";
        
        if($request->get('sort')){
            $query->orderBy($request->get('sort'), $request->get('direction'));    
        }
        
        $precioVenta=0;
        if ($this->get('security.authorization_checker')->isGranted('ROLE_CLI')) {
           $condiciones .= " AND (pr.aproboCliente=1 AND pr.aproboOperaciones=1 AND pr.aproboComercial=1 AND pr.aproboDirector=1)";
           $cliente =  $this->getUser()->getCliente()->getId();      
           if($cliente==28) $precioVenta = 1;
        }

        $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($catalogo);

        $query->where($condiciones.$condicionesFiltro);
        $premios = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $premios,
            $request->query->get('page', 1)/*page number*/,
            20 /*limit per page*/
        );

        $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($catalogo);
        
         return $this->render('IncentivesCatalogoBundle:Premios:listado.html.twig', 
            array('premios' => $pagination, 'catalogo'=>$catalogo, 'form' => $form->createView()));
    }

    public function importarCombosAction(Request $request, $id)
    {
        $excelForm = new Excel();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder($excelForm)
            ->setMethod('POST')
            ->add('excel', FileType::class)
            ->add('cargar', SubmitType::class)
            ->getForm();

        $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($id);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            $excel = $form['excel']->getData();

            $objPHPExcel = PHPExcel_IOFactory::load($excel);
            
            $worksheet  = $objPHPExcel->setActiveSheetIndex('0');
            $ultimaFila = $worksheet->getHighestRow(); // e.g. 10

            //$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            $sheetData = $objPHPExcel->getActiveSheet()->rangeToArray("A1:AA".$ultimaFila,false,false,false);

            $ok=0;
            $fila=0;
            $sku = array();
            $error = 0;
            $listaErrores="";

            if($error==0){
           
                $fila=0;
                foreach ($sheetData as $row) {

                    $puntos=0;
                    if($fila > 0 && $fila <= $ultimaFila && trim($row[17])!=""){
 
                        $estado = $row[7]."";
                        $categoria = $row[6]."";

                        if($row[7] && isset($estado) && $estado!=""){

                            unset($premio);

                            $precio = $row[12];
                            $incremento = $row[13];
                            $logistica = $row[14];
                            $puntaje = $row[15];

                            $puntos = $this->calcularPuntos($precio, $incremento, $logistica, $puntaje, $id);

                            if($row[0]!="") $id_premio = $row[0]; else $id_premio = "";

                            if($id_premio != ""){

                                $qb = $em->createQueryBuilder();            
                                $qb->select('pr');
                                $qb->from('IncentivesCatalogoBundle:Premios','pr');
                                $qb->where('pr.id = :id_premio AND pr.catalogos = :id_catalogo');
                                $qb->setParameter('id_premio', $id_premio);
                                $qb->setParameter('id_catalogo', $id);
                                $qb->setMaxResults(1);
                                $premio = $qb->getQuery()->getOneOrNullResult();

                                if(!isset($premio) ){
                                    $premio = new Premios();
                                }

                            }else{
                                $premio = new Premios();
                            }

                            $premio->setCatalogos($catalogo);
                            $categoriaP = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($categoria);
                            $premio->setCategoria($categoriaP);
                            $estado = $em->getRepository('IncentivesCatalogoBundle:Estadocatalogo')->find($estado);
                            $premio->setEstado($estado);
                            $premio->setPuntosTemporal($puntos);
                            $premio->setPrecioTemporal($precio);
                            $premio->setIncrementoTemporal($incremento);
                            $premio->setLogisticaTemporal($logistica);
                            $premio->setEstadoAprobacion(NULL);
                            
                            if($row[1]!="") $premio->setNombre($row[1]);
                            if($row[2]!="") $premio->setDescripcion($row[2]);
                            if($row[3]!="") $premio->setMarca($row[3]);
                            if($row[4]!="") $premio->setReferencia($row[4]);
                            if($row[5]!="") $premio->setImagenTemp($row[5]);

                            //echo $premio->getId(); exit;
                            $em->persist($premio);
                            $em->flush();

                               //establecer productos por premio
                                $ipC = 16;
                                $cantP = 0;
                                $cmb=0;

                                for($ip = 0; $ip <= 2; $ip++){

                                    $ipP = $ipC + ($ip*3);
                                    $sku = $row[$ipP];
                                    $cantidad = $row[$ipP + 1];
                                    $estadoP = $row[$ipP + 2];

                                    /*echo $ipP." -- ";
                                    echo $row[$ipP]." - ".$row[$ipP + 1]." - ".$row[$ipP + 2]." ** ";*/

                                    if (isset($sku) && $sku!="") {

                                        $qb = $em->createQueryBuilder();            
                                        $qb->select('p');
                                        $qb->from('IncentivesCatalogoBundle:Producto','p');
                                        $qb->where("p.codInc LIKE '".$sku."'");
                                        $qb->setMaxResults(1);
                                        $producto = $qb->getQuery()->getOneOrNullResult();

                                        if(isset($producto) && $producto->getId()!=""){

                                            $cantP++;

                                            $qb = $em->createQueryBuilder();            
                                            $qb->select('prp');
                                            $qb->from('IncentivesCatalogoBundle:PremiosProductos','prp');
                                            $qb->where("prp.premio = ".$premio->getId()." AND prp.producto=".$producto->getId());
                                            //echo $premioProducto->getId(); exit;

                                            if(!($premioProducto = $qb->getQuery()->getOneOrNullResult())){
                                                $premioProducto = new PremiosProductos();
                                            }
                                            
                                            $estado = $em->getRepository('IncentivesCatalogoBundle:Estadocatalogo')->find($estadoP);

                                            $premioProducto->setEstado($estado);
                                            $premioProducto->setCantidad($cantidad);
                                            $premioProducto->setProducto($producto);
                                            $premioProducto->setPremio($premio);
                                            $em->persist($premioProducto);
                                            $em->flush();

                                            $ultimoProd = $producto;
                                            if($cantidad>1) $cmb=1;
                                        }
                                    }   
                                }

                                //si es mas de un producto o mas de una unidad asignar codigo de combo, sino asignar codigo de primer producto

                                if($cantP>=2 || $cmb==1){
                                    $num=str_pad($premio->getId(), 6, '0', STR_PAD_LEFT);
                                    $premio->setCodigo("CMB".$num);

                                    if($row[1]!="") $premio->setNombre($row[1]);
                                    if($row[2]!="") $premio->setDescripcion($row[2]);
                                    if($row[3]!="") $premio->setMarca($row[3]);
                                    if($row[4]!="") $premio->setReferencia($row[4]);
                                    if($row[5]!="") $premio->setImagenTemp($row[5]);

                                    $em->persist($premio);

                                }else{
                                    //echo $ultimoProd->getCodInc(); exit;
                                    if(isset($ultimoProd)) $premio->setCodigo($ultimoProd->getCodInc());
                                }

                                $em->persist($premio);
                                $em->flush();

                            $ok++;
                        }
                    }
                    
                    $fila++;
                }
                $this->get('session')->getFlashBag()->add(
                    'warning',
                    'Se agregaron/actualizaron '.$ok.' premios al catalogo.'
                    );
           }else{
                 $this->get('session')->getFlashBag()->add(
                'warning',
                'Error con los siguientes productos :'.$listaErrores
                );
            }
           //return $this->redirect($this->generateUrl('catalogo_datos'));

        }



        return $this->render('IncentivesCatalogoBundle:Premios:importarCombos.html.twig', array(
            'form' => $form->createView(), 'id' => $id
        ));

    }

    public function masivoImagenCombosAction($catalogo)
    {
        //Leer el directorio de imagenes temporales

        $em = $this->getDoctrine()->getManager();
        //$producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->findByCategoria(8);

        //Proveedor principal
        $qb = $em->createQueryBuilder();            
        $qb->select('p');
        $qb->from('IncentivesCatalogoBundle:Premios','p');
        $str_filtro = 'p.imagenTemp IS NOT NULL';               
        $qb->where($str_filtro);                    
        $producto = $qb->getQuery()->getResult();

        //$producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->findByCategoria(8);

        $conteo =0;
        foreach ($producto as $key => $value) {

            $ruta = "../web/tmp/";
            $file = $ruta.$value->getImagenTemp();

            if($original_img = @imagecreatefromjpeg($file)){

                $original_info = getimagesize($file);
                $original_w = $original_info[0];
                $original_h = $original_info[1];
                list($width,$height)=getimagesize($file);
                        
                $extension = substr($file, -3);

                $newwidth=300;//acho de la imagen
                $newheight=($original_h/$original_w)*$newwidth;                           
                $tmp=imagecreatetruecolor($newwidth,$newheight);

                imagecopyresampled($tmp,$original_img,0,0,0,0,$newwidth,$newheight,$width,$height);
                imagejpeg($tmp,$file,100);

                $uploadDir = '../web/Combos/';

                if (!file_exists($uploadDir)) mkdir($uploadDir, 0700);
                $conteo++;
                $nombreArchivo = $value->getCodigo().'.jpg';            //.'.$extension
                $nombreArchivo2 = $value->getCodigo().'_min.jpg';            //.$extension;

                //$file->move($uploadDir,$nombreArchivo);
                copy($file,$uploadDir.$nombreArchivo);
                //echo $file.",".$uploadDir.$nombreArchivo;
                copy($uploadDir.$nombreArchivo,$uploadDir.$nombreArchivo2);

                $premio = $em->getRepository('IncentivesCatalogoBundle:Premios')->find($value->getId());
                //echo $productoO->getId()."<br>";
                //$producto->addImagenproducto($imagen);
                
                $premio->setImagen($uploadDir.$nombreArchivo);
                $premio->setImagenTemp(null);
                $em->persist($premio);
                //$em->persist($productoO);
                $em->flush();

                //unlink($file);

                //$conn = $this->get('database_connection');
                //$imagenProd = $conn->insert('Imagenproducto',array('producto_id'=>$value->getId(), 'nombre'=>$nombreArchivo, 'path' =>$uploadDir.$nombreArchivo, 'estado'=>1));

            }
            # code...
        }

        $this->get('session')->getFlashBag()->add('notice', 'Imagenes procesadas exitosamente');

        return $this->redirect($this->generateUrl('premios_importar_combos').'/'.$catalogo);
        
    }

    public function formatoCombosAction()
    {
            // Create new PHPExcel object
            $Descarga = new PHPExcel();

            // Set document properties
            $Descarga->setActiveSheetIndex(0);

            $Descarga->getActiveSheet()
                        ->setCellValue('A1','Id (Solo para actualizar)')
                        ->setCellValue('B1','Nombre')
                        ->setCellValue('C1','Descripción')
                        ->setCellValue('D1','Marca')
                        ->setCellValue('E1','Referencia')
                        ->setCellValue('F1','Archivo Imagen')
                        ->setCellValue('G1','Subcategoria')
                        ->setCellValue('H1','Estado')
                        ->setCellValue('I1','Precio Actual')
                        ->setCellValue('J1','Incremento Actual')
                        ->setCellValue('K1','Logistica Actual')
                        ->setCellValue('L1','Puntos Actuales')
                        ->setCellValue('M1','Precio Nuevo')
                        ->setCellValue('N1','Incremento Nuevo')
                        ->setCellValue('O1','Logistica Nuevo')
                        ->setCellValue('P1','Puntos Nuevos')
                        ->setCellValue('Q1','SKU')
                        ->setCellValue('R1','Cantidad')
                        ->setCellValue('S1','Estado SKU')
                        ->setCellValue('T1','SKU')
                        ->setCellValue('U1','Cantidad')
                        ->setCellValue('V1','Estado SKU')
                        ->setCellValue('W1','SKU')
                        ->setCellValue('X1','Cantidad')
                        ->setCellValue('Y1','Estado SKU')
                        ->setCellValue('Z1','SKU')
                        ->setCellValue('AA1','Cantidad')
                        ->setCellValue('AB1','Estado SKU')
                        ->setCellValue('AC1','SKU')
                        ->setCellValue('AD1','Cantidad')
                        ->setCellValue('AE1','Estado SKU');
                        
                        $Descarga->getActiveSheet()->getStyle('G1:H1')->applyFromArray(
                            array(
                                'fill' => array(
                                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                    'color' => array('rgb' => 'FFFF00')
                                )
                            )
                        );
                        $Descarga->getActiveSheet()->getStyle('M1:P1')->applyFromArray(
                            array(
                                'fill' => array(
                                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                    'color' => array('rgb' => 'FFFF00')
                                )
                            )
                        );
                        
            
            $objWriter = new PHPExcel_Writer_Excel2007($Descarga); 
            $objWriter->save('Formato_Catologo_Combos.xlsx');  //send it to user, of course you can save it to disk also!
             // prepare BinaryFileResponse
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
            $filename = 'Formato_Catologo_Combos.xlsx';
            $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
            $filePath = $basePath.'/'.$filename; 
             
            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
            return $response;

    }


    public function editarComboAction(Request $request, $premio)
    {
        $em = $this->getDoctrine()->getManager();

        $premiosEditar = $em->getRepository('IncentivesCatalogoBundle:Premios')->find($premio);
        $form = $this->createForm(CombosEditarType::class, $premiosEditar);
        
        if ($request->isMethod('POST')) {
           
               //$form->handleRequest($request);
               //if ($form->isValid()) {
                
//                if(null !== $premio->getImagen()) $imagenCombo = $premio->getImagen();
                $pro = $request->request->all()['combos_editar'];
                //echo "<pre>"; print_r($pro); echo "</pre>"; exit;
                $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($pro['categoria']);
                // realiza alguna acción, tal como guardar la tarea en la base de datos

                $puntos = $this->calcularPuntos($pro['precioTemporal'], $pro['incrementoTemporal'], $pro['logisticaTemporal'], $pro['puntosTemporal'], $premiosEditar->getCatalogos()->getId());

                $premiosEditar->setCategoria($categoria);
                $premiosEditar->setPuntosTemporal(($puntos) ? $puntos : 0 );
                $premiosEditar->setPrecioTemporal($pro['precioTemporal']);
                $premiosEditar->setIncrementoTemporal($pro['incrementoTemporal']);
                $premiosEditar->setLogisticaTemporal($pro['logisticaTemporal']);

                if(isset($pro['nombre']) && $pro['nombre']!="") $premiosEditar->setNombre($pro['nombre']);
                if(isset($pro['marca']) && $pro['marca']!="") $premiosEditar->setMarca($pro['marca']);
                if(isset($pro['referencia']) && $pro['referencia']!="") $premiosEditar->setReferencia($pro['referencia']);
                if(isset($pro['descripcion']) && $pro['descripcion']!="") $premiosEditar->setDescripcion($pro['descripcion']);

                $em->persist($premiosEditar);
                $em->flush();

                $form->handleRequest($request);
                $imagenCombo = $premiosEditar->getImagen();

                if(isset($imagenCombo) && null !== $imagenCombo){

                    //$form->handleRequest($request);
                    //print_r($form['imagen']->getData()); exit;
                    //Imagen
                    $file = $imagenCombo;
                    
                    //Tamaño de imagen
                    $original_info = getimagesize($file);
                    $original_w = $original_info[0];
                    $original_h = $original_info[1];
                    list($width,$height)=getimagesize($file);
                    $extension = $file->guessExtension();
                    //echo $file->getPath(); exit;
                    if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
                      echo 'Extensión invalida.';
                    } else {
                   
                      $size=filesize($file);
         
                      if ($size > 1500*1024)
                      {
                        echo "Supero limite de tamaño de archivo.";
                        $errors=1;
                      } else {

                        $uploadDir = 'Combos/';

                        if (!file_exists($uploadDir)) {
                            mkdir($uploadDir, 0777);
                        }

                        if($extension=="jpg" || $extension=="jpeg" )
                        {
                          $original_img = imagecreatefromjpeg($file);
                        }
                        else if($extension=="png")
                        {
                          $original_img = imagecreatefrompng($file);
                        }
                        else
                        {
                          $original_img = imagecreatefromgif($file);
                        }

                        $nombreArchivo = $premiosEditar->getId().'.jpg';
                        $file1 = $uploadDir.$nombreArchivo;

                        $newwidth = 300;
                        $newheight = ($original_h/$original_w)*$newwidth;
                        $tmp = imagecreatetruecolor($newwidth,$newheight);
                        imagecopyresampled($tmp,$original_img,0,0,0,0,$newwidth,$newheight,$width,$height);
                        imagejpeg($tmp,$file1,100);

                        

                        $premioImagen = $em->getRepository('IncentivesCatalogoBundle:Premios')->find($premio);
                        $premioImagen->setImagen($file1);
                        echo $premioImagen->getId();
                        $em->persist($premioImagen);
                        $em->flush();
                       
                        }
                    }//Imagen

                }
  
                //probar el redirect en la verison 2.3 y hacer el ajsutepara la 2.7
                return $this->redirect($this->generateUrl('premios_datos')."/".$premiosEditar->getId());
                //}
        }

        return $this->render('IncentivesCatalogoBundle:Premios:editarCombo.html.twig', array(
                'form' => $form->createView(), 'premio' => $premio
        ));
    }
}