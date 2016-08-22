<?php

namespace Incentives\OperacionesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\OperacionesBundle\Entity\Convocatorias;
use Incentives\OperacionesBundle\Entity\ConvocatoriasProveedores;
use Incentives\OperacionesBundle\Entity\ConvocatoriasArchivos;
use Incentives\OperacionesBundle\Form\Type\ConvocatoriasType;
use Incentives\OperacionesBundle\Form\Type\ConvocatoriasEdicionType;
use Incentives\OperacionesBundle\Form\Type\ConvocatoriasProveedoresType;
use Incentives\OperacionesBundle\Form\Type\ConvocatoriasProveedorType;
use Incentives\OperacionesBundle\Form\Type\ConvocatoriasArchivosType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ConvocatoriasController extends Controller
{
    /**
     * @Route("/nueva")
     * @Template()
     */
    public function nuevaAction(Request $request, $solicitud=null)
    {

        $convocatoria = new Convocatorias();
        $proveedor = new ConvocatoriasProveedores();

        $form = $this->createForm(ConvocatoriasType::class, $convocatoria);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            //if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                    
                $pro=($request->request->get('convocatorias'));

                $convocatoria->setTitulo($pro["titulo"]);
                $convocatoria->setDescripcion($pro["descripcion"]);
                $convocatoria->setFechaInicio(new \DateTime($pro["fechaInicio"]));
                $convocatoria->setFechaFin(new \DateTime($pro["fechaFin"]));
                $estado = $em->getRepository('IncentivesOperacionesBundle:ConvocatoriasEstado')->find(1);
                $convocatoria->setEstado($estado);
                
                if(isset($solicitud)){
                    $solicitudC = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($solicitud);
                    $convocatoria->setSolicitud($solicitudC);
                }

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
                $convocatoria->setRuta($Dir);
                $convocatoria->setArchivo($nombreArchivo);

                if (0 != count($convocatoria->getConvocatoriasproveedores())) {
                    foreach ($convocatoria->getConvocatoriasproveedores() as $proveedor) {
                        $proveedor->setConvocatorias($convocatoria);
                        //$convocatoria->addConvocatoriasproveedore($proveedor);
                        $em->persist($proveedor);
                    }
                } 

                $em->persist($convocatoria);

                $em->flush();
                
                if (0 != count($convocatoria->getConvocatoriasproveedores())) {
                    foreach ($convocatoria->getConvocatoriasproveedores() as $proveedor) {
                        //$this->correoAconvocatoriaAction($convocatoria->getId(), $proveedor->getProveedor());
                    }
                } 

                //$this->enviarcorreoAction($usuario->getId());
                return $this->redirect($this->generateUrl('convocatorias_datos')."/".$convocatoria->getId());

                
            //}

        }

        return $this->render('IncentivesOperacionesBundle:Convocatorias:nueva.html.twig', array(
            'form' => $form->createView(), 'solicitud' => $solicitud,
        ));
    }

    /**
     * @Route("/editar")
     * @Template()
     */
    public function editarAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();

        $convocatoria = $em->getRepository('IncentivesOperacionesBundle:Convocatorias')->find($id);
        $proveedor = new ConvocatoriasProveedores();

        $form = $this->createForm(ConvocatoriasEdicionType::class, $convocatoria);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                    
                $pro=($request->request->get('convocatorias'));

                $convocatoria->setTitulo($pro["titulo"]);
                $convocatoria->setDescripcion($pro["descripcion"]);
                $convocatoria->setFechaInicio(new \DateTime($pro["fechaInicio"]));
                $convocatoria->setFechaFin(new \DateTime($pro["fechaFin"]));

                $estado = $em->getRepository('IncentivesOperacionesBundle:ConvocatoriasEstado')->find($pro["estado"]);
                $convocatoria->setEstado($estado);

                if($form["archivo"]->getData()){
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
                $convocatoria->setRuta($Dir);
                $convocatoria->setArchivo($nombreArchivo);

                }


                $em->persist($convocatoria);

                $em->flush();

                //$this->enviarcorreoAction($usuario->getId());
                return $this->redirect($this->generateUrl('convocatorias_datos').'/'.$id);

                
            }

        }

        return $this->render('IncentivesOperacionesBundle:Convocatorias:editar.html.twig', array(
            'form' => $form->createView(), 'convocatoria' => $convocatoria, 'id'=>$id
        ));
    }


    public function agregarproveedorAction(Request $request, $id)
    {
        // crea una task y le asigna algunos datos ficticios para este ejemplo
        

        $em = $this->getDoctrine()->getManager();
        if (isset($id)){
            $convocatoria = $em->getRepository('IncentivesOperacionesBundle:Convocatorias')->find($id);
        }else{
            $convocatoria = new Convocatoria();
        }
        $proveedor = new ConvocatoriasProveedores();

        $form = $this->createForm(ConvocatoriasProveedorType::class, $proveedor);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                $id=($request->request->get('id'));
                $convocatoria = $em->getRepository('IncentivesOperacionesBundle:Convocatorias')->find($id);
                $proveedor->setConvocatorias($convocatoria);
                //$convocatoria->addConvocatoriasproveedores($proveedor);
                $em->persist($proveedor);
                //$em->persist($convocatoria);           
                $em->flush();
            
                return $this->redirect($this->generateUrl('convocatorias_datos').'/'.$id);
                //return $this->render('IncentivesOperacionesBundle:Default:index.html.twig');
            }
        }            

        return $this->render('IncentivesOperacionesBundle:Convocatorias:nuevoproveedor.html.twig', array(
            'form' => $form->createView(), 'id'=>$id,
        ));
    }

    /**
     * @Route("/notificar")
     * @Template()
     */
    public function notificarAction()
    {
    }

    /**
     * @Route("/listado")
     * @Template()
     */
    public function listadoAction()
    {      
        $hoy = date("Y-m-d");
        
        if ($this->get('security.authorization_checker')->isGranted('ROLE_PROV')) {

            $proveedor =  $this->getUser()->getProveedor();
            $id = $proveedor->getId();

            $em = $this->getDoctrine()->getManager();

            $qb = $em->createQueryBuilder();
            $qb->select('c');
            $qb->from('IncentivesOperacionesBundle:Convocatorias','c');
            $qb->leftJoin('c.convocatoriasproveedores', 'cp');
            $condicion = " AND c.fechaFin >='".$hoy."'"; 
            $qb->where('cp.proveedor = :id'.$condicion." AND c.estado=1");
            $qb->setParameter('id', $id);
            $qb->orderBy('c.id', 'DESC');

            $listado = $qb->getQuery()->getResult();

        }else{

            $em = $this->getDoctrine()->getManager();

            $qb = $em->createQueryBuilder();
            $qb->select('c');
            $qb->from('IncentivesOperacionesBundle:Convocatorias','c');
            $qb->leftJoin('c.convocatoriasproveedores', 'cp');
            $condicion = " c.fechaFin >='".$hoy."'"; 
            $qb->where($condicion);
            $qb->orderBy('c.id', 'DESC');

            $listado = $qb->getQuery()->getResult();
        }

        return $this->render('IncentivesOperacionesBundle:Convocatorias:listado.html.twig', 
            array('listado' => $listado));
    }

    /**
     * @Route("/datos")
     * @Template()
     */
    public function datosAction($id)
    {
        $rootDir = dirname($this->container->getParameter('kernel.root_dir'));

        $repositoryc = $this->getDoctrine()
            ->getRepository('IncentivesOperacionesBundle:Convocatorias');

        $repositoryp = $this->getDoctrine()
            ->getRepository('IncentivesOperacionesBundle:ConvocatoriasProveedores');
            
        $repositorya = $this->getDoctrine()
            ->getRepository('IncentivesOperacionesBundle:ConvocatoriasArchivos');

        $convocatoria = $repositoryc->find($id);
        $proveedores = $repositoryp->findByConvocatorias($id);
        $archivos = $repositorya->findBy(array('convocatoria' => $id, 'estado' => 1));

         if ($this->get('security.authorization_checker')->isGranted('ROLE_PROV')) {
            $proveedor =  $this->getUser()->getProveedor();
            $id_prov = $proveedor->getId();

            $em = $this->getDoctrine()->getManager();

            /*$qb = $em->createQueryBuilder();
            $qb->select('c');
            $qb->from('IncentivesOperacionesBundle:Convocatorias','c');
            $qb->leftJoin('c.convocatoriasproveedores', 'cp');
            $qb->where('cp.proveedor = :id');
            $qb->setParameter('id', $id);

            $proveedores = $qb->getQuery()->getResult();*/

            $proveedores = $repositoryp->findBy(array('proveedor' => $id_prov, 'convocatorias' => $id));
        }

        return $this->render('IncentivesOperacionesBundle:Convocatorias:datos.html.twig', 
            array('convocatoria' => $convocatoria, 'proveedores' => $proveedores, 'archivos' => $archivos));
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

                $pro=($request->request->get('convocatoriasproveedores'));

                $convocatoria->setObservacion($pro["observacion"]);

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
        $transport = \Swift_SmtpTransport::newInstance('mail.sociosyamigos.com', 25)
          ->setAuthMode('login')
          ->setUsername('pruebas@sociosyamigos.com')
          ->setPassword('7d7_r47@fqxo')
          ;

        // Create the Mailer using your created Transport
        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance()
            ->setSubject('Nueva Convocatoria. Incentives Operaciones')
            ->setFrom(array('test@grupo-inc.com' => 'Grupo Inc'))
            ->setTo("manuelgb13@gmail.com")
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
    
    
    
    public function agregarArchivoAction(Request $request, $id)
    {
        $archivo= new ConvocatoriasArchivos();

        $form = $this->createForm(ConvocatoriasArchivosType::class, $archivo);

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
                
                $convocatoriaEnt = $em->getRepository('IncentivesOperacionesBundle:Convocatorias')->find($id);
                $archivo->setConvocatoria($convocatoriaEnt);
                
                $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
                $archivo->setEstado($estado);

                $em->persist($archivo);
                $em->flush();
                return $this->redirect($this->generateUrl('convocatorias_datos')."/".$id);
            }

        }

        return $this->render('IncentivesOperacionesBundle:Convocatorias:archivo.html.twig', array(
            'form' => $form->createView(), 'convocatoria' => $id,
        ));

    }
    
    public function archivoEstadoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $archivo = $em->getRepository('IncentivesOperacionesBundle:ConvocatoriasArchivos')->find($id);
        $convocatoria = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($archivo->getConvocatoria()->getId());

        if ($archivo->getEstado()->getId() == 1){
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(2);
            $archivo->setEstado($estado);
        }else{
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
            $archivo->setEstado($estado);
        }       
        $em->flush();
        
        return $this->redirect($this->generateUrl('convocatorias_datos')."/".$convocatoria->getId());
    }

}
