<?php

namespace Incentives\OperacionesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Incentives\OperacionesBundle\Entity\Proveedores;
use Incentives\OperacionesBundle\Form\Type\ProveedoresType;
use Incentives\OperacionesBundle\Entity\Contacto;
use Incentives\OperacionesBundle\Form\Type\ContactoType;
use Doctrine\ORM\Mapping as ORM;

class ContactoController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IncentivesOperacionesBundle:Contacto:index.html.twig', array('name' => $name));
    }
    
	
    public function editAction(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();
        if (isset($id)){
	        $contacto = $em->getRepository('IncentivesOperacionesBundle:Contacto')->find($id);
	        $form = $this->createForm(ContactoType::class, $contacto);
	    }else{
	    	$form = $this->createForm(ContactoType::class);
	    	$contacto = new Contacto();
	    }
                    
		if ($request->isMethod('POST')) {
			$form->handleRequest($request);

			if ($form->isValid()) {
				$pro=($request->request->get('contacto'));
				$id=($request->request->get('id'));
				$query = $em->createQuery(
				    'UPDATE IncentivesOperacionesBundle:Contacto p 
				    SET p.nombres=:nombres, p.correo=:correo, p.telefono=:telefono, p.cargo=:cargo
				    WHERE p.id=:id'
				);
				$query->setParameters(array(
				    'nombres' => $pro['nombres'],
				    'correo' => $pro['correo'],
				    'telefono' => $pro['telefono'],
				    'cargo' => $pro['cargo'],
				    'id' => $id,
				));
				$query->getResult();
			
				return $this->render('IncentivesOperacionesBundle:Contacto:index.html.twig');
			}
		}            

        return $this->render('IncentivesOperacionesBundle:Contacto:edit.html.twig', array(
            'form' => $form->createView(), 'contacto' => $contacto, 'id'=>$id,
        ));
    }


	public function estadoAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		$contacto = $em->getRepository('IncentivesOperacionesBundle:Contacto')->find($id);

		if ($contacto->getEstado()=='1'){
			$contacto->setEstado('0');
		}else{
			$contacto->setEstado('1');
		}		
	    $em->flush();

    	return $this->render('IncentivesOperacionesBundle:Contacto:able.html.twig', array(
            'contacto' => $contacto, 'id'=>$id, 'estado'=>$contacto->getEstado(),
        ));
    }

	public function nuevoAction(Request $request, $id)
    {
        // crea una task y le asigna algunos datos ficticios para este ejemplo
        

        $em = $this->getDoctrine()->getManager();
        if (isset($id)){
	        $proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($id);
	    }else{
	     	$proveedor = new Proveedores();
	    }
        $contacto = new Contacto();

		$form = $this->createForm(ContactoType::class, $contacto);
                    
		if ($request->isMethod('POST')) {
			$form->handleRequest($request);

			if ($form->isValid()) {
				// realiza alguna acción, tal como guardar la tarea en la base de datos
				$id=($request->request->get('id'));
				$proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($id);
                $contacto->setProveedor($proveedor);
                $proveedor->addContacto($contacto);
                $em->persist($contacto);
				$em->persist($proveedor);			
				$em->flush();
			
				return $this->redirect($this->generateUrl('proveedores_datos').'/'.$id);
				//return $this->render('IncentivesOperacionesBundle:Default:index.html.twig');
			}
		}            

        return $this->render('IncentivesOperacionesBundle:Contacto:nuevo.html.twig', array(
            'form' => $form->createView(), 'id'=>$id,
        ));
    }

}
