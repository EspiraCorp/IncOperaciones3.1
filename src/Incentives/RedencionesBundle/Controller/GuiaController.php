<?php

namespace Incentives\RedencionesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Incentives\RedencionesBundle\Entity\GuiaEnvio;
use Incentives\RedencionesBundle\Form\Type\GuiaEnvioType;

class GuiaController extends Controller
{
    /**
     * @Route("/nueva")
     * @Template()
     */
    public function nuevaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->findAll();

        $guia = new GuiaEnvio();

        $form = $this->createForm(GuiaEnvioType::class, $guia);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                $guia->setEstado("1");
                $guia->setFecha(date_create("now"));
                $em->persist($guia);
                $em->flush();

                return $this->redirect($this->generateUrl('guia_listado'));
            }
        }            

        return $this->render('IncentivesRedencionesBundle:Guia:nueva.html.twig', array(
            'form' => $form->createView(), 'redencion'=>$redencion,
        ));
    }

    public function listadoAction()
    {
    }

    /**
     * @Route("/planilla")
     * @Template()
     */
    public function planillaAction()
    {
    }

    /**
     * @Route("/estado")
     * @Template()
     */
    public function estadoAction()
    {
    }

}
