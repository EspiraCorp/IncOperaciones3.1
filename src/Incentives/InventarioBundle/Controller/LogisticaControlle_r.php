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
use Incentives\InventarioBundle\Entity\Despachos;
use Incentives\InventarioBundle\Entity\DespachoGuia;
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

class LogisticaController extends Controller
{
    
    public function cargardespachosAction(Request $request, $solicitud)
    {
        $excelForm = new Excel();
        $form = $this->createFormBuilder($excelForm)
            ->setAction($this->generateUrl('inventario_cargardespachos'))
            ->setMethod('POST')
            ->add('excel', 'file')
            ->add('cargar', SubmitType::class)
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            $excel = $form['excel']->getData();

            $objPHPExcel = PHPExcel_IOFactory::load($excel);
            $sheetData = $objPHPExcel->getSheet()->toArray(null,true,true,true);

            $worksheet  = $objPHPExcel->setActiveSheetIndex('0');
            $em = $this->getDoctrine()->getManager();

            $fila=1;
            $error = 0;
            foreach ($sheetData as $row) {
                
                if($fila > 1 && $row['A']!="" && $row['R']!=""){
                    
                    $despacho = new Despachos();
                    
                    $despacho->setDocumento($row['R']);
                    $despacho->setNombre($row['A']);
                    $despacho->setObservaciones($row['P']);
                    $despacho->setCiudadNombre($row['F']);
                    $despacho->setDireccion($row['D']);
                    $despacho->setBarrio($row['E']);
                    $despacho->setTelefono($row['Q']);
                    $despacho->setCelular("");
                    $despacho->setDepartamentoNombre($row['G']);
                    $despacho->setNombreContacto($row['B']);
                    $despacho->setDocumentoContacto($row['B']);
                    $despacho->setCiudadContacto("");
                    $despacho->setDireccionContacto("");
                    $despacho->setBarrioContacto("");
                    $despacho->setTelefonoContacto("");
                    $despacho->setCelularContacto("");
                    $despacho->setDepartamentoContacto("");
                            
                    $em->persist($despacho);
                    $em->flush();   

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

        return $this->render('IncentivesInventarioBundle:Logistica:cargardespachos.html.twig', array(
            'form' => $form->createView(),));

    }
    
    public function planillaDespachoSolicitudesAction($id){
        //buscar despachos cargados para esta solicitud sin planilla
        
        $em = $this->getDoctrine()->getManager();

        //crear la planilla

        $planilla = new Planilla();
                    
        $fecha = date_create()->format('Y-m-d');

        // realiza alguna acción, tal como guardar la tarea en la base de datos

        $estado = $em->getRepository('IncentivesInventarioBundle:PlanillaEstado')->find("1");
        $planillas= $em->getRepository('IncentivesInventarioBundle:Planilla')->findAll();
                
        $tipo= $em->getRepository('IncentivesInventarioBundle:PlanillaTipo')->find(1);
        $pais = $em->getRepository('IncentivesOperacionesBundle:Pais')->find(1);
        $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find(1);

        $solicitud = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($id);

        $planilla = new Planilla();                
        $planilla->setFecha(new \DateTime($fecha));
        $planilla->setPlanillaEstado($estado);
        $planilla->setPlanillatipo($tipo);
        $planilla->setConsecutivo(count($planillas)+1);
        $planilla->setCategoria($categoria);
        $planilla->setPais($pais);
        $planilla->setSolicitud($solicitud);

        $em->persist($planilla);
        $em->flush();

        $qb = $em->createQueryBuilder();            
        $qb->select('d','p');
        $qb->from('IncentivesInventarioBundle:Despachos','d');
        $qb->Join('d.producto', 'p');
        $str_filtro = ' d.planilla IS NULL AND d.solicitud='.$id;
        $qb->where($str_filtro);
        $despachos = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        foreach($despachos as $key => $value){
            
            $cantidadDespacho = $value['cantidad'];
            
            //asignar planilla
            $despachoInd = $em->getRepository('IncentivesInventarioBundle:Despachos')->find($value['id']);
            $despachoInd->setPlanilla($planilla);
            $em->persist($despachoInd);
                
            //buscar si hay productos ingresados para ese sku y solicitud
            $qb = $em->createQueryBuilder();            
            $qb->select('i');
            $qb->from('IncentivesInventarioBundle:Inventario','i');
            $str_filtro = ' i.salio IS NULL AND i.despacho is NULL AND i.producto='.$value['producto']['id'];
            $str_filtro .= ' AND i.solicitud='.$id;
            $qb->where($str_filtro);
            $qb->setMaxResults($cantidadDespacho);
            $inventarios = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            
            //verificar cantidades
            $cantidadInventario = count($inventarios);
            
            if($cantidadDespacho > $cantidadInventario){
                $this->get('session')->getFlashBag()->add('warning', 'No hay suficientes productos para el despacho solicitado.');
            }else{
                //actualizar inventarios
                foreach($inventarios as $keyI => $valueI){
                    $inventarioInd = $em->getRepository('IncentivesInventarioBundle:Inventario')->find($valueI['id']);
                    $inventarioInd->setDespacho($despachoInd);
                    $em->persist($inventarioInd);
                }
                
            }
            
            $em->flush();
        }
        
        return $this->redirect($this->generateUrl('solicitudes_datos')."/".$id);
    }
    
    public function importarGuiasAction(Request $request)
    {
        $excelForm = new Excel();
        $form = $this->createFormBuilder($excelForm)
            ->setAction($this->generateUrl('inventario_importar_planilla'))
            ->setMethod('POST')
            ->add('excel', 'file')
            ->add('cargar', SubmitType::class)
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            $excel = $form['excel']->getData();

            $objPHPExcel = PHPExcel_IOFactory::load($excel);
            $sheetData = $objPHPExcel->getSheet()->toArray(null,true,true,true);

            $worksheet  = $objPHPExcel->setActiveSheetIndex('0');
            $em = $this->getDoctrine()->getManager();

            $fila=1;
            $error = 0;
            foreach ($sheetData as $row) {
                $errorFecha = 0;
                
                if($fila > 1 && $row['AC']!="" && $row['O']!=""){
                    
                    $errorFecha = 0;
                    unset($fechaEntrega);
                   
                    //Si hay fecha de entrega ponerla y pasara a entregado
                    if($row['AA']!=""){
                        
                        $fechaEntrega=$objPHPExcel->getActiveSheet()->getCell("AA".$fila)->getFormattedValue();
                        
			if (strpos($fechaEntrega, '-') !== FALSE){
				$fechaEntrega = explode("-", $fechaEntrega);
			}elseif(strpos($fechaEntrega, '/') !== FALSE){
				$fechaEntrega = explode("/", $fechaEntrega);
			}

                        if(count($fechaEntrega)==3){
			    if(strlen($fechaEntrega[2])<=2) $fechaEntrega[2] = '20'.$fechaEntrega[2];//complementar la fecha
			
 			    $fechaEntrega = $fechaEntrega[0]."/".$fechaEntrega[1]."/".$fechaEntrega[2];
                            $fechaEntrega = date("Y-m-d", strtotime($fechaEntrega));
                            $fechaBase = date('Y-m-d', strtotime("01/01/2010"));

                            if($fechaEntrega < $fechaBase) $errorFecha =  1;
                        }else{
                            $errorFecha =  1;
                        }
                    }
                    
                    if($errorFecha == 0){
                        //verificar si la guia ya existe o sino crearla
                        
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
                            if(isset($fechaEntrega)) $guia->setFecha(new \DateTime($fechaEntrega));
                            $guia->setValor($row['X']);
                            
                            $em->persist($guia);
                        }
                        
                        $em->flush();
                        
                        //Asociar el despacho
                        $despacho = $em->getRepository('IncentivesInventarioBundle:Despachos')->find($row['AC']);

                        if(!isset($despacho)){
                            
                            $this->get('session')->getFlashBag()->add('warning', 'No se encontro despacho asociado a la fila: '.$fila);
    
                        }else{
                            
                            //verificar si ya existe esta asociacion entre guia y despacho
                            $qb = $em->createQueryBuilder();            
                            $qb->select('dg');
                            $qb->from('IncentivesInventarioBundle:DespachoGuia','dg');
                            $str_filtro = "dg.despacho=".$despacho->getId();
                            $str_filtro .= " AND dg.guia=".$guia->getId();
                            $qb->where($str_filtro);
                            $despachoguiaInicial = $qb->getQuery()->getOneOrNullResult();
                            
                            // si existe relacion generar alerta, sino guardarla
                            if(!isset($despachoguiaInicial) || $despachoguiaInicial==Null){
                                $despachoguia = new DespachoGuia();
                                $despachoguia->setGuia($guia);
                                $despachoguia->setDespacho($despacho);
                                if(isset($fechaEntrega)) $despachoguia->setFechaEntrega(new \DateTime($fechaEntrega));
                                $em->persist($despachoguia);
                                
                                //Verificar si tiene inventarios asociados
                                $qb = $em->createQueryBuilder();            
                                $qb->select('i');
                                $qb->from('IncentivesInventarioBundle:Inventario','i');
                                $str_filtro = "i.despacho=".$despacho->getId();
                                $qb->where($str_filtro);
                                $inventarios = $qb->getQuery()->getResult();
                                
                                foreach($inventarios as $keyI => $inventario){
                                    $inventario->setSalio("1");
                		            $inventario->setFechaSalida(new \DateTime());
                		            
                		            $em->persist($inventario);
                                }
                                
                            }else{
                                
                                $this->get('session')->getFlashBag()->add('warning', 'La guía y despacho de la  fila: '.$fila.' ya se encuentran asociados');
                                
                            } 
                            
                            //Verificar si tiene redencion asociadas
                            if($despacho->getRedencion() !== null){
                                $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($despacho->getRedencion()->getId());
                                if(isset($fechaEntrega)){
                                    $idEstado = 6;
                                }else{
                                    $idEstado = 5;
                                } 
                                
                                $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find($idEstado);
                                if(isset($fechaEntrega)) $redencion->setfechaEntrega(new \DateTime($fechaEntrega));
                                $redencion->setRedencionestado($estado);
            
                                $em->persist($redencion);
                            }
                            
                        }
                        
                        $em->flush();
                    }else{
                        $this->get('session')->getFlashBag()->add('warning', 'Existe un problema asociado a la fecha de la fila: '.$fila.', asegúrese de usar el formato adecuado día/mes/año. ej. 24/03/2016');
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

        return $this->render('IncentivesInventarioBundle:Logistica:importarguias.html.twig', array(
            'form' => $form->createView(),));

    }
}
