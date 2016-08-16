<?php

namespace Incentives\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Incentives\OperacionesBundle\Entity\Pais;
use Incentives\OperacionesBundle\Entity\Ciudad;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class CamposController extends Controller
{
    /**
     * @Route("/Pais")
     * @Template()
     */
    public function PaisAction()
    {
    }

    /**
     * @Route("/Departamento")
     * @Template()
     */
    public function DepartamentoAction($id)
    {

        $pais = $id;

        $query = $this->getDoctrine()->getManager()
            ->createQuery('
            SELECT d FROM IncentivesOperacionesBundle:Departamento d
            JOIN d.pais p
            WHERE d.pais = :pais
            ORDER BY d.nombre'
        )->setParameter('pais', $pais);
    
        $listado = $query->getResult();

        return $this->render('IncentivesBaseBundle:Campos:Departamento.html.twig', array(
            'listado' => $listado,
        ));
    }

    /**
     * @Route("/Ciudad")
     * @Template()
     */
    public function CiudadAction($id)
    {
        $departamento = $id;

        $query = $this->getDoctrine()->getManager()
            ->createQuery('
            SELECT c FROM IncentivesOperacionesBundle:Ciudad c
            JOIN c.departamento d
            WHERE c.departamento = :departamento
            ORDER BY c.nombre'
        )->setParameter('departamento', $departamento);
    
        $listado = $query->getResult();

        return $this->render('IncentivesBaseBundle:Campos:Ciudad.html.twig', array(
            'listado' => $listado,
        ));
    }

    public function CapitalesAction($id)
    {
        $pais = $id;

        $query = $this->getDoctrine()->getManager()
            ->createQuery('
            SELECT c FROM IncentivesOperacionesBundle:Ciudad c
            JOIN c.departamento d
            JOIN d.pais p
            WHERE d.pais = :pais
            AND c.principal=1
            ORDER BY c.nombre'
        )->setParameter('pais', $pais);
    
        $listado = $query->getResult();

        return $this->render('IncentivesBaseBundle:Campos:Ciudad.html.twig', array(
            'listado' => $listado,
        ));
    }

}
