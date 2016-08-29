<?php

namespace Incentives\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\BaseBundle\Entity\Menu;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Component\Security\Core\SecurityContextInterface;

class MenuController extends Controller
{
	
	public function menuPrincipalAction()
    {
        /*if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')){
        	$rol=array();
    		$userRoles =  $this->getUser()->getGrupos();
    		foreach ($userRoles as $clave => $valor) {
    		   $rol[] = "'".$valor->getRole()."'";
    		}
    		
    		$rol = implode(",", $rol);
        }else{*/
            $rol = "'ROLE_DIR'";
        //}

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder()
                ->select('m','op')
                ->from('IncentivesBaseBundle:Menu','m')
                ->Join('m.grupos', 'g')
                ->leftJoin('m.opciones', 'op', 'WITH', 'op.estado = 1')
                ->Join('op.grupos', 'go', 'WITH', 'go.role IN ('.$rol.')');
                
        $str = "g.role IN (".$rol.")";
        $str .= " AND m.estado=1 AND m.tipo=3";
        $qb->where($str);
        $qb->orderBy("m.orden");
        
        $menu =  $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        //echo "<pre>"; print_r($menu); echo "</pre>"; exit;
        return $this->render('IncentivesBaseBundle:Menu:menuprincipal.html.twig', 
	    	array('menu' => $menu));
    }

    public function menuPrincipalLteAction()
    {
        /*if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            $rol=array();
            $userRoles =  $this->getUser()->getGrupos();
            foreach ($userRoles as $clave => $valor) {
               $rol[] = "'".$valor->getRole()."'";
            }
            
            $rol = implode(",", $rol);
        }else{*/
            $rol = "'ROLE_DIR'";
        //}

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder()
                ->select('m','op')
                ->from('IncentivesBaseBundle:Menu','m')
                ->Join('m.grupos', 'g')
                ->leftJoin('m.opciones', 'op', 'WITH', 'op.estado = 1')
                ->Join('op.grupos', 'go', 'WITH', 'go.role IN ('.$rol.')');
                
        $str = "g.role IN (".$rol.")";
        $str .= " AND m.estado=1 AND m.tipo=3";
        $qb->where($str);
        $qb->orderBy("m.orden");
        
        $menu =  $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        //echo "<pre>"; print_r($menu); echo "</pre>"; exit;
        return $this->render('IncentivesBaseBundle:Menu:menuprincipalLte.html.twig', 
            array('menu' => $menu));
    }
	
}
