<?php

namespace Incentives\SolicitudesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\SolicitudesBundle\Entity\Cotizacion;
use Incentives\SolicitudesBundle\Entity\Requisicion;
use Incentives\SolicitudesBundle\Form\Type\RequisicionType;
use Incentives\SolicitudesBundle\Entity\RequisicionProducto;
use Incentives\SolicitudesBundle\Form\Type\RequisicionProductoType;
use Incentives\SolicitudesBundle\Form\Type\RequisicionProductoAgregarType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Dompdf\Dompdf;

class RequisicionesController extends Controller
{
     /**
     * @Route("/listado")
     * @Template()
     */
    public function listadoAction()
    {
        $repository = $this->getDoctrine()->getRepository('IncentivesSolicitudesBundle:Requisicion');
        $listado= $repository->findAll();
       
        return $this->render('IncentivesSolicitudesBundle:Requisiciones:listado.html.twig', 
            array('listado' => $listado
        ));
    }
    
     public function nuevaAction(Request $request, $solicitud)
    {        
        $em = $this->getDoctrine()->getManager();
        $requisiciones = $em->getRepository('IncentivesSolicitudesBundle:Requisicion')->findAll();
        $requisicion = new Requisicion();

        $form = $this->createForm(RequisicionType::class, $requisicion);
        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                
                $requisicion->setConsecutivo(str_pad(count($requisiciones)+1, 5, '0', STR_PAD_LEFT));
                
                if(isset($solicitud)){
                    $solicitudCt = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($solicitud);
                    $requisicion->setSolicitud($solicitudCt);
                }
                
                $em->persist($requisicion);

                $em->flush();

                //$this->pdfAction($requisicion->getId());
                $this->get('session')->getFlashBag()->add('notice', 'La requisición con consecutivo '.$requisicion->getConsecutivo().' se creo correctamente');

                return $this->redirect($this->generateUrl('requisiciones_datos')."/".$requisicion->getId());
            }
        }            

        return $this->render('IncentivesSolicitudesBundle:Requisiciones:nueva.html.twig', array(
            'form' => $form->createView(), 'solicitud' => $solicitud,
        ));
    }
    
    public function datosAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()
            ->getRepository('IncentivesSolicitudesBundle:Requisicion');

        $repository2 = $this->getDoctrine()
            ->getRepository('IncentivesSolicitudesBundle:RequisicionProducto');

        $requisicion = $repository->find($id);
        $productos = $repository2->findBy(array('requisicion' => $requisicion->getId()));
        
        //$this->pdfAction($id);

        return $this->render('IncentivesSolicitudesBundle:Requisiciones:datos.html.twig', 
            array( 'requisicion' => $requisicion, 'productos' => $productos,
        ));
    }    
     
    public function agregarProductoAction(Request $request, $id)
    {        
        $em = $this->getDoctrine()->getManager();
        $requisicionproducto = new RequisicionProducto();

        $form = $this->createForm(RequisicionProductoAgregarType::class, $requisicionproducto);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                
                $pro = $request->request->all();
                $id = $pro['id'];
                
                $requisicion = $em->getRepository('IncentivesSolicitudesBundle:Requisicion')->find($id);
                $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find(1);
                $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($pro['requisicion_producto_agregar']['producto']);
                $requisicionproducto->setCantidad($pro['requisicion_producto_agregar']["cantidad"]);
                $requisicionproducto->setValorunidad($pro['requisicion_producto_agregar']["valorunidad"]);
                $requisicionproducto->setValortotal($pro['requisicion_producto_agregar']["valorunidad"]/(1 - ($pro['requisicion_producto_agregar']["incremento"]/100))*$pro['requisicion_producto_agregar']["cantidad"]);
                $requisicionproducto->setLogistica($pro['requisicion_producto_agregar']["logistica"]);
                $requisicionproducto->setIncremento($pro['requisicion_producto_agregar']["incremento"]);
                $requisicionproducto->setRequisicion($requisicion);
                $requisicionproducto->setProducto($producto);

                $em->persist($requisicionproducto);
                $em->flush();

                //$this->pdfAction($id);

                return $this->redirect($this->generateUrl('requisiciones_datos').'/'.$id);

            }
        }           

        return $this->render('IncentivesSolicitudesBundle:Requisiciones:agregarproducto.html.twig', array(
            'form' => $form->createView(), 'id' => $id
        ));
    }
    
    
    public function editarValoresAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();


        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $ordenes = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                
                if (0 != count($orden->getOrdenesProducto())) {
                    foreach ($orden->getOrdenesProducto() as $productos) {
                        $precio = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->findByProducto($productos->getProducto());
                        foreach ($precio as $key => $value) {
                            if ($value->getProveedor()->getId()==$ordenes->getProveedor()->getId()){
                                $productos->setValorunidad($value->getPrecio());
                                $productos->setValortotal($value->getPrecio()*(1+($value->getIncremento()/100))*$productos->getCantidad());
                            }
                        }      
                        $productos->setOrdenesCompra($ordenes);
                        $orden->addOrdenesProducto($productos);
                        $em->persist($productos);
                    }
                }      
                $em->persist($ordenes);
                $em->flush();
                
                $form=null;
                $form = $this->createForm(OrdenesCompraCantidadType::class, $orden);
            }
            
        }  
        
        $this->pdfAction($id);
        
        $repository = $this->getDoctrine()->getRepository('IncentivesSolicitudesBundle:Cotizacion');
        $cotizaciones = $repository->find($id);

        $repository2 = $this->getDoctrine()->getRepository('IncentivesSolicitudesBundle:CotizacionProducto');
        $productos = $repository2->findBy(array('cotizacion' => $cotizaciones->getId(), 'estado'=> 1));

        return $this->render('IncentivesSolicitudesBundle:Cotizaciones:editarvalores.html.twig', 
            array('cotizaciones' => $cotizaciones, 
                'productos' => $productos,
        ));
    }
    
    public function valoresAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $productos = $em->getRepository('IncentivesSolicitudesBundle:CotizacionProducto')->find($id);

        $cotizacion = $productos->getCotizacion()->getId();

        $form = $this->createForm(CotizacionesProductoCantidadType::class, $productos);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $valores = $request->request->all();

            if ($form->isValid()) {

                //actualiza valores
                $productos->setCantidad($valores['cotizaciones_producto']['cantidad']);
                $productos->setValorunidad($valores['cotizaciones_producto']['valorunidad']);
                $productos->setValortotal($valores['cotizaciones_producto']['valorunidad']*$valores['cotizaciones_producto']['cantidad']);
                $productos->setLogistica($valores['cotizaciones_producto']['logistica']);
                $em->persist($productos);
                $em->flush();
                
                return $this->redirect($this->generateUrl('cotizaciones_datos').'/'.$cotizacion);
            }

        }          

        $this->pdfAction($cotizacion);
        
        return $this->render('IncentivesSolicitudesBundle:Cotizaciones:verificar.html.twig', array(
            'form' => $form->createView(), 'productos'=>$productos, 'id'=>$id, 'cotizacion' => $cotizacion,
        ));
    }
    
    public function eliminarProductoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $productos = $em->getRepository('IncentivesSolicitudesBundle:CotizacionProducto')->find($id);

        $cotizacion = $productos->getCotizacion()->getId();

        $em->remove($productos);
        $em->flush();
        
        $this->pdfAction($cotizacion);
        
        return $this->redirect($this->generateUrl('cotizaciones_datos').'/'.$cotizacion);

    }

    public function pdfAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $cotizacion = $em->getRepository('IncentivesSolicitudesBundle:Cotizacion')->find($id);
        $productos = $em->getRepository('IncentivesSolicitudesBundle:CotizacionProducto')->findByCotizacion($cotizacion->getId());
        

        $html = $this->render('IncentivesSolicitudesBundle:Cotizaciones:pdf.html.twig', array(
            'cotizacion' => $cotizacion, 'productos' => $productos,
        ));


        
        $rootDir = dirname($this->container->getParameter('kernel.root_dir'));
        $Dir = '/web/Cotizaciones/';
        $uploadDir = $rootDir.$Dir;

        $dompdf = new DOMPDF();
        $dompdf->load_html($html,'UTF-8');
        $dompdf->render();
        $pdf = $dompdf->output();
        file_put_contents($uploadDir.$cotizacion->getConsecutivo().".pdf", $pdf);
        $cotizacion->setRutapdf($Dir.$cotizacion->getConsecutivo().".pdf");
        $em->flush();

        return $uploadDir.$cotizacion->getConsecutivo().".pdf";

    }
    
    public function correoAprobacionAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        
        $productos = $em->getRepository('IncentivesSolicitudesBundle:CotizacionProducto')->find($id);
        $solicitud = $productos->getCotizacion()->getSolicitud();

        $solicitante = $solicitud->getSolicitante();

        $correos =  array('control@grupo-inc.com');
	array_push($correos, $solicitante->getEmail());
        
        $responsables = $em->getRepository('IncentivesSolicitudesBundle:SolicitudesAsignar')->findBySolicitud($solicitud->getId());
        foreach($responsables as $key => $value){
            array_push($correos, $value->getResponsable()->getEmail());
            
        }

        // Create the Transport
        $transport = \Swift_SmtpTransport::newInstance('mail.sociosyamigos.com', 25)
          ->setAuthMode('login')
          ->setUsername('pruebas@sociosyamigos.com')
          ->setPassword('7d7_r47@fqxo')
          ;

          $template = 'IncentivesSolicitudesBundle:Cotizaciones:emailAprobacion.txt.twig';
          $subjet = 'Nueva aprobación en cotización';
        
        // Create the Mailer using your created Transport
        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance()
            ->setSubject($subjet)
            ->setFrom(array('test@grupo-inc.com' => 'Grupo Inc'))
            //->setTo('manuelgb13@gmail.com')
            ->setTo($correos)
 
            ->setBody(
                $this->renderView(
                    $template,
                    array('solicitud' => $solicitud)
                )
            );
        
        //Send the message
        if($mailer->send($message)) {
            $this->get('session')->getFlashBag()->add('notice', 'El correo de alerta ha sido enviado correctamente');
        }else{
            $this->get('session')->getFlashBag()->add('notice', 'El correo de alerta no pudo ser enviado');
        }

    }
    
    
    public function verificarEstadoAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        
        $cotizacion = $em->getRepository('IncentivesSolicitudesBundle:Cotizacion')->find($id);
        $productos = $em->getRepository('IncentivesSolicitudesBundle:CotizacionProducto')->findByCotizacion($id);
        
        $Pp = 0;
        
        foreach($productos as $key => $value){
            if($value->getEstado()->getId() == 1){
                $Pp++;
            }
        }

        if($Pp==0){
            $estado = $em->getRepository('IncentivesSolicitudesBundle:CotizacionesEstado')->find('4');
        }else{
           $estado = $em->getRepository('IncentivesSolicitudesBundle:CotizacionesEstado')->find('3'); 
        }
        
        $cotizacion->setEstado($estado);
        $em->persist($cotizacion);
        $em->flush();
    }
    
    public function finalizarAction($id)
    {
        //lista para aprobar
        $em = $this->getDoctrine()->getManager();
        
        $cotizacion = $em->getRepository('IncentivesSolicitudesBundle:Cotizacion')->find($id);

        $estado = $em->getRepository('IncentivesSolicitudesBundle:CotizacionesEstado')->find('2'); 

        $cotizacion->setEstado($estado);
        $em->persist($cotizacion);
        $em->flush();
        
        $this->correoAction($cotizacion->getId(), 'para ser aprobada');
        
        return $this->redirect($this->generateUrl('cotizaciones_datos')."/".$cotizacion->getId());
        
    }
    
    public function cancelarAction($id)
    {
        //lista para aprobar
        $em = $this->getDoctrine()->getManager();
        
        $cotizacion = $em->getRepository('IncentivesSolicitudesBundle:Cotizacion')->find($id);

        $estado = $em->getRepository('IncentivesSolicitudesBundle:CotizacionesEstado')->find('5'); 

        $cotizacion->setEstado($estado);
        $em->persist($cotizacion);
        $em->flush();
        
        $this->correoAction($cotizacion->getId(), 'cancelada');
        
        return $this->redirect($this->generateUrl('cotizaciones_datos')."/".$cotizacion->getId());
        
    }
    
    
    public function correoAction($id, $accion)
    {

        $em = $this->getDoctrine()->getManager();
        
        $cotizacion = $em->getRepository('IncentivesSolicitudesBundle:Cotizacion')->find($id);

	$solicitud = $cotizacion->getSolicitud();

        $solicitante = $solicitud->getSolicitante();

        $correos =  array('control@grupo-inc.com');
	array_push($correos, $solicitante->getEmail());
        
        $responsables = $em->getRepository('IncentivesSolicitudesBundle:SolicitudesAsignar')->findBySolicitud($solicitud->getId());
        foreach($responsables as $key => $value){
            array_push($correos, $value->getResponsable()->getEmail());
            
        }

        // Create the Transport
        $transport = \Swift_SmtpTransport::newInstance('mail.sociosyamigos.com', 25)
          ->setAuthMode('login')
          ->setUsername('pruebas@sociosyamigos.com')
          ->setPassword('7d7_r47@fqxo')
          ;

          $template = 'IncentivesSolicitudesBundle:Cotizaciones:email.txt.twig';
          $subjet = 'Notificación Cotización';
        
        // Create the Mailer using your created Transport
        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance()
            ->setSubject($subjet)
            ->setFrom(array('test@grupo-inc.com' => 'Grupo Inc'))
            //->setTo('manuelgb13@gmail.com')
            ->setTo($correos)
            
            ->setBody(
                $this->renderView(
                    $template,
                    array('cotizacion' => $cotizacion, 'accion' => $accion)
                )
            );
        
        //Send the message
        if($mailer->send($message)) {
            $this->get('session')->getFlashBag()->add('notice', 'El correo de alerta ha sido enviado correctamente');
        }else{
            $this->get('session')->getFlashBag()->add('notice', 'El correo de alerta no pudo ser enviado');
        }

    }

    public function exportarAction()
    {         
            $fp = fopen('php://temp','r+');

            // Header
            $row = array('Id','Consecutivo','Centro Costos','Solicitud','Titulo Solicitud','Fecha Creacion');
            
            $em = $this->getDoctrine()->getManager();

            $query = "SELECT r.id,r.consecutivo,r.fechaCreacion,s.id solicitud,s.titulo,c.nombre centroCostos
                    FROM Requisicion r
                    LEFT JOIN Solicitud s ON s.id=r.solicitud_id
                    LEFT JOIN CentroCostos c ON c.id=s.centroCostos_id;";
            
            $conn = $this->get('database_connection'); 
            $solicitudes = $conn->fetchAll($query, array(1));
           
            //echo "<pre>"; print_r($solicitudes); echo "</pre>";
            //exit;
            
            $ir = 0;
            foreach($solicitudes as $key => $value){              
               
               if($ir==0){
                   
                    fputcsv($fp,$row,';');
                }
               
                $ir++;
               
                $row = array();
                //Redencion, participante, producto
                $row[] = $value['id'];//1
                $row[] = $value['consecutivo'];//2
                $row[] = $value['centroCostos'];//3
                $row[] = $value['solicitud'];//4
                $row[] = $value['titulo'];//6
                $row[] = $value['fechaCreacion'];//5
                
                fputcsv($fp,$row,';');
            }

            rewind($fp);
            $csv = stream_get_contents($fp);
            fclose($fp);
            
            $filename = 'Requisiciones.csv';
            $response = new Response($csv);
            
            $response->headers->set('Content-Type', "text/csv");
            $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $filename));            
            
            return $response;

    }
    
    public function exportarProductosAction()
    {         
            $fp = fopen('php://temp','r+');

            // Header
            $row = array('Id','Requisicion','Solicitud','Centro de Costos','Fecha Modificación','Producto','Marca','Referencia','Cantidad','Valor Unitario','Total');
            
            $em = $this->getDoctrine()->getManager();

            $query = "SELECT rp.id,rp.cantidad,rp.valorunidad,rp.valortotal,rp.fechaModificacion,p.nombre producto,c.centrocostos centroCostos,p.marca,p.referencia,r.consecutivo requisicion,r.fechaCreacion,s.id solicitud
                    FROM RequisicionProducto rp
                    JOIN Requisicion r ON rp.requisicion_id=r.id
                    JOIN Solicitud s ON r.solicitud_id=s.id
                    JOIN CentroCostos c ON s.centroCostos_id=c.id
                    LEFT JOIN Producto p ON p.id=rp.producto_id;";
            
            $conn = $this->get('database_connection'); 
            $productos = $conn->fetchAll($query, array(1));

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
                $row[] = $value['requisicion'];//2
                $row[] = $value['solicitud'];//3
                $row[] = $value['centroCostos'];//3
                $row[] = $value['fechaModificacion'];//4
                $row[] = $value['producto'];//5
                $row[] = $value['marca'];//6
                $row[] = $value['referencia'];//7
                $row[] = $value['cantidad'];//8
                $row[] = number_format($value['valorunidad'], 2, ',', '');//9
                $row[] = number_format($value['valortotal'], 2, ',', '');//10
                
                fputcsv($fp,$row,';');
            }

            rewind($fp);
            $csv = stream_get_contents($fp);
            fclose($fp);
            
            $filename = 'Requisiciones_Productos.csv';
            $response = new Response($csv);
            
            $response->headers->set('Content-Type', "text/csv");
            $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $filename));            
            
            return $response;

    }

}

