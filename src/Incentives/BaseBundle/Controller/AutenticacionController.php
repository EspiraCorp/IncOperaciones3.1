<?php

// src/Incentives/BaseBundle/Controller/AutenticacionController.php;
namespace Incentives\BaseBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Component\HttpFoundation\Request;
 
class AutenticacionController extends Controller
{
    public function loginAction(Request $request)
    {
         $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'IncentivesBaseBundle:Autenticacion:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername ,
                'error'         => $error,
            )
        );
    }
 

    public function redireccionAction()
    {
		//$user = $this->container->get('security.token_storage')->getToken()->getUser();
		//$user1 = $this->getUser();
		//echo $user->getId(); //
		//if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) return $this->redirect($this->generateUrl('_inicio'));
		//elseif ($this->get('security.authorization_checker')->isGranted('ROLE_PROV')) return $this->redirect($this->generateUrl('proveedores_datos'));
		//elseif ($this->get('security.authorization_checker')->isGranted('ROLE_DIR')) return $this->redirect($this->generateUrl('proveedores'));
		return $this->redirect($this->generateUrl('_inicio'));
    }
}

