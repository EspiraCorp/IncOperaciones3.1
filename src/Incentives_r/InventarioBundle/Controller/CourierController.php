<?php

namespace Incentives\InventarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\InventarioBundle\Entity\Courier;
use Incentives\InventarioBundle\Form\Type\CourierType;

class CourierController extends Controller
{
    /**
     * @Route("/courier/crear")
     * @Template()
     */
    public function nuevoAction(Request $request)
    {
        $courier = new Courier();

        $form = $this->createForm(CourierType::class, $courier);
                    
        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                $courier->setEstado("1");
                $em->persist($courier);
                $em->flush();

                return $this->redirect($this->generateUrl('courier'));
            }
        }            

        return $this->render('IncentivesInventarioBundle:Courier:nuevo.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/courier")
     * @Template()
     */
    public function listadoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $courier = $em->getRepository('IncentivesInventarioBundle:Courier')->findAll();

        return $this->render('IncentivesInventarioBundle:Courier:listado.html.twig', 
            array('courier' => $courier));
    }

    /**
     * @Route("/courier/datos/{id}")
     * @Template()
     */
    public function datosAction($id)
    {
    }

    /**
     * @Route("/courier/estado/{id}")
     * @Template()
     */
    public function estadoAction($id)
    {
    }

    public function correoIngresoAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $courier = $em->getRepository('IncentivesInventarioBundle:Courier')->findAll();


        // Create the Transport
        $transport = \Swift_SmtpTransport::newInstance('smtp.zoho.com', 465)
          ->setEncryption('ssl')
          ->setAuthMode('login')
          ->setUsername('manuel@sinaptica.co')
          ->setPassword('orwell')
          ;

        // Create the Mailer using your created Transport
        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance()
            ->setSubject('Datos de Acceso. Incentives Operaciones')
            ->setFrom('manuel@sinaptica.co')
            ->setTo($courier->getCorreo())
            ->setBody(
                $this->renderView(
                    'IncentivesInventarioBundle:Courier:email.txt.twig',
                    array('courier' => $courier)
                )
            )
        ;
        
        // Send the message
        if($mailer->send($message)) {
            $this->get('session')->getFlashBag()->add('notice', 'El correo ha sido enviado correctamente');
        }else{
            $this->get('session')->getFlashBag()->add('notice', 'El mensaje no pudo ser enviado');
        }

        return $this->redirect($this->generateUrl('inventario'));
    }

}
