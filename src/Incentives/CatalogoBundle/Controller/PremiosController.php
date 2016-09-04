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
use Incentives\CatalogoBundle\Form\Type\PremiosProductosType;

use Incentives\CatalogoBundle\Entity\Excel;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Cell_DataValidation;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Style_Fill;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class PremiosController extends Controller
{

    public function nuevoAction(Request $request, $producto, $catalogo)
    {
        $premio = new Premios();
        $form = $this->createFormBuilder($premio)
            ->add('activo')
            ->add('puntos')
            ->add('precio')
            ->add('incremento')
            ->add('logistica')
            ->add('actualizacion')
            ->getForm();

        return $this->render('IncentivesCatalogoBundle:Premios:nuevo.html.twig', array(
                'form' => $form->createView(), /*'productocatalogo'=>$productocatalogo,*/ 
                'producto'=>$producto, 'catalogo'=>$catalogo
        ));
    }

    public function listadoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->findAll();
        $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->findAll();
        $imagen = $em->getRepository('IncentivesCatalogoBundle:Imagenproducto')->findAll();
        $productoprecio = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->findAll();
        $programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->findAll();
        $productocatalogo = new Productocatalogo();
        foreach ($producto as $key => $value) {
            foreach ($catalogo as $keys => $values) {
                $matriz[$value->getId()][$values->getId()] = $this->createForm(ProductocatalogoType::class, $productocatalogo);
                $matrizv[$value->getId()][$values->getId()] = $matriz[$value->getId()][$values->getId()] ->createView();
            }
        }
        

        $form = $this->createForm(ProductocatalogoType::class, $productocatalogo);

        return $this->render('IncentivesCatalogoBundle:Maestro:listado3.html.twig', array(
                'form' => $form->createView(), 'matrizv'=>$matrizv,
                'producto'=>$producto, 'catalogo'=>$catalogo, 'imagen'=>$imagen,
                'productoprecio'=>$productoprecio, 'programa'=>$programa,
        ));
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
                            $sqlFiltro .= " AND pc.puntos >= ".$valueF."";
                       }elseif($Filtro=="puntos_max"){
                            $sqlFiltro .= " AND pc.puntos <= ".$valueF."";
                       }elseif($Filtro=="catalogo"){

						   if($valueF[0]!=""){
							   foreach($valueF as $keyKF => $valueKF){
								   $valuek[] = $valueKF;
								}
								$valueF = implode($valuek,",");

								$arrayFiltro['id'] = $valuek;
								$sqlFiltro .= " AND pc.catalogos in (".$valueF.")";
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
                ->select('p producto','pp precio', 'c categoria','e estado', 'pc', 'i','ct') 
                ->from('IncentivesCatalogoBundle:Producto', 'p')
                ->leftJoin('p.productoprecio','pp')
                ->leftJoin('p.imagenproducto','i', "WITH", "i.estado=1")
                ->leftJoin('p.categoria', 'c')
                ->leftJoin('p.productocatalogo', 'pc')
                ->leftJoin('pc.catalogos', 'ct')
                ->leftJoin('p.estado', 'e')
                ->where($sqlFiltro);
            
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
            
        return $this->render('IncentivesCatalogoBundle:Maestro:maestro.html.twig', 
            array('productos' => $pagination, 'catalogos' => $catalogos, 'form' => $form->createView()));
    }


    public function grupoAction(Request $request, $id, $pagina, $str_filtro, $parametros)
    {
        $em = $this->getDoctrine()->getManager();

        //Seteo de la consulta para productos
        $qb = $em->createQueryBuilder();            
        $qb->select('p');
        $qb->from('IncentivesCatalogoBundle:Producto','p');
        $qb->where($str_filtro);
        $parametros = json_decode($parametros, true);
        $qb->setParameters($parametros);
        $producto = $qb->getQuery()->getResult();

        //$producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $producto,
            $pagina /*page number*/,
            20 /*limit per page*/
        );

        $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($id);
        $productoprecio = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->findAll();

        foreach ($pagination as $key => $value) {

            $qb = $em->createQueryBuilder();            
            $qb->select('pc');
            $qb->from('IncentivesCatalogoBundle:Productocatalogo','pc');
            $qb->where('pc.producto = :id_producto AND pc.catalogos = :id_catalogo');
            $qb->setParameter('id_producto', $value);
            $qb->setParameter('id_catalogo', $catalogo);

            if(!($productocatalogo = $qb->getQuery()->getOneOrNullResult())) $productocatalogo = new Productocatalogo();

            $matriz[$value->getId()][$id] = $this->createForm(ProductocatalogoType::class, $productocatalogo);
            $matrizv[$value->getId()][$id] = $matriz[$value->getId()][$id] ->createView();
        }

        $pagina=$request->query->get('page', 1);

        return $this->render('IncentivesCatalogoBundle:Maestro:grupo.html.twig', array(
                'matrizv'=>$matrizv,
                'producto'=>$pagination, 
                'catalogo'=>$catalogo,
                'id' => $id,
                'productoprecio'=>$productoprecio,
        ));

    }


    /**
     * @Route("/")
     * @Template()
     */
    public function procesarItemAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();

        $id_prod = ($request->request->get('producto'));
        $id_catal = ($request->request->get('catalogo'));

        $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($id_catal);
        $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($id_prod);

        $qb = $em->createQueryBuilder();            
        $qb->select('pc');
        $qb->from('IncentivesCatalogoBundle:Productocatalogo','pc');
        $qb->where('pc.producto = :id_producto AND pc.catalogos = :id_catalogo');
        $qb->setParameter('id_producto', $id_prod);
        $qb->setParameter('id_catalogo', $id_catal);

        if(!($productocatalogo = $qb->getQuery()->getOneOrNullResult())) $productocatalogo = new Productocatalogo();

        $form = $this->createForm(ProductocatalogoType::class, $productocatalogo);
   
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {

                $pro=($request->request->get('productocatalogo'));

                if(isset($pro['activo'])){
                    
                    $puntos = $pro['precio']/$catalogo->getValorpunto();
                    $productocatalogo->setActivo($pro['activo']);
                    $productocatalogo->setPuntos($puntos);
                    $productocatalogo->setPrecio($pro['precio']);
                    $productocatalogo->setIncremento($pro['incremento']);
                    $productocatalogo->setLogistica($pro['logistica']);
                    //$productocatalogo->setActualizacion($pro['actualizacion']);

                    if( $pro['puntos'] > $catalogo->getPuntosMaximos()){
                    echo '<div class="alert alert-error span4" ">El valor del premio es mayor al máximo de puntos del catálogo.
                        <button class="close" data-dismiss="alert" type="button">×</button></div>';
                    }
                }else{
                    $productocatalogo->setActivo(0);
                }
                $productocatalogo->setCatalogos($catalogo);
                $productocatalogo->setProducto($producto);

                $em->persist($productocatalogo);          
                $em->flush();

                echo '<div class="alert alert-success span4" ">El producto se actualizo correctamente.
                        <button class="close" data-dismiss="alert" type="button">×</button></div>';

            }else{
                 echo '<div class="alert alert-error span4" ">Error al actualizar el producto
                        <button class="close" data-dismiss="alert" type="button">×</button></div>';
            }
        }            

        return $this->render('IncentivesCatalogoBundle:Maestro:procesarItem.html.twig');

    }


    /**
     * @Route("/")
     * @Template()
     */
    public function calcularPuntosAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();

        $id_prod = ($request->request->get('producto'));
        $id_catal = ($request->request->get('catalogo'));

        $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($id_catal);

        $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($id_prod);
        //$productoprecio = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($id_prod);

        $qb = $em->createQueryBuilder();
        $qb->select('pp');
        $qb->from('IncentivesCatalogoBundle:Productoprecio','pp');
        $qb->where('pp.producto= :producto AND pp.principal=1');
        $qb->setParameter('producto', $producto->getId());

        $productoprecio = $qb->getQuery()->getSingleResult();

        //Iva y logistica por programa
        $programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($catalogo->getPrograma()->getId());

        $log = $programa->getLogistica();
        $iva = $programa->getIva();

        $add=0;

        if($iva==1){
            $add += $producto->getIva();
        }

        if($log > 0){
            $add += $log;
        }

        $productoprecio = $qb->getQuery()->getSingleResult();

        $valor = ceil(($productoprecio->getPrecio() * (1 + $add))/$catalogo->getValorpunto());

        echo $valor;

        return $this->render('IncentivesCatalogoBundle:Maestro:calcularPuntos.html.twig');

    }

    public function importarAction(Request $request, $id)
    {
        $excelForm = new Excel();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder($excelForm)
            ->setAction($this->generateUrl('proveedores_importar'))
            ->setMethod('POST')
            ->add('excel', 'file')
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
                            $qb->select('pc');
                            $qb->from('IncentivesCatalogoBundle:Productocatalogo','pc');
                            $qb->where('pc.producto = :id_producto AND pc.catalogos = :id_catalogo');
                            $qb->setParameter('id_producto', $producto->getId());
                            $qb->setParameter('id_catalogo', $id);
                            $qb->setMaxResults(1);

                            if(!($productocatalogo = $qb->getQuery()->getOneOrNullResult())) $productocatalogo = new Productocatalogo();

                            $productocatalogo->setProducto($producto);
                            $productocatalogo->setCatalogos($catalogo);
                            $categoriaP = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($categoria);
                            $productocatalogo->setCategoria($categoriaP);
                            $productocatalogo->setActivo($estado);
                            $productocatalogo->setPuntosTemporal($puntos);
                            $productocatalogo->setPrecioTemporal($precio);
                            $productocatalogo->setIncrementoTemporal($incremento);
                            $productocatalogo->setLogisticaTemporal($logistica);
                            //$productocatalogo->setActualizacion($tipo_actual);

                            //$productocatalogo->setAproboOperaciones(NULL);
                            //$productocatalogo->setAproboComercial(NULL);
                            //$productocatalogo->setAproboDirector(NULL);
                            //$productocatalogo->setAproboCliente(NULL);
                            
                            $productocatalogo->setEstadoAprobacion(NULL);

                            $em->persist($productocatalogo);  
                            
                            $productocatalogoH = $this->get('incentives_catalogo');
                            $productocatalogoH->historico($productocatalogo);
                            
                            $em->flush();

                            $ok++;
                        }
                    }
                    
                    $fila++;
                }
                $this->get('session')->getFlashBag()->add(
                    'warning',
                    'Se adicionaron: '.$ok.' registros al catalogo de premios'
                    );
           }else{
                 $this->get('session')->getFlashBag()->add(
                'warning',
                'Error con los siguientes productos :'.$listaErrores
                );
            }
           //return $this->redirect($this->generateUrl('catalogo_datos'));

        }



        return $this->render('IncentivesCatalogoBundle:Maestro:importar.html.twig', array(
            'form' => $form->createView(), 'id' => $id
        ));

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

            $arryaCategorias = array();
            foreach($categorias as $keyCat => $valueCat){
                $arryaCategorias[] = $valueCat['id']." - ".$valueCat['nombre'];
                
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
                        $objValidation->setFormula1('"' . implode(",", $arryaCategorias) . '"');

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
    
    public function formatoimagenAction($id)
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
            $qb->select('pc','p','pe','c','cat');
            $qb->from('IncentivesCatalogoBundle:Productocatalogo','pc');
            $qb->leftJoin('pc.producto','p');
            $qb->leftJoin('pc.categoria','c');
            $qb->leftJoin('p.categoria','cat');
            $qb->leftJoin('p.estado','pe');
            $str_filtro = 'pc.catalogos = '.$id;   
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

                    $Descarga->getActiveSheet()->getRowDimension($fil)->setRowHeight('45');     //->getColumnDimension('P')->setWidth(17.43); //original width of column A
                    $Descarga->getActiveSheet()->getColumnDimension('L')->setWidth(10);

                    if($value['actualizacion'] == 1) $actual = "1 - Manual"; else  $actual = "0 - Automatica";
                    if($value['activo'] == 1) $estad = "1 - Activo"; else  $estad = "0 - Inactivo";

					$valorVenta = ($value['precio']/(1-$value['incremento']/100))+$value['logistica'];
					$valorVentaTemp = ($value['precioTemporal']/(1-$value['incrementoTemporal']/100))+$value['logisticaTemporal'];

                    $Descarga->getActiveSheet()
                            ->setCellValue('A'.$fil, $value['producto']['codInc'])
                            ->setCellValue('B'.$fil, $value['producto']['nombre'])
                            ->setCellValue('C'.$fil, $value['producto']['referencia'])
                            ->setCellValue('D'.$fil, $value['producto']['marca'])
                            ->setCellValue('E'.$fil, $value['producto']['descripcion'])
                            ->setCellValue('G'.$fil, $value['producto']['estado']['id'])
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
            
                            if(null == $value['producto']['categoria']) $Descarga->getActiveSheet()->setCellValue('F'.$fil, 'Nulo');
                            else $Descarga->getActiveSheet()->setCellValue('F'.$fil, $value['producto']['categoria']['id']." - ".$value['producto']['categoria']['nombre']);
            

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
    
     public function nuevoProductoAction(Request $request, $producto)
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
                  
                $premioProducto = new PremiosProductos();
                $premioProducto->setPremio($premio);
                $premioProducto->setProducto($producto);

                $em->persist($premio);
                $em->persist($premioProducto);                            
                $em->flush();
                //probar el redirect en la verison 2.3 y hacer el ajsutepara la 2.7
                return $this->redirect($this->generateUrl('producto_datos')."/".$producto->getId());
                //}

        }

        return $this->render('IncentivesCatalogoBundle:Premios:nuevoProducto.html.twig', array(
                'form' => $form->createView(), 'producto' => $producto->getId(),
        ));
    }
    
    public function editarcatalogoAction(Request $request, $productocatalogo)
    {
        $em = $this->getDoctrine()->getManager();
        $productocatalogoEditar = $em->getRepository('IncentivesCatalogoBundle:Productocatalogo')->find($productocatalogo);
        $datosProducto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($productocatalogoEditar->getProducto()->getId());
        $form = $this->createForm(new ProductocatalogoProdType(), $productocatalogoEditar);
        
        if ($request->isMethod('POST')) {
           
                //$form->handleRequest($request);
                //if ($form->isValid()) {
                
                    $pro=($request->request->get('productocatalogo'));
                    $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($pro['categoria']);
                    
                    $puntos = $this->calcularPuntos($pro['precioTemporal'], $pro['incrementoTemporal'], $pro['logisticaTemporal'], $pro['puntosTemporal'], $productocatalogoEditar->getCatalogos()->getId());

                    $productocatalogoEditar->setActivo($productocatalogoEditar->getActivo());
                    $productocatalogoEditar->setCategoria($categoria);
                    $productocatalogoEditar->setPuntosTemporal($puntos);
                    $productocatalogoEditar->setPrecioTemporal($pro['precioTemporal']);
                    $productocatalogoEditar->setIncrementoTemporal($pro['incrementoTemporal']);
                    $productocatalogoEditar->setLogisticaTemporal($pro['logisticaTemporal']);

                    $productocatalogoEditar->setEstadoAprobacion(NULL);
                      
                    $em->persist($productocatalogoEditar);
                    
                    $productocatalogoH = $this->get('incentives_catalogo');
                    $productocatalogoH->historico($productocatalogoEditar);
                    
                    $em->flush();
                    //probar el redirect en la verison 2.3 y hacer el ajsutepara la 2.7
                   return $this->redirect($this->generateUrl('producto_datos', array('id' => $datosProducto->getId())));
                //}

        }

        return $this->render('IncentivesCatalogoBundle:Maestro:editarcatalogo.html.twig', array(
                'form' => $form->createView(), 'id' =>   $datosProducto->getId(), 'productocatalogo' => $productocatalogo,
        ));
    }

    public function nuevoPremioAction(Request $request, $producto, $catalogo)
    {
        $em = $this->getDoctrine()->getManager();
        $premio = new Premio();

        $datosProducto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($producto);

        $form = $this->createForm(PremioType::class, $premio);
        
        if ($request->isMethod('POST')) {
           
                $form->handleRequest($request);
               if ($form->isValid()) {
                
                $pro=($request->request->get('premios'));
                $catalogoP = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($catalogo);
                $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($pro['categoria']);
                // realiza alguna acción, tal como guardar la tarea en la base de datos

                $puntos = $this->calcularPuntos($pro['precioTemporal'], $pro['incrementoTemporal'], $pro['logisticaTemporal'], $pro['puntosTemporal'], $catalogoP->getId());

                $premio->setProducto($datosProducto);
                $premio->setCatalogos($catalogoP);
                $premio->setCategoria($categoria);
                $premio->setPuntosTemporal($puntos);
                $premio->setPrecioTemporal($pro['precioTemporal']);
                $premio->setActivo(1);
                $premio->setIncrementoTemporal($pro['incrementoTemporal']);
                $premio->setLogisticaTemporal($pro['logisticaTemporal']);
                //$productocatalogo->setPrecio($pro['precioTemporal']);
                //$productocatalogo->setIncremento($pro['incrementoTemporal']);
                //$productocatalogo->setLogistica($pro['logisticaTemporal']);

                if(isset($pro["agotado"]) && $pro["agotado"]==1) $agotado = 1; else $agotado = 0;
                $productocatalogo->setAgotado($agotado);
                  
                $em->persist($premio);
                            
                $em->flush();
                //probar el redirect en la verison 2.3 y hacer el ajsutepara la 2.7
                   return $this->redirect($this->generateUrl('productocatalogo_maestro'));
                }

        }

        return $this->render('IncentivesCatalogoBundle:Premios:nuevopremio.html.twig', array(
                'form' => $form->createView(), 'producto' => $producto, 'catalogo' => $catalogo,
        ));
    }
    
    public function editarPremioAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $productocatalogoEditar = $em->getRepository('IncentivesCatalogoBundle:Productocatalogo')->find($id);
        $datosProducto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($productocatalogoEditar->getProducto()->getId());
        $form = $this->createForm(ProductocatalogoProdType::class, $productocatalogoEditar);


        if ($request->isMethod('POST')) {
                
                $idCatalogo = $productocatalogoEditar->getCatalogos()->getId();
                
                    $pro=($request->request->get('productocatalogo'));
                    $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($pro['categoria']);
                    
                    $puntos = $this->calcularPuntos($pro['precioTemporal'], $pro['incrementoTemporal'], $pro['logisticaTemporal'], $pro['puntosTemporal'], $idCatalogo);
                     
                    $productocatalogoEditar->setPuntosTemporal($puntos);
                    $productocatalogoEditar->setPrecioTemporal($pro['precioTemporal']);
                    $productocatalogoEditar->setCategoria($categoria);
                    $productocatalogoEditar->setIncrementoTemporal($pro['incrementoTemporal']);
                    $productocatalogoEditar->setLogisticaTemporal($pro['logisticaTemporal']);

			if(isset($pro["agotado"]) && $pro["agotado"]==1) $agotado = 1; else $agotado = 0;	
                    $productocatalogoEditar->setAgotado($agotado);

                    $productocatalogoEditar->setEstadoAprobacion(NULL);
                      
                    $em->persist($productocatalogoEditar);
                    
                    $productocatalogoH = $this->get('incentives_catalogo');
                    $productocatalogoH->historico($productocatalogoEditar);
                            
                    $em->flush();
                //probar el redirect en la verison 2.3 y hacer el ajsutepara la 2.7
                   return $this->redirect($this->generateUrl('productocatalogo_maestro'));

        }

        return $this->render('IncentivesCatalogoBundle:Maestro:editarpremio.html.twig', array(
                'form' => $form->createView(), 'id' => $productocatalogoEditar->getId(),
        ));
    }
    
    public function estadoPremioAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $premio = $em->getRepository('IncentivesCatalogoBundle:Productocatalogo')->find($id);

        if ($premio->getActivo()==1){
            $premio->setActivo(0);
            $premio->setEstadoAprobacion(NULL);
            $premio->setFechaInactivacion(new \DateTime("now"));
        }else{
            $premio->setActivo(1);
        }   
        $em->flush();
        
        return $this->redirect($this->generateUrl('producto_datos', array('id' => $premio->getProducto()->getId())));
    }

    public function estadoPremioMaestroAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $premio = $em->getRepository('IncentivesCatalogoBundle:Productocatalogo')->find($id);

        if ($premio->getActivo()==1){
            $premio->setActivo(0);
            $premio->setEstadoAprobacion(NULL);
            $premio->setFechaInactivacion(new \DateTime("now"));
        }else{
            $premio->setActivo(1);
        }   
        $em->flush();
        
        return $this->redirect($this->generateUrl('productocatalogo_maestro'));
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

        $productoCatalogo = $em->getRepository('IncentivesCatalogoBundle:Productocatalogo')->findBy(array('catalogos' => $id));

		foreach($productoCatalogo as $keyCat => $valueCat){
			
			//Puntos Aprobados
			$puntos = $this->calcularPuntos($valueCat->getPrecio(), $valueCat->getIncremento(), $valueCat->getLogistica(), 0, $id);
            		$valueCat->setPuntos($puntos);
                  
            		//Puntos por Aprobar
            		$puntosTemp = $this->calcularPuntos($valueCat->getPrecioTemporal(), $valueCat->getIncrementoTemporal(), $valueCat->getLogisticaTemporal(), 0, $id);
            		$valueCat->setPuntosTemporal($puntosTemp);
                  
            		$em->persist($valueCat);
            		$em->flush();
                
			/*echo $valueCat->getId()."<br>";
			echo $valueCat->getPrecio()."<br>";
			echo $valueCat->getLogistica()."<br>";
			echo $valueCat->getIncremento()."<br>";
			echo $puntos."<br><br>";*/
		}
        
        $this->get('session')->getFlashBag()->add('notice','Puntajes recalculados.');
        
        return $this->redirect($this->generateUrl('catalogo_datos').'/'.$id);
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
            $qb->select('pc','p','pe','c','cat','ac','ad','ao','acom');
            $qb->from('IncentivesCatalogoBundle:Productocatalogo','pc');
            $qb->leftJoin('pc.producto','p');
            $qb->leftJoin('pc.categoria','c');
            $qb->leftJoin('p.categoria','cat');
            $qb->leftJoin('p.estado','pe');
            $qb->leftJoin('pc.aproboCliente','ac');
            $qb->leftJoin('pc.aproboDirector','ad');
            $qb->leftJoin('pc.aproboOperaciones','ao');
            $qb->leftJoin('pc.aproboComercial','acom');
            $str_filtro = 'pc.catalogos = '.$id.' AND p.estado=1 AND pc.activo=1 AND pc.aproboDirector=1';   
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

                    if($value['activo'] == 1 && $value['producto']['estado']['id'] == 1) $estad = "1 - Activo"; else  $estad = "0 - Inactivo";
                    //echo "<pre>"; print_r($value); echo "</pre>"; exit;
                    if($value['aproboCliente']['id'] == 1 && $value['aproboComercial']['id'] ==1 && $value['aproboOperaciones']['id'] == 1 && $value['aproboDirector']['id'] == 1){
                        $aprobacion = "Aprobado"; 
                    } elseif($value['aproboCliente']['id'] == 2 || $value['aproboComercial']['id'] == 2 || $value['aproboOperaciones']['id'] == 2 || $value['aproboDirector']['id'] == 2) {
                        $aprobacion = "Rechazado";
                    }else{
                        $aprobacion = "Por Aprobar";
                    }  

                    //traer valores anteriores
                    $qb = $em->createQueryBuilder();
                    $qb->select('ph');
                    $qb->from('IncentivesCatalogoBundle:ProductocatalogoHistorico','ph');
                    $str_filtro = 'ph.productocatalogo = '.$value['id'];   
                    $qb->where($str_filtro);
                    $qb->orderBy('ph.id', 'DESC');
                    $productohistorico = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
                    
                    $precio = ($value['precioTemporal']/(1-($value['incrementoTemporal']/100)))+$value['logisticaTemporal'];
                    
                    $precioAnterior = "";
                    $puntosAnterior = "";
                    $cambio = "";
                    $variacion = "";
                    
                    //comparar con el registro inmediatamente anterior
                    if(isset($productohistorico[1])){
                        $anterior = $productohistorico[1];
                        
                        $precioAnterior = ($anterior['precio']/(1-($anterior['incremento']/100)))+$anterior['logistica'];
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
                            ->setCellValue('A'.$fil, $value['producto']['codInc'])
                            ->setCellValue('B'.$fil, $value['producto']['nombre'])
                            ->setCellValue('C'.$fil, $value['producto']['referencia'])
                            ->setCellValue('D'.$fil, $value['producto']['marca'])
                            ->setCellValue('E'.$fil, $value['producto']['descripcion'])
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

}


