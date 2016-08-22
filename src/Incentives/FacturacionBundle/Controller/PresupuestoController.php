<?php

namespace Incentives\FacturacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\FacturacionBundle\Entity\Presupuestos;
use Incentives\FacturacionBundle\Entity\Presupuestoshistorico;
use Incentives\FacturacionBundle\Form\Type\PresupuestosType;
use Symfony\Component\HttpFoundation\Request;

class PresupuestoController extends Controller
{

	public function listadoAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Programa');

        $listado= $repository->findAll();

        return $this->render('IncentivesFacturacionBundle:Presupuesto:listado.html.twig', 
            array('listado' => $listado));
    }


    public function detalleAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        //Seleccion del programa
        $programa = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Programa')->find($id);

        $repository = $this->getDoctrine()
            ->getRepository('IncentivesFacturacionBundle:Areas');

        $areas = $repository->findAll();

        $presupuestos = array();
        $presupuestos['total']['valor'] = 0;
        $presupuestos['total']['ejecutado'] = 0;

        foreach ($areas as $key => $value) {

            //Informacion de presupuestos
            $qb = $em->createQueryBuilder();            
            $qb->select('p');
            $qb->from('IncentivesFacturacionBundle:Presupuestos','p');
            $str_filtro = 'p.area = :id_area AND p.programa = :id_programa';

            $qb->where($str_filtro);

            //Definicion de parametros para filtros
            
            $arrayParametros['id_area'] = $value->getId();
            $arrayParametros['id_programa'] = $id;
            $qb->setParameters($arrayParametros);
                
            $presupuesto = $qb->getQuery()->getOneOrNullResult();
            if(isset($presupuesto)){
                $presupuestos[$value->getId()]['descripcion'] = $presupuesto->getDescripcion();
                $presupuestos[$value->getId()]['valor'] = $presupuesto->getValor();
                //$presupuestos[$value->getId()]['tipo'] = $presupuesto->getTipo()->getNombre();

                $qb = $em->createQueryBuilder();            
                $qb->select('f.valorTotal');
                $qb->from('IncentivesFacturacionBundle:FacturaDetalle','f');
                $qb->Join('f.factura', 'fp');
                $str_filtro = 'f.area = :id_area AND fp.programa = :id_programa';

                $qb->where($str_filtro);

                //Definicion de parametros para filtros
                
                $arrayParametros['id_area'] = $value->getId();
                $arrayParametros['id_programa'] = $id;
                $qb->setParameters($arrayParametros);

                $ejecutado = $qb->getQuery()->getResult();
                $total_ej = 0;
                foreach ($ejecutado as $keyPE => $valuePE) {
                    $total_ej += $valuePE['valorTotal'];
                }

                $presupuestos[$value->getId()]['ejecutado'] = $total_ej;
                $presupuestos[$value->getId()]['porc'] = @($total_ej/$presupuesto->getValor())*100;
            }else{
                $presupuestos[$value->getId()]['descripcion'] = '';
                $presupuestos[$value->getId()]['tipo'] = '';
                $presupuestos[$value->getId()]['valor'] = 0;
                $presupuestos[$value->getId()]['ejecutado'] = 0;
                $presupuestos[$value->getId()]['porc'] = 0;
            }

            $presupuestos['total']['valor'] += $presupuestos[$value->getId()]['valor'];
            $presupuestos['total']['ejecutado'] += $presupuestos[$value->getId()]['ejecutado'];

        }
         
        $presupuestos['total']['porc'] = 0;

        return $this->render('IncentivesFacturacionBundle:Presupuesto:detalle.html.twig', 
            array('areas' => $areas, 'presupuestos' => $presupuestos, 'programa' => $programa));

    }

    public function editarAction(Request $request, $programa, $area)
    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();            
        $qb->select('p');
        $qb->from('IncentivesFacturacionBundle:Presupuestos','p');
        $str_filtro = 'p.area = :id_area AND p.programa = :id_programa';
        $qb->where($str_filtro);
        //Definicion de parametros para filtros
        $arrayParametros['id_area'] = $area;
        $arrayParametros['id_programa'] = $programa;
        $qb->setParameters($arrayParametros);
        $presupuesto = $qb->getQuery()->getOneOrNullResult();

        if (isset($presupuesto)){
            $presupuesto = $em->getRepository('IncentivesFacturacionBundle:Presupuestos')->find($presupuesto->getId());
            $form = $this->createForm(PresupuestosType::class, $presupuesto);

        }else{
            $form = $this->createForm(PresupuestosType::class;
            $presupuesto = new Presupuestos();
        }

        if ($request->isMethod('POST')) {
            
            $form->handleRequest($request);

            if ($form->isValid()) {
                
                $pro=($request->request->get('presupuestos'));
                $programaE = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($programa);
                $areaE = $em->getRepository('IncentivesFacturacionBundle:Areas')->find($area);
                //$tipo = $em->getRepository('IncentivesFacturacionBundle:Tipocostos')->find($pro['tipo']);

                $presupuesto->setPrograma($programaE);
                $presupuesto->setArea($areaE);
                $presupuesto->setValor($pro["valor"]);
                $presupuesto->setMensual($pro["mensual"]);
                //$presupuesto->setTipo($tipo);
                $presupuesto->setDescripcion($pro["descripcion"]);

                $presupuestoH = new Presupuestoshistorico();
                $presupuestoH->setPrograma($programaE);
                $presupuestoH->setArea($areaE);
                $presupuestoH->setValor($pro["valor"]);
                $presupuestoH->setMensual($pro["mensual"]);
                //$presupuestoH->setTipo($tipo);
                $presupuestoH->setDescripcion($pro["descripcion"]);
                $presupuestoH->setPresupuesto($presupuesto);

                $id_usuario = $this->getUser()->getId();
                $usuario = $em->getRepository('IncentivesBaseBundle:Usuario')->find($id_usuario);        
                $presupuestoH->setUsuario($usuario);

                $em->persist($presupuesto);
                $em->persist($presupuestoH);   
                $em->flush();

                return $this->redirect($this->generateUrl('presupuesto_detalle').'/'.$programa);
            }
        }

        return $this->render('IncentivesFacturacionBundle:Presupuesto:editar.html.twig', array('form' => $form->createView()));

    }

}
