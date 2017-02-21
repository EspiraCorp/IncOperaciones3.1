<?php

namespace Incentives\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CorreosController extends Controller
{
    public function indexAction()
    {
        return $this->render('IncentivesBaseBundle:Default:index.html.twig');
    }

    public function correoEnviarAction()
    {
        $em = $this->getDoctrine()->getManager();


        $correos =  array('manuelgb13@gmail.com');        

        // Create the Transport
        $transport = \Swift_SmtpTransport::newInstance('email-smtp.us-east-1.amazonaws.com', 587, 'tls')
          ->setAuthMode('login')
          ->setUsername('AKIAJAETNFKDQJKWT64Q')
          ->setPassword('Aq29dWq2pKC+XhNaMGa1kG+vwjmNKBxbz7JJ4R1cRqjt')
          ->setLocalDomain('inc-group.co');

        $template = 'IncentivesSolicitudesBundle:Solicitudes:email.txt.twig';
        $subjet = 'Solicitudes - Notificación';
        
        // Create the Mailer using your created Transport
        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance()
            ->setSubject($subjet)
            ->setFrom(array('operaciones@inc-group.co' => 'Grupo Inc'))
            ->setTo($correos)
            
            ->setBody('prueba');

        try{
            //Send the message
            if($mailer->send($message)) {
                $this->get('session')->getFlashBag()->add('notice', 'El correo ha sido enviado correctamente.');
            }else{
                $this->get('session')->getFlashBag()->add('notice', 'El correo no pudo ser enviado.');
            }
        }catch(Swift_TransportException $e){
            $mailer->getTransport()->stop();
            sleep(10); // Just in case ;-)
        }
    }
}
