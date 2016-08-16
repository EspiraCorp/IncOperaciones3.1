<?php

namespace Incentives\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('IncentivesBaseBundle:Default:index.html.twig');
    }
}
