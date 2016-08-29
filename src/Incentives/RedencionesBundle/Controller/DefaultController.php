<?php

namespace Incentives\RedencionesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IncentivesRedencionesBundle:Default:index.html.twig', array('name' => $name));
    }
}
