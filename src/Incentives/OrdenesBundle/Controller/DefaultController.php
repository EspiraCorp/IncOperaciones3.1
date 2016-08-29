<?php

namespace Incentives\OrdenesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IncentivesOrdenesBundle:Default:index.html.twig', array('name' => $name));
    }
}
