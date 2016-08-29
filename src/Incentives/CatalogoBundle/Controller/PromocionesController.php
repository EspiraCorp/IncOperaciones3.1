<?php

namespace Incentives\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\CatalogoBundle\Entity\Programa;
use Incentives\CatalogoBundle\Form\Type\ProgramaType;
use Incentives\CatalogoBundle\Entity\Catalogos;
use Incentives\CatalogoBundle\Entity\Intervalos;
use Incentives\CatalogoBundle\Form\Type\IntervalosType;
use Incentives\CatalogoBundle\Form\Type\CatalogosType;
use Incentives\CatalogoBundle\Form\Type\CatalogosnuevoType;
use Incentives\CatalogoBundle\Form\Type\ProductoType;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Cell_DataValidation;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Style_Fill;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PromocionesController extends Controller
{
    /**
     * @Route("/catalogo/nuevo")
     * @Template()
     */
    public function nuevoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $catalogo = new Catalogos();
        if (isset($id)){
            $programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($id);
            $form = $this->createForm(CatalogosType::class, $catalogo);
        }else{
            $programa = new Programa();
            $form = $this->createForm(CatalogosnuevoType::class, $catalogo);
        }        
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $id=($request->request->get('id'));
                if ($id==0){
                    $id=$catalogo->getPrograma()->getId();
                }
                $programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($id);
                $catalogo->setPrograma($programa);
                $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
                $catalogo->setEstado($estado);
                $em->persist($catalogo);

                $em->flush();

                return $this->redirect($this->generateUrl('programa_datos').'/'.$id);
            }
        }          
        if ($id!=0){
            return $this->render('IncentivesCatalogoBundle:Catalogos:nuevo.html.twig', array(
                'form' => $form->createView(), 'id'=>$id
            ));
        }else{
            return $this->render('IncentivesCatalogoBundle:Catalogos:nuevo1.html.twig', array(
                'form' => $form->createView(), 'id'=>$id
            ));
        }
    }

    /**
     * @Route("/catalogo/editar")
     * @Template()
     */
    public function editarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        if (isset($id)){
            $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($id);
            $form = $this->createForm(CatalogosType::class, $catalogo);
        }else{
            $form = $this->createForm(CatalogosType::class);
            $catalogo = new Catalogos();
        }

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);


            if ($form->isValid()) {                
                $pro=($request->request->get('catalogos'));
                $id=($request->request->get('id'));
                $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($id);
                $catalogo->setNombre($pro["nombre"]);
                $catalogo->setDescripcion($pro["descripcion"]);
                $catalogo->setValorpunto($pro["valorPunto"]);
                
                $tipo = $em->getRepository('IncentivesCatalogoBundle:Catalogotipo')->find($pro["catalogotipo"]);
                $catalogo->setCatalogotipo($tipo);

                $em->persist($catalogo);   
                $em->flush();

                //$conn = $this->get('database_connection'); 

                //$excelcar = $conn->insert('Programa', array('fechainicio' => date($pro["fechainicio"]["year"]."-". $pro["fechainicio"]["month"]."-".$pro["fechainicio"]["day"])));

                return $this->redirect($this->generateUrl('catalogo_datos').'/'.$id);
            }
        }


        return $this->render('IncentivesCatalogoBundle:Catalogos:editar.html.twig', array(
            'form' => $form->createView(), 'catalogo' => $catalogo, 'id'=>$id,
        ));
    }

    /**
     * @Route("/catalogo/datos/{id}")
     * @Template()
     */
    public function datosAction($id)
    {
        $repositoryca = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Catalogos');

        $catalogo = $repositoryca->find($id);
        
        $repositoryInt = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Intervalos');

        $intervalos = $repositoryInt->findByCatalogos($id);

		$galeria = 0;
        if ($this->get('security.authorization_checker')->isGranted('ROLE_CLI')) {
            $cliente =  $this->getUser()->getCliente()->getId();      
            if($cliente==28) $galeria = 1;
        }

        return $this->render('IncentivesCatalogoBundle:Catalogos:datos.html.twig', 
            array( 'id'=>$id, 'catalogo'=>$catalogo, 'intervalos' => $intervalos, 'galeria' => $galeria));
    }

    /**
     * @Route("/catalogo")
     * @Template()
     */
    public function listadoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Catalogos');

        $listado= $repository->findAll();

        $query = $em->createQueryBuilder()
                ->select('c','p','cl') 
                ->from('IncentivesCatalogoBundle:Catalogos', 'c')
                ->leftJoin('c.programa','p')
                ->leftJoin('p.cliente','cl')
                ->orderBy("c.id");

        if ($this->get('security.authorization_checker')->isGranted('ROLE_CLI')) {
            $cliente =  $this->getUser()->getCliente()->getId();
            $condicion = " cl.id=".$cliente;
            $query->where($condicion);
        }

        $listado = $query->getQuery()->getResult();

        return $this->render('IncentivesCatalogoBundle:Catalogos:listado.html.twig', 
            array('listado' => $listado));
    }

    /**
     * @Route("/catalogo/estado/{id}")
     * @Template()
     */
    public function estadoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($id);

        if ($catalogo->getEstado()->getId() == 1){
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(2);
            $catalogo->setEstado($estado);
            
            //inhabilitar de todos los catalogos
            $repositorypc = $this->getDoctrine()->getRepository('IncentivesCatalogoBundle:Productocatalogo');
            $productocatalogo = $repositorypc->findByCatalogos($id);
            
            foreach($productocatalogo as $keyP => $valueP){
                
                $valueP->setActivo(0);
                $em->persist($valueP);
                $em->flush();
                
            }
            
        }else{
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
            $catalogo->setEstado($estado);
        }       
        $em->flush();
       
        return $this->redirect($this->generateUrl('catalogo'));
    }
    
}

