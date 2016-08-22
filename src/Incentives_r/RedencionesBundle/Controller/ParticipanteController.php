<?php

namespace Incentives\RedencionesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Incentives\RedencionesBundle\Entity\Participantes;
use Incentives\RedencionesBundle\Form\Type\ParticipanteType;
use Incentives\RedencionesBundle\Form\Type\ParticipanteeditarType;

class ParticipanteController extends Controller
{
    /**
     * @Route("/participante/nuevo")
     * @Template()
     */
    public function nuevoAction(Request $request)
    {
        $participante = new Participantes();

        $form = $this->createForm(ParticipanteType::class, $participante);
                    
        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                $participante->setLlave($participante->getDocumento()."_".$participante->getPrograma()->getId());
                $participante->setEstado("1");
                $estado = $em->getRepository('IncentivesRedencionesBundle:Participantesestado')->find("1");
                $participante->setParticipanteestado($estado);
                $em->persist($participante);
                $em->flush();

                return $this->redirect($this->generateUrl('participante'));
            }
        }            

        return $this->render('IncentivesRedencionesBundle:Participante:nuevo.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/participante/editar/{id}")
     * @Template()
     */
    public function editarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        if (isset($id)){
            $participante = $em->getRepository('IncentivesRedencionesBundle:Participantes')->find($id);
            $form = $this->createForm(ParticipanteeditarType::class, $participante);
        }else{
            $form = $this->createForm(ParticipanteeditarType::class);
            $participante = new Participantes();
        }

        if ($request->isMethod('POST')) {
            $form->bind($request);
            
            var_dump($form->getErrorsAsString());

            if ($form->isValid()) {                
                $pro=($this->get('request')->request->get('participante'));
                $id=($this->get('request')->request->get('id'));
                $participante = $em->getRepository('IncentivesRedencionesBundle:Participantes')->find($id);
                $participante->setNombre($pro["nombre"]);
                $participante->setDocumento($pro["documento"]);
                $participante->setDireccion($pro["direccion"]);
                $participante->setTelefono($pro["telefono"]);
                $participante->setCelular($pro["celular"]);
                $participante->setBarrio($pro["barrio"]);
                $programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($pro["programa"]);
                $ciudad = $em->getRepository('IncentivesOperacionesBundle:Ciudad')->find($pro["ciudad"]);
                $tipodocumento = $em->getRepository('IncentivesOperacionesBundle:Tipodocumento')->find($pro["tipodocumento"]);
                $estado = $em->getRepository('IncentivesRedencionesBundle:Participantesestado')->find($pro["participanteEstado"]);
                $participante->setParticipanteestado($estado);
                $participante->setPrograma($programa);
                $participante->setCiudad($ciudad);
                $participante->setTipodocumento($tipodocumento);
                $participante->setLlave($participante->getDocumento()."_".$participante->getPrograma()->getId());

                $em->persist($participante);   
                $em->flush();

                //$conn = $this->get('database_connection'); 

                //$excelcar = $conn->insert('Programa', array('fechainicio' => date($pro["fechainicio"]["year"]."-". $pro["fechainicio"]["month"]."-".$pro["fechainicio"]["day"])));

                return $this->redirect($this->generateUrl('participante'));
            }
        }

        return $this->render('IncentivesRedencionesBundle:Participante:editar.html.twig', array(
            'form' => $form->createView(), 'participante' => $participante, 'id'=>$id,
        ));
    }

    /**
     * @Route("/participante")
     * @Template()
     */
    public function listadoAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('IncentivesRedencionesBundle:Participantes');

        $listado= $repository->findAll();

        return $this->render('IncentivesRedencionesBundle:Participante:listado.html.twig', 
            array('listado' => $listado));
    }

    /**
     * @Route("/participante/estado/{id}")
     * @Template()
     */
    public function estadoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $participante = $em->getRepository('IncentivesRedencionesBundle:Participantes')->find($id);

        if ($participante->getEstado()=='1'){
            $participante->setEstado('0');
        }else{
            $participante->setEstado('1');
        }       
        $em->flush();
        
        return $this->redirect($this->generateUrl('participante'));
    }

    private function getErrorMessages(\Symfony\Component\Form\Form $form) {      
        $errors = array();

        
        foreach ($form->getErrors() as $key => $error) {
            $errors[] = $error->getMessage();
        }   
        return $errors;
    }

}
