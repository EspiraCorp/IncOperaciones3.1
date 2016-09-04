<?php

namespace Incentives\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

// use Acme\operacionesBundle\Form\Type\RegistrationType;
use Incentives\BaseBundle\Form\Type\UserType;
// use Incentives\BaseBundle\Form\Model\Registration;
use Incentives\BaseBundle\Entity\Usuario;
use Incentives\BaseBundle\Form\Type\PassType;

use Symfony\Component\Security\Core\SecurityContext;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UsuariosController extends Controller
{
    
    public function listadoAction(Request $request)
    {
            $form = $this->createForm(UserType::class);
            
            $em = $this->getDoctrine()->getManager();
            
            $session = $this->get('session');
            
            $page = $request->get('page');
            if(!$page) $page= 1;
            
            if($pro = $request->request->get('usuario')){
                $page = 1;
                $session->set('filtros_usuarios', $pro);
            }

            $sqlFiltro = " 1=1 ";

            if($filtros = $session->get('filtros_usuarios')){
               
               foreach($filtros as $Filtro => $valueF){
                   
                   if($valueF!=""){
                       if($Filtro=="grupos"){
                            $sqlFiltro .= " AND g.id IN (".implode(",", $valueF).")";
                       }elseif($Filtro=="proveedor"){
                            $sqlFiltro .= " AND p.id=".$valueF."";
                       }elseif($Filtro=="cliente"){
                            $sqlFiltro .= " AND c.id=".$valueF."";
                       }else{
                            $sqlFiltro .= " AND u.".$Filtro." LIKE '%".$valueF."%'";
                       }
                       
                   }
               } 
                
            }

            $query = $em->createQueryBuilder()
                ->select('u','g', 'c','p') 
                ->from('IncentivesBaseBundle:Usuario', 'u')
                ->leftJoin('u.grupos','g')
                ->leftJoin('u.cliente', 'c')
                ->leftJoin('u.proveedor', 'p')
                ->where($sqlFiltro);
        
        /*if($request->get('sort')){
            $query->orderBy($request->get('sort'), $request->get('direction'));    
        }else{
            $query->orderBy("g.nombre", "ASC");    
        }*/

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $page/*page number*/,
            50 /*limit per page*/
        );
             
        return $this->render('IncentivesBaseBundle:Usuarios:listado.html.twig', 
            array('listado' => $pagination, 'form' => $form->createView(), 'filtros' => $filtros));
    }

    public function nuevoAction(Request $request)
  	{
  	    $em = $this->getDoctrine()->getManager();

        $usuario = new Usuario();
  //       $usuario->setSalt('');

  	    //$form = $this->createForm(new RegistrationType(), new Registration());
        $form = $this->createForm(UserType::class, $usuario);
  	    $form->handleRequest($request);

  	    if ($form->isValid()) {
  	        $registration = $form->getData();

  	        $em->persist($usuario);
  	        $em->flush();

  	        // return $this->redirect(...);
            // $grupo=$form['groups']->getData();
            
  	        return $this->redirect($this->generateUrl('usuarios'));
  	    }

  	    return $this->render(
  	        'IncentivesBaseBundle:Usuarios:nuevo.html.twig',
  	        array('form' => $form->createView())
  	    );
  	}

	public function editarAction(Request $request, $id)
  	{
  	    $em = $this->getDoctrine()->getManager();

        $usuario = $em->getRepository('IncentivesBaseBundle:Usuario')->find($id);
        $form = $this->createForm(UserType::class, $usuario);
                    
            if ($request->isMethod('POST')) {
                
                $form->handleRequest($request);

                if ($form->isValid()) {
                    if(isset($pro['password']['first']) && $pro['password']['first']!=""){
                      $usuario->setPassword($pro['password']['first']);
                    }
                    
                    $em->persist($usuario);
                    $em->flush();
                }

                return $this->redirect($this->generateUrl('usuarios'));
            }    

        return $this->render(
            'IncentivesBaseBundle:Usuarios:editar.html.twig',
            array('form' => $form->createView(), 'id' => $id)
        );
    }

    public function nombreAction (){

      if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $userName =  $this->getUser()->getNombre();
      }else{
         $userName = 'User';
      }

      return $this->render('IncentivesBaseBundle:Usuarios:nombre.html.twig', 
        array('userName' => $userName));
    }

    public function recordarAction(Request $request)
    {
        $session = $request->getSession();

        $error="";

        if($request->request->all()){

          $email = $request->request->all()['email'];

          $em = $this->getDoctrine()->getManager();

          $qb = $em->createQueryBuilder();
          $qb->select('u');
          $qb->from('IncentivesBaseBundle:Usuario','u');
          $qb->where("u.email LIKE '".$email."'");

          $usuario = $qb->getQuery()->getOneOrNullResult();

          if($usuario){
            $this->correoIngresoAction($usuario->getId());
            return $this->redirect($this->generateUrl('login'));
          }else{
            $error['message']="Usuario no encontrado";
          }
        }

        return $this->render(
            'IncentivesBaseBundle:Usuarios:recordar.html.twig',
            array(
                // last username entered by the user
                'error'         => $error,
            )
        );
    }

    public function correoIngresoAction($id)
    {

      $em = $this->getDoctrine()->getManager();

      $qb = $em->createQueryBuilder();
      $qb->select('u');
      $qb->from('IncentivesBaseBundle:Usuario','u');
      $qb->where('u.id = :id');
      $qb->setParameter('id', $id);

      $usuario = $qb->getQuery()->getSingleResult();


      // Create the Transport
    $transport = \Swift_SmtpTransport::newInstance('smtp.office365.com', 25, 'tls')
          ->setAuthMode('login')
          ->setUsername('operaciones@inc-group.co')
          ->setPassword('IncGroup2016!')
          ;

    // Create the Mailer using your created Transport
    $mailer = \Swift_Mailer::newInstance($transport);

      $message = \Swift_Message::newInstance()
          ->setSubject('Datos de Acceso. Incentives Operaciones')
          ->setFrom('operaciones@inc-group.co')
          ->setTo($usuario->getEmail())
          ->setBody(
              $this->renderView(
                  'IncentivesBaseBundle:Usuarios:email.txt.twig',
                  array('usuario' => $usuario)
              )
          )
      ;
      
      // Send the message
      if($mailer->send($message)) {
        $this->get('session')->getFlashBag()->add('notice', 'El enlace para cambio de contraseña ha sido enviado correctamente.');
      }else{
        $this->get('session')->getFlashBag()->add('notice', 'El mensaje no pudo ser enviado.');
      }

    }

    public function actualizarpasswordAction(Request $request, $id, $token)
    {
      $em = $this->getDoctrine()->getManager();

      $form = $this->createForm(PassType::class);
      
      $error = array();

      if (isset($id)){
        $usuario = $em->getRepository('IncentivesBaseBundle:Usuario')->find($id);
       
        if (isset($usuario)){
          $error['message'] = "";

          if ($usuario->getPassword()!=$token){
            $error['message'] = 'Error en el token recibido';
          }
        }

      }else{
        $error['message'] = 'No se encontro el usuario';
      }

      if (isset($id) && $request->isMethod('POST')) {
        
        $form->handleRequest($request);

          $pro = $request->request->all()['pass'];
          $id = $request->request->all()['id'];

          $password = $pro['password'];
          
          //print_r(sha1($pro['password']['first'].'{'.$usuario->getSalt().'}')); exit;

          if ($password['first']==$password['second']){

            $usuario->setPassword($password['first']);
            
            $em->persist($usuario);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'La contraseña se actualizo correctamente.');

            return $this->redirect($this->generateUrl('login'));

          }else{

            $error['message'] = 'Las contraseñas no coinciden.';
          }         
      }

      return $this->render('IncentivesBaseBundle:Usuarios:pass.html.twig', array(
                'form' => $form->createView(), 'id' => $id, 'token' => $token, 'error' => $error
            ));
  }

}
