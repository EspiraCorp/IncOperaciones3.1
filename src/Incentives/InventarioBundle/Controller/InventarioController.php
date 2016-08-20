<?php

namespace Incentives\InventarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\InventarioBundle\Entity\Planilla;
use Incentives\RedencionesBundle\Entity\GuiaEnvio;
use Incentives\OperacionesBundle\Entity\Excel;
use Incentives\InventarioBundle\Entity\Inventario;
use Incentives\InventarioBundle\Entity\InventarioGuia;
use Incentives\InventarioBundle\Entity\CostosLogistica;
use Incentives\InventarioBundle\Entity\Requisicionesenvios;
use Incentives\InventarioBundle\Form\Type\IngresoType;
use Incentives\InventarioBundle\Form\Type\SalidaType;
use Incentives\InventarioBundle\Form\Type\PlanillaType;
use Incentives\InventarioBundle\Form\Type\AgregarType;
use Incentives\InventarioBundle\Form\Type\CierreType;
use Incentives\InventarioBundle\Form\Type\CostosLogisticaType;
use Incentives\InventarioBundle\Form\Type\PlanillasGenerarType;
use Incentives\GarantiasBundle\Entity\Novedades;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Cell_DataValidation;
use PHPExcel_Style_Fill;

ini_set('max_execution_time', 500);

class InventarioController extends Controller
{
    /**
     * @Route("/inventario")
     * @Template()
     */
    public function listadoAction()
    {
        $em = $this->getDoctrine()->getManager();

        //unidades totales
        //unidades disponibles
        //ingresos por OC
        //ingresos manuales
        
        $query = $em->createQueryBuilder()
                    ->select('i inventario', 'pr producto','SUM(i.ingreso) ingresada','SUM(i.salio) salida')
                     ->addSelect('(SELECT COUNT(inv.id)
                            FROM IncentivesInventarioBundle:Inventario inv
                        LEFT JOIN inv.orden oc
                            WHERE inv.producto = i.producto AND ((inv.despacho IS NOT NULL OR inv.solicitud IS NOT NULL) AND (inv.salio IS NULL OR inv.salio=0)) GROUP BY inv.producto) AS asignada'
                        )
                ->addSelect('(SELECT COUNT(inven.id)
                            FROM IncentivesInventarioBundle:Inventario inven
                	    LEFT JOIN inven.orden oci
                            WHERE inven.producto = i.producto AND (inven.despacho IS NULL AND inven.solicitud IS NULL AND (inven.salio=0 OR inven.salio IS NULL)) GROUP BY inven.producto) AS disponible'
                        )
                    ->from('IncentivesInventarioBundle:Inventario', 'i')
                    ->Join('i.producto','pr')
                    ->groupBy('i.producto')
                    ->orderBy('i.producto', 'ASC');
        $productos = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        //echo "<pre>"; print_r($productos); exit;
        return $this->render('IncentivesInventarioBundle:Inventario:listado.html.twig', 
            array('productos' => $productos));
    }

    
    public function reporteAction()
    {    
                
            $fp = fopen('php://temp','r+');
            
            // Header
            $row = array('Id','Producto','Marca','Referencia','Descripcion','SKU','C. Ingreso','C. Salida','C. Asignada','C. Disponible');
            
            $em = $this->getDoctrine()->getManager();

            //unidades totales
            //unidades disponibles
            //ingresos por OC
            //ingresos manuales
            
            $query = $em->createQueryBuilder()
                    ->select('i inventario', 'pr.nombre nombre', 'pr.codInc codInc', 'pr.descripcion descripcion', 'pr.referencia referencia', 'pr.marca marca','pr.id idProducto', 'SUM(i.ingreso) ingresada','SUM(i.salio) salida')
                     ->addSelect('(SELECT COUNT(inv.id)
                            FROM IncentivesInventarioBundle:Inventario inv
                        LEFT JOIN inv.orden oc
                            WHERE inv.producto = i.producto AND (inv.despacho IS NOT NULL AND (inv.salio IS NULL OR inv.salio=0)) GROUP BY inv.producto) AS asignada'
                        )
                ->addSelect('(SELECT COUNT(inven.id)
                            FROM IncentivesInventarioBundle:Inventario inven
                	    LEFT JOIN inven.orden oci
                            WHERE inven.producto = i.producto AND (inven.despacho IS NULL AND (inven.salio=0 OR inven.salio IS NULL)) GROUP BY inven.producto) AS disponible'
                        )
                    ->from('IncentivesInventarioBundle:Inventario', 'i')
                    ->Join('i.producto','pr')
                    ->groupBy('i.producto')
                    ->orderBy('i.producto', 'ASC');
            $productos = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

			//echo "<pre>"; print_r($productos); echo "</pre>"; exit;
    			
            $ir = 0;
            foreach($productos as $key => $value){              
               
               if($ir==0){
				   
					fputcsv($fp,$row,';');
				}
               
                $ir++;
               
                $row = array();
				$row[] = $value['idProducto'];//1
				
    			$row[] = $value['nombre'];
    			$row[] = $value['marca'];
    			$row[] = $value['referencia'];
    			$row[] = $value['descripcion'];
    			$row[] = $value['codInc'];
    			
    			$row[] = 0 + $value['ingresada'];
    			$row[] = 0 + $value['salida'];
    			
    			$row[] = 0 + $value['asignada'];
    			$row[] = 0 + $value['disponible'];
				
						 
				fputcsv($fp,$row,';');
            }

			rewind($fp);
			$csv = stream_get_contents($fp);
			fclose($fp);
			
			$filename = 'Inventario.csv';
			$response = new Response($csv);
			
			$response->headers->set('Content-Type', "text/csv");
			$response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $filename));            
			
            return $response;
        
    }
     
    public function listadooldAction()
    {
        $em = $this->getDoctrine()->getManager();
        $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->findAll();
        $inventario= $em->getRepository('IncentivesInventarioBundle:Inventario')->findAll();
        $max=0;
        foreach ($producto as $key => $value) {
            $max=max($max, $value->getId());
        }
        $total=array_fill(0, $max+1, '0');
        $fechas=array_fill(0, ($max+1)*2, date_create('2000-01-01'));
        $orden=array_fill(0, $max+1, '0');
        $redencion=array_fill(0, $max+1, '0');
        foreach ($producto as $key1 => $value1) {
            foreach ($inventario as $key2 => $value2) {
                if ($value1==$value2->getProducto()){
                    if ($value2->getIngreso()==1 && $value2->getSalio()==0){
                        $total[$value2->getProducto()->getId()]=$total[$value2->getProducto()->getId()]+1;
                        $fechas[2*$value2->getProducto()->getId()]=$value2->getFechaEntrada();
                        if ($value2->getOrden()!=null){
                            $orden[$value1->getId()]=$value2->getOrden()->getId();
                        }
                    }elseif ($value2->getIngreso()==0 && $value2->getSalio()==1) {
                        $total[$value2->getProducto()->getId()]=$total[$value2->getProducto()->getId()]-1;
                        $fechas[2*$value2->getProducto()->getId()-1]=$value2->getFechaSalida();
                        if ($value2->getRedencion()!=null){
                            $redencion[$value1->getId()]=$value2->getRedencion()->getId();
                        }
                    }
                }
            }
        }
        
        return $this->render('IncentivesInventarioBundle:Inventario:listado.html.twig', 
            array('producto' => $producto, 'inventario' => $inventario, 'total' => $total, 'max' => $max,
                'fechas' => $fechas, 'orden' => $orden, 'redencion' => $redencion));
    }

    public function planillasAction()
    {
        $em = $this->getDoctrine()->getManager();
        $planillas = $em->getRepository('IncentivesInventarioBundle:Planilla')->findAll();
        
        return $this->render('IncentivesInventarioBundle:Inventario:planillas.html.twig', 
            array('planillas' => $planillas));
    }

    /**
     * @Route("/inventario/historico/{id}")
     * @Template()
     */
    public function historicoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($id);
        $inventario= $em->getRepository('IncentivesInventarioBundle:Inventario')->findByProducto($producto);
        
        return $this->render('IncentivesInventarioBundle:Inventario:historico.html.twig', 
            array('producto' => $producto, 'inventario' => $inventario));
    }

    public function planillaRedencionAction($fecha)
    {
        $em = $this->getDoctrine()->getManager();
        $inventario = $em->getRepository('IncentivesInventarioBundle:Inventario')->findBySalio("1");
        $estado = $em->getRepository('IncentivesInventarioBundle:PlanillaEstado')->find("1");
        $planillas= $em->getRepository('IncentivesInventarioBundle:Planilla')->findAll();
        $fechas=date_create($fecha);

        $arrayParametros = array();
        $qb = $em->createQueryBuilder();            
        $qb->select('i');
        $qb->from('IncentivesInventarioBundle:Inventario','i');
        $qb->leftJoin('i.redencion', 'r');
        $str_filtro = 'r.redencionestado = 4';
        $str_filtro .= ' AND (i.salio = 0 OR i.salio is NULL) AND i.planilla is NULL';
        $qb->where($str_filtro);

        $redenciones = $qb->getQuery()->getResult();

        $planilla = new Planilla();                
        $planilla->setFecha($fechas);
        $planilla->setPlanillaEstado($estado);
        $planilla->setConsecutivo(count($planillas)+1);
        $em->persist($planilla);

        $i=0;
        $redencion = array();
        foreach ($redenciones as $keyR => $valueR) {
            $redencion[$i] = $em->getRepository('IncentivesInventarioBundle:Inventario')->find($valueR->getId());
            $redencion[$i]->setPlanilla($planilla);
            
            $inventarioH = $this->get('incentives_inventario');
            $inventarioH->insertar($redencion[$i]);
                    
            $em->persist($redencion[$i]);
            $i++;
        }
        $em->flush();


        require_once($this->get('kernel')->getRootDir().'/config/dompdf_config.inc.php');
        $uploadDir=dirname($this->container->getParameter('kernel.root_dir')).'/web/Planillas/';
        
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Incentives SAS")
                                         ->setLastModifiedBy("Icentives SAS")
                                         ->setCategory("");

            $objPHPExcel->getActiveSheet()
                        ->setCellValue('A1','** Destinatario 1')
                        ->setCellValue('B1','** Destinatario 2')
                        ->setCellValue('C1','Dirección de despacho')
                        ->setCellValue('D1','** Ciudad')
                        ->setCellValue('E1','** Departamento')
                        ->setCellValue('F1','** Descripción del premio')
                        ->setCellValue('G1','Código del premio')
                        ->setCellValue('H1','** Cantidad')
                        ->setCellValue('I1','** Centro de costo')
                        ->setCellValue('J1','No. De Guía')
                        ->setCellValue('K1','Observaciones')
                        ->setCellValue('L1','** Teléfono de contacto')
                        ->setCellValue('M1','** Cedula ganador')
                        ->setCellValue('N1','ID Premio')
                        ->setCellValue('O1','ID ganador');

            $fil=2;
            /*foreach ($inventario as $key => $value) 
            {
                //if (($value->getFechaSalida() > $fechas) && ($value->getFechaSalida() < date_add($fechas, date_interval_create_from_date_string("1 day"))))
                //if ($value->getFechaSalida() > date_modify($fechas, '-1 day'))
                if ($value->getFechaSalida() >= $fechas and $value->getFechaSalida()<$fechas2)
                // if ($value->getFechaSalida()->format('Y-m-d') >= $fechas->format('Y-m-d'))
                {
                    //if ($value->getFechaSalida() < date_add($fechas, date_interval_create_from_date_string("1 day")))
                    {
                        $objPHPExcel->getActiveSheet()
                            ->setCellValue('A'.$fil, $value->getProducto()->getNombre())
                            ->setCellValue('B'.$fil, $value->getProducto()->getCodEAN())
                            ->setCellValue('C'.$fil, $value->getProducto()->getMarca())
                            ->setCellValue('D'.$fil, $value->getRedencion()->getProductocatalogo()->getCatalogos()->getPrograma()->getNombre())
                            ->setCellValue('E'.$fil, $value->getRedencion()->getId())
                            ->setCellValue('F'.$fil, $value->getRedencion()->getParticipante()->getNombre())
                            ->setCellValue('G'.$fil, $value->getRedencion()->getParticipante()->getTipodocumento()->getNombre()." ".$value->getRedencion()->getParticipante()->getDocumento())
                            ->setCellValue('H'.$fil, $value->getRedencion()->getParticipante()->getCiudad()->getNombre())
                            ->setCellValue('I'.$fil, $value->getRedencion()->getParticipante()->getDireccion());
                        $fil+=1;
                    }
                }
            }*/

            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
            //$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
            $objWriter->save("Planilla_".$fecha.".xlsx");  //send it to user, of course you can save it to disk also!
            
            
             // prepare BinaryFileResponse
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web/Planillas/';
            $filename = "Planilla_R".$fecha.".xlsx";
            $filePath = $basePath.$filename;


            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
            $uploadDir=dirname($this->container->getParameter('kernel.root_dir')).'/../web/Planillas/';
            file_put_contents($uploadDir."Planilla_R".$fecha.".xlsx", $response);


        //return $this->redirect($this->generateUrl('inventario_listado_planilla'));
    }

    public function planillaAction($fecha)
    {
        $em = $this->getDoctrine()->getManager();
        $inventario= $em->getRepository('IncentivesInventarioBundle:Inventario')->findBySalio("1");
        $estado= $em->getRepository('IncentivesInventarioBundle:PlanillaEstado')->find("1");
        $planillas= $em->getRepository('IncentivesInventarioBundle:Planilla')->findAll();
        $fechas=date_create($fecha);
        $i=0;

        foreach ($planillas as $key => $value) {
            if ($value->getFecha()==$fechas){
                $i++;
            }
        }
        
        if ($i==0){
            var_dump($i==0);
            $planilla = new Planilla();                
            $planilla->setFecha($fechas);
            $planilla->setPlanillaEstado($estado);
            $planilla->setConsecutivo(count($planillas)+1);

            $html= $this->render('IncentivesInventarioBundle:Inventario:planilla.html.twig', array(
                'inventario'=>$inventario, 'fecha'=>$fecha
            ));

            /*require_once($this->get('kernel')->getRootDir().'/config/dompdf_config.inc.php');
            $uploadDir=dirname($this->container->getParameter('kernel.root_dir')).'/web/bundles/OperacionesBundle/Planillas/';
            
            $dompdf = new \DOMPDF();
            $dompdf->load_html(utf8_decode($html));
            $dompdf->render();
            $pdf = $dompdf->output();
            file_put_contents($uploadDir."Planilla_".$fecha.".pdf", $pdf);
            $planilla->setRuta($uploadDir."Planilla_".$fecha.".pdf");*/ 
            $em->persist($planilla);
            $em->flush();
        }else{
            $this->get('session')->getFlashBag()->add('notice', 'La planilla para la fecha indicada ya se encuentra creada.');
        }

        return $this->redirect($this->generateUrl('inventario_listado_planilla'));
    }

    public function listadoPlanillaAction()
    {
        $em = $this->getDoctrine()->getManager();

        $planillas = $em->getRepository('IncentivesInventarioBundle:Planilla')->findAll();
        $primera=date_create("now");
        $ultima=date_create('2000-01-01');
        foreach ($planillas as $key => $value) {
            $diff=date_diff($value->getFecha(), date_create("now"))->format('%R%a');
            if ($value->getFecha()>$ultima){
                $ultima=$value->getFecha();
            }
            if ($value->getFecha()<$primera){
                $primera=$value->getFecha();
            }
            $diff2=date_diff($primera, date_create("now"))->format('%R%a');
        }

        return $this->render('IncentivesInventarioBundle:Inventario:listadoPlanilla.html.twig', 
            array('planillas' => $planillas, 'diff' => $diff, 'ultima' => $ultima, 'primera' => $primera, 'diff2' => $diff2));
    }

    public function estadoPlanillaAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $planilla = $em->getRepository('IncentivesInventarioBundle:Planilla')->find($id);
        $estado = $em->getRepository('IncentivesInventarioBundle:PlanillaEstado')->find("2");

        if($planilla->getSolicitud() != Null){
            $this->correoDespachoAction($planilla->getSolicitud()->getId());
        }

        $planilla->setPlanillaEstado($estado);
        $em->flush();
        return $this->redirect($this->generateUrl('planillas_lista'));
    }

    public function planillaexportarAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $inventario= $em->getRepository('IncentivesInventarioBundle:Inventario')->findBySalio("1");
        $estado= $em->getRepository('IncentivesInventarioBundle:PlanillaEstado')->find("1");
        $planillas= $em->getRepository('IncentivesInventarioBundle:Planilla')->findAll();
        //$fechas=date_sub(date_create($fecha), date_interval_create_from_date_string('2 days'));
        $fechas=date_create("now");
        $fechas2=date_modify(date_create($fecha), '+1 day');
        // var_dump($fechas);
        // echo("<br>");
        // var_dump(date_modify($fechas, '+1 day'));
        $i=0;
        // foreach ($planillas as $key => $value) {
        //     if ($value->getFecha()!=$fechas){
        //         $i++;
        //     }
        // }
        if ($i==0){
            $planilla = new Planilla();                
            $planilla->setFecha($fechas);
            $planilla->setPlanillaEstado($estado);
            $planilla->setConsecutivo(count($planillas)+1);

            require_once($this->get('kernel')->getRootDir().'/config/dompdf_config.inc.php');
            $uploadDir=dirname($this->container->getParameter('kernel.root_dir')).'/web/Planillas/';
            
            // $dompdf = new \DOMPDF();
            // $dompdf->load_html(utf8_decode($html));
            // $dompdf->render();
            // $pdf = $dompdf->output();
            // file_put_contents($uploadDir."Planilla_".$fecha.".pdf", $pdf);

            // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();

            // Set document properties
            $objPHPExcel->getProperties()->setCreator("Sinaptica bIT")
                                         ->setLastModifiedBy("Sinaptica bIT")
                                         ->setCategory("");

            $objPHPExcel->getActiveSheet()
                        ->setCellValue('A1','Producto')
                        ->setCellValue('B1','Codigo EAN')
                        ->setCellValue('C1','Marca')
                        ->setCellValue('D1','Programa')
                        ->setCellValue('E1','Redencion')
                        ->setCellValue('F1','Participante')
                        ->setCellValue('G1','Documento')
                        ->setCellValue('H1','Ciudad')
                        ->setCellValue('I1','Direccion')
                        ->setCellValue('J1','Guia')
                        ->setCellValue('K1','Valor')
                        ->setCellValue('L1','Operador')
                        /*->setCellValue('L1', $fechas->format('Y-m-d h:i:s'))
                        ->setCellValue('M1', $fechas2->format('Y-m-d h:i:s'))*/;

            $fil=2;
            $conn = $this->get('database_connection');

            foreach ($inventario as $key => $value) 
            {
                //if (($value->getFechaSalida() > $fechas) && ($value->getFechaSalida() < date_add($fechas, date_interval_create_from_date_string("1 day"))))
                //if ($value->getFechaSalida() > date_modify($fechas, '-1 day'))
                if ($value->getFechaSalida() >= $fechas and $value->getFechaSalida()<$fechas2)
                // if ($value->getFechaSalida()->format('Y-m-d') >= $fechas->format('Y-m-d'))
                {
                    //if ($value->getFechaSalida() < date_add($fechas, date_interval_create_from_date_string("1 day")))
                    {
                        $objPHPExcel->getActiveSheet()
                            ->setCellValue('A'.$fil, $value->getProducto()->getNombre())
                            ->setCellValue('B'.$fil, $value->getProducto()->getCodEAN())
                            ->setCellValue('C'.$fil, $value->getProducto()->getMarca())
                            ->setCellValue('D'.$fil, $value->getRedencion()->getProductocatalogo()->getCatalogos()->getPrograma()->getNombre())
                            ->setCellValue('E'.$fil, $value->getRedencion()->getId())
                            ->setCellValue('F'.$fil, $value->getRedencion()->getParticipante()->getNombre())
                            ->setCellValue('G'.$fil, $value->getRedencion()->getParticipante()->getTipodocumento()->getNombre()." ".$value->getRedencion()->getParticipante()->getDocumento())
                            ->setCellValue('H'.$fil, $value->getRedencion()->getParticipante()->getCiudad()->getNombre())
                            ->setCellValue('I'.$fil, $value->getRedencion()->getParticipante()->getDireccion());
                        $fil+=1;
                    }
                }
            }

            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
            //$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
            $objWriter->save("Planilla_".$fecha.".xlsx");  //send it to user, of course you can save it to disk also!
            
            
             // prepare BinaryFileResponse
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web/Planillas/';
            $filename = "Planilla_".$fecha.".xlsx";
            $filePath = $basePath.'/'.$filename; 
             
            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
            $uploadDir=dirname($this->container->getParameter('kernel.root_dir')).'/web/Planillas/';
            file_put_contents($uploadDir."Planilla_".$fecha.".xlsx", $response);
            $planilla->setRuta($uploadDir."Planilla_".$fecha.".xlsx");

            return $response;
        }
    }


    public function importarAction(Request $request)
    {
        $excelForm = new Excel();
        $form = $this->createFormBuilder($excelForm)
            ->setAction($this->generateUrl('inventario_importar_planilla'))
            ->setMethod('POST')
            ->add('excel', 'file')
            ->add('cargar', 'submit')
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->bind($request);

            $excel = $form['excel']->getData();

            $objPHPExcel = PHPExcel_IOFactory::load($excel);
            $sheetData = $objPHPExcel->getSheet()->toArray(null,true,true,true);

            $worksheet  = $objPHPExcel->setActiveSheetIndex('0');
            $em = $this->getDoctrine()->getManager();


            $fila=1;
            foreach ($sheetData as $row) {
                if($fila > 1 && $row['Y']!="" && $row['O']!=""){
                    //$courier= $em->getRepository('IncentivesInventarioBundle:Courier')->find("1");
                    $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($row['Y']);
                    //$inventario = $em->getRepository('IncentivesInventarioBundle:Inventario')->findByRedencion($redencion->getId());

                    $qb = $em->createQueryBuilder();            
                    $qb->select('i');
                    $qb->from('IncentivesInventarioBundle:Inventario','i');
                    $str_filtro = 'i.redencion = '.$redencion->getId();
                    $qb->where($str_filtro);
                    $qb->setMaxResults(1);
                    $inventario = $qb->getQuery()->getOneOrNullResult();

                    if(!isset($inventario)){
                        
                        $this->get('session')->getFlashBag()->add('warning', 'No se encontro inventario asociado a la redencin: '.$row['Y']);
                    }else{
                        
                        //Determinar si la guia ya existe
                        $qb = $em->createQueryBuilder();            
                        $qb->select('g');
                        $qb->from('IncentivesRedencionesBundle:GuiaEnvio','g');
                        $str_filtro = "g.guia LIKE '".$row['O']."' ";
                        $qb->where($str_filtro);
                        $qb->setMaxResults(1);
                        $guia = $qb->getQuery()->getOneOrNullResult();
    
                        if(!isset($guia) || $guia==Null){
                            //Si no existe guardar la guia nueva y la relacion con la redencion
                            $guia= new GuiaEnvio();
                            $guia->setOrdenProducto($redencion->getOrdenesProducto());
                            $guia->setGuia($row['O']);
                            $guia->setOperador($row['W']);
                            $guia->setEstado("1");
                            $guia->setFecha($row['AA']);
                            $guia->setValor($row['X']);
                            //$guia->setInventario($inventario);
                            //$guia->setCourier($courier);                        
                        }
                        
                        //Si existe guardar la relacion con la redencion
                        $inventarioguia = new InventarioGuia();
                        $inventarioguia->setGuia($guia);
                        $inventarioguia->setInventario($inventario);
                        $estado = $em->getRepository('IncentivesInventarioBundle:CierreEstado')->find('1');
                        $inventarioguia->setCierreEstado($estado);
    
    		            $inventario->setSalio("1");
        		        $inventario->setFechaSalida(new \DateTime());
    
                        $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('5');
                        $redencion->setfechaEntrega($row['AA']);
                        $redencion->setRedencionestado($estado);
    
                        $em->persist($redencion);
                        $em->persist($guia);
                        $em->persist($inventarioguia);
                        $em->persist($inventario);
                        $em->flush();    
                            
                    }

                    
                }
                $fila=$fila+1;
            }

             $this->get('session')->getFlashBag()->add('notice', 'Las guías se cargaron de forma exitosa.');
        }

    

        return $this->render('IncentivesInventarioBundle:Inventario:importar.html.twig', array(
            'form' => $form->createView(),));

    }


    public function generarplanillaAction()
    {
        $em = $this->getDoctrine()->getManager();
        $inventario = $em->getRepository('IncentivesInventarioBundle:Inventario')->findBySalio("1");
        $estado = $em->getRepository('IncentivesInventarioBundle:PlanillaEstado')->find("1");
        $planillas= $em->getRepository('IncentivesInventarioBundle:Planilla')->findAll();
        $fecha = date_create()->format('Y-m-d');

        $arrayParametros = array();
        $qb = $em->createQueryBuilder();            
        $qb->select('i');
        $qb->from('IncentivesInventarioBundle:Inventario','i');
        $qb->Join('i.redencion', 'r', 'WITH', 'r.redencionestado = 4');
        //$str_filtro = 'r.redencionestado = 4';
        $str_filtro = ' (i.salio = 0 OR i.salio is NULL) AND i.planilla is NULL';
        $qb->where($str_filtro);

        $redenciones = $qb->getQuery()->getResult();

        if(count($redenciones)>0){            

        $planilla = new Planilla();                
        $planilla->setFecha(new \DateTime($fecha));
        $planilla->setPlanillaEstado($estado);
        $planilla->setConsecutivo(count($planillas)+1);
        $em->persist($planilla);

        $i=0;
        $redencion = array();
        foreach ($redenciones as $keyR => $valueR) {

		$redencion[$i] = $em->getRepository('IncentivesInventarioBundle:Inventario')->find($valueR->getId());
		
		/*if($redencion[$i]->getRedencion() != Null){ 
			
		    $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('5');
		    $redencionI = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($redencion[$i]->getRedencion()->getId());
		    $redencionI->setRedencionestado($estado);
		    $em->persist($redencionI);

		    //Historico redenciones
		    $redencionH = $this->get('incentives_redenciones');
		    $redencionH->insertar($redencionI);
			

		}*/

		$redencion[$i]->setPlanilla($planilla);
		$em->persist($redencion[$i]);

		$i++; 
        }

        $em->flush();
	
        $inventario = $em->getRepository('IncentivesInventarioBundle:Inventario')->findByPlanilla($planilla->getId());

        require_once($this->get('kernel')->getRootDir().'/config/dompdf_config.inc.php');
        $uploadDir=dirname($this->container->getParameter('kernel.root_dir')).'/web/Planillas';
        
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Incentives SAS")
                                         ->setLastModifiedBy("Icentives SAS")
                                         ->setCategory("");
          
        $objPHPExcel->getActiveSheet()
                        ->setCellValue('A1','** Destinatario 1')
                        ->setCellValue('B1','** Destinatario 2')
                        ->setCellValue('C1','No. De despacho')
                        ->setCellValue('D1','Dirección de despacho')
                        ->setCellValue('E1','**Barrio')
                        ->setCellValue('F1','** Ciudad')
                        ->setCellValue('G1','** Departamento')
                        ->setCellValue('H1','Valor declarado')
                        ->setCellValue('I1','** Descripción del premio')
                        ->setCellValue('J1','Código del premio')
                        ->setCellValue('K1','Categoria')
                        ->setCellValue('L1','** Cantidad')
                        ->setCellValue('M1','** Centro de costo')
                        ->setCellValue('N1','CTA')
                        ->setCellValue('O1','No. De Guía')
                        ->setCellValue('P1','Observaciones')
                        ->setCellValue('Q1','Telefono Contacto')
                        ->setCellValue('R1','** Cedula ganador')
                        ->setCellValue('S1','ID Premio')
                        ->setCellValue('T1','ID ganador')
                        ->setCellValue('U1','Codigo redención')
                        ->setCellValue('V1','Orden de Compra')
			->setCellValue('W1','Operador Logistico')
                        ->setCellValue('X1','Valor Guia')
			->setCellValue('Y1','Id Redencion')
            ->setCellValue('Z1','Fecha Despacho');

            $fil=2;
            foreach ($inventario as $key => $value) 
            {

                    {
                        $objPHPExcel->getActiveSheet()
			                ->setCellValue('F'.$fil, $value->getProducto()->getMarca()." - ".$value->getProducto()->getNombre())
                            ->setCellValue('G'.$fil, $value->getProducto()->getCodEAN())
                            ->setCellValue('H'.$fil, 1)
                            ->setCellValue('J'.$fil, "")
                            ->setCellValue('K'.$fil, "")
                            ->setCellValue('L'.$fil, "");

			
			if($value->getRedencion() != Null){

				$datosEnvio = $value->getRedencion()->getRedencionesenvios();

				$objPHPExcel->getActiveSheet()
                    ->setCellValue('A'.$fil, $value->getRedencion()->getParticipante()->getNombre())
					->setCellValue('B'.$fil, $value->getRedencion()->getParticipante()->getNombre())
					
                    ->setCellValue('D'.$fil, $datosEnvio[0]->getDireccion())
					->setCellValue('E'.$fil, $datosEnvio[0]->getBarrio())
					->setCellValue('F'.$fil, $datosEnvio[0]->getCiudadNombre())
					->setCellValue('G'.$fil, $datosEnvio[0]->getDepartamentoNombre())
					
					->setCellValue('I'.$fil, $value->getProducto()->getNombre())
					->setCellValue('J'.$fil, $value->getProducto()->getCodinc())
					->setCellValue('K'.$fil, $value->getProducto()->getCategoria()->getNombre())
					->setCellValue('L'.$fil, 1)
					->setCellValue('M'.$fil, $value->getRedencion()->getParticipante()->getPrograma()->getCentrocostos())
					->setCellValue('N'.$fil, $value->getRedencion()->getParticipante()->getPrograma()->getNombre())//Programa
					
					->setCellValue('P'.$fil, "")
					
					->setCellValue('Q'.$fil, $datosEnvio[0]->getTelefono())
					->setCellValue('R'.$fil, $value->getRedencion()->getParticipante()->getDocumento())
					
					->setCellValue('S'.$fil, $value->getCodigo())
					->setCellValue('T'.$fil, $value->getRedencion()->getParticipante()->getId())
					->setCellValue('U'.$fil, $value->getRedencion()->getCodigoredencion());


				if($value->getRedencion()->getOrdenesProducto() != Null){
    				$objPHPExcel->getActiveSheet()
    				            ->setCellValue('H'.$fil, $value->getRedencion()->getOrdenesProducto()->getValorunidad())
    				            ->setCellValue('V'.$fil, $value->getRedencion()->getOrdenesProducto()->getOrdenesCompra()->getConsecutivo());
				}

				if($value->getRedencion() != Null){
					$objPHPExcel->getActiveSheet()
						    ->setCellValue('Y'.$fil, $value->getRedencion()->getId());
				}

                $objPHPExcel->getActiveSheet()
                            ->setCellValue('Z'.$fil, $planilla->getFecha()->format("Y-m-d"));
				
			}elseif($value->getOrden() != Null ){
				$objPHPExcel->getActiveSheet()
					->setCellValue('V'.$fil, $value->getOrden()->getConsecutivo());
			}
                        $fil+=1;
                    }
            }


            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
            $objWriter->save('Planilla_'.$planilla->getId().'.xlsx');  //send it to user, of course you can save it to disk also!
             // prepare BinaryFileResponse
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web/Planillas';
            $filename = 'Planilla_'.$planilla->getId().'.xlsx';
            $filePath = $basePath.'/'.$filename;
            $objWriter->save($filePath);  //send it to user, of course you can save it to disk also!
             
            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));

            $planilla->setRuta($filename);
            $em->persist($planilla);
            $em->flush();
        }else{
            $this->get('session')->getFlashBag()->add('notice', 'No hay productos para despachar');
        }

            return $this->redirect($this->generateUrl('planillas_lista'));

    }
    
    
    public function planillarequisicion_oldAction(Request $request, $arreglo){
        
        $em = $this->getDoctrine()->getManager();
        
        if (isset($arreglo)) {
            //arreglo de inventario para planilla
            
            $estado = $em->getRepository('IncentivesInventarioBundle:PlanillaEstado')->find("1");
            $planillas= $em->getRepository('IncentivesInventarioBundle:Planilla')->findAll();
            
            $planilla = new Planilla();                
            $planilla->setFecha(new \DateTime());
            $planilla->setPlanillaEstado($estado);
            $planilla->setConsecutivo(count($planillas)+1);
            $em->persist($planilla);

            $arreglo = explode(",", $arreglo); 
            print_r($arreglo);
            $inventarioI = array();
            
            foreach ($arreglo as $key => $value) {
                
                $inventarioI[$value] = $em->getRepository('IncentivesInventarioBundle:Inventario')->find($value);
                if ($value!=""){
                    $inventarioI[$value]->setPlanilla($planilla);
                    $em->persist($inventarioI[$value]);
                }
            }
            
            $em->flush();

            $inventario = $em->getRepository('IncentivesInventarioBundle:Inventario')->findByPlanilla($planilla->getId());

            require_once($this->get('kernel')->getRootDir().'/config/dompdf_config.inc.php');
            $uploadDir=dirname($this->container->getParameter('kernel.root_dir')).'/web/Planillas';
            
            // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();
            // Set document properties
            $objPHPExcel->getProperties()->setCreator("Incentives SAS")
                                             ->setLastModifiedBy("Icentives SAS")
                                             ->setCategory("");
    
                $objPHPExcel->getActiveSheet()
                            ->setCellValue('A1','** Destinatario 1')
                            ->setCellValue('B1','** Destinatario 2')
                            ->setCellValue('C1','Dirección de despacho')
                            ->setCellValue('D1','** Ciudad')
                            ->setCellValue('E1','** Departamento')
                            ->setCellValue('F1','** Descripción del premio')
                            ->setCellValue('G1','Código del premio')
                            ->setCellValue('H1','** Cantidad')
                            ->setCellValue('I1','** Centro de costo')
                            ->setCellValue('J1','No. De Guía')
                            ->setCellValue('K1','Valor')
                            ->setCellValue('L1','Operador')
                            ->setCellValue('M1','** Teléfono de contacto')
                            ->setCellValue('N1','** Cedula ganador')
                            ->setCellValue('O1','ID Premio')
                            ->setCellValue('P1','ID ganador')
                            ->setCellValue('Q1','Orden de Compra')
                            ->setCellValue('R1','Redencion')
                            ->setCellValue('S1','Valor Compra')
    			            ->setCellValue('T1','Nombre Contacto')
    			            ->setCellValue('U1','Documento Contacto')
    			            ->setCellValue('W1','Direccion Contacto')
    			            ->setCellValue('V1','Telefono Contacto');
    
                $fil=2;
                foreach ($inventario as $key => $value) 
                {
    
                        {
                            $objPHPExcel->getActiveSheet()
    			                ->setCellValue('F'.$fil, $value->getProducto()->getMarca()." - ".$value->getProducto()->getNombre())
                                ->setCellValue('G'.$fil, $value->getProducto()->getCodEAN())
                                ->setCellValue('H'.$fil, 1)
                                ->setCellValue('J'.$fil, "")
                                ->setCellValue('K'.$fil, "")
                                ->setCellValue('L'.$fil, "");
    
    			
    			if($value->getRedencion() != Null){
    
    				$datosEnvio = $value->getRedencion()->getRedencionesenvios();
    
    				$objPHPExcel->getActiveSheet()
    					->setCellValue('A'.$fil, $value->getRedencion()->getParticipante()->getNombre())
    					->setCellValue('C'.$fil, $value->getRedencion()->getParticipante()->getDireccion())
    					->setCellValue('D'.$fil, $value->getRedencion()->getParticipante()->getCiudadNombre())
    					->setCellValue('E'.$fil, $value->getRedencion()->getParticipante()->getDireccion())
    					->setCellValue('I'.$fil, $value->getRedencion()->getParticipante()->getPrograma()->getCentrocostos())
    					->setCellValue('M'.$fil, $value->getRedencion()->getParticipante()->getTelefono())
    					->setCellValue('N'.$fil, $value->getRedencion()->getParticipante()->getDocumento())
    					->setCellValue('P'.$fil, $value->getRedencion()->getParticipante()->getId())
    		            ->setCellValue('O'.$fil, $value->getCodigo())
    		            ->setCellValue('R'.$fil, $value->getRedencion()->getId())
    					->setCellValue('T'.$fil, $datosEnvio[0]->getNombreContacto())
    					->setCellValue('U'.$fil, $datosEnvio[0]->getDocumentoContacto())
    					->setCellValue('V'.$fil, $datosEnvio[0]->getDireccionContacto())
    					->setCellValue('W'.$fil, $datosEnvio[0]->getTelefonoContacto());
    				
    				if($value->getRedencion()->getOrdenesProducto() != Null){
        				$objPHPExcel->getActiveSheet()
        				            ->setCellValue('S'.$fil, $value->getRedencion()->getOrdenesProducto()->getValorunidad())
        				            ->setCellValue('Q'.$fil, $value->getRedencion()->getOrdenesProducto()->getOrdenesCompra()->getConsecutivo());
    				}
    				
    			}elseif($value->getOrden() != Null ){
    				$objPHPExcel->getActiveSheet()
    					->setCellValue('Q'.$fil, $value->getOrden()->getConsecutivo());
    			}
                            $fil+=1;
                        }
                }
    
    
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
                $objWriter->save('Planilla_'.$planilla->getId().'.xlsx');  //send it to user, of course you can save it to disk also!
                 // prepare BinaryFileResponse
                $basePath = $this->container->getParameter('kernel.root_dir').'/../web/Planillas';
                $filename = 'Planilla_'.$planilla->getId().'.xlsx';
                $filePath = $basePath.'/'.$filename;
                $objWriter->save($filePath);  //send it to user, of course you can save it to disk also!
                 
                $response = new BinaryFileResponse($filePath);
                $response->trustXSendfileTypeHeader();
                $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
    
                $planilla->setRuta($filename);
                $em->persist($planilla);
                $em->flush();
            
                $this->get('session')->getFlashBag()->add('notice', 'La planilla se genero exitosamente');
            
                return $this->redirect($this->generateUrl('planillas_lista'));
        }

        $arrayParametros = array();
        $qb = $em->createQueryBuilder();            
        $qb->select('count(i) total','i inventario', 'oc orden', 'p planilla', 'pr producto');
        $qb->from('IncentivesInventarioBundle:Inventario','i');
        $qb->leftJoin('i.orden','oc');
        $qb->leftJoin('i.planilla','p');
        $qb->leftJoin('i.producto','pr');
        $str_filtro = ' (i.salio = 0 OR i.salio is NULL) AND i.redencion is NULL AND i.planilla is NULL';
        $qb->groupBy('pr.id','oc.id');
        $qb->where($str_filtro);

        $inventario = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $this->render('IncentivesInventarioBundle:Inventario:planillarequisicion.html.twig', 
            array('inventario' => $inventario));

    }


	public function programasAction()
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

        return $this->render('IncentivesInventarioBundle:Inventario:programas.html.twig', 
            array('listado' => $listado, 'programa' => $programa, 'redencion' => $redencion, 'fechas' => $fechas));
    }

    public function redencionesAction($programa)
    {
        $em = $this->getDoctrine()->getManager();

        $programas = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($programa);
        if ($programas!=null){
            $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->findByPrograma($programas);
        }else{
            $catalogo=null;
        }
        if ($catalogo!=null){
            $productos = $em->getRepository('IncentivesCatalogoBundle:Productocatalogo')->findByCatalogos($catalogo);
        }else{
            $productos=null;
        }
        if ($productos!=null){
            $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->findByProductocatalogo($productos);
        }else{
            $redencion=null;
        }

        return $this->render('IncentivesInventarioBundle:Inventario:redenciones.html.twig', 
            array( 'programa' => $programas, 'redencion' => $redencion));
    }
    
    public function ingresoAction(Request $request, $id){
        
        $em = $this->getDoctrine()->getManager();
        
        $form = $this->createForm (new IngresoType());
        
        if ($request->isMethod('POST')) {
            $form->bind($request);
            $pro=($this->get('request')->request->get('inventario'));
            
            for($ic=1; $ic<=$pro['cantidad']; $ic++){
        
                $inventario = new Inventario();
           
                $inventario->setFechaEntrada(new \DateTime());
                $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($pro['producto']);
                $inventario->setProducto($producto);
                $inventario->setIngreso(1);
                $inventario->setValorCompra($pro['valorCompra']);
                $inventario->setObservacion($pro['observacion']);
                $em->persist($inventario);
                
                $inventarioH = $this->get('incentives_inventario');
                $inventarioH->insertar($inventario);
                
                $em->flush();
                
            }
            
            $this->get('session')->getFlashBag()->add('notice', 'El producto ingreso corretamente.');
            
        }

        return $this->render('IncentivesInventarioBundle:Inventario:ingreso.html.twig', 
            array('form' => $form->createView()));
        
    }
    
    
    public function listadosalidaAction(Request $request, $arreglo){
        
        $em = $this->getDoctrine()->getManager();
        
        if (isset($arreglo)) {
            $arreglo = explode(",", $arreglo); 
            
            foreach ($arreglo as $key => $value) {
                
                $inventario = $em->getRepository('IncentivesInventarioBundle:Inventario')->find($value);
                if ($value!=""){
                    $inventario->setFechaSalida(new \DateTime());
                    $inventario->setSalio(1);
                    $em->persist($inventario);
                    
                    $inventarioH = $this->get('incentives_inventario');
                    $inventarioH->insertar($inventario);
            
                    $em->flush();
                }
            }
            
            $this->get('session')->getFlashBag()->add('notice', 'La salida de productos fue exitosa');
        }

        $session = $this->get('session');
        
        if($pro=($this->get('request')->request->get('inventario'))){
            $page = 1;
            $session->set('filtros_salida', $pro);
        }
        
        $sqlFiltro = "";

            if($filtros = $session->get('filtros_salida')){
               foreach($filtros as $Filtro => $valueF){
                   
                   if($valueF!=""){
                       if($Filtro=="codigo"){
                            $sqlFiltro .= " AND i.codigo=".$valueF."";
                       }elseif($Filtro=="ordenCompra"){
                            $sqlFiltro .= " AND oc.consecutivo LIKE '%".$valueF."%'";
                       }elseif($Filtro=="fechaEntrada"){
                            $sqlFiltro .= " AND i.fechaEntrada LIKE '%".$valueF."%'";
                       }elseif($Filtro=="observacion"){
                            $sqlFiltro .= " AND i.observacion LIKE '%".$valueF."%'";
                       }else{
                            $sqlFiltro .= " AND pr.".$Filtro." LIKE '%".$valueF."%'";
                       }
                       
                   }
               } 
                
            }

        $arrayParametros = array();
        $qb = $em->createQueryBuilder();            
        $qb->select('i inventario', 'oc orden', 'p planilla', 'pr producto');
        $qb->from('IncentivesInventarioBundle:Inventario','i');
        $qb->leftJoin('i.orden','oc');
        $qb->leftJoin('i.planilla','p');
        $qb->leftJoin('i.producto','pr');
        $str_filtro = ' (i.salio = 0 OR i.salio is NULL) AND i.planilla is NULL AND i.redencion is NULL '.$sqlFiltro;
        $qb->where($str_filtro);
        
        $listado = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        //echo "<pre>"; print_r($listado); echo "</pre>"; exit;
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $listado,
            $this->get('request')->query->get('page', 1)/*page number*/,
            50 /*limit per page*/
        );
        
        return $this->render('IncentivesInventarioBundle:Inventario:listadosalida.html.twig', 
            array('listado' => $pagination));
        
    }
    
    
    public function salidaAction(Request $request, $id){
        
        $em = $this->getDoctrine()->getManager();
        
        $inventario = $em->getRepository('IncentivesInventarioBundle:Inventario')->find($id);
        $redencionI = null;
        if($inventario->getRedencion() != Null) $redencionI = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($inventario->getRedencion()->getId());
        
        $form = $this->createForm (new SalidaType(), $inventario);
        
        if ($request->isMethod('POST')) {
            $form->bind($request);
            $pro=($this->get('request')->request->get('inventario'));
            
            $inventario->setFechaSalida(new \DateTime());
            if(isset($pro['salio'])) $inventario->setSalio($pro['salio']);
            $inventario->setObservacion($pro['observacion']);
            $em->persist($inventario);
            
            $inventarioH = $this->get('incentives_inventario');
            $inventarioH->insertar($inventario);
            
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('notice', 'La salida de productos fue exitosa');
            
        }
        //Almacenar salida de inventario

        //Cambiar estado a redencion
        
        return $this->render('IncentivesInventarioBundle:Inventario:salida.html.twig', 
            array('inventario' => $inventario, 'redencion' => $redencionI, 'form' => $form->createView()));
        
    }


    public function actualizarplanillaAction($id, $descargar = 0)
    {
        $em = $this->getDoctrine()->getManager();
	
        $planilla = $em->getRepository('IncentivesInventarioBundle:Planilla')->find($id);

        $arrayParametros = array();
        $qb = $em->createQueryBuilder();            
        $qb->select('d', 'oc orden', 'p planilla', 'pr producto', 'r', 'pt', 'c', 'pg','op','dg','g');
        $qb->from('IncentivesInventarioBundle:Despachos','d');
        $qb->leftJoin('d.planilla','p');
        $qb->leftJoin('d.producto','pr');
        $qb->leftJoin('pr.categoria','c');
        $qb->leftJoin('d.redencion','r');
        $qb->leftJoin('d.despachoguia','dg');
        $qb->leftJoin('dg.guia','g');
        $qb->leftJoin('r.participante','pt');
        $qb->leftJoin('pt.programa','pg');
        $qb->leftJoin('d.ordenproducto','op');
        $qb->leftJoin('op.ordenesCompra','oc');
        $str_filtro = ' d.planilla='.$id;
        $qb->where($str_filtro);
        $despachos = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        //echo "<pre>"; print_r($despachos); echo "</pre>"; exit;
        require_once($this->get('kernel')->getRootDir().'/config/dompdf_config.inc.php');
        $uploadDir=dirname($this->container->getParameter('kernel.root_dir')).'/web/Planillas';
        
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Incentives SAS")
                                         ->setLastModifiedBy("Incentives SAS")
                                         ->setCategory("");

			            
	        $objPHPExcel->getActiveSheet()
                        ->setCellValue('A1','** Destinatario 1')
                        ->setCellValue('B1','** Destinatario 2')
                        ->setCellValue('C1','No. De despacho')
                        ->setCellValue('D1','Dirección de despacho')
                        ->setCellValue('E1','**Barrio')
                        ->setCellValue('F1','** Ciudad')
                        ->setCellValue('G1','** Departamento')
                        ->setCellValue('H1','Valor declarado')
                        ->setCellValue('I1','** Descripción del premio')
                        ->setCellValue('J1','Código del premio')
                        ->setCellValue('K1','Categoria')
                        ->setCellValue('L1','** Cantidad')
                        ->setCellValue('M1','** Centro de costo')
                        ->setCellValue('N1','CTA')
                        ->setCellValue('O1','No. De Guía')
                        ->setCellValue('P1','Observaciones')
                        ->setCellValue('Q1','Telefono Contacto')
                        ->setCellValue('R1','** Cedula ganador')
                        ->setCellValue('S1','ID Premio')
                        ->setCellValue('T1','ID ganador')
                        ->setCellValue('U1','Codigo redención')
                        ->setCellValue('V1','Orden de Compra')
                        ->setCellValue('W1','Operador Logistico')
                        ->setCellValue('X1','Valor Guia')
                        ->setCellValue('Y1','Id Redencion')
                        ->setCellValue('Z1','Fecha Despacho')
                        ->setCellValue('AA1','Fecha Entrega')
                        ->setCellValue('AB1','Guias Anteriores')
                        ->setCellValue('AC1','Id Inventario');

            $fil=2;
            foreach ($despachos as $key => $value) 
            {

            				$objPHPExcel->getActiveSheet()
                                ->setCellValue('A'.$fil, $value['redencion']['participante']['nombre'])
            					->setCellValue('I'.$fil, $value['producto']['nombre'])
            					->setCellValue('J'.$fil, $value['producto']['codInc'])
            					->setCellValue('K'.$fil, $value['producto']['categoria']['nombre'])
            					->setCellValue('L'.$fil, $value['cantidad'])
            					->setCellValue('M'.$fil, $value['redencion']['participante']['programa']['centrocostos'])
            					->setCellValue('N'.$fil, $value['redencion']['participante']['programa']['nombre'])//Programa
            					->setCellValue('P'.$fil, "")
            					->setCellValue('R'.$fil, $value['redencion']['participante']['documento'])
            					->setCellValue('S'.$fil, $value['id'])
            					->setCellValue('T'.$fil, $value['redencion']['participante']['id'])
            					->setCellValue('U'.$fil, $value['redencion']['codigoredencion']);

                                $objPHPExcel->getActiveSheet()
                                            ->setCellValue('B'.$fil, $value['nombreContacto'])
                                            ->setCellValue('D'.$fil, $value['direccion'])
                                            ->setCellValue('E'.$fil, $value['barrio'])
                                            ->setCellValue('F'.$fil, $value['ciudadNombre'])
                                            ->setCellValue('G'.$fil, $value['departamentoNombre'])
                                            ->setCellValue('Q'.$fil, $value['telefono']." - ". $value['celular']);


            				if(isset($value['ordenproducto'])){
                				$objPHPExcel->getActiveSheet()
                				            ->setCellValue('H'.$fil, $value['ordenproducto']['valorunidad'])
                				            ->setCellValue('V'.$fil, $value['ordenproducto']['ordenesCompra']['consecutivo']);
            				}

                            if(isset($value['guia'])){
                                $guias = "";
                                foreach ($value['guia'] as $keyG => $valueG) {
                                    $guias .= $valueG['guia'];
                                }

                                $objPHPExcel->getActiveSheet()
                                            ->setCellValue('AB'.$fil, $guias);
                            }
            				
            				if($value['redencion']!= Null){
            					$objPHPExcel->getActiveSheet()
            						    ->setCellValue('Y'.$fil, $value['redencion']['id']);
            				}

                            $objPHPExcel->getActiveSheet()
                                        ->setCellValue('Z'.$fil, $planilla->getFecha()->format("Y-m-d"));
            			$objPHPExcel->getActiveSheet()->setCellValue('AC'.$fil, $value['id']);
            			
                        $fil+=1;
            }


            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
            $objWriter->save('Planilla_'.$id.'.xlsx');  //send it to user, of course you can save it to disk also!
             // prepare BinaryFileResponse
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web/Planillas';
            $filename = 'Planilla_'.$id.'.xlsx';
            $filePath = $basePath.'/'.$filename;
            $objWriter->save($filePath);  //send it to user, of course you can save it to disk also!
             
            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));

            if($descargar == 1){
                $this->estadoPlanillaAction($id);
                return $response;
            }else{
                return $filename;
            }
            
    }

	public function planillaSegmentadoAction(Request $request)
    {

      $em = $this->getDoctrine()->getManager();

      $arrayParametros = array();
                $qb = $em->createQueryBuilder();            
                $qb->select('count(d) total','d','r','p','pr','pais','cat','c');
                $qb->from('IncentivesInventarioBundle:Despachos','d');
                $qb->Join('d.redencion', 'r', 'WITH', 'r.redencionestado = 4');
                $qb->Join('r.productocatalogo', 'p');
                $qb->Join('r.inventario', 'i');
                $qb->Join('p.producto', 'pr');
                $qb->Join('p.catalogos', 'c');
                $qb->Join('pr.categoria', 'cat');
                $qb->Join('c.pais', 'pais');
                $str_filtro = ' d.redencion IS NOT NULL AND d.planilla is NULL';
                
                //no mostrar premios de otros paisses a el operador logistico
                if($this->get('security.authorization_checker')->isGranted('ROLE_BOD')){
                    $str_filtro .= ' AND c.pais=1';
                }
                
                $qb->where($str_filtro);
                $qb->groupBy('c.pais', 'pr.categoria');

      $despachos =  $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

      //echo "<pre>"; print_r($Inventarios); echo "</pre>"; exit;
      $form = $this->createForm(new PlanillasGenerarType());

      if ($request->isMethod('POST')) {
                // realiza alguna acción, tal como guardar la tarea en la base de datos

              $pais = intval($request->get('pais'));
              $categoria = intval($request->get('categoria'));

              if($pais!="" && $categoria!=""){

				//$inventario = $em->getRepository('IncentivesInventarioBundle:Inventario')->findBySalio("1");
                $estado = $em->getRepository('IncentivesInventarioBundle:PlanillaEstado')->find("1");
                //$planillas= $em->getRepository('IncentivesInventarioBundle:Planilla')->findAll();
                
                $qb = $em->createQueryBuilder();            
                $qb->select('MAX(p.id)');
                $qb->from('IncentivesInventarioBundle:Planilla','p');
                $maxPlanilla = $qb->getQuery()->getOneOrNullResult();
                $fecha = date_create()->format('Y-m-d');

                $arrayParametros = array();
                $qb = $em->createQueryBuilder();            
                $qb->select('d','r','p','i');
                $qb->from('IncentivesInventarioBundle:Despachos','d');
                $qb->Join('d.redencion', 'r', 'WITH', 'r.redencionestado = 4');
                $qb->Join('r.productocatalogo', 'p');
                $qb->Join('p.producto', 'pr');
                $qb->Join('r.inventario', 'i');
                $qb->Join('p.catalogos', 'c');
                $str_filtro = ' d.redencion IS NOT NULL AND d.planilla is NULL AND i.despacho=d.id';
                $str_filtro .= ' AND c.pais = '.$pais;
                $str_filtro .= ' AND pr.categoria = '.$categoria;
                $qb->where($str_filtro);

                $despachos = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

                if(count($despachos)>0){            

                    $pais = $em->getRepository('IncentivesOperacionesBundle:Pais')->find($pais);
                    $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($categoria);
                    $tipo = $em->getRepository('IncentivesInventarioBundle:PlanillaTipo')->find(1);
    
                    $planilla = new Planilla();                
                    $planilla->setFecha(new \DateTime($fecha));
                    $planilla->setPlanillaEstado($estado);
                    $planilla->setConsecutivo($maxPlanilla[1]+1);
                    $planilla->setCategoria($categoria);
                    $planilla->setPais($pais);
                    $planilla->setPlanillatipo($tipo);
                    $em->persist($planilla);
    
                    $i=0;
                    $redencion = array();
                    foreach ($despachos as $keyR => $valueR) {
    
                        $redencion[$i] = $em->getRepository('IncentivesInventarioBundle:Despachos')->find($valueR['id']);
                       
                        $qb = $em->createQueryBuilder();            
                        $qb->select('i');
                        $qb->from('IncentivesInventarioBundle:Inventario','i');
                        $str_filtro = ' i.despacho = '.$valueR['id'];
                        $qb->where($str_filtro);
                        $qb->setMaxResults(1);
                        $qb->orderBy('i.id','DESC');
                        $inventario[$i] = $qb->getQuery()->getOneOrNullResult();
                    
    					if($redencion[$i]->getRedencion() != Null){
    						$redencionI = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($redencion[$i]->getRedencion()->getId());
    						$redencionI->setfechaDespacho(new \DateTime($fecha));
    						$em->persist($redencionI);
    					}
    					
    					$redencion[$i]->setPlanilla($planilla);
    					$inventario[$i]->setPlanilla($planilla);
    					
    					//$redencion[$i]->setFechaDespacho(date_create("now"));
    					$em->persist($redencion[$i]);
    					$em->persist($inventario[$i]);
    
    					$i++; 
    					$em->flush();
                    }
                
                    $filename = $this->actualizarplanillaAction($planilla->getId(), 0);
    
                    $planilla->setRuta($filename);
                    $em->persist($planilla);
                    $em->flush();
    
                    $this->get('session')->getFlashBag()->add('notice', 'Se generaron las siguientes planillas nuevas: '.$planilla->getConsecutivo());

                }else{
                    $this->get('session')->getFlashBag()->add('notice', 'No hay productos para despachar');
                }
  
              }else{
                $this->get('session')->getFlashBag()->add('warning', 'Asegurese de seleccionar los filtros para generar planillas');
              }//Cierra if pais cateogoria

            return $this->redirect($this->generateUrl('planillas_lista'));
    }

    return $this->render('IncentivesInventarioBundle:Inventario:generarsegmentado.html.twig', 
          array('despachos' => $despachos
      ));

  }

  public function nuevaplanillaAction(Request $request){

    $em = $this->getDoctrine()->getManager();
       
        $planilla = new Planilla();
        $form = $this->createForm(new PlanillaType(), $planilla);
                    
        $fecha = date_create()->format('Y-m-d');

        if ($request->isMethod('POST')) {
            
            $form->bind($request);

            //if ($form->isValid()) {

                $pro = $request->get('planilla');
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                $pais = intval($pro['pais']);
                $categoria = intval($pro['categoria']);
                $tipo = intval($pro['planillatipo']);

                $estado = $em->getRepository('IncentivesInventarioBundle:PlanillaEstado')->find("1");
                $planillas= $em->getRepository('IncentivesInventarioBundle:Planilla')->findAll();
                
                $tipo= $em->getRepository('IncentivesInventarioBundle:PlanillaTipo')->find($tipo);
                $pais = $em->getRepository('IncentivesOperacionesBundle:Pais')->find($pais);
                $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($categoria);

                $planilla = new Planilla();                
                $planilla->setFecha(new \DateTime($fecha));
                $planilla->setPlanillaEstado($estado);
                $planilla->setPlanillatipo($tipo);
                $planilla->setConsecutivo(count($planillas)+1);
                $planilla->setCategoria($categoria);
                $planilla->setPais($pais);
                //$planilla->setTipo($tipo);
                $em->persist($planilla);
                $em->flush();
                
                if($tipo->getId() == 2){
                     return $this->redirect($this->generateUrl('planilla_requisicion')."/".$planilla->getId()); 
                }else{
                   return $this->redirect($this->generateUrl('planillas_lista')); 
                }
                
            //}
        }            

        return $this->render('IncentivesInventarioBundle:Inventario:nuevaplanilla.html.twig', array(
            'form' => $form->createView()
        ));


  }

public function planillaSolicitudAction(Request $request, $id){

    $em = $this->getDoctrine()->getManager();
       
        $planilla = new Planilla();
        $form = $this->createForm(new PlanillaType(), $planilla);
                    
        $fecha = date_create()->format('Y-m-d');

        if ($request->isMethod('POST')) {
            
            $form->bind($request);

            //if ($form->isValid()) {

                $pro = $request->get('planilla');
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                $pais = intval($pro['pais']);
                $categoria = intval($pro['categoria']);
                $tipo = intval($pro['planillatipo']);

                $estado = $em->getRepository('IncentivesInventarioBundle:PlanillaEstado')->find("1");
                $planillas= $em->getRepository('IncentivesInventarioBundle:Planilla')->findAll();
                
                $tipo= $em->getRepository('IncentivesInventarioBundle:PlanillaTipo')->find($tipo);
                $pais = $em->getRepository('IncentivesOperacionesBundle:Pais')->find($pais);
                $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($categoria);

                $solicitud = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($id);

                $planilla = new Planilla();                
                $planilla->setFecha(new \DateTime($fecha));
                $planilla->setPlanillaEstado($estado);
                $planilla->setPlanillatipo($tipo);
                $planilla->setConsecutivo(count($planillas)+1);
                $planilla->setCategoria($categoria);
                $planilla->setPais($pais);
                $planilla->setSolicitud($solicitud);
                //$planilla->setTipo($tipo);
                $em->persist($planilla);
                $em->flush();
                
                if($tipo->getId() == 2){
                     return $this->redirect($this->generateUrl('planilla_requisicion')."/".$planilla->getId()); 
                }else{
                   return $this->redirect($this->generateUrl('planillas_lista')); 
                }
                
            //}
        }            

        return $this->render('IncentivesInventarioBundle:Inventario:planillasolicitud.html.twig', array(
            'form' => $form->createView(), 'id' => $id,
        ));


  }

  public function planillarequisicionAction(Request $request, $id){
        
        $em = $this->getDoctrine()->getManager();
        
        $planilla = $em->getRepository('IncentivesInventarioBundle:Planilla')->find($id);
        
        $arrayParametros = array();
        $qb = $em->createQueryBuilder();            
        $qb->select('count(i) total','i inventario', 'oc orden', 'p planilla', 'pr producto');
        $qb->from('IncentivesInventarioBundle:Inventario','i');
        $qb->leftJoin('i.orden','oc');
        $qb->leftJoin('i.planilla','p');
        $qb->Join('i.producto','pr');
        $str_filtro = ' (i.salio = 0 OR i.salio is NULL) AND i.redencion is NULL AND i.planilla is NULL';
        $qb->groupBy('pr.id','oc.id');
        $qb->where($str_filtro);

        $inventario = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
//echo "<pre>"; print_r($inventario); echo "</pr>";exit;
        return $this->render('IncentivesInventarioBundle:Inventario:planillarequisicion.html.twig', 
            array('inventario' => $inventario, 'id' => $id, 'planilla' => $planilla));

    }

    public function planillagregarAction(Request $request, $planilla, $producto){
        
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm (new AgregarType());
        
        $cantidad = $request->get('cantidad');
        $planillaR = $em->getRepository('IncentivesInventarioBundle:Planilla')->find($planilla);

        if ($request->isMethod('POST')) {
            $form->bind($request);

               $pro = $request->get('envio');
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                $envio = new Requisicionesenvios();               
                $envio->setDireccion($pro['direccion']);
                $envio->setNombre($pro['nombre']);
                $envio->setDocumento($pro['documento']);
                $envio->setCiudadNombre($pro['ciudadNombre']);
                $envio->setDireccion($pro['direccion']);
                $envio->setTelefono($pro['telefono']);
                $envio->setBarrio($pro['barrio']);
                $envio->setCelular($pro['celular']);
                $envio->setDepartamentoNombre($pro['departamentoNombre']);
                
                $envio->setDireccionContacto($pro['direccionContacto']);
                $envio->setNombreContacto($pro['nombreContacto']);
                $envio->setDocumentoContacto($pro['documentoContacto']);
                $envio->setCiudadContacto($pro['ciudadContacto']);
                $envio->setDireccionContacto($pro['direccionContacto']);
                $envio->setTelefonoContacto($pro['telefonoContacto']);
                $envio->setBarrioContacto($pro['barrioContacto']);
                $envio->setCelularContacto($pro['celularContacto']);
                $envio->setDepartamentoContacto($pro['departamentoContacto']);
                
                $envio->setObservaciones($pro['observaciones']);
                
                $em->persist($envio);
                
                $qb = $em->createQueryBuilder();            
                $qb->select('i inventario');
                $qb->from('IncentivesInventarioBundle:Inventario','i');
                $qb->leftJoin('i.orden','oc');
                $qb->leftJoin('i.planilla','p');
                $qb->leftJoin('i.producto','pr');
                $qb->setMaxResults($cantidad);
                $str_filtro = ' (i.salio = 0 OR i.salio is NULL) AND i.redencion is NULL AND i.planilla is NULL AND pr.id='.$producto;
                $qb->where($str_filtro);

                $inventario = $qb->getQuery()->getResult();
                
                foreach($inventario as $keyI => $valueI){
                    
                    $valueI['inventario']->setRequisicionesesenvios($envio);
                    $valueI['inventario']->setPlanilla($planillaR);
                    $em->persist($valueI['inventario']);
                }

                $em->flush();
                
                return $this->redirect($this->generateUrl('planilla_requisicion')."/".$planilla);

        }


        return $this->render('IncentivesInventarioBundle:Inventario:planillagregar.html.twig', 
            array('form' => $form->createView(), 'planilla' => $planilla, 'producto' => $producto));

    }
    
    
    public function planillasCierreAction(Request $request){
            
        $em = $this->getDoctrine()->getManager();
            
        $session = $this->get('session');
            
        $page = $this->get('request')->get('page');
        if(!$page) $page= 1;
            
        if($pro=($this->get('request')->request->get('producto'))){
            $page = 1;
            $session->set('filtros_productos', $pro);
        }

        $sqlFiltro = "";

        if($filtros = $session->get('filtros_productos')){
               
               foreach($filtros as $Filtro => $valueF){
                   
                   if($valueF!=""){
                       if($Filtro=="categoria"){
                            $sqlFiltro .= " AND c.id=".$valueF."";
                       }elseif($Filtro=="estado"){
                            $sqlFiltro .= " AND e.id=".$valueF."";
                       }else{
                            $sqlFiltro .= " AND p.".$Filtro." LIKE '%".$valueF."%'";
                       }
                       
                   };
               } 
                
        }
       
        $arrayParametros = array();
        $qb = $em->createQueryBuilder();            
        $qb->select('count(g) total', 'pl');
        $qb->from('IncentivesInventarioBundle:Planilla','pl');
        $qb->leftJoin('pl.inventario','i');
        $qb->leftJoin('i.inventarioguia','ig');
        $qb->leftJoin('ig.guia','g');
        $str_filtro = ' ig.cierreEstado = 1';
        $qb->where($str_filtro);
        $qb->groupBy('pl.id');
        //$planillas = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $qb,
                $page/*page number*/,
                50 /*limit per page*/
            );
        
        //echo "<pre>"; print_r($planillas); echo "</pre>"; exit;
        return $this->render('IncentivesInventarioBundle:Inventario:planillacierre.html.twig', array(
            'planillas' => $pagination,
        ));

  }
  
  public function cierreDetalleAction(Request $request, $planilla){

        $em = $this->getDoctrine()->getManager();
        
        $arrayParametros = array();
        $qb = $em->createQueryBuilder();            
        $qb->select('i','ig','g','ce','r','pt','pg','p');
        $qb->from('IncentivesInventarioBundle:InventarioGuia','ig');
        $qb->leftJoin('ig.guia','g');
        $qb->leftJoin('ig.inventario','i');
        $qb->leftJoin('ig.cierreEstado','ce');
        $qb->leftJoin('i.planilla','pl');
        $qb->leftJoin('i.redencion','r');
        $qb->leftJoin('i.producto','p');
        $qb->leftJoin('r.participante','pt');
        $qb->leftJoin('pt.programa','pg');
        $str_filtro = ' ig.cierreEstado = 1';
        $str_filtro .= ' AND pl.id='.$planilla;
        $qb->where($str_filtro);
        $guias = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        //echo "<pre>"; print_r($guias); echo "</pre>"; exit;
        $planilla = $em->getRepository('IncentivesInventarioBundle:Planilla')->find($planilla);
       
        return $this->render('IncentivesInventarioBundle:Inventario:cierredetalle.html.twig', array(
            'guias' => $guias, 'planilla' => $planilla
        ));

  }

    public function cierreEntregaAction(Request $request, $id, $planilla){

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new CierreType());
        
        $guia = $em->getRepository('IncentivesInventarioBundle:InventarioGuia')->find($id);
        
        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                
                $pro=($this->get('request')->request->get('cierre'));
                
                $estado = $em->getRepository('IncentivesInventarioBundle:cierreEstado')->find($pro['cierreEstado']);
                $guia->setCierreEstado($estado);
		        $guia->setObservacion($pro['observacion']);
		        
		        if($pro['cierreEstado']==3 || $pro['cierreEstado']==4 || $pro['cierreEstado']==5){
		            
		            switch ($pro['cierreEstado']) {
                        case 3:
                            $tipo=1;
                        case 4:
                            $tipo=1;
                        case 5:
                            $tipo=2;
                    }
                    
                    $novedad = new Novedades();
                    
		            //registrar novedad
		            $redencionN = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($guia->getInventario()->getRedencion()->getId());
                    $novedad->setRedencion($redencionN);
                    $estado = $em->getRepository('IncentivesGarantiasBundle:Novedadesestado')->find(1);
                    $novedad->setEstado($estado);
                    $tipo = $em->getRepository('IncentivesGarantiasBundle:Novedadestipo')->find($tipo);
                    $novedad->setTipo($tipo);
                    $novedad->setFecha(new \DateTime());
                    $novedad->setObservacion($pro['observacion']);
                    $em->persist($novedad);
		            
		        }else{
		            $guia->setFechaEntrega(date_create($pro['fechaEntrega']));
		        }
                
                $em->persist($guia);
                $em->flush();

                return $this->redirect($this->generateUrl('inventario_planilla_cierre_detalle').'/'.$planilla);

            }
        }
       
        return $this->render('IncentivesInventarioBundle:Inventario:cierreentrega.html.twig', array(
            'form' => $form->createView(), 'id' => $id, 'planilla' => $planilla, 'guia'=> $guia
        ));

  }
  
  public function costosPlanillaAction(Request $request, $planilla){

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new CostosLogisticaType());
        
        //echo "<pre>"; print_r($inventario); echo "</pre>"; exit;
        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                
                $pro=($this->get('request')->request->get('costosLogistica'));
                $costosLogistica = new CostosLogistica();
                
                $planillaEnt = $em->getRepository('IncentivesInventarioBundle:Planilla')->find($planilla);
                $costosLogistica->setCantidad($pro["cantidad"]);
                $costosLogistica->setValorUnitario($pro["valorUnitario"]);
                $costosLogistica->setValortotal($pro["valorUnitario"]*$pro["cantidad"]);
                $costosLogistica->setDescripcion($pro["descripcion"]);
                $costosLogistica->setPlanilla($planillaEnt);
                
                $em->persist($costosLogistica);
                $em->flush();

                return $this->redirect($this->generateUrl('planillas_datos').'/'.$planilla);

            }
        }
       
        return $this->render('IncentivesInventarioBundle:Inventario:costoslogistica.html.twig', array(
            'form' => $form->createView(), 'planilla' => $planilla
        ));

  }
  
  public function datosPlanillaAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        
        $planilla = $em->getRepository('IncentivesInventarioBundle:Planilla')->find($id);
        $costosLogistica = $em->getRepository('IncentivesInventarioBundle:CostosLogistica')->findByPlanilla($id);

        $arrayParametros = array();
        $qb = $em->createQueryBuilder();            
        $qb->select('i','pl','r','pt','pg','pp');
        $qb->from('IncentivesInventarioBundle:Inventario','i');
        $qb->leftJoin('i.planilla','pl');
        $qb->leftJoin('i.redencion','r');
        $qb->leftJoin('r.participante','pt');
        $qb->leftJoin('pt.programa','pg');
        $qb->leftJoin('i.producto','pp');
        $str_filtro = ' r.justificacion IS NULL AND pl.id='.$id;
        $qb->where($str_filtro);
        $redencionesPlanilla = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
//echo "<pre>"; print_r($redencionesPlanilla); echo "</pre>"; exit;

        return $this->render('IncentivesInventarioBundle:Inventario:planilladatos.html.twig', array(
            'planilla' => $planilla, 'costoslogistica' => $costosLogistica, 'redencionesPlanilla' => $redencionesPlanilla
        ));

  }
  
    public function reporteDetalleAction()
    {         
            $fp = fopen('php://temp','r+');

			// Header
			$row = array('Id','Producto','Marca','Referencia','Descripcion','SKU','Fecha Ingreso','Salio','Orden Compra','Planilla','Redencion','Observaciones');
			
    	    $em = $this->getDoctrine()->getManager();

            $query = "SELECT i.id,i.salio,i.fechaEntrada,oc.consecutivo,pl.id planilla,i.observacion,pd.nombre,pd.referencia,pd.marca,pd.codInc,r.id redencion,pd.descripcion
                    	FROM Inventario i
                    	LEFT JOIN Producto pd ON i.producto_id=pd.id
                    	LEFT JOIN Planilla pl ON i.planilla_id=pl.id
                    	LEFT JOIN OrdenesCompra oc ON i.orden_id=oc.id
                    	LEFT JOIN Redenciones r ON i.redencion_id=r.id;";
            
            $conn = $this->get('database_connection'); 
            $productos = $conn->fetchAll($query, array(1), 0);

			//echo "<pre>"; print_r($productos); echo "</pre>"; exit;
    			
            $ir = 0;
            foreach($productos as $key => $value){              
               
               if($ir==0){
				   
					fputcsv($fp,$row,';');
				}
               
                $ir++;
               
                $row = array();
                //Redencion, participante, producto
				$row[] = $value['id'];//1
				
    			$row[] = $value['nombre'];
    			$row[] = $value['marca'];
    			$row[] = $value['referencia'];
    			$row[] = $value['descripcion'];
    			$row[] = $value['codInc'];
    			
    			$row[] = $value['fechaEntrada'];
    			$row[] = $value['salio'];
    			
    			$row[] = $value['consecutivo'];
    			$row[] = $value['planilla'];
    			$row[] = $value['redencion'];
    			
    			$row[] = $value['observacion'];
				
						 
				fputcsv($fp,$row,';');
            }

			rewind($fp);
			$csv = stream_get_contents($fp);
			fclose($fp);
			
			$filename = 'Inventario_detalle.csv';
			$response = new Response($csv);
			
			$response->headers->set('Content-Type', "text/csv");
			$response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $filename));            
			
            return $response;

    }

    public function listadoliberarAction(Request $request, $arreglo){
        
        $em = $this->getDoctrine()->getManager();
        
        if (isset($arreglo)) {
            $arreglo = explode(",", $arreglo); 
            
            foreach ($arreglo as $key => $value) {
                
                $inventario = $em->getRepository('IncentivesInventarioBundle:Inventario')->find($value);
                if ($value!=""){
                    
                    $inventario->setPlanilla(null);
                    //$inventario->setOrdenProducto(null);
                    //$inventario->setOrden(null);
                    $inventario->setRedencion(null);
                    $em->persist($inventario);
                    $em->flush();
                    
                    
                    if($inventario->getRedencion() !== null){
                        //liberar redenciones
                        $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($inventario->getRedencion()->getId());
                    
                        //Determinar estado
                        
                        //Si tiene OC estado 3
                        if($redencion->getOrdenesProducto() !== null){
                            $estadoRed = 3;
                            $this->cerrarOrdenAction($redencion->getOrdenesProducto()->getOrdenesCompra()->getId());
                            
                        }else{
                        //Si no tiene OC estado 2
                            $estadoRed = 2;
                        }
                        
                        $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find($estadoRed);
                        $redencion->setRedencionestado($estado); 
                        
                        $em->persist($redencion);
                        $em->flush();
                        
                    }
                }
            }
            
            $this->get('session')->getFlashBag()->add('notice', 'Los productos se liberaron exitosamente. Recuerde que quedan disponibles en el inventario.');
        }
        
        
        $session = $this->get('session');
        
        if($pro=($this->get('request')->request->get('inventario'))){
            $page = 1;
            $session->set('filtros_liberar', $pro);
        }
        
        $sqlFiltro = "";

            if($filtros = $session->get('filtros_liberar')){
               foreach($filtros as $Filtro => $valueF){
                   
                   if($valueF!=""){
                       if($Filtro=="codigo"){
                            $sqlFiltro .= " AND i.codigo=".$valueF."";
                       }elseif($Filtro=="ordenCompra"){
                            $sqlFiltro .= " AND oc.consecutivo LIKE '%".$valueF."%'";
                       }elseif($Filtro=="fechaEntrada"){
                            $sqlFiltro .= " AND i.fechaEntrada LIKE '%".$valueF."%'";
                       }elseif($Filtro=="observacion"){
                            $sqlFiltro .= " AND i.observacion LIKE '%".$valueF."%'";
                       }elseif($Filtro=="planilla"){
                            $sqlFiltro .= " AND p.id LIKE '%".$valueF."%'";
                       }elseif($Filtro=="redencion"){
                            $sqlFiltro .= " AND r.codigoredencion LIKE '%".$valueF."%'";
                       }else{
                            $sqlFiltro .= " AND pr.".$Filtro." LIKE '%".$valueF."%'";
                       }
                       
                   }
               } 
                
            }

        $arrayParametros = array();
        $qb = $em->createQueryBuilder();            
        $qb->select('i inventario', 'oc orden', 'p planilla', 'pr producto', 'r');
        $qb->from('IncentivesInventarioBundle:Inventario','i');
        $qb->leftJoin('i.orden','oc');
        $qb->leftJoin('i.redencion','r');
        $qb->leftJoin('i.planilla','p');
        $qb->leftJoin('i.producto','pr');
        $str_filtro = ' (i.salio = 0 OR i.salio is NULL) AND (i.planilla IS NOT NULL OR i.redencion IS NOT NULL) '.$sqlFiltro;
        $qb->where($str_filtro);
        
        $listado = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        //echo "<pre>"; print_r($listado); echo "</pre>"; exit;
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $listado,
            $this->get('request')->query->get('page', 1)/*page number*/,
            50 /*limit per page*/
        );
        
        return $this->render('IncentivesInventarioBundle:Inventario:listadoliberar.html.twig', 
            array('listado' => $pagination));
        
    }
    
    
    public function liberarAction(Request $request, $id){
        
        $em = $this->getDoctrine()->getManager();
        
        $inventario = $em->getRepository('IncentivesInventarioBundle:Inventario')->find($id);
        $redencionI = null;
        if($inventario->getRedencion() != Null) $redencionI = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($inventario->getRedencion()->getId());
        
        $form = $this->createForm (new SalidaType(), $inventario);
        
        if ($request->isMethod('POST')) {
            $form->bind($request);
            $pro=($this->get('request')->request->get('inventario'));
            
            $inventario->setFechaSalida(new \DateTime());
            if(isset($pro['salio'])) $inventario->setSalio($pro['salio']);
            $inventario->setObservacion($pro['observacion']);
            $em->persist($inventario);
            
            $inventarioH = $this->get('incentives_inventario');
            $inventarioH->insertar($inventario);
            
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('notice', 'La salida de productos fue exitosa');
            
        }
        //Almacenar salida de inventario

        //Cambiar estado a redencion
        
        return $this->render('IncentivesInventarioBundle:Inventario:salida.html.twig', 
            array('inventario' => $inventario, 'redencion' => $redencionI, 'form' => $form->createView()));
        
    }

    public function cerrarOrdenAction($id){
        
        $this->actualizarCantidadAction($id);
        
        $em = $this->getDoctrine()->getManager();
        $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
        
        $arrayParametros = array();
        $qb = $em->createQueryBuilder();            
        $qb->select(array('cantidad'=>'COUNT(op.id)'));
        $qb->from('IncentivesOrdenesBundle:OrdenesProducto','op');
        $str_filtro = 'op.ordenesCompra = '.$orden->getId();
        $str_filtro .= ' AND op.cantidad!=op.cantidadrecibida AND op.estado=1';
        $qb->where($str_filtro);
        $cantidad = $qb->getQuery()->getSingleScalarResult();

        if($cantidad==0){
            $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('5'); 
        }else{
            $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('4'); 
        }
        
        $orden->setOrdenesEstado($estado);
        $em->persist($orden);
        $em->flush();
    }
    
     public function correoDespachoAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        
        $solicitud = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($id);
        $solicitante = $solicitud->getSolicitante();
       
        // Create the Transport
        $transport = \Swift_SmtpTransport::newInstance('smtp.office365.com', 25, 'tls')
          ->setAuthMode('login')
          ->setUsername('operaciones@inc-group.co')
          ->setPassword('IncGroup2016!')
          ;

          $template = 'IncentivesInventarioBundle:Inventario:emailDespacho.txt.twig';
          $subjet = 'Nueva despacho en solicitud';
        
        // Create the Mailer using your created Transport
        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance()
            ->setSubject($subjet)
            ->setFrom(array('operaciones@inc-group.co' => 'Grupo Inc'))
            ->setTo('manuelgb13@gmail.com')
            //->setTo($solicitante->getEmail())
            
            ->setBody(
                $this->renderView(
                    $template,
                    array('solicitud' => $solicitud)
                )
            );
        
        //Send the message
        /*if($mailer->send($message)) {
            $this->get('session')->getFlashBag()->add('notice', 'El correo de aviso se ha enviado correctamente.');
        }else{
            $this->get('session')->getFlashBag()->add('notice', 'El correo no pudo ser enviado');
        }*/

    }
    
    public function cargarguiasAction(Request $request)
    {
        $excelForm = new Excel();
        $form = $this->createFormBuilder($excelForm)
            ->setAction($this->generateUrl('inventario_importar_planilla'))
            ->setMethod('POST')
            ->add('excel', 'file')
            ->add('cargar', 'submit')
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->bind($request);

            $excel = $form['excel']->getData();

            $objPHPExcel = PHPExcel_IOFactory::load($excel);
            $sheetData = $objPHPExcel->getSheet()->toArray(null,true,true,true);

            $worksheet  = $objPHPExcel->setActiveSheetIndex('0');
            $em = $this->getDoctrine()->getManager();

            $fila=1;
            $error = 0;
            foreach ($sheetData as $row) {
                $errorFecha = 0;
                
                if($fila > 1 && $row['AC']!="" && $row['O']!="" && $row['AA']!=""){
                    //Comprobar fechas
                    $fechaEntrega = explode("/", $row['AA']);
                    if(count($fechaEntrega)==3){
                        $fechaEntrega = date("Y-m-d", strtotime($fechaEntrega[2]."-".$fechaEntrega[1]."-".$fechaEntrega[0]));
                        $fechaBase = date('Y-m-d', strtotime("01/01/2010"));
                        if($fechaEntrega < $fechaBase) $errorFecha =  1;
                    }else{
                        $errorFecha =  1;
                    } 
                   
                    if($errorFecha == 0){
                        $inventario = $em->getRepository('IncentivesInventarioBundle:Inventario')->find($row['AC']);

                        if(!isset($inventario)){
                            
                            $this->get('session')->getFlashBag()->add('warning', 'No se encontro inventario asociado a la fila: '.$fila);
    
                        }else{
                            
                            //Determinar si la guia ya existe
                            $qb = $em->createQueryBuilder();            
                            $qb->select('g');
                            $qb->from('IncentivesRedencionesBundle:GuiaEnvio','g');
                            $str_filtro = "g.guia LIKE '".$row['O']."' ";
                            $qb->where($str_filtro);
                            $qb->setMaxResults(1);
                            $guia = $qb->getQuery()->getOneOrNullResult();
        
                            if(!isset($guia) || $guia==Null){
                                //Si no existe guardar la guia nueva y la relacion con la redencion
                                $guia= new GuiaEnvio();
                                $guia->setGuia($row['O']);
                                $guia->setOperador($row['W']);
                                $guia->setEstado("1");
                                $guia->setFecha(new \DateTime($fechaEntrega));
                                $guia->setValor($row['X']);
                            
                                if($inventario->getOrdenproducto() !== null) $guia->setOrdenProducto($inventario->getOrdenproducto());
                                
                            }
                            
                            //Si existe guardar la relacion con la redencion
                            $inventarioguia = new InventarioGuia();
                            $inventarioguia->setGuia($guia);
                            $inventarioguia->setInventario($inventario);
                            $estado = $em->getRepository('IncentivesInventarioBundle:CierreEstado')->find('1');
                            $inventarioguia->setCierreEstado($estado);
        
        		            $inventario->setSalio("1");
            		        $inventario->setFechaSalida(new \DateTime());

                            if($inventario->getRedencion() !== null){
                                
                                $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($inventario->getRedencion()->getId());
                                $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('5');
                                $redencion->setfechaEntrega(new \DateTime($fechaEntrega));
                                $redencion->setRedencionestado($estado);
        
                                $em->persist($redencion);
                            }
                            
                            $em->persist($guia);
                            $em->persist($inventarioguia);
                            $em->persist($inventario);
                            
                            $inventarioH = $this->get('incentives_inventario');
                            $inventarioH->insertar($inventario);
                            
                            $em->flush();    
                                
                        }
                        
                    }else{
                        $this->get('session')->getFlashBag()->add('warning', 'Existe un problema asociado a la fecha de la fila: '.$fila.', asegúrese de usar el formato adecuado día/mes/año. ej. 24/03/16');
                        $error = 1;
                    }
                    
                }else{
                    if($fila>1){
                        $this->get('session')->getFlashBag()->add('warning', 'La información de la fila  '.$fila.' se encuentra incompleta.');
                        $error = 1;
                    }
                }
                $fila=$fila+1;
            }
        
            if($error==0){
                $this->get('session')->getFlashBag()->add('notice', 'Las guías se cargaron de forma exitosa.');
            }
        }

        return $this->render('IncentivesInventarioBundle:Inventario:importar.html.twig', array(
            'form' => $form->createView(),));

    }
    
    public function actualizarCantidadAction($id){
        
        $em = $this->getDoctrine()->getManager();
        $ordenesProducto = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findByordenesCompra($id);
        
        foreach($ordenesProducto as $keyO => $valueO){

            $arrayParametros = array();
            $qb = $em->createQueryBuilder();            
            $qb->select(array('cantidad'=>'COUNT(i.id)'));
            $qb->from('IncentivesInventarioBundle:Inventario','i');
            $str_filtro = 'i.orden = '.$id;
            $str_filtro .= ' AND i.producto ='.$valueO->getProducto()->getId();
            $str_filtro .= ' AND i.ordenproducto ='.$valueO->getId();
            $qb->where($str_filtro);
            $cantidad = $qb->getQuery()->getSingleScalarResult();

            $valueO->setCantidadrecibida($cantidad);
            $em->persist($valueO);
            $em->flush();
        } 
    }



}
