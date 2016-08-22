<?php

namespace Incentives\OperacionesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\OperacionesBundle\Entity\Convocatorias;
use Incentives\OperacionesBundle\Entity\ConvocatoriasProveedores;
use Incentives\OperacionesBundle\Form\Type\ConvocatoriasType;
use Incentives\OperacionesBundle\Form\Type\ConvocatoriasEdicionType;
use Incentives\OperacionesBundle\Form\Type\ConvocatoriasProveedoresType;
use Incentives\OperacionesBundle\Form\Type\ConvocatoriasProveedorType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Cell_DataValidation;
use PHPExcel_Worksheet_Drawing;

use Dompdf\Dompdf;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CalificacionController extends Controller
{
   public function pendientesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb->select('c','p');
        $qb->from('IncentivesOperacionesBundle:ProveedoresCalificacion','c');
        $qb->leftJoin('c.proveedor', 'p');
        $qb->where('c.estado=0');

        $datos = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $this->render('IncentivesOperacionesBundle:Calificacion:pendientes.html.twig', array(
            'datos'=>$datos));

    }

    public function planesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb->select('c','p');
        $qb->from('IncentivesOperacionesBundle:ProveedoresCalificacion','c');
        $qb->leftJoin('c.proveedor', 'p');
        $qb->where('c.estadoPlan=0');

        $datos = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $this->render('IncentivesOperacionesBundle:Calificacion:planes.html.twig', array(
            'datos'=>$datos));

    }


    public function datosAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb->select('c','p');
        $qb->from('IncentivesOperacionesBundle:ProveedoresCalificacion','c');
        $qb->leftJoin('c.proveedor', 'p');
        $qb->where('c.id='.$id);

        $datos = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $this->render('IncentivesOperacionesBundle:Calificacion:datos.html.twig', array(
            'datos'=>$datos));

    }

    public function aprobarAction($id, $accion)
    {
        $em = $this->getDoctrine()->getManager();

        $calificacion = $em->getRepository('IncentivesOperacionesBundle:ProveedoresCalificacion')->find($id);

        if($accion=="autorizar"){
            $calificacion->setEstado("1");
                $this->correoAction($id);
        }elseif($accion=="rechazar"){
            $calificacion->setEstado("2");    
        }
        $em->persist($calificacion);
        $em->flush();

       return $this->redirect($this->generateUrl('calificaciones'));

    }

    public function correoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $calificacion = $em->getRepository('IncentivesOperacionesBundle:ProveedoresCalificacion')->find($id);
        $destino = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($calificacion->getProveedor()->getId());
        $this->pdfAction($id);
        $this->cartaAction($id);     
        $correos=  explode(',',$destino->getCorreo());   
        //poner correo del proveedor


        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb->select('c','p');
        $qb->from('IncentivesOperacionesBundle:ProveedoresCalificacion','c');
        $qb->leftJoin('c.proveedor', 'p');
        $qb->where('c.id='.$id);
        $datos = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        // Create the Transport
         $transport = \Swift_SmtpTransport::newInstance('mail.sociosyamigos.com', 25)
          ->setAuthMode('login')
          ->setUsername('pruebas@sociosyamigos.com')
          ->setPassword('7d7_r47@fqxo');

        // Create the Mailer using your created Transport
        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance()
            ->setSubject('Resultados de evaluación de desempeño proveedores INC Group')
            ->setFrom(array('test@grupo-inc.com' => 'Grupo Inc'))
            ->setTo(array_merge(array('manuelgb13@gmail.com','controloperaciones@inc-group.co','lferro@inc-group.co','compras1@grupo-inc.com','compras2@grupo-inc.com','compras3@grupo-inc.com','compras4@grupo-inc.com'),$correos))
            ->attach(\Swift_Attachment::fromPath($this->container->getParameter('kernel.root_dir').'/..'.$calificacion->getPath()))
            ->attach(\Swift_Attachment::fromPath($this->container->getParameter('kernel.root_dir').'/..'.$calificacion->getCarta()))
            ->setBody(
                $this->renderView(
                    'IncentivesOperacionesBundle:Calificacion:email.html.twig'
                )
            );
            
        if($calificacion->getCalificacion()>50 && $calificacion->getCalificacion()<=70 ){
            $message->attach(\Swift_Attachment::fromPath($this->container->getParameter('kernel.root_dir').'/../web/Calificacion/planAccion.doc'));   
        }
        
        //Send the message
        if($mailer->send($message)) {
            $this->get('session')->getFlashBag()->add('notice', 'El correo de notificacion ha sido enviado correctamente');
        }else{
            $this->get('session')->getFlashBag()->add('notice', 'El mensaje no pudo ser enviado');
        }

    }


    public function pdfAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb->select('c','p');
        $qb->from('IncentivesOperacionesBundle:ProveedoresCalificacion','c');
        $qb->leftJoin('c.proveedor', 'p');
        $qb->where('c.id='.$id);
        $datos = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);


        $html = $this->render('IncentivesOperacionesBundle:Calificacion:pdf.html.twig', array(
            'datos' => $datos
        ));

        $rootDir = dirname($this->container->getParameter('kernel.root_dir'));
        $Dir = '/web/Calificacion/';
        $uploadDir = $rootDir.$Dir;

        $dompdf = new DOMPDF();
        $dompdf->load_html($html,'UTF-8');
        $dompdf->render();
        $pdf = $dompdf->output();
        file_put_contents($uploadDir.$datos[0]['proveedor']['numero_documento']."_".$id.".pdf", $pdf);
        $calificacion = $em->getRepository('IncentivesOperacionesBundle:ProveedoresCalificacion')->find($id);
        $calificacion->setPath($Dir.$datos[0]['proveedor']['numero_documento']."_".$id.".pdf");
        $em->persist($calificacion);
        $em->flush();

        return $uploadDir.$datos[0]['proveedor']['numero_documento']."_".$id.".pdf";
    }

    public function cartaAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb->select('c','p');
        $qb->from('IncentivesOperacionesBundle:ProveedoresCalificacion','c');
        $qb->leftJoin('c.proveedor', 'p');
        $qb->where('c.id='.$id);
        $datos = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $html = $this->render('IncentivesOperacionesBundle:Calificacion:carta.html.twig', array(
            'datos' => $datos
        ));

        $rootDir = dirname($this->container->getParameter('kernel.root_dir'));
        $Dir = '/web/Calificacion/';
        $uploadDir = $rootDir.$Dir;

        $dompdf = new DOMPDF();
        $dompdf->load_html($html,'UTF-8');
        $dompdf->render();
        $pdf = $dompdf->output();
        file_put_contents($uploadDir.$datos[0]['proveedor']['numero_documento']."_carta.pdf", $pdf);
        $calificacion = $em->getRepository('IncentivesOperacionesBundle:ProveedoresCalificacion')->find($id);
        $calificacion->setCarta($Dir.$datos[0]['proveedor']['numero_documento']."_carta.pdf");
        $em->persist($calificacion);
        $em->flush();

        return $uploadDir.$datos[0]['proveedor']['numero_documento']."_carta.pdf";
    }


    public function planestadoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $calificacion = $em->getRepository('IncentivesOperacionesBundle:ProveedoresCalificacion')->find($id);
        $calificacion->setEstadoPlan(1);
      
        $em->persist($calificacion);
        $em->flush();

    
        return $this->redirect($this->generateUrl('planes'));
    }
    
    public function exportarAction()
    {

	    // Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Sinaptica bIT")
			                             ->setLastModifiedBy("Sinaptica bIT")
			                             ->setCategory("");
			     
			     
		$em = $this->getDoctrine()->getManager();
		

		$objPHPExcel->getActiveSheet()
			  			->setCellValue('A1','Id')
			            ->setCellValue('B1','Razon Social')
			            ->setCellValue('C1','Documento')
			            ->setCellValue('D1','Pais')
			            ->setCellValue('E1','Categoria')
			            ->setCellValue('F1','Periodo Evaluación')
			            ->setCellValue('G1','Número')
			            ->setCellValue('H1','Estado')
			            ->setCellValue('I1','Fecha Evaluación')
			            ->setCellValue('J1','Eligibilidad Técnica')
			            ->setCellValue('K1','Eligibilidad Operativa')
			            ->setCellValue('L1','Puntaje Total')
			            ->setCellValue('M1','Observaciones');
			            
			$fil=2;
			
			
			$query = $em->createQueryBuilder()
                ->select('pv','c','ct','p') 
                ->from('IncentivesOperacionesBundle:ProveedoresCalificacion', 'c')
                ->Join('c.proveedor','pv')
                ->leftJoin('pv.pais','p')
                ->leftJoin('pv.categoria','ct')
                ->orderBy('pv.nombre', 'ASC');
                
            $califcaciones = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
			
			//echo "<pre>"; print_r($califcaciones); echo "</pre>"; exit;
			
			foreach ($califcaciones as $keyC => $valueC){
			    
			    $estado = "Por Aprobar";
			    if($valueC['estado']==1) $estado = "Aprobada";
			    if($valueC['estado']==2) $estado = "Rechazada";
			    
			    $tecnica = ($valueC['ce'] + $valueC['cpi'] + $valueC['bep'] + $valueC['pd'])*2;
                $operativa = ($valueC['aoc'] + $valueC['cfp'])*6;
            
			    $objPHPExcel->getActiveSheet()
			            ->setCellValue('A'.$fil, $valueC['proveedor']['id'])
			            ->setCellValue('B'.$fil, $valueC['proveedor']['nombre'])
			            ->setCellValue('C'.$fil, $valueC['proveedor']['numero_documento'])
			            ->setCellValue('D'.$fil, $valueC['proveedor']['pais']['nombre'])
			            ->setCellValue('E'.$fil, $valueC['proveedor']['categoria']['nombre'])
			            ->setCellValue('F'.$fil, $valueC['periodo'])
			            ->setCellValue('G'.$fil, $valueC['numero'])
			            ->setCellValue('H'.$fil, $estado)
			            ->setCellValue('I'.$fil, $valueC['fecha']->format('Y-m-d'))
			            ->setCellValue('J'.$fil, $tecnica)
			            ->setCellValue('K'.$fil, $operativa)
			            ->setCellValue('L'.$fil, $valueC['calificacion'])
			            ->setCellValue('M'.$fil, $valueC['observacion']);

			    $fil+=1;
			}
			
			 
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
			//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
			$objWriter->save('Calificaion_proveedores.xlsx');  //send it to user, of course you can save it to disk also!
			
			
			 // prepare BinaryFileResponse
			$basePath = $this->container->getParameter('kernel.root_dir').'/../web';
			$filename = 'Calificaion_proveedores.xlsx';
			$filePath = $basePath.'/'.$filename; 
			 
			$response = new BinaryFileResponse($filePath);
			$response->trustXSendfileTypeHeader();
			$response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
			
			return $response;

    }   

}

