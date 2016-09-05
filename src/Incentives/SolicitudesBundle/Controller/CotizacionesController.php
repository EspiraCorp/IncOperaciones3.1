<?php

namespace Incentives\SolicitudesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\SolicitudesBundle\Entity\Cotizacion;
use Incentives\SolicitudesBundle\Form\Type\CotizacionType;
use Incentives\SolicitudesBundle\Entity\CotizacionProducto;
use Incentives\SolicitudesBundle\Form\Type\CotizacionProductoType;
use Incentives\SolicitudesBundle\Form\Type\CotizacionProductoAgregarType;
use Incentives\SolicitudesBundle\Form\Type\CotizacionesProductoCantidadType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Dompdf\Dompdf;

ini_set('memory_limit','512M');

class CotizacionesController extends Controller
{
     /**
     * @Route("/listado")
     * @Template()
     */
    public function listadoAction()
    {
        $repository = $this->getDoctrine()->getRepository('IncentivesSolicitudesBundle:Cotizacion');
        $listado= $repository->findAll();
       
        return $this->render('IncentivesSolicitudesBundle:Cotizaciones:listado.html.twig', 
            array('listado' => $listado
        ));
    }
    
     public function nuevaAction(Request $request, $solicitud)
    {        
        $em = $this->getDoctrine()->getManager();
        $cotizaciones = $em->getRepository('IncentivesSolicitudesBundle:Cotizacion')->findAll();
        $cotizacion = new Cotizacion();
        $estado = $em->getRepository('IncentivesSolicitudesBundle:CotizacionesEstado')->find('1');

        $form = $this->createForm(CotizacionType::class, $cotizacion);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            //if ($form->isValid()) {
                
                $tipo = $em->getRepository('IncentivesOrdenesBundle:OrdenesTipo')->find("1");
                $cotizacion->setEstado($estado);
                $cotizacion->setConsecutivo(str_pad(count($cotizaciones)+1, 5, '0', STR_PAD_LEFT));
                
                if(isset($solicitud)){
                    $solicitudCt = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($solicitud);
                    $cotizacion->setSolicitud($solicitudCt);
                }
                
                $em->persist($cotizacion);

                $em->flush();

                $this->pdfAction($cotizacion->getId());
                $this->get('session')->getFlashBag()->add('notice', 'La cotizacion con consecutivo '.$cotizacion->getConsecutivo().' se creo correctamente');

                return $this->redirect($this->generateUrl('cotizaciones_datos')."/".$cotizacion->getId());
            //}
        }            

        return $this->render('IncentivesSolicitudesBundle:Cotizaciones:nueva.html.twig', array(
            'form' => $form->createView(), 'solicitud' => $solicitud,
        ));
    }
    
    public function editarAction(Request $request, $id)
    {        
        $em = $this->getDoctrine()->getManager();
        
        $cotizacion = $em->getRepository('IncentivesSolicitudesBundle:Cotizacion')->find($id);
        $form = $this->createForm(CotizacionType::class, $cotizacion);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                
                $em->persist($cotizacion);

                $em->flush();

                $this->pdfAction($cotizacion->getId());
                $this->get('session')->getFlashBag()->add('notice', 'La cotizacion con consecutivo '.$cotizacion->getConsecutivo().' se edito correctamente');

                return $this->redirect($this->generateUrl('cotizaciones_datos')."/".$cotizacion->getId());
            }
        }            

        return $this->render('IncentivesSolicitudesBundle:Cotizaciones:editar.html.twig', array(
            'form' => $form->createView(), 'id' => $id,
        ));
    }
    
    public function datosAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $ordenes = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
                
                if (0 != count($orden->getOrdenesProducto())) {
                    foreach ($orden->getOrdenesProducto() as $productos) {
                        
                        $qb = $em->createQueryBuilder(); 
                        $qb->select('p');
                        $qb->from('IncentivesRedencionesBundle:Productoprecio','p');
                        $str_filtro = "p.producto=".$productos->getProducto();
                        $str_filtro = " AND p.principal=1";
                        $qb->where($str_filtro);
                        $qb->groupBy('p.producto');
                        $precio = $qb->getQuery()->getResult();
                        
                        //$precio = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->findByProducto($productos->getProducto());
                        foreach ($precio as $key => $value) {
                            if ($value->getProveedor()->getId()==$ordenes->getProveedor()->getId()){
                                $productos->setValorunidad($value->getPrecio());
                                $productos->setValortotal($value->getPrecio()*(1+($value->getPrecio()/100))*$productos->getCantidad());
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

        $repository = $this->getDoctrine()
            ->getRepository('IncentivesSolicitudesBundle:Cotizacion');

        $repository2 = $this->getDoctrine()
            ->getRepository('IncentivesSolicitudesBundle:CotizacionProducto');

        $cotizacion= $repository->find($id);
        $productos= $repository2->findBy(array('cotizacion' => $cotizacion->getId()));
        
        $this->pdfAction($id);

        return $this->render('IncentivesSolicitudesBundle:Cotizaciones:datos.html.twig', 
            array( 'cotizacion' => $cotizacion, 'productos' => $productos,
        ));
    }    
     
    public function agregarProductoAction(Request $request, $id)
    {        
        $em = $this->getDoctrine()->getManager();
        $cotizacionproducto = new CotizacionProducto();

        $form = $this->createForm(CotizacionProductoAgregarType::class, $cotizacionproducto);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                
                $id = $request->request->all()['id'];
                $pro = $request->request->all()['cotizacion_producto_agregar'];
                
                $cotizacion = $em->getRepository('IncentivesSolicitudesBundle:Cotizacion')->find($id);
                $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find(1);
                $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($pro['producto']);
                $cotizacionproducto->setCantidad($pro["cantidad"]);
                $cotizacionproducto->setValorunidad($pro["valorunidad"]);
                $cotizacionproducto->setValortotal($pro["valorunidad"]/(1 - ($pro["incremento"]/100))*$pro["cantidad"]);
                $cotizacionproducto->setLogistica($pro["logistica"]);
                $cotizacionproducto->setIncremento($pro["incremento"]);
                $cotizacionproducto->setCotizacion($cotizacion);
                $cotizacionproducto->setEstado($estado);
                $cotizacionproducto->setProducto($producto);

                $em->persist($cotizacionproducto);
                $em->flush();

                $this->pdfAction($id);

                return $this->redirect($this->generateUrl('cotizaciones_datos').'/'.$id);

            }
        }           

        return $this->render('IncentivesSolicitudesBundle:Cotizaciones:agregarproducto.html.twig', array(
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
            $valores = $request->get('cotizacionesproducto');

            if ($form->isValid()) {

                //actualiza valores
                $productos->setCantidad($valores['cantidad']);
                $productos->setValorunidad($valores['valorunidad']);
                $productos->setValortotal($valores['valorunidad']*$valores['cantidad']);
                $productos->setLogistica($valores['logistica']);
                $productos->setValortotal($valores["valorunidad"]/(1 - ($valores["incremento"]/100))*$valores["cantidad"]);
                $productos->setIncremento($valores["incremento"]);
                
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
    
     public function aprobarProductoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $productos = $em->getRepository('IncentivesSolicitudesBundle:CotizacionProducto')->find($id);

        $cotizacion = $productos->getCotizacion()->getId();

        $form = $this->createForm(CotizacionesProductoCantidadType::class, $productos);
                    
        if ($request->isMethod('POST')) {
           // $form->handleRequest($request);
                $valores = $request->get('cotizacionesproducto');
                
                $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find(2);

                //actualiza valores
                $productos->setEstado($estado);
                $productos->setCantidad($valores['cantidad']);
                $productos->setValortotal($productos->getValorunidad()/(1-($productos->getIncremento()/100))*$valores['cantidad']);
                $em->persist($productos);
                $em->flush();
                
                $this->verificarEstadoAction($cotizacion);
                
                $this->correoAprobacionAction($id);

		        //$this->pdfAction($cotizacion);
		        
		        //Generar orden de compra
		        
		        //Buscar proveedor principal
		        /*$proveedorprincipal = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->findBy(array('producto' => $productos->getProducto()->getId(), 'principal' => 1));
		        echo $proveedorprincipal->getId();
		        if(isset($proveedorprincipal)){
		            //Buscar si hay orden para este proveedor y esta solicitud
		            $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->findBy(array('proveedor' => $proveedorprincipal->getProveedor()->getId(), 'solicitud' => $productos->getCotizacion()->getSolicitud()->getId(), 'estado' => 1));
		        
    		        //Si no hay crear orden
    		        if(!isset($orden)){
        		            
    		            $ordenes = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->findAll();
    		            $orden = new OrdenesCompra();
                        $productos = new OrdenesProducto();
                        $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('1');
                        $proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($proveedorprincipal->getProveedor()->getId());
                
                        $tipo = $em->getRepository('IncentivesOrdenesBundle:OrdenesTipo')->find("1");
                        $orden->setOrdenesTipo($tipo);
                        $orden->setProveedor($tipo);
                        $orden->setOrdenesEstado($estado);
                        $orden->setConsecutivo(str_pad(count($ordenes)+1, 3, '0', STR_PAD_LEFT)."-".date_create("now")->format('y'));
                        $solicitud = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($productos->getCotizacion()->getSolicitud()->getId());
                        $orden->setSolicitud($solicitud);
                
                        $em->persist($orden);
                
                        $em->flush();
                        $this->get('session')->getFlashBag()->add('notice', 'La orden con consecutivo '.$orden->getConsecutivo().' se creo correctamente');
                    }
    		        
    		        //Agregar productos
    		        
                    $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
                    $ordenproducto->setCantidad($valores["cantidad"]);
                    $ordenproducto->setValorunidad($productos->getValorunidad());
                    $ordenproducto->setOrdenesCompra($orden);
                    $ordenproducto->setEstado($estado);
                    $ordenproducto->setProducto($productos->getProducto());
    
                    $em->persist($ordenproducto);
                    $em->flush();    
		            
		        }*/

                return $this->redirect($this->generateUrl('cotizaciones_datos').'/'.$cotizacion);
        }          

        return $this->render('IncentivesSolicitudesBundle:Cotizaciones:aprobarproducto.html.twig', array(
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
    
    public function rechazarProductoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $productos = $em->getRepository('IncentivesSolicitudesBundle:CotizacionProducto')->find($id);

        $cotizacion = $productos->getCotizacion()->getId();

        $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find(3);

        //actualiza valores
        $productos->setEstado($estado);
        $em->persist($productos);

        $em->flush();
        
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

        $correos =  array('controloperaciones@inc-group.co');
	array_push($correos, $solicitante->getEmail());
        
        $responsables = $em->getRepository('IncentivesSolicitudesBundle:SolicitudesAsignar')->findBySolicitud($solicitud->getId());
        foreach($responsables as $key => $value){
            array_push($correos, $value->getResponsable()->getEmail());
            
        }

        // Create the Transport
        $transport = \Swift_SmtpTransport::newInstance('smtp.office365.com', 25, 'tls')
          ->setAuthMode('login')
          ->setUsername('operaciones@inc-group.co')
          ->setPassword('IncGroup2016!')
          ;

          $template = 'IncentivesSolicitudesBundle:Cotizaciones:emailAprobacion.txt.twig';
          $subjet = 'Nueva aprobación en cotización';
        
        // Create the Mailer using your created Transport
        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance()
            ->setSubject($subjet)
            ->setFrom(array('operaciones@inc-group.co' => 'Grupo Inc'))
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

        $correos =  array('controloperaciones@inc-group.co');
	array_push($correos, $solicitante->getEmail());
        
        $responsables = $em->getRepository('IncentivesSolicitudesBundle:SolicitudesAsignar')->findBySolicitud($solicitud->getId());
        foreach($responsables as $key => $value){
            array_push($correos, $value->getResponsable()->getEmail());
            
        }

        // Create the Transport
        $transport = \Swift_SmtpTransport::newInstance('smtp.office365.com', 25, 'tls')
          ->setAuthMode('login')
          ->setUsername('operaciones@inc-group.co')
          ->setPassword('IncGroup2016!')
          ;

          $template = 'IncentivesSolicitudesBundle:Cotizaciones:email.txt.twig';
          $subjet = 'Notificación Cotización';
        
        // Create the Mailer using your created Transport
        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance()
            ->setSubject($subjet)
            ->setFrom(array('operaciones@inc-group.co' => 'Grupo Inc'))
            //->setTo('manuelgb13@gmail.com')
            ->setTo($correos)
            
            ->setBody(
                $this->renderView(
                    $template,
                    array('cotizacion' => $cotizacion, 'accion' => $accion)
                )
            );

        try{
            //Send the message
            if($mailer->send($message)) {
                $this->get('session')->getFlashBag()->add('notice', 'El correo de alerta ha sido enviado correctamente');
            }else{
                $this->get('session')->getFlashBag()->add('notice', 'El correo de alerta no pudo ser enviado');
            }
        }catch(Swift_TransportException $e){
            $mailer->getTransport()->stop();
            sleep(10); // Just in case ;-)
        }

    }

    public function exportarAction()
    {         
            $fp = fopen('php://temp','r+');

            // Header
            $row = array('Id','Consecutivo','Centro Costos','Solicitud','Titulo Solicitud','Fecha Creacion','Logistica','Estado');
            
            $em = $this->getDoctrine()->getManager();

            $query = "SELECT c.id,c.consecutivo,c.fechaCreacion,c.logistica,s.id solicitud,cc.centrocostos centroCostos,s.titulo,e.nombre estado
                    FROM Cotizacion c
                    LEFT JOIN Solicitud s ON s.id=c.solicitud_id
                    LEFT JOIN CentroCostos cc ON cc.id=s.centroCostos_id
                    LEFT JOIN CotizacionesEstado e ON e.id=c.estado_id;";
            
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
                $row[] = $value['centroCostos'];//4
                $row[] = $value['solicitud'];//4
                $row[] = $value['fechaCreacion'];//5
                $row[] = $value['titulo'];//6
                $row[] = $value['logistica'];//7
                $row[] = $value['estado'];//8
                
                fputcsv($fp,$row,';');
            }

            rewind($fp);
            $csv = stream_get_contents($fp);
            fclose($fp);
            
            $filename = 'Cotizaciones.csv';
            $response = new Response($csv);
            
            $response->headers->set('Content-Type', "text/csv");
            $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $filename));            
            
            return $response;

    }
    
    public function exportarProductosAction()
    {         
            $fp = fopen('php://temp','r+');

            // Header
            $row = array('Id','Cotizacion','Solicitud','Fecha Modificación','Producto','Marca','Referencia','Cantidad','Valor Unitario','Total','Estado');
            
            $em = $this->getDoctrine()->getManager();

            $query = "SELECT cp.id,cp.cantidad,cp.valorunidad,cp.valortotal,cp.fechaModificacion,p.nombre producto,p.marca,p.referencia,ep.nombre estadoProducto,c.consecutivo cotizacion,cc.centrocostos centroCostos,c.fechaCreacion,ec.nombre estado,s.id solicitud
                    FROM CotizacionProducto cp
                    JOIN Cotizacion c ON cp.cotizacion_id=c.id
                    JOIN Solicitud s ON c.solicitud_id=s.id
                    JOIN CentroCostos cc ON cc.id=s.centroCostos_id
                    LEFT JOIN Producto p ON p.id=cp.producto_id
                    LEFT JOIN OrdenesEstado ep ON ep.id=cp.estado_id
                    LEFT JOIN OrdenesEstado ec ON ec.id=c.estado_id;";
            
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
                $row[] = $value['cotizacion'];//2
                $row[] = $value['solicitud'];//3
                $row[] = $value['centroCostos'];//4
                $row[] = $value['fechaModificacion'];//5
                $row[] = $value['producto'];//6
                $row[] = $value['marca'];//7
                $row[] = $value['referencia'];//8
                $row[] = $value['cantidad'];//9
                $row[] = number_format($value['valorunidad'], 2, ',', '');//10
                $row[] = number_format($value['valortotal'], 2, ',', '');//11
                $row[] = $value['estadoProducto'];//12
                
                fputcsv($fp,$row,';');
            }

            rewind($fp);
            $csv = stream_get_contents($fp);
            fclose($fp);
            
            $filename = 'Cotizaciones_Productos.csv';
            $response = new Response($csv);
            
            $response->headers->set('Content-Type', "text/csv");
            $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $filename));            
            
            return $response;

    }

}

