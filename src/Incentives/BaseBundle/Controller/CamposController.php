<?php

namespace Incentives\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Incentives\OperacionesBundle\Entity\Pais;
use Incentives\OperacionesBundle\Entity\Ciudad;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

use Symfony\Component\HttpFoundation\Request;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Cell_DataValidation;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Style_Fill;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


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
    
    public function CiudadBuscarAction(Request $request)
    {
        $q = $request->query->get('term');
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQueryBuilder()
            ->select('c') 
            ->from('IncentivesOperacionesBundle:Ciudad', 'c')
		    ->where("c.nombre LIKE '%".$q."%'");
		    
		$results = $query->getQuery()->getResult();
        
//echo $results->getId(); exit;
        return $this->render('IncentivesBaseBundle:Campos:BuscarCiudad.html.twig', array('results' => $results));
    }

    public function CiudadCamposAction($id = null)
    {
        $ciudad = $this->getDoctrine()->getRepository('IncentivesOperacionesBundle:Ciudad')->find($id);

        return new Response($ciudad->getNombre());
    }


    public function exportarAction(Request $request)
    {
        
            // Create new PHPExcel object
            $Descarga = new PHPExcel();

            // Set document properties
            $Descarga->setActiveSheetIndex(0);
    
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder(); 
            $qb->select('c');
            $qb->from('IncentivesOperacionesBundle:Categoria','c');
            $categorias = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            $Descarga->getActiveSheet()->setTitle("Categorias");
            $Descarga->getActiveSheet()
                        ->setCellValue('A1','Id')
                        ->setCellValue('B1','Nombre');
            $fil=2;
            
            foreach ($categorias as $key => $value) {

                    $Descarga->getActiveSheet()
                            ->setCellValue('A'.$fil, $value['id'])
                            ->setCellValue('B'.$fil, $value['nombre']);
                   
                $fil++;
            }

            // Set document properties
            $Descarga->createSheet();
            $Descarga->setActiveSheetIndex(1);
            $Descarga->getActiveSheet()->setTitle("Paises");
    
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder(); 
            $qb->select('p');
            $qb->from('IncentivesOperacionesBundle:Pais','p');
            $paises = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            $Descarga->getActiveSheet()
                        ->setCellValue('A1','Id')
                        ->setCellValue('B1','Nombre');
            $fil=2;
            
            foreach ($paises as $key => $value) {

                    $Descarga->getActiveSheet()
                            ->setCellValue('A'.$fil, $value['id'])
                            ->setCellValue('B'.$fil, $value['nombre']);
                   
                $fil++;
            }

            // Set document properties
            $Descarga->createSheet();
            $Descarga->setActiveSheetIndex(2);
            $Descarga->getActiveSheet()->setTitle("Ciudades");
    
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder(); 
            $qb->select('c');
            $qb->from('IncentivesOperacionesBundle:Ciudad','c');
            $paises = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            $Descarga->getActiveSheet()
                        ->setCellValue('A1','Id')
                        ->setCellValue('B1','Nombre');
            $fil=2;
            
            foreach ($paises as $key => $value) {

                    $Descarga->getActiveSheet()
                            ->setCellValue('A'.$fil, $value['id'])
                            ->setCellValue('B'.$fil, $value['nombre']);
                   
                $fil++;
            }

            // Set document properties
            $Descarga->createSheet();
            $Descarga->setActiveSheetIndex(3);
            $Descarga->getActiveSheet()->setTitle("Catalogos");
    
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder(); 
            $qb->select('c');
            $qb->from('IncentivesCatalogoBundle:Catalogos','c');
            $paises = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            $Descarga->getActiveSheet()
                        ->setCellValue('A1','Id')
                        ->setCellValue('B1','Nombre');
            $fil=2;
            
            foreach ($paises as $key => $value) {

                    $Descarga->getActiveSheet()
                            ->setCellValue('A'.$fil, $value['id'])
                            ->setCellValue('B'.$fil, $value['nombre']);
                   
                $fil++;
            }

            // Set document properties
            $Descarga->createSheet();
            $Descarga->setActiveSheetIndex(4);
            $Descarga->getActiveSheet()->setTitle("Centros de Costo");
    
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder(); 
            $qb->select('c');
            $qb->from('IncentivesCatalogoBundle:CentroCostos','c');
            $paises = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            $Descarga->getActiveSheet()
                        ->setCellValue('A1','Id')
                        ->setCellValue('B1','Nombre')
                        ->setCellValue('C1','Codigo');
            $fil=2;
            
            foreach ($paises as $key => $value) {

                    $Descarga->getActiveSheet()
                            ->setCellValue('A'.$fil, $value['id'])
                            ->setCellValue('B'.$fil, $value['nombre'])
                            ->setCellValue('C'.$fil, $value['centrocostos']);
                   
                $fil++;
            }
                
            $objWriter = new PHPExcel_Writer_Excel2007($Descarga); 
            $objWriter->save('Campos.xlsx');  //send it to user, of course you can save it to disk also!
             // prepare BinaryFileResponse
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
            $filename = 'Campos.xlsx';
            $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
            $filePath = $basePath.'/'.$filename; 
             
            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
            return $response;

    }

}
