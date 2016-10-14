<?php

namespace Incentives\SolicitudesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\SolicitudesBundle\Entity\Solicitud;
use Incentives\SolicitudesBundle\Entity\SolicitudesAsignar;
use Incentives\SolicitudesBundle\Entity\SolicitudesArchivos;
use Incentives\SolicitudesBundle\Entity\SolicitudesObservaciones;
use Incentives\InventarioBundle\Entity\Despachos;
use Incentives\SolicitudesBundle\Form\Type\SolicitudType;
use Incentives\SolicitudesBundle\Form\Type\ArchivosType;
use Incentives\SolicitudesBundle\Entity\DespachoOrdenes;
use Incentives\SolicitudesBundle\Form\Type\SolicitudesAsignarType;
use Incentives\SolicitudesBundle\Form\Type\SolicitudesObservacionesType;
use Incentives\OperacionesBundle\Entity\Excel;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Cell_DataValidation;
use PHPExcel_Style_Fill;

ini_set('max_execution_time', 300); 
ini_set('memory_limit','512M');
ini_set("upload_max_filesize","20M");

class SolicitudesController extends Controller
{
    
    /**
     * @Route("/listado")
     * @Template()
     */
    public function listadoAction()
    {      
        $em = $this->getDoctrine()->getManager();

        if ($this->get('security.authorization_checker')->isGranted('ROLE_DIR') || $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $qb = $em->createQueryBuilder();
            $qb->select('s');
            $qb->from('IncentivesSolicitudesBundle:Solicitud','s');
        }elseif($this->get('security.authorization_checker')->isGranted('ROLE_EJEC') || $this->get('security.authorization_checker')->isGranted('ROLE_COM')){
			
			$usuario = $this->getUser()->getId();    
            $qb = $em->createQueryBuilder();
            $qb->select('s');
            $qb->from('IncentivesSolicitudesBundle:Solicitud','s');
            $qb->where("s.solicitante=".$usuario);
            
        }else{
            
            $usuario = $this->getUser()->getId();
            $qb = $em->createQueryBuilder();
            $qb->select('s');
            $qb->from('IncentivesSolicitudesBundle:Solicitud','s');
            $qb->Join('s.asignar','a');
            $qb->where("a.responsable=".$usuario);
        }

        $listado = $qb->getQuery()->getResult();

        return $this->render('IncentivesSolicitudesBundle:Solicitudes:listado.html.twig', 
            array('listado' => $listado));
    }
    
    /**
     * @Route("/nueva")
     * @Template()
     */
    public function nuevaAction(Request $request)
    {

        $solicitud = new Solicitud();

        $form = $this->createForm(SolicitudType::class, $solicitud);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                    
                $pro = $request->request->all();
                
                $tipo = $em->getRepository('IncentivesSolicitudesBundle:SolicitudTipo')->find($pro['solicitud']['tipo']);
                $estado = $em->getRepository('IncentivesSolicitudesBundle:SolicitudesEstado')->find(1);

                $solicitud->setTitulo($pro['solicitud']["titulo"]);
                $solicitud->setDescripcion($pro['solicitud']["descripcion"]);
                //$solicitud->setMantis($pro["mantis"]);
                $solicitud->setTipo($tipo);
                $solicitud->setEstado($estado);
                $solicitud->setFechaSolicitud(new \DateTime());

                $usuario = $this->container->get('security.token_storage')->getToken()->getUser();
                $solicitud->setSolicitante($usuario);

                $em->persist($solicitud);

                $em->flush();

                $this->correoAction($solicitud->getId(), 'creada');

                return $this->redirect($this->generateUrl('solicitudes_datos')."/".$solicitud->getId());

            }

        }

        return $this->render('IncentivesSolicitudesBundle:Solicitudes:nueva.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/editar")
     * @Template()
     */
    public function editarAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();

        $solicitud = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($id);
        $form = $this->createForm(SolicitudType::class, $solicitud);

        if ($request->isMethod('POST')) {

            $em = $this->getDoctrine()->getManager();
                    
            $pro = $request->request->all()['solicitud'];

            $tipo = $em->getRepository('IncentivesSolicitudesBundle:SolicitudTipo')->find($pro['tipo']);
            
            if(isset($pro["estado"])){
                $estado = $em->getRepository('IncentivesSolicitudesBundle:SolicitudesEstado')->find($pro["estado"]);
                $solicitud->setEstado($estado);
            }
            
            if(isset($pro["solicitante"])){
                $solicitante = $em->getRepository('IncentivesBaseBundle:Usuario')->find($pro["solicitante"]);
                $solicitud->setSolicitante($solicitante);
            }
            
            $centroCostos= $em->getRepository('IncentivesCatalogoBundle:CentroCostos')->find($pro["centroCostos"]);
            $solicitud->setCentroCostos($centroCostos);
            $solicitud->setTitulo($pro["titulo"]);
            $solicitud->setDescripcion($pro["descripcion"]);
            $solicitud->setTipo($tipo);

            $em->persist($solicitud);
            $em->flush();

            return $this->redirect($this->generateUrl('solicitudes_datos')."/".$solicitud->getId());

        }

        return $this->render('IncentivesSolicitudesBundle:Solicitudes:editar.html.twig', array(
            'form' => $form->createView(), 'solicitud' => $solicitud
        ));
    }

    /**
     * @Route("/datos")
     * @Template()
     */
    public function datosAction($id)
    {

        $repositoryc = $this->getDoctrine()
            ->getRepository('IncentivesSolicitudesBundle:Solicitud');
        $solicitud = $repositoryc->find($id);
        
        $repository = $this->getDoctrine()
            ->getRepository('IncentivesOperacionesBundle:Convocatorias');
        $convocatorias = $repository->findBySolicitud($id);
        
        $repositoryCt = $this->getDoctrine()
            ->getRepository('IncentivesSolicitudesBundle:Cotizacion');
        $cotizaciones = $repositoryCt->findBySolicitud($id);
        
        $repositoryCt = $this->getDoctrine()
            ->getRepository('IncentivesSolicitudesBundle:Requisicion');
        $requisiciones = $repositoryCt->findBySolicitud($id);
        
        $repositoryCt = $this->getDoctrine()
            ->getRepository('IncentivesOrdenesBundle:OrdenesCompra');
        $ordenes = $repositoryCt->findBySolicitud($id);
        
        $repositoryCt = $this->getDoctrine()
            ->getRepository('IncentivesSolicitudesBundle:SolicitudesAsignar');
        $responsables = $repositoryCt->findBySolicitud($id);

        $repositoryP = $this->getDoctrine()
            ->getRepository('IncentivesInventarioBundle:Planilla');
        $planillas = $repositoryP->findBySolicitud($id);
        
        $repositoryA = $this->getDoctrine()
            ->getRepository('IncentivesSolicitudesBundle:SolicitudesArchivos');
        $archivos = $repositoryA->findBy(array('solicitud' => $id, 'tipo' => array(1,2)));//tipo 1 archivos complementarios a la solictud, 2 ordenes despacho antiguas
        
        $repositoryA = $this->getDoctrine()
            ->getRepository('IncentivesSolicitudesBundle:DespachoOrdenes');
        $ordenesDespacho = $repositoryA->findBy(array('solicitud' => $id));//tipo 2 ordens despacho

        $repositoryA = $this->getDoctrine()
            ->getRepository('IncentivesSolicitudesBundle:SolicitudesArchivos');
        $preoctizaciones = $repositoryA->findBy(array('solicitud' => $id, 'tipo' => 3));//tipo 3 precotizaciones
        
        $repositoryOb = $this->getDoctrine()
            ->getRepository('IncentivesSolicitudesBundle:SolicitudesObservaciones');
        $observaciones = $repositoryOb->findBySolicitud($id);

        return $this->render('IncentivesSolicitudesBundle:Solicitudes:datos.html.twig', 
            array('solicitud' => $solicitud, 'convocatorias' => $convocatorias, 'planillas' => $planillas, 
            'cotizaciones' => $cotizaciones, 'requisiciones' => $requisiciones, 'ordenes' => $ordenes, 'responsables' => $responsables,
            'archivos' => $archivos, 'ordenesDespacho' => $ordenesDespacho, 'precotizaciones' => $preoctizaciones, 'observaciones' => $observaciones));
    }

    /**
     * @Route("/proveedor")
     * @Template()
     */
    public function cargaProveedorAction(Request $request, $id)
    {
        $proveedor =  $this->getUser()->getProveedor();
        $id_prov = $proveedor->getId();

        $em = $this->getDoctrine()->getManager();
        $convocatoria = $em->getRepository('IncentivesOperacionesBundle:ConvocatoriasProveedores')->findAll();

        $form = $this->createForm(ConvocatoriasProveedoresType::class);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {

                $repositoryp = $this->getDoctrine()
                    ->getRepository('IncentivesOperacionesBundle:ConvocatoriasProveedores');
                $convocatoria = $repositoryp->findOneBy(array('proveedor' => $id_prov, 'convocatorias' => $id));

                $pro = $request->request->all();

                $convocatoria->setObservacion($pro['convocatoriasproveedores']['observacion']);

                $file = $form["archivo"]->getData();
                
                $rootDir = dirname($this->container->getParameter('kernel.root_dir'));
                $Dir = '/web/Proveedores/'.$proveedor->getNumeroDocumento().'/Convocatorias/';
                $uploadDir = $rootDir.$Dir;

                $nombreArchivo =  $file->getClientOriginalName();
                $file->move($uploadDir,$nombreArchivo);
                
                $convocatoria->setRuta($Dir);
                $convocatoria->setArchivo($nombreArchivo);

                $convocatoria->setfechaCarga(new \DateTime("now"));

                $em->persist($convocatoria);

                $em->flush();

               return $this->redirect($this->generateUrl('convocatorias_datos').'/'.$id);
            }

        }

        return $this->render('IncentivesOperacionesBundle:Convocatorias:cargaproveedor.html.twig', array(
            'form' => $form->createView(), 'id' => $id
        ));

    }

    public function correoAconvocatoriaAction($id, $id_prov)
    {

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb->select('u');
        $qb->from('IncentivesBaseBundle:Usuario','u');
        $qb->where('u.proveedor = :id');
        $qb->setParameter('id', $id_prov);

        $usuario = $qb->getQuery()->getSingleResult();

        $convocatoria = $em->getRepository('IncentivesOperacionesBundle:Convocatorias')->find($id);

        // Create the Transport
        $transport = \Swift_SmtpTransport::newInstance('smtp.office365.com', 587, 'tls')
          ->setAuthMode('login')
          ->setUsername('operaciones@inc-group.co')
          ->setPassword('IncGroup2016!')
          ;

        // Create the Mailer using your created Transport
        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance()
            ->setSubject('Nueva Convocatoria. Incentives Operaciones')
            ->setFrom(array('operaciones@inc-group.co' => 'Grupo Inc'))
            ->setTo('controloperaciones@inc-group.co')
            ->setBody(
                $this->renderView(
                    'IncentivesOperacionesBundle:Convocatorias:aconvocatoria.txt.twig',
                    array('usuario' => $usuario, 'convocatoria' => $convocatoria)
                )
            )
        ;
        
        // Send the message
        if($mailer->send($message)) {
            $this->get('session')->getFlashBag()->add('notice', 'El correo de notificación ha sido enviado correctamente');
        }else{
            $this->get('session')->getFlashBag()->add('notice', 'El mensaje no pudo ser enviado');
        }

        return $this->redirect($this->generateUrl('convocatorias_datos').'/'.$id);
    }
    
     /**
     * @Route("/proveedor")
     * @Template()
     */
    public function asignarSolicitudAction(Request $request, $solicitud)
    {
        $asignacion = new SolicitudesAsignar();

        $form = $this->createForm(SolicitudesAsignarType::class, $asignacion);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                
                $pro = $request->request->all()['solicitudes_asignar'];
                
                $usuario = $em->getRepository('IncentivesBaseBundle:Usuario')->find($pro['responsable']);
                $solicitudEnt = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($solicitud);
                $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);

                $asignacion->setResponsable($usuario);
                $asignacion->setSolicitud($solicitudEnt);
                $asignacion->setEstado($estado);

                $em->persist($asignacion);
                $em->flush();
                
                $this->correoAction($solicitudEnt->getId(), 'asignada');
                
                return $this->redirect($this->generateUrl('solicitudes_datos')."/".$solicitud);
            }

        }

        return $this->render('IncentivesSolicitudesBundle:Solicitudes:asignar.html.twig', array(
            'form' => $form->createView(), 'solicitud' => $solicitud,
        ));

    }
    
     public function agregarArchivoAction(Request $request, $solicitud)
    {
        $archivo= new SolicitudesArchivos();

        $form = $this->createForm(ArchivosType::class, $archivo);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            //if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();                    
                    
                //Archivo
                $file = $form["archivo"]->getData();
                
                $extension = $file->guessExtension();

                $rootDir = dirname($this->container->getParameter('kernel.root_dir'));
                $Dir = '/web/Archivos/Convocatorias/';
                $uploadDir = $rootDir.$Dir;

                $nombreArchivo =  $file->getClientOriginalName();
                $file->move($uploadDir,$nombreArchivo);
                $archivo->setArchivo($Dir.$nombreArchivo);
                
                $solicitudEnt = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($solicitud);
                $archivo->setSolicitud($solicitudEnt);
                $archivo->setTipo(1);
                
                $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
                $archivo->setEstado($estado);

                $em->persist($archivo);
                $em->flush();

                return $this->redirect($this->generateUrl('solicitudes_datos')."/".$solicitud);
            //}

        }

        return $this->render('IncentivesSolicitudesBundle:Solicitudes:archivo.html.twig', array(
            'form' => $form->createView(), 'solicitud' => $solicitud,
        ));

    }
    
     public function agregarOrdenesDespachoAction(Request $request, $solicitud)
    {
        $archivo= new SolicitudesArchivos();

        $form = $this->createForm(ArchivosType::class, $archivo);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                    
                    
                //Archivo
                $file = $form["archivo"]->getData();
                
                $extension = $file->guessExtension();
                if (!$extension) {
                    // extension cannot be guessed
                    $extension = 'bin';
                }

                $rootDir = dirname($this->container->getParameter('kernel.root_dir'));
                $Dir = '/web/Archivos/Convocatorias/';
                $uploadDir = $rootDir.$Dir;

                $nombreArchivo =  $file->getClientOriginalName();
                $file->move($uploadDir,$nombreArchivo);
                $archivo->setArchivo($Dir.$nombreArchivo);
                
                $solicitudEnt = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($solicitud);
                $archivo->setSolicitud($solicitudEnt);
                $archivo->setTipo(2);
                
                $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
                $archivo->setEstado($estado);

                $em->persist($archivo);
                $em->flush();
                return $this->redirect($this->generateUrl('solicitudes_datos')."/".$solicitud);
            }

        }

        return $this->render('IncentivesSolicitudesBundle:Solicitudes:ordenesDespacho.html.twig', array(
            'form' => $form->createView(), 'solicitud' => $solicitud,
        ));

    }
    
     public function agregarPrecotizacionAction(Request $request, $solicitud)
    {
        $archivo= new SolicitudesArchivos();

        $form = $this->createForm(ArchivosType::class, $archivo);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                    
                    
                //Archivo
                $file = $form["archivo"]->getData();
                
                $extension = $file->guessExtension();
                if (!$extension) {
                    // extension cannot be guessed
                    $extension = 'bin';
                }

                $rootDir = dirname($this->container->getParameter('kernel.root_dir'));
                $Dir = '/web/Archivos/Convocatorias/';
                $uploadDir = $rootDir.$Dir;

                $nombreArchivo =  $file->getClientOriginalName();
                $file->move($uploadDir,$nombreArchivo);
                $archivo->setArchivo($Dir.$nombreArchivo);
                
                $solicitudEnt = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($solicitud);
                $archivo->setSolicitud($solicitudEnt);
                $archivo->setTipo(3);
                
                $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
                $archivo->setEstado($estado);

                $em->persist($archivo);
                $em->flush();
                
                 $this->correoAction($solicitud, ' tiene una nueva precotización cargada.');
                 
                return $this->redirect($this->generateUrl('solicitudes_datos')."/".$solicitud);
            }

        }

        return $this->render('IncentivesSolicitudesBundle:Solicitudes:precotizacion.html.twig', array(
            'form' => $form->createView(), 'solicitud' => $solicitud,
        ));

    }
    
     public function archivoEstadoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $archivo = $em->getRepository('IncentivesSolicitudesBundle:SolicitudesArchivos')->find($id);
        $solicitud = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($archivo->getSolicitud()->getId());

        if ($archivo->getEstado()->getId() == 1){
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(2);
            $archivo->setEstado($estado);
        }else{
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
            $archivo->setEstado($estado);
        }       
        $em->flush();
        
        return $this->redirect($this->generateUrl('solicitudes_datos')."/".$solicitud->getId());
    }

     public function despachoEstadoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $ordenDespacho = $em->getRepository('IncentivesSolicitudesBundle:DespachoOrdenes')->find($id);
        $solicitud = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($ordenDespacho->getSolicitud()->getId());

        if ($ordenDespacho->getEstado()->getId() == 1){
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(2);
            $ordenDespacho->setEstado($estado);
        }else{
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
            $ordenDespacho->setEstado($estado);
        }       
        $em->flush();
        
        return $this->redirect($this->generateUrl('solicitudes_datos')."/".$solicitud->getId());
    }


    public function cerrarAction($id){
        
        $em = $this->getDoctrine()->getManager();
        $solicitud = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($id);

        $estado = $em->getRepository('IncentivesSolicitudesBundle:SolicitudesEstado')->find('5'); 

        $solicitud->setEstado($estado);
        $em->persist($solicitud);
        $em->flush();
        
        $this->correoAction($solicitud->getId(), 'Cerrada');
        
        return $this->redirect($this->generateUrl('solicitudes_datos')."/".$solicitud->getId());
    }
    
    public function cancelarAction($id){
        
        $em = $this->getDoctrine()->getManager();
        $solicitud = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($id);

        $estado = $em->getRepository('IncentivesSolicitudesBundle:SolicitudesEstado')->find('3'); 

        $solicitud->setEstado($estado);
        $em->persist($solicitud);
        $em->flush();
        
        $this->correoAction($solicitud->getId(), 'Cancelada');
        
        return $this->redirect($this->generateUrl('solicitudes_datos')."/".$solicitud->getId());
    }
    
    public function AceptarAction($id){
        
        $em = $this->getDoctrine()->getManager();
        $solicitud = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($id);

        $estado = $em->getRepository('IncentivesSolicitudesBundle:SolicitudesEstado')->find('2'); 

        $solicitud->setEstado($estado);
        $em->persist($solicitud);
        $em->flush();
        
        $this->correoAction($solicitud->getId(), 'Aprobada');
        
        return $this->redirect($this->generateUrl('solicitudes_datos')."/".$solicitud->getId());
    }
    
    public function correoAction($idSolicitud, $accion)
    {

        $em = $this->getDoctrine()->getManager();

        $solicitud = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($idSolicitud);
        $solicitante = $solicitud->getSolicitante();

        $correos =  array('controloperaciones@inc-group.co');
	   array_push($correos, $solicitante->getEmail());
        
        $responsables = $em->getRepository('IncentivesSolicitudesBundle:SolicitudesAsignar')->findBySolicitud($idSolicitud);
        foreach($responsables as $key => $value){
            array_push($correos, $value->getResponsable()->getEmail());
            
        }

        // Create the Transport
        $transport = \Swift_SmtpTransport::newInstance('smtp.office365.com', 587, 'tls')
          ->setAuthMode('login')
          ->setUsername('operaciones@inc-group.co')
          ->setPassword('IncGroup2016!')
          //->setSourceIp('x.x.x.x') //replace x with your ip address
          ->setLocalDomain('inc-group.co');

        $template = 'IncentivesSolicitudesBundle:Solicitudes:email.txt.twig';
        $subjet = 'Solicitudes - Notificación';
        
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
                    array('solicitud' => $solicitud, 'accion' => $accion)
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
    
    public function observacionesAction(Request $request, $id)
    {
        $observacion = new SolicitudesObservaciones();
        $form = $this->createForm(SolicitudesObservacionesType::class, $observacion);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $pro = $request->request->all()['solicitudes_observaciones'];

                $solicitudEnt = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($id);
                $observacion->setSolicitud($solicitudEnt);
                $observacion->setObservacion($pro['observacion']);

                $em->persist($observacion);
                $em->flush();
                
                $this->correoAction($solicitudEnt->getId(), 'comentario: <br>'.$pro['observacion']);
                
                return $this->redirect($this->generateUrl('solicitudes_datos')."/".$id);
            }

        }

        return $this->render('IncentivesSolicitudesBundle:Solicitudes:observaciones.html.twig', array(
            'form' => $form->createView(), 'solicitud' => $id,
        ));

    }
    
     public function cargardespachosAction(Request $request, $solicitud)
    {
        $excelForm = new Excel();
        $form = $this->createFormBuilder($excelForm)
            ->setAction($this->generateUrl('solicitudes_cargardespachos'))
            ->setMethod('POST')
            ->add('excel', FileType::class)
            ->add('cargar', SubmitType::class)
            ->getForm();
            
        if ($request->isMethod('POST')) {
            

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $archivo= new DespachoOrdenes();
                $em->persist($archivo);
                
                $file = $form["excel"]->getData();
                $excel = $file;
    
                $objPHPExcel = PHPExcel_IOFactory::load($excel);
                $sheetData = $objPHPExcel->getSheet()->toArray(null,true,true,true);
    
                $worksheet  = $objPHPExcel->setActiveSheetIndex('0');
    
                $fila=1;
                $error = 0;
                foreach ($sheetData as $row) {
                    
                    if($fila > 1 && $row['A']!="" && $row['R']!=""){
                        
                        $despacho[$fila] = new Despachos();
                        
                        $despacho[$fila]->setDocumento($row['R']);
                        $despacho[$fila]->setNombre($row['A']);
                        $despacho[$fila]->setObservaciones($row['P']);
                        $despacho[$fila]->setCiudadNombre($row['F']);
                        $despacho[$fila]->setDireccion($row['D']);
                        $despacho[$fila]->setBarrio($row['E']);
                        $despacho[$fila]->setTelefono($row['Q']);
                        $despacho[$fila]->setCelular("");
                        $despacho[$fila]->setDepartamentoNombre($row['G']);
                        $despacho[$fila]->setNombreContacto($row['B']);
                        $despacho[$fila]->setDocumentoContacto($row['B']);
                        $despacho[$fila]->setCiudadContacto("");
                        $despacho[$fila]->setDireccionContacto("");
                        $despacho[$fila]->setBarrioContacto("");
                        $despacho[$fila]->setTelefonoContacto("");
                        $despacho[$fila]->setCelularContacto("");
                        $despacho[$fila]->setDepartamentoContacto("");
                        $despacho[$fila]->setOrdendespacho($archivo);
                        
                        $solicitudEnt = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($solicitud);
                        $despacho[$fila]->setSolicitud($solicitudEnt);
                        
                        if($row['J']!=""){
                            $qb = $em->createQueryBuilder();
                            $qb->select('p');
                            $qb->from('IncentivesCatalogoBundle:Producto','p');
                            $qb->where('p.codInc = :cod');
                            $qb->setParameter('cod', $row['J']);
                            $producto = $qb->getQuery()->getSingleResult();
                            
                            $despacho[$fila]->setProducto($producto);
                        }
                        
                        $despacho[$fila]->setCantidad($row['L']);
                                
                        $em->persist($despacho[$fila]);
    
                    }else{
                        if($fila>1){
                            $this->get('session')->getFlashBag()->add('warning', 'La información de la fila  '.$fila.' se encuentra incompleta.');
                            $error = 1;
                        }
                    }
                    $fila=$fila+1;
                }
                
                //Archivo
                
                $extension = $file->guessExtension();
                if (!$extension) {
                    // extension cannot be guessed
                    $extension = 'bin';
                }

                $rootDir = dirname($this->container->getParameter('kernel.root_dir'));
                $Dir = '/web/Archivos/Convocatorias/';
                $uploadDir = $rootDir.$Dir;

                $nombreArchivo =  $file->getClientOriginalName();
                $file->move($uploadDir,$nombreArchivo);
                $archivo->setArchivo($Dir.$nombreArchivo);
                
                $solicitudEnt = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($solicitud);
                $archivo->setSolicitud($solicitudEnt);

                $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
                $archivo->setEstado($estado);

                $em->persist($archivo);
                $em->flush();
            
                if($error==0){
                    $this->get('session')->getFlashBag()->add('notice', 'Las información se cargo de forma exitosa.');
                }
            }
            
            return $this->redirect($this->generateUrl('solicitudes_datos')."/".$solicitud);
        }

        return $this->render('IncentivesSolicitudesBundle:Solicitudes:cargardespachos.html.twig', array(
            'form' => $form->createView(), 'solicitud' => $solicitud));

    }

    public function exportarAction()
    {         
            $fp = fopen('php://temp','r+');

            // Header
            $row = array('Id','Centro Costos','Fecha Solicitud','Titulo','Descripción','Tipo','Solicitante','Estado');
            
            $em = $this->getDoctrine()->getManager();

            $query = "SELECT s.id,s.titulo,s.descripcion,s.fecha_solicitud,s.fechaModificacion,c.centrocostos centroCostos,e.nombre estado,t.nombre tipo,u.nombre solicitante
                    FROM Solicitud s
                    LEFT JOIN CentroCostos c ON c.id=s.centroCostos_id
                    LEFT JOIN OrdenesEstado e ON e.id=s.estado_id
                    LEFT JOIN SolicitudTipo t ON t.id=s.tipo_id
                    LEFT JOIN Usuarios u ON u.id=s.solicitante_id;";
            
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
                $row[] = $value['centroCostos'];//2
                $row[] = $value['fecha_solicitud'];//3
                $row[] = $value['titulo'];//4
                $row[] = $value['descripcion'];//5
                $row[] = $value['tipo'];//6
                $row[] = $value['solicitante'];//6
                $row[] = $value['estado'];//7
                
                fputcsv($fp,$row,';');
            }

            rewind($fp);
            $csv = stream_get_contents($fp);
            fclose($fp);
            
            $filename = 'Solicitudes.csv';
            $response = new Response($csv);
            
            $response->headers->set('Content-Type', "text/csv");
            $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $filename));            
            
            return $response;

    }

}
