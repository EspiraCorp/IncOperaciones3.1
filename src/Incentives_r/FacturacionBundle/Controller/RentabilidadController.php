<?php

namespace Incentives\FacturacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Cell_DataValidation;
use PHPExcel_Style_Fill;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RentabilidadController extends Controller
{

	public function listadoAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Programa');

        $listado= $repository->findAll();

        return $this->render('IncentivesFacturacionBundle:Rentabilidad:listado.html.twig', 
            array('listado' => $listado));
    }

    public function rentabilidadProgramaAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $programa = $this->getDoctrine()->getRepository('IncentivesCatalogoBundle:Programa')->find($id);

        $session = $this->get('session');
            
        if($pro=($this->get('request')->request->get('rentabilidad'))){
            $page = 1;
            $session->set('filtros_rentabilidad', $pro);
        }

        $condicionesFiltro = "";

        $fechaInicio = "";
        $fechaFin = "";

        if($filtros = $session->get('filtros_rentabilidad')){
            $fechaInicio = $filtros['fechaInicio'];
            $fechaFin = $filtros['fechaFin'];
        }

        $qb = $em->createQueryBuilder(); 
        $qb->select('r redenciones, count(r) total, SUM(r.valorCompra/(1-(r.incremento/100))) venta, SUM(r.valorOrden) compra, SUM(r.logistica) logisticaVenta, SUM(g.valor) logisticaCompra, AVG(NULLIF(r.diasEntrega ,0)) dias','pc','p','c','g');
        $qb->from('IncentivesRedencionesBundle:Redenciones','r');
        $qb->leftJoin('r.participante', 'pt');
        $qb->leftJoin('r.productocatalogo', 'pc');
        $qb->leftJoin('pc.producto', 'p');
        $qb->leftJoin('p.categoria', 'c');
        $qb->leftJoin('r.inventario', 'i');
        $qb->leftJoin('i.inventarioguia', 'ig');
        $qb->leftJoin('ig.guia', 'g');
        $qb->groupBy('c.id');
        $str_filtro = "pt.programa=".$id;
        $str_filtro.= " AND r.redencionestado in (3,4,5,6)";
        if($fechaInicio!="") $str_filtro .= " AND r.fecha >='".$fechaInicio."'";
        if($fechaFin!="") $str_filtro .= " AND r.fecha <='".$fechaFin."'";

        $qb->where($str_filtro);
        $categorias = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        //echo "<pre>"; print_r($categorias); echo "</pre>"; exit;

        return $this->render('IncentivesFacturacionBundle:Rentabilidad:rentabilidadprograma.html.twig', 
            array('categorias' => $categorias, 'programa' => $programa, 'filtros' => $filtros));
    }

    public function rentabilidadGeneralAction()
    {

        $em = $this->getDoctrine()->getManager();

        $session = $this->get('session');
            
        if($pro=($this->get('request')->request->get('rentabilidad'))){
            $page = 1;
            $session->set('filtros_rentabilidad', $pro);
        }

        $condicionesFiltro = "";

        $fechaInicio = "";
        $fechaFin = "";

        if($filtros = $session->get('filtros_rentabilidad')){
            $fechaInicio = $filtros['fechaInicio'];
            $fechaFin = $filtros['fechaFin'];
        }

        $qb = $em->createQueryBuilder(); 
        $qb->select('r redenciones, count(r) total, SUM(r.valorCompra/(1-(r.incremento/100))) venta, SUM(r.valorOrden) compra, SUM(r.logistica) logisticaVenta, SUM(g.valor) logisticaCompra, AVG(NULLIF(r.diasEntrega ,0)) dias','pc','p','c','g');
        $qb->from('IncentivesRedencionesBundle:Redenciones','r');
        $qb->leftJoin('r.participante', 'pt');
        $qb->leftJoin('r.productocatalogo', 'pc');
        $qb->leftJoin('pc.producto', 'p');
        $qb->leftJoin('p.categoria', 'c');
        $qb->leftJoin('r.inventario', 'i');
        $qb->leftJoin('i.inventarioguia', 'ig');
        $qb->leftJoin('ig.guia', 'g');
        $qb->groupBy('c.id');
        $str_filtro = " 1=1 ";
        $str_filtro.= " AND r.redencionestado in (3,4,5,6)";
        if($fechaInicio!="") $str_filtro .= " AND r.fecha >='".$fechaInicio."'";
        if($fechaFin!="") $str_filtro .= " AND r.fecha <='".$fechaFin."'";

        $qb->where($str_filtro);
        $categorias = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        //echo "<pre>"; print_r($categorias); echo "</pre>"; exit;

        return $this->render('IncentivesFacturacionBundle:Rentabilidad:rentabilidadgeneral.html.twig', 
            array('categorias' => $categorias,'filtros' => $filtros));
    }

    public function rentabilidadPremiosAction($programa, $categoria)
    {

        $em = $this->getDoctrine()->getManager();

        $session = $this->get('session');

        $fechaInicio = "";
        $fechaFin = "";

        if($filtros = $session->get('filtros_rentabilidad')){
            $fechaInicio = $filtros['fechaInicio'];
            $fechaFin = $filtros['fechaFin'];
        }

        $qb = $em->createQueryBuilder(); 
        $qb->select('r','pc','p','c','pt');
        $qb->from('IncentivesRedencionesBundle:Redenciones','r');
        $qb->leftJoin('r.participante', 'pt');
        $qb->leftJoin('r.productocatalogo', 'pc');
        $qb->leftJoin('pc.producto', 'p');
        $qb->leftJoin('p.categoria', 'c');
        $qb->leftJoin('r.inventario', 'i');
        $qb->leftJoin('i.inventarioguia', 'ig');
        $qb->leftJoin('ig.guia', 'g');
        $qb->groupBy('r.id');
        $str_filtro = "pt.programa=".$programa." AND c.id=".$categoria;
        $str_filtro.= " AND r.redencionestado in (3,4,5,6)";

        if($fechaInicio!="") $str_filtro .= " AND r.fecha >='".$fechaInicio."'";
        if($fechaFin!="") $str_filtro .= " AND r.fecha <='".$fechaFin."'";

        $qb->where($str_filtro);
        $redenciones = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $this->render('IncentivesFacturacionBundle:Rentabilidad:rentabilidadpremios.html.twig', 
            array('redenciones' => $redenciones));

    }

    public function listacategoriasAction()
    {
    }

    public function categoriaAction()
    {
    }

    public function exportarAction($id){

        $PHPexcel = new PHPExcel();
            // Set document properties
        $PHPexcel->setActiveSheetIndex(0);
        $em = $this->getDoctrine()->getManager();
        
        
        $PHPexcel ->getActiveSheet()
                        ->setCellValue('A1','Id')
                        ->setCellValue('B1','Fecha Redencion')
                        ->setCellValue('C1','Fecha Autorizacion')
                        ->setCellValue('D1','Programa')
                        ->setCellValue('E1','Codigo Redencion')
                        ->setCellValue('F1','Nombre Participante')
                        ->setCellValue('G1','Cedula participante')
                        ->setCellValue('H1','Puntos')
                        ->setCellValue('I1','Producto')
                        ->setCellValue('J1','Sku')
                        ->setCellValue('K1','Categoria')
                        ->setCellValue('L1','Precio Venta')
                        ->setCellValue('M1','Incremento')
                        ->setCellValue('N1','Valor Venta')
                        ->setCellValue('O1','Valor Compra')
                        ->setCellValue('P1','Descuento')
                        ->setCellValue('Q1','Rentabilidad')
                        ->setCellValue('R1','Logistica')
                        ->setCellValue('S1','TRM')
                        ->setCellValue('T1','Semaforo')
                        ->setCellValue('U1','Orden Compra')
                        ->setCellValue('V1','Pais');

        $em = $this->getDoctrine()->getManager();
        //Consultar puntos redimidos
        $qb = $em->createQueryBuilder();            
        $qb->select('r','pt','pc','pd','ct','i','estado','pg','op','oc','pais','c');
            $qb->from('IncentivesRedencionesBundle:Redenciones','r');
            $qb->leftJoin('r.productocatalogo', 'pc');
            $qb->leftJoin('pc.producto', 'pd');
            $qb->leftJoin('pd.categoria', 'ct');
            $qb->leftJoin('pc.catalogos', 'c');
            $qb->leftJoin('c.pais', 'pais');
            $qb->leftJoin('r.participante', 'pt');
            $qb->leftJoin('pt.programa', 'pg');
            $qb->leftJoin('r.ordenesProducto', 'op');
            $qb->leftJoin('op.ordenesCompra', 'oc');
            $qb->leftJoin('r.redencionestado', 'estado');
            $qb->leftJoin('r.inventario', 'i');
            $qb->orderBy('pt.programa,r.fecha', 'ASC');
            
            $str_filtro = " pc.id!=2505 ";
            $str_filtro .= " AND r.redencionestado in (3,4,5,6)";
            if(isset($id)) $str_filtro .= " AND pg.id=".$id;
            $qb->where($str_filtro);
            $redenciones = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            $fil=2;
            foreach($redenciones as $key => $value){              

                $valorVenta = 0 + @$value['valorCompra']/(1-($value['incremento']/100));
                if($valorVenta>0) $rentabilidadPremios = (1- (($value['valorOrden']-$value['descuento'])/$valorVenta))*100; else $rentabilidadPremios = "";

                $ordenCompra = "";
                $ordenCompra = $value['ordenesProducto']['ordenesCompra']['consecutivo'];

                //Redencion, participante, producto
                $PHPexcel->getActiveSheet()
                        ->setCellValueByColumnAndRow(0, $fil, $value['id'])
                        ->setCellValueByColumnAndRow(1, $fil, $value['fecha']->format('Y-m-d'))
                        ->setCellValueByColumnAndRow(3, $fil, $value['participante']['programa']['nombre'])
                        ->setCellValueByColumnAndRow(4, $fil, $value['codigoredencion'])
                        ->setCellValueByColumnAndRow(5, $fil, $value['participante']['nombre'])
                        ->setCellValueByColumnAndRow(6, $fil, $value['participante']['documento'])
                        ->setCellValueByColumnAndRow(7, $fil, $value['puntos'])
                        ->setCellValueByColumnAndRow(8, $fil, $value['productocatalogo']['producto']['nombre'])
                        ->setCellValueByColumnAndRow(9, $fil, $value['productocatalogo']['producto']['codInc'])
                        ->setCellValueByColumnAndRow(10, $fil, $value['productocatalogo']['producto']['categoria']['nombre'])
                        ->setCellValueByColumnAndRow(11, $fil, $value['valorCompra'])
                        ->setCellValueByColumnAndRow(12, $fil, $value['incremento'])
                        ->setCellValueByColumnAndRow(13, $fil, $valorVenta)
                        ->setCellValueByColumnAndRow(14, $fil, $value['valorOrden'])
                        ->setCellValueByColumnAndRow(15, $fil, $value['descuento'])
                        ->setCellValueByColumnAndRow(16, $fil, $rentabilidadPremios)
                        ->setCellValueByColumnAndRow(17, $fil, $value['logistica'])
                        ->setCellValueByColumnAndRow(18, $fil, $value['ordenesProducto']['ordenesCompra']['trm'])
                        ->setCellValueByColumnAndRow(19, $fil, $value['redencionestado']['nombre'])
                        ->setCellValueByColumnAndRow(20, $fil, $ordenCompra)
                        ->setCellValueByColumnAndRow(21, $fil, $value['productocatalogo']['catalogos']['pais']['nombre']);

                if($value['fechaAutorizacion']!= null) $PHPexcel->getActiveSheet()->setCellValueByColumnAndRow(2, $fil, $value['fechaAutorizacion']->format('Y-m-d'));
                if($value['fechaDespacho']!= null) $PHPexcel->getActiveSheet()->setCellValueByColumnAndRow(18, $fil, $value['fechaDespacho']->format('Y-m-d'));
                
                
                $fil++;

            }

            $objWriter = new PHPExcel_Writer_Excel2007($PHPexcel); 
            $objWriter->save('Rentabilidad.xlsx');  //send it to user, of course you can save it to disk also!
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
            $filename = 'Rentabilidad.xlsx';
            $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
            $filePath = $basePath.'/'.$filename; 

            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
            return $response;

    }
}
