<?php

namespace Incentives\OperacionesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Incentives\OperacionesBundle\Entity\Proveedores;
use Incentives\OperacionesBundle\Form\Type\ProveedoresType;
use Incentives\OperacionesBundle\Form\Type\ProveedoresedicionType;
use Incentives\OperacionesBundle\Entity\Contacto;
use Incentives\OperacionesBundle\Form\Type\ContactoType;
use Incentives\OperacionesBundle\Entity\Archivos;
use Incentives\OperacionesBundle\Form\Type\ArchivosType;
use Incentives\OperacionesBundle\Entity\Catalogo;
use Incentives\OperacionesBundle\Form\Type\CatalogoType;
use Incentives\OperacionesBundle\Entity\Tipo_documento;
use Incentives\OperacionesBundle\Entity\Aeconomica;
use Incentives\OperacionesBundle\Form\Type\AeconomicaType;
use Incentives\OperacionesBundle\Entity\Country;
use Incentives\OperacionesBundle\Entity\City;
use Incentives\OperacionesBundle\Form\Type\LocationType;
use Incentives\OperacionesBundle\Form\Type\PassType;
use Incentives\BaseBundle\Entity\Usuario;
use Incentives\OperacionesBundle\Entity\Excel;
use Incentives\OperacionesBundle\Entity\ProveedoresCalificacion;
use Incentives\OperacionesBundle\Form\Type\ProveedoresCalificacionType;
use Incentives\OperacionesBundle\Form\Type\ProveedoresPlanType;
use Incentives\OperacionesBundle\Form\Type\ProveedoresFiltroType;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Cell_DataValidation;
use PHPExcel_Style_Fill;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;



class ProveedorController extends Controller
{
       
	public function nuevoAction(Request $request)
    {
        // crea una task y le asigna algunos datos ficticios para este ejemplo
        
        $proveedor = new Proveedores();
        $contacto = new Contacto();
        $usuario = new Usuario();

		$form = $this->createForm(ProveedoresType::class, $proveedor);
                    
		if ($request->isMethod('POST')) {

			$form->bind($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                if (0 != count($proveedor->getContactos())) {
                    foreach ($proveedor->getContactos() as $contacto) {
                        $contacto->setProveedor($proveedor);
                        $proveedor->addContacto($contacto);
                        $em->persist($contacto);
                    }
                }    
                    
                $pro=($this->get('request')->request->get('proveedores'));

                $proveedor->setDireccion($pro["direccion"]);
                $pais = $em->getRepository('IncentivesOperacionesBundle:Pais')->find($pro["pais"]);
                $proveedor->setPais($pais);
                $ciudad = $em->getRepository('IncentivesOperacionesBundle:Ciudad')->find($pro["ciudad"]);
                $proveedor->setCiudad($ciudad);
                $regimen = $em->getRepository('IncentivesOperacionesBundle:Regimen')->find($pro["regimen"]);
                $proveedor->setRegimen($regimen);
                $clasificacion = $em->getRepository('IncentivesOperacionesBundle:ProveedoresClasificacion')->find($pro["proveedorclasificacion"]);
                $proveedor->setProveedorClasificacion($clasificacion);
                $area = $em->getRepository('IncentivesOperacionesBundle:ProveedoresArea')->find($pro["proveedorarea"]);
                $proveedor->setProveedorArea($area);
                $proveedor->setSedeprincipal($pro["sede_principal"]);
                $proveedor->setRegistrocamara($pro["registro_camara"]);
                $proveedor->setTelefono($pro["telefono"]);
                $proveedor->setLineaAtencion($pro["lineaAtencion"]);
                $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
                $proveedor->setEstado($estado);
                if (isset($pro["sedes"])){
                    $proveedor->setSedes(true);
                }else{
                    $proveedor->setSedes(false);
                }
                $proveedor->setDatossedes($pro["datos_sedes"]);
                $proveedor->setPagina($pro["pagina"]);
                $tipo = $em->getRepository('IncentivesOperacionesBundle:ProveedoresTipo')->find($pro["proveedortipo"]);
                $proveedor->setProveedortipo($tipo);
                /*if($pro["codigo_postal"]) $proveedor->setCodigopostal($pro["codigo_postal"]);
                if($pro["cobertura"]) $proveedor->setCobertura($pro["cobertura"]);
                if($pro["condiciones_comerciales"]) $proveedor->setCondicionescomerciales($pro["condiciones_comerciales"]);
                if($pro["tiempo_entrega"]) $proveedor->setTiempoentrega($pro["tiempo_entrega"]);
                if($pro["cupo_asignado"]) $proveedor->setCupoAsignado($pro["cupo_asignado"]);
                */
                $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($pro["categoria"]);
                $proveedor->setCategoria($categoria);   

                if($pro["proveedortipo"]==1){
	                $usuario->setNombre($pro["nombre"]);
	                //$usuario->setGrupos('Proveedor');
	                $usuario->setEmail($pro["correo"]);
	                $usuario->setUsername($pro["numero_documento"]);
	                $usuario->setPassword($pro["numero_documento"]);
	                $grupo = $em->getRepository('IncentivesBaseBundle:Grupo')->find(4);
	                $usuario->setGrupos($grupo);
	                $usuario->setProveedor($proveedor);
	                $proveedor->addUsuario($usuario);
	                $em->persist($usuario);
            	}

                $em->persist($proveedor);

			    try {
	                $em->flush();
	               
	                $this->get('session')->getFlashBag()->add('notice', 'El proveedor con documento '.$pro["numero_documento"].' se creo correctamente');
			   		
	                /*if(!$this->correoIngresoAction($proveedor->getId())){
				    	$this->get('session')->getFlashBag()->add('warning', 'No es posible el envio del correo.');
				    }*/

			   		return $this->redirect($this->generateUrl('proveedores'));
	     
			     } catch(\Exception $e){
			      	//throw new \Exception('Ya existe un registro con el número de identificación y/o correo digitados.');
			       	$this->get('session')->getFlashBag()->add('warning','Ya existe un registro con el número de identificación digitado.');
			    }

			}
		}            

        return $this->render('IncentivesOperacionesBundle:Proveedor:nuevo.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction(Request $request, $id)
    {

    	$user = $this->get('security.token_storage')->getToken()->getUser()->getRoles();
		$rol = $user[0]->getRole();
		if ($rol == 'ROLE_PROV') {
            $proveedor =  $this->getUser()->getProveedor();
            $id = $proveedor->getId();
      	}

    	$em = $this->getDoctrine()->getManager();

        if (isset($id)){
	        $proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($id);
	        $form = $this->createForm(ProveedoresedicionType::class, $proveedor);
	    }else{
	     	$form = $this->createForm(ProveedoresedicionType::class);
	     	$proveedor = new Proveedores();
	    }

	    $actividad = new Aeconomica();

		if ($request->isMethod('POST')) {
			$pro=($this->get('request')->request->get('proveedores'));
			$form->bind($request);

			//if ($form->isValid()) {
				
				$pro=($this->get('request')->request->get('proveedores'));
				$id=($this->get('request')->request->get('id'));
				$proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($id);
				
				$proveedor->setDireccion($pro["direccion"]);
				$pais = $em->getRepository('IncentivesOperacionesBundle:Pais')->find($pro["pais"]);
				$proveedor->setPais	($pais);
				$ciudad = $em->getRepository('IncentivesOperacionesBundle:Ciudad')->find($pro["ciudad"]);
				$proveedor->setCiudad($ciudad);
				$regimen = $em->getRepository('IncentivesOperacionesBundle:Regimen')->find($pro["regimen"]);
				$proveedor->setRegimen($regimen);
				
				$user = $this->get('security.context')->getToken()->getUser()->getRoles();
				$rol = $user[0]->getRole();
				if ($rol == 'ROLE_PROV') {
					$categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($pro["categoria"]);
							$proveedor->setCategoria($categoria);
				}

                $clasificacion = $em->getRepository('IncentivesOperacionesBundle:ProveedoresClasificacion')->find($pro["proveedorclasificacion"]);
                $proveedor->setProveedorClasificacion($clasificacion);
                
                $area = $em->getRepository('IncentivesOperacionesBundle:ProveedoresArea')->find($pro["proveedorarea"]);
                $proveedor->setProveedorArea($area);
                
				$otrasSedes = isset($pro["sedes"]) ? $pro["sedes"] : 0;
				
				$proveedor->setCorreo($pro["correo"]);
				$proveedor->setNombre($pro["nombre"]);
				$proveedor->setSedeprincipal($pro["sede_principal"]);
				$proveedor->setRegistrocamara($pro["registro_camara"]);
				$proveedor->setTelefono($pro["telefono"]);
				$proveedor->setLineaAtencion($pro["lineaAtencion"]);
				if(isset($pro["directo"])) $proveedor->setDirecto($pro["directo"]);
				$proveedor->setSedes($otrasSedes);
				$proveedor->setDatossedes($pro["datos_sedes"]);
				$proveedor->setPagina($pro["pagina"]);
				$proveedor->setCupoAsignado($pro["cupo_asignado"]);
				$proveedor->setCondicionesComerciales($pro["condiciones_comerciales"]);
				$proveedor->setCodigoPostal($pro["codigo_postal"]);
				$proveedor->setTiempoEntrega($pro["tiempo_entrega"]);
				$proveedor->setCupoAsignado($pro["cupo_asignado"]);
				$proveedor->setCobertura($pro["cobertura"]);
				$proveedor->setNumeroDocumento($pro["numero_documento"]);
				$tipodocumento = $em->getRepository('IncentivesOperacionesBundle:Tipodocumento')->find($pro["tipodocumento"]);
				$proveedor->setTipodocumento($tipodocumento);
 	            $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($pro["categoria"]);
                $proveedor->setCategoria($categoria);   


				if (isset($pro["aeconomica"])) {
                    foreach ($pro["aeconomica"] as $value) {
                        $conteo=0;
                        foreach ($proveedor->getAeconomica() as $aeconomica){
                            if ($value["codigo"]==$aeconomica->getCodigo()){
                                $conteo++;
                            }
                        }
                        if ($conteo==0){                                
                            $actividad->setCodigo($value["codigo"]);
                            $actividad->setProveedor($proveedor);
                            $proveedor->addAeconomicon($actividad);
							$em->persist($proveedor);
                            $em->persist($actividad);
							$em->flush();
                        }
                    }
                }

				//$query->getResult();	
				$em->flush();

				//return $this->render('IncentivesOperacionesBundle:Proveedor:index.html.twig');
				return $this->redirect($this->generateUrl('proveedores_datos').'/'.$id);
			//}
		}            

        return $this->render('IncentivesOperacionesBundle:Proveedor:edit.html.twig', array(
            'form' => $form->createView(), 'proveedor' => $proveedor, 'id'=>$id,
        ));
    }

     public function listadoAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
            
        $session = $this->get('session');
           
        $page = $request->get('page');
        
        if(!$page) $page= 1;
            
        if($pro=($request->request->get('proveedores'))){
            $page = 1;
            $session->set('filtros_proveedores', $pro);
        }

        $sqlFiltro = " 1=1 ";

        if($filtros = $session->get('filtros_proveedores')){
               
            foreach($filtros as $Filtro => $valueF){
                  
                if($valueF!=""){
                    if($Filtro=="pais"){
                        $sqlFiltro .= " AND ps.id=".$valueF."";
                    }elseif($Filtro=="ciudad"){
                        $sqlFiltro .= " AND c.id=".$valueF."";
                    }elseif($Filtro=="estado"){
                        $sqlFiltro .= " AND e.id=".$valueF."";
                    }else{
                        $sqlFiltro .= " AND p.".$Filtro." LIKE '%".$valueF."%'";
                    }
                       
                };
            } 
                
        }

		$form = $this->createForm(ProveedoresFiltroType::class);

        $qb = $em->createQueryBuilder();
	    $qb->select('p','e','c','ps');
	    $qb->from('IncentivesOperacionesBundle:Proveedores','p');
	    $qb->leftJoin('p.pais','ps');
	    $qb->leftJoin('p.estado','e');
	    $qb->leftJoin('p.ciudad','c');
	    $qb->where($sqlFiltro);
	    
		$repositoryp = $this->getDoctrine()
    		->getRepository('IncentivesOperacionesBundle:Proveedores');

	    $listado = $qb->getQuery()->getResult();

    	$qb = $em->createQueryBuilder();
	    $qb->select('count(t.id)');
	    $qb->from('IncentivesOperacionesBundle:Tipoarchivo','t');
	    $qb->where('t.id != 3');
	    
	    $cantidadTipo = $qb->getQuery()->getSingleScalarResult();
	    
	    $detalle = array();

	    foreach ($listado as $keyP => $valueP) {
	    	$idP =$valueP->getId();

	    	$detalle['calificacion'][$idP] = 0 + $this->valorCal($idP);
	    	$totalDocs = 0 + $this->totalDocumentos($idP);
	    	$detalle['documentos'][$idP] = @($totalDocs/$cantidadTipo) * 100;
	    	$detalle['catalogo'][$idP] = $this->ultimoCatalogo($idP);

	    	if($detalle['documentos'][$idP] >= 100 ){
				$detalle['clasedoc'][$idP] = 'progress-success';
	    	}elseif($detalle['documentos'][$idP] >= 60){
				$detalle['clasedoc'][$idP] = 'progress-warning';
	    	}else{
	    		$detalle['clasedoc'][$idP] = 'progress-danger';
	    	} 

	    	if($detalle['catalogo'][$idP] == null){
				$detalle['clasecat'][$idP] = 'btn-danger';
	    	}else{

	    		$datetime2 = date_create($detalle['catalogo'][$idP]['fecha']->format('Y-m-d'));
				$datetime1 = date_create('now');
				$interval = date_diff($datetime1, $datetime2);
				(int)$diff = $interval->format('%a');

				if($diff >= 30) $detalle['clasecat'][$idP] = 'btn-warning';
	    	}
	    }

	    $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $listado,
                $page/*page number*/,
                50 /*limit per page*/
            );

	    return $this->render('IncentivesOperacionesBundle:Proveedor:listado_nuevo.html.twig', 
	    	array('listado' => $pagination, 'detalle' => $detalle, 'form' => $form->createView()));
	}

    public function datosAction($id)
	{

		$user = $this->get('security.token_storage')->getToken()->getUser()->getRoles();
		$rol = $user[0]->getRole();
		if ($rol == 'ROLE_PROV') {
            $proveedor =  $this->getUser()->getProveedor();
            $id = $proveedor->getId();
      	}

		$repositoryp = $this->getDoctrine()
    		->getRepository('IncentivesOperacionesBundle:Proveedores');

		$repositoryc = $this->getDoctrine()
    		->getRepository('IncentivesOperacionesBundle:Contacto');

		$repositorya = $this->getDoctrine()
    		->getRepository('IncentivesOperacionesBundle:Archivos');

		$repositoryca = $this->getDoctrine()
    		->getRepository('IncentivesOperacionesBundle:Catalogo');

    	$repositoryac = $this->getDoctrine()
    		->getRepository('IncentivesOperacionesBundle:Aeconomica');
    	
    	$repositorycal = $this->getDoctrine()
    		->getRepository('IncentivesOperacionesBundle:Proveedorescalificacion');

	    $proveedor = $repositoryp->find($id);
	    $contacto = $repositoryc->findBy(array('proveedor'=> $id));
	    $archivo = $repositorya->findBy(array('proveedor'=> $id, 'estado' => 1));
	    $catalogo = $repositoryca->findBy(array('proveedor'=> $id, 'estado' => 1));
	    $aeconomica = $repositoryac->findBy(array('proveedor'=> $id));
	    $calificacion = $repositorycal->findBy(array('proveedor'=> $id, 'estado' => 1));


	    return $this->render('IncentivesOperacionesBundle:Proveedor:datos.html.twig', 
	    	array('proveedor' => $proveedor, 'id'=>$id, 'contacto' => $contacto, 
	    		'archivo'=>$archivo, 'catalogo'=>$catalogo, 'aeconomica'=>$aeconomica
	    		,'calificacion'=>$calificacion));
	}

	public function estadoAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		$proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($id);

		if ($proveedor->getEstado()->getId() == 1){
			$estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(2);
			$proveedor->setEstado($estado);
		}else{
			$estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
			$proveedor->setEstado($estado);
		}		
	    $em->flush();

    
    	return $this->redirect($this->generateUrl('proveedores'));
    }

   	public function documentosAction(Request $request, $id)
    {
		$em = $this->getDoctrine()->getManager();
		
	 	$user = $this->get('security.context')->getToken()->getUser()->getRoles();
		$rol = $user[0]->getRole();
		if ($rol == 'ROLE_PROV') {
            $proveedor =  $this->getUser()->getProveedor();
            $id = $proveedor->getId();
      	}

	 	if (isset($id)){
	        $proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($id);
	    }else{
	     	$proveedor = new Proveedores();
	    }
	    
	    $archivo = new Archivos();
	    $form = $this->createForm(new ArchivosType(), $archivo);
	       
		if ($request->isMethod('POST')) {
			$form->bind($request);

			if ($form->isValid()) {
				$id=($this->get('request')->request->get('id'));
				$proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($id);
			    $file = $form['archivo']->getData();
			    // compute a random name and try to guess the extension (more secure)
			    
                
			    $extension = $file->guessExtension();
			    if (!$extension) {
				// extension cannot be guessed
				$extension = 'bin';
			    }

			    if ($extension!='pdf') {
			        throw $this->createNotFoundException(
			            'Solo se aceptan archivos tipo pdf.'
			        );
			    }
			    
			    $rootDir = dirname($this->container->getParameter('kernel.root_dir'));
                $Dir = '/web/Proveedores/'.$proveedor->getNumeroDocumento().'/Documentos/';
                $uploadDir = $rootDir.$Dir;

			    $new=0;
			    foreach ($proveedor->getArchivo() as $value){
			    	$new++;
			    }

	    		$nombreArchivo = $proveedor->getNombre().$archivo->getTipoarchivo()->getNombre().$new.'.'.$extension;
			    $file->move($uploadDir,$nombreArchivo);

			    $archivo->setArchivo($nombreArchivo);
			    $archivo->setRuta($Dir);
			    $id=($this->get('request')->request->get('id'));
                $archivo->setProveedor($proveedor);
                
                $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
                $archivo->setEstado($estado);
			      
			    $em = $this->getDoctrine()->getManager();
			    $em->persist($archivo);
			    $em->flush();
		    
		    	return $this->redirect($this->generateUrl('proveedores_datos').'/'.$proveedor->getId());
		  	}
		}

		return $this->render('IncentivesOperacionesBundle:Proveedor:carga.html.twig', array(
	            'form' => $form->createView(), 'id'=>$id, 
		));      
    }

   	public function catalogoAction(Request $request, $id)
    {
		$em = $this->getDoctrine()->getManager();
		
	 	$user = $this->get('security.context')->getToken()->getUser()->getRoles();
		$rol = $user[0]->getRole();
		if ($rol == 'ROLE_PROV') {
            $proveedor =  $this->getUser()->getProveedor();
            $id = $proveedor->getId();
      	}
	 	
	 	if (isset($id)){
	        $proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($id);
	    }else{
	     	$proveedor = new Proveedores();
	    }
	    $catalogo = new Catalogo();
	    $form = $this->createForm(new CatalogoType(), $catalogo);
	       
		if ($request->isMethod('POST')) {
			$form->bind($request);

			if ($form->isValid()) {
				$id=($this->get('request')->request->get('id'));
				$proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($id);
				
			    $file = $form['archivo']->getData();
			    // compute a random name and try to guess the extension (more secure)
			    
                
			    $extension = $file->guessExtension();
			    if (!$extension) {
				// extension cannot be guessed
				$extension = 'bin';
			    }
			      
			    $rootDir = dirname($this->container->getParameter('kernel.root_dir'));
                $Dir = '/web/Proveedores/'.$proveedor->getNumeroDocumento().'/Catalogos/';
                $uploadDir = $rootDir.$Dir;

			    $nombreArchivo = $proveedor->getNombre().date("Y-m-d").'.'.$extension;
			    $file->move($uploadDir,$nombreArchivo);
			    $catalogo->setRuta($Dir);
			    $catalogo->setArchivo($nombreArchivo);

			    $id=($this->get('request')->request->get('id'));
                $catalogo->setProveedor($proveedor);
			     
			    $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
                $catalogo->setEstado($estado);
			     
			    $em = $this->getDoctrine()->getManager();
			    $em->persist($catalogo);
			    $em->flush();
		    
		    	return $this->redirect($this->generateUrl('proveedores_datos').'/'.$proveedor->getId());
		  	}
		}

		return $this->render('IncentivesOperacionesBundle:Proveedor:catalogo.html.twig', array(
	            'form' => $form->createView(), 'id'=>$id, 'proveedor'=>$proveedor,
		));      
    }

   	public function removercatalogoAction($id)
    {
	 	$em = $this->getDoctrine()->getManager();
	    $catalogo = $em->getRepository('IncentivesOperacionesBundle:Catalogo')->find($id);
	    unlink($catalogo->getRuta().$catalogo->getArchivo());
	    $catalogo->setProveedor(null);
	    $catalogo->setContacto(null);
	    $em->remove($catalogo);
		$em->flush();

		return $this->redirect($this->generateUrl('incentives_operaciones_proveedores_id'));      
    }

	public function pruebaAction(Request $request)
    {
        // crea una task y le asigna algunos datos ficticios para este ejemplo
        
        $pais = new Country();
        $ciudad = new City();

		$form = $this->createForm(new LocationType(), $pais);

		if ($request->isMethod('POST')) {
			$form->bind($request);

			if ($form->isValid()) {
			}
		}            

        return $this->render('IncentivesOperacionesBundle:Proveedor:prueba.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
	 * @Route("/listByCountry", name="_cityByCountryId")
	 */
	public function getByCountryId()
	{
	    $this->em = $this->get('doctrine')->getEntityManager();
	    $this->repository = $this->em->getRepository('RunnerMainBundle:City');
	 
	    $countryId = $this->get('request')->query->get('data');
	 
	    $cities = $this->repository->findByCountry($countryId);
	 
	    $html = '';
	    foreach($cities as $city)
	    {
	        $html = $html . sprintf("<option value=\"%d\">%s</option>",$city->getId(), $city->getNombre());
	    }
	 
	    return new Response($html);
	}

    public function correoIngresoAction($id)
    {

    	$em = $this->getDoctrine()->getManager();

    	$qb = $em->createQueryBuilder();
	    $qb->select('u');
	    $qb->from('IncentivesBaseBundle:Usuario','u');
	    $qb->where('u.proveedor = :id');
	    $qb->setParameter('id', $id);

	    $usuario = $qb->getQuery()->getSingleResult();


    	// Create the Transport
		$transport = \Swift_SmtpTransport::newInstance('mail.sociosyamigos.com', 25)
		  ->setAuthMode('login')
		  ->setUsername('pruebas@sociosyamigos.com')
		  ->setPassword('7d7_r47@fqxo')
		  ;

		// Create the Mailer using your created Transport
		$mailer = \Swift_Mailer::newInstance($transport);

	    $message = \Swift_Message::newInstance()
	        ->setSubject('Datos de Acceso. Incentives Operaciones')
	        ->setFrom('test@grupo-inc.com')
	        ->setTo($usuario->getEmail())
	        ->setBody(
	            $this->renderView(
	                'IncentivesOperacionesBundle:Proveedor:email.txt.twig',
	                array('usuario' => $usuario)
	            )
	        )
	    ;
	    
	    // Send the message
	    if($mailer->send($message)) {
	    	$this->get('session')->getFlashBag()->add('notice', 'El correo para ingresar ha sido enviado correctamente');
	    }else{
	    	$this->get('session')->getFlashBag()->add('notice', 'El mensaje no pudo ser enviado');
	    }

	    return $this->redirect($this->generateUrl('proveedores_datos').'/'.$id);
    }

    public function actualizarpasswordAction(Request $request, $id, $pass)
    {
    	$em = $this->getDoctrine()->getManager();
    	if (isset($id)){
	        $usuario = $em->getRepository('IncentivesBaseBundle:Usuario')->find($id);
	        $form = $this->createForm(new PassType(), $usuario);
	    	if ($usuario->getPassword()==$pass)
	    	{
	    		return $this->render('IncentivesOperacionesBundle:Proveedor:pass.html.twig', array(
	            	'form' => $form->createView(), 'id'=>$id, 'pass'=>$pass
	        	));
	    	}else{
		    	throw $this->createNotFoundException(
			            'Error en el token recibido'
		        );
		    }
	    }else{
	    	$form = $this->createForm(new PassType());
	    	$usuario = new Usuario();
	    }

	    if (!$usuario){
			throw $this->createNotFoundException(
	            'No se encontro el proveedor'
	        );
		}



    	if ($request->isMethod('POST')) {
			$form->bind($request);

			if ($form->isValid()) {
				$pro=($this->get('request')->request->get('password'));
				$id=($this->get('request')->request->get('id'));
				$pass=($this->get('request')->request->get('pass'));
				$usuario = $em->getRepository('IncentivesBaseBundle:Usuario')->find($id);

				if ($usuario->getPassword()!=$pass)
			    {
			    	throw $this->createNotFoundException(
				            'Error en el token recibido'
			        );
			    }

				if ($pro['password']['first']==$pro['password']['second']){
					$query = $em->createQuery(
					    'UPDATE IncentivesBaseBundle:Usuario p 
					    SET p.password=:password
					    WHERE p.id=:id'
					);
					$query->setParameters(array(
					    'password' => sha1($pro['password']['first'].'{'.$usuario->getSalt().'}'),
					    'id' => $id,
					));
					$query->getResult();
				
					return $this->redirect($this->generateUrl('login'));
				}else{
					throw $this->createNotFoundException(
			            'Claves no coinciden, vuelva a iniciar el proceso.'
			        );
				}
					
			}
		}


    }
    
    
    
    
    public function importarAction(Request $request)
    {
    	$excelForm = new Excel();
        $form = $this->createFormBuilder($excelForm)
            ->setAction($this->generateUrl('proveedores_importar'))
            ->setMethod('POST')
            ->add('excel', 'file')
            ->add('cargar', 'submit')
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->bind($request);

            $excel = $form['excel']->getData();

            $objPHPExcel = PHPExcel_IOFactory::load($excel);

            

            //$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            $sheetData = $objPHPExcel->getSheet(0)->toArray(null,true,true,true);

            $worksheet  = $objPHPExcel->setActiveSheetIndex('0');
            $ultimaFila = $worksheet->getHighestRow(); // e.g. 10
		    // $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
		    // $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

// 	    $em = $this->getDoctrine()->getManager();
// 	    $query = $em->createQuery(
// 		'SELECT p
// 		  FROM IncentivesOperacionesBundle:Proveedores p
// 	      ORDER BY p.id ASC'
// 	    );
// 	    
// 	    $proveedores = $query->getResult();
// 
// 	    $documento__ = $value->getNumeroDocumento();
// 	    $correo__ = $value->getCorreo();

	    
	    
            $conn = $this->get('database_connection');
            //$excelcar = $conn->insert('Cargaexcel', array('username' => 'jwage'));
                // INSERT INTO user (username) VALUES (?) (jwage)

            $date = date_create();
	    $fecha = date_format($date, 'Y-m-d');
	    
	    
	    $repetidos_corr = array();
	    $repetidos_doc = array();
            $fila=1;
            
            foreach ($sheetData as $row) {
            	if($fila > 1){
		    $rep_doc = $this->buscarepetidos($row['F'],'numero_documento');
		    //$rep_correo = $this->buscarepetidos($row['I'],'correo');
		    
		    if(count($rep_doc)) array_push($repetidos_doc, $rep_doc);
		    //if(count($rep_correo)) array_push($repetidos_corr, $rep_correo);
		    
		}
		$fila =$fila + 1;
            }
            
          /*  
            echo count($repetidos_doc).'</br>';
            echo count($repetidos_corr).'</br>';*/
            
            
            $fila=1;
            foreach ($sheetData as $row) {
            	if($fila > 1){
            		//	try
            		//echo "ULTIMA: ".$ultimaFila;
            		//print_r($row);
            		$tipoDoc = explode(" ", $row['A']);
	            	$pais = explode(" ", $row['B']);
	            	$ciudad = explode(" ", $row['C']);
	            	$regimen = explode(" ", $row['D']);
	            	$sedes = explode(" ", $row['M']);
	            	$categoria = explode(" ", $row['R']);
	            	$tipo = explode(" ", $row['X']);
	            	$estado = explode(" ", $row['P']);
		      
	            	
					if (count($repetidos_doc) == 0) {
						$excelcar = $conn->insert('Proveedores', array('tipodocumento_id' => $tipoDoc[0], 'pais_id' => $pais[0], 'ciudad_id' => $ciudad[0], 'regimen_id' => $regimen[0], 'nombre' => $row['E'], 'numero_documento' => $row['F'], 'sede_principal' => $row['G'], 'direccion' => $row['H'], 'correo' => $row['I'], 'registro_camara' => $row['J'], 'telefono' => $row['K'], 'sedes' => $sedes[0], 'datos_sedes' => $row['N'], 'pagina' => $row['O'], 'estado_id' => $estado[0], 'fecha' => $fecha, 'categoria_id' => $categoria[0], 'codigo_postal' => $row['S'], 'cobertura' => $row['T'], 'condiciones_comerciales' => $row['U'], 'tiempo_entrega' => $row['V'], 'cupo_asignado' => $row['W'],  'tipo_id' => $tipo[0]));
								//$idInsert = $conn->last_insert_id();
								//$excelcar = $conn->insert('Contacto', array('nombres' => $row['P'], 'correo' => $row['Q'], 'telefono' => $row['R'], 'movil' => $row['S'], 'cargo' => $row['T'], 'estado' => '1'));
						$ultimo_id = $conn->fetchColumn('SELECT MAX(id) FROM Proveedores WHERE 1', array(1), 0);
						if($row['Y']!="" && $row['Z']!="") $excelcar = $conn->insert('Contacto', array('proveedor_id' => $ultimo_id, 'nombres' => $row['Y'], 'correo' => $row['Z'], 'telefono' => $row['AA'], 'cargo' => $row['AA'], 'estado_id' => '1'));
						//echo $ultimo_id;
						$salt = md5(uniqid(null, true));
						$pass = sha1($row['F'].'{'.$salt.'}');
						$excelcar = $conn->insert('Usuarios', array('username' => $row['F'], 'nombre' => $row['E'], 'salt' => $salt, 'password' => $pass, 'email' => $row['I'], 'is_active' => '1', 'proveedor_id' => $ultimo_id));
						$ultimo_id_usuario = $conn->fetchColumn('SELECT MAX(id) FROM Usuarios WHERE 1', array(1), 0);
						$excelcar = $conn->insert('usuario_grupo', array('usuario_id' => $ultimo_id_usuario, 'grupo_id' => '4'));
						
					}
	                
	            }
	            $fila =$fila + 1;
            }
            $docsrep='';
            $corrsrep='';
            if (count($repetidos_doc)) {
				foreach($repetidos_doc as $key => $value) $docsrep .= ','.$value[0];
				if(count($repetidos_doc)) {
				    $this->get('session')->getFlashBag()->add(
					'warning',
					'No se ha podido cargar el documento porque existen documentos repetidos: '.$docsrep
				    );
				}
	    	}
            //return $this->redirect($this->generateUrl('importar'));
        }

        

        return $this->render('IncentivesOperacionesBundle:Proveedor:importar.html.twig', array(
            'form' => $form->createView(),));

    }
    
    private function buscarepetidos($buscar, $campo)
    {
	  $conn = $this->get('database_connection');
	  $res = $conn->fetchAll('SELECT '.$campo.' FROM Proveedores');
	  
	  $resultado = array();
// 	  
	  foreach($res as $key => $value) {;
// 	  echo $value[$campo];
	      if($buscar == $value[$campo]) array_push($resultado, $value[$campo]);		//    echo 'Repetido: '.$value[$campo];
	  }
// 	  
	  return $resultado;
    }
    
    
public function exportarAction()
    {
    	/*
		echo "<form method='post' action=''>";
		echo "<input name='go' type='submit' value='Exportar' />";
		echo "</form>";*/

// 		$filename='prueba.xlsx';
// 		echo "<a href=".$this->get('kernel')->getRootDir(). '/../web/'.$filename.">Descarga</a>";

		//if(isset($_POST['go'])) { // button name
			
			   // Create new PHPExcel object
			$objPHPExcel = new PHPExcel();

			// Set document properties
			$objPHPExcel->getProperties()->setCreator("Sinaptica bIT")
			                             ->setLastModifiedBy("Sinaptica bIT")
			                             ->setCategory("");
			     
			     
			$em = $this->getDoctrine()->getManager();
			$query = $em->createQuery(
			    'SELECT p
			      FROM IncentivesOperacionesBundle:Proveedores p
			  ORDER BY p.id ASC'
			);
			
			$proveedores = $query->getResult();

			
// 			$conn = $this->get('database_connection');	


			 $objPHPExcel->getActiveSheet()
			  			->setCellValue('A1','Id')
			            ->setCellValue('B1','Tipo de Documento')
			            ->setCellValue('C1','Pais')
			            ->setCellValue('D1','Ciudad')
			            ->setCellValue('E1','Regimen')
			            ->setCellValue('F1','Nombre')
			            ->setCellValue('G1','Documento')
			            ->setCellValue('H1','Sede Principal')
			            ->setCellValue('I1','Dirección')
			            ->setCellValue('J1','Correo')
			            ->setCellValue('K1','Registro Camara')
			            ->setCellValue('L1','Telefono')
			            ->setCellValue('N1','Sedes')
			            ->setCellValue('O1','Datos Sedes')
			            ->setCellValue('P1','Página')
			            ->setCellValue('Q1','Estado')
			            ->setCellValue('R1','Fecha')
			            ->setCellValue('S1','Categoria')
			            ->setCellValue('T1','Códifo Postal')
			            ->setCellValue('U1','Cobertura')
			            ->setCellValue('V1','Condiciones Comerciales')
			            ->setCellValue('W1','Tiempo de Entrga')
			            ->setCellValue('X1','Cupo Asignado')
			            ->setCellValue('Y1','Tipo');
			            //->setCellValue('Y1','Departamento');
			$fil=2;
			$conn = $this->get('database_connection');
			foreach ($proveedores as $key => $value) {
				# code...
				//echo  "Value: ". $value."<br/>";
				//print_r($value);
// 				print_r($value->getPais()->getNombre());

				$tipdoc_ = $conn->fetchColumn('SELECT tipodocumento_id FROM Proveedores WHERE id = '.$value->getId(), array(1), 0);
				$pais_ = $conn->fetchColumn('SELECT pais_id FROM Proveedores WHERE id = '.$value->getId(), array(1), 0);
				$ciudad_ = $conn->fetchColumn('SELECT ciudad_id FROM Proveedores WHERE id = '.$value->getId(), array(1), 0);
				//$departamento_ = $conn->fetchColumn('SELECT departamento_id FROM Proveedores WHERE id = '.$value->getId(), array(1), 0);
				$regimen_ = $conn->fetchColumn('SELECT regimen_id FROM Proveedores WHERE id = '.$value->getId(), array(1), 0);
				$categ_ = $conn->fetchColumn('SELECT categoria_id FROM Proveedores WHERE id = '.$value->getId(), array(1), 0);
				$tipo_ = $conn->fetchColumn('SELECT tipo_id FROM Proveedores WHERE id = '.$value->getId(), array(1), 0);
// 				echo $categ;
// 				
				//if($value->getEstado() == 1) $estadoProv = "Activo"; else $estadoProv = "Inactivo";

				$objPHPExcel->getActiveSheet()
// 			            ->setCellValue('A'.$fil, $value->getTipodocumento()->getNombre())
// 			            ->setCellValue('B'.$fil, $value->getPais()->getNombre())
// 			            ->setCellValue('C'.$fil, $value->getCiudad()->getNombre())
// 			            ->setCellValue('D'.$fil, $value->getRegimen()->getNombre())
			            ->setCellValue('A'.$fil, $value->getId())
			            ->setCellValue('F'.$fil, $value->getNombre())
			            ->setCellValue('G'.$fil, $value->getNumeroDocumento())
			            ->setCellValue('H'.$fil, $value->getSedePrincipal())
			            ->setCellValue('I'.$fil, $value->getDireccion())
			            ->setCellValue('J'.$fil, $value->getCorreo())
			            ->setCellValue('K'.$fil, $value->getRegistroCamara())
			            ->setCellValue('L'.$fil, $value->getTelefono())
			            ->setCellValue('N'.$fil, $value->getSedes())
			            ->setCellValue('O'.$fil, $value->getDatosSedes())
			            ->setCellValue('P'.$fil, $value->getPagina())
			            ->setCellValue('Q'.$fil, $value->getEstado()->getNombre())
			            ->setCellValue('R'.$fil, $value->getFecha()->format('Y-m-d'))
			           //->setCellValue('R'.$fil, $value->getCategoria()->getNombre())
			            ->setCellValue('T'.$fil, $value->getCodigoPostal())
			            ->setCellValue('U'.$fil, $value->getCobertura())
			            ->setCellValue('V'.$fil, $value->getCondicionesComerciales())
			            ->setCellValue('W'.$fil, $value->getTiempoEntrega())
			            ->setCellValue('X'.$fil, $value->getCupoAsignado());
// 				    print_r($value->getFecha()->date());
// 				    echo $value->getFecha()->format('Y-m-d H:i:s');
// 				    print_r($value->getCategoria()->Nombre);
// 				    echo $value->getCategoria()->getNombre();
				    if(null == $tipdoc_) $objPHPExcel->getActiveSheet()->setCellValue('B'.$fil, 'Nulo');
				    else $objPHPExcel->getActiveSheet()->setCellValue('B'.$fil, $value->getTipodocumento()->getNombre());

				    if(null == $pais_) $objPHPExcel->getActiveSheet()->setCellValue('C'.$fil, 'Nulo');
				    else $objPHPExcel->getActiveSheet()->setCellValue('C'.$fil, $value->getPais()->getNombre());

				    if(null == $ciudad_) $objPHPExcel->getActiveSheet()->setCellValue('D'.$fil, 'Nulo');
				    else $objPHPExcel->getActiveSheet()->setCellValue('D'.$fil, $value->getCiudad()->getNombre());

				    if(null == $regimen_) $objPHPExcel->getActiveSheet()->setCellValue('E'.$fil, 'Nulo');
				    else $objPHPExcel->getActiveSheet()->setCellValue('E'.$fil, $value->getRegimen()->getNombre());

				    if(null == $categ_) $objPHPExcel->getActiveSheet()->setCellValue('S'.$fil, 'Nulo');
				    else $objPHPExcel->getActiveSheet()->setCellValue('S'.$fil, $value->getCategoria()->getNombre());
				    
				    if(null == $tipo_) $objPHPExcel->getActiveSheet()->setCellValue('Y'.$fil, 'Nulo');
				    else $objPHPExcel->getActiveSheet()->setCellValue('Y'.$fil, $value->getProveedortipo()->getNombre());

 				    //if(null == $departamento_) $objPHPExcel->getActiveSheet()->setCellValue('Y'.$fil, 'Nulo');
				    //else $objPHPExcel->getActiveSheet()->setCellValue('Y'.$fil, $value->getDepartamento()->getNombre());

			    $fil+=1;
			}
			
			 
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
			//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
			$objWriter->save('Proveedor.xlsx');  //send it to user, of course you can save it to disk also!
			
			
			 // prepare BinaryFileResponse
			$basePath = $this->container->getParameter('kernel.root_dir').'/../web';
			$filename = 'Proveedor.xlsx';
			$filePath = $basePath.'/'.$filename; 
			 
			$response = new BinaryFileResponse($filePath);
			$response->trustXSendfileTypeHeader();
			$response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
			
			return $response;

		//}


	    //return $this->render('IncentivesOperacionesBundle:Proveedor:exportar.html.twig');		//, array(
	 //        'form' => $form->createView(),
		// ));


	    // return $this->render('AcmeoperacionesBundle:Operaciones:excel.html.twig', array(
	    //     'form' => $form->createView(),);
		  // return new Response ('Holaaaa '.$name);
    }   
    
    public function formatoAction()
    {

		for ($i = 'A'; $i !== 'AH'; $i++){
		    $letters[] = $i;
		}

		//print_r($letters); exit;
    
		//if(isset($_POST['go'])) { // button name
			
			   // Create new PHPExcel object
			$objPHPExcel = new PHPExcel();

			// Set document properties
			$objPHPExcel->getProperties()->setCreator("Sinaptica bIT")
			                             ->setLastModifiedBy("Sinaptica bIT")
			                             ->setCategory("");

                        
			$sheetData = $objPHPExcel->getSheet(0)->toArray(null,true,true,true);
			$objPHPExcel->setActiveSheetIndex('0');


			$conn = $this->get('database_connection');
			$sm = $conn->getSchemaManager();
			$columns = $sm->listTableColumns('Proveedores');
			$col = 0;
			//$letters = range('A', 'Z');

// 			print_r($letters); exit;

			foreach ($columns as $column) {
// 			    echo $column->getName() . ': ' . $column->getType() . "\n";
// 			    echo ($letters[$col].'1');
			    if(($col>0) && ($column->getName()!='departamento_id')){
					$objPHPExcel->getActiveSheet()
							->setCellValue($letters[$col-1].'1',$column->getName());
							
					if(($column->getName()=='tipodocumento_id') || ($column->getName()=='pais_id') || ($column->getName()=='ciudad_id') || ($column->getName()=='regimen_id') || ($column->getName()=='nombre') || ($column->getName()=='correo') || ($column->getName()=='telefono') || ($column->getName()=='categoria_id') || ($column->getName()=='tipo_id') || ($column->getName()=='numero_documento')) {
						$objPHPExcel->getActiveSheet()->getStyle($letters[$col-1].'1')->applyFromArray(
							array(
								'fill' => array(
									'type' => PHPExcel_Style_Fill::FILL_SOLID,
									'color' => array('rgb' => 'FFFF00')
								)
							)
						);
					$objPHPExcel->getActiveSheet()
							->setCellValue($letters[$col-1].'1',$column->getName().'***');
					}			        
			    }
			    $col += 1;
			}
			
			$objPHPExcel->getActiveSheet()
								->setCellValue('Y1','Nombre Contacto')
								->setCellValue('Z1','Correo Contacto')
								->setCellValue('AA1','Telefono Contacto')
								->setCellValue('AB1','Cargo Contacto');

			

			 //Lista tipodocumento_id
			$tipo_doc = $conn->fetchAll('SELECT nombre FROM Tipodocumento ORDER BY id ASC');
// 			print_r($tipo_doc);
			$tipdoc=Array();
			$indice=1;
			foreach($tipo_doc as $key => $value){
			    array_push($tipdoc, $indice.' - '.$value['nombre']);
// 			    echo 'Key: '.$key.'Valor: '.$value['nombre'];
// 			    print_r($value);
			    $indice+=1;
			}
// 			echo(implode(",", $tipdoc));
// 			print_r($tipdoc);
			
			$objValidation = $objPHPExcel->getActiveSheet()->getCell('A2')->getDataValidation();
			$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
			$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
			$objValidation->setAllowBlank(false);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setShowDropDown(true);
			$objValidation->setErrorTitle('Error de entrada.');
			$objValidation->setError('Este valor no esta en la lista.');
			$objValidation->setPromptTitle('Seleccione uno de la lista.');
			$objValidation->setPrompt('Por favor seleccione uno de la lista.');
// 			$objValidation->setFormula1('"Item A,Item B,Item C"');	// Make sure to put the list items between " and "  !!!
			$objValidation->setFormula1('"' . implode(",", $tipdoc) . '"');
			
			
			 //Lista pais_id
			$pais = $conn->fetchAll('SELECT nombre FROM Pais ORDER BY id ASC LIMIT 0, 14'); 	// 14 para que office no ponga problema
			$pais_array=Array();
			$indice=1;
			foreach($pais as $key => $value){
			    array_push($pais_array, $indice.' - '.$value['nombre']);
			    $indice+=1;
			}
			$objValidation = $objPHPExcel->getActiveSheet()->getCell('B2')->getDataValidation();
			$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
			$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
			$objValidation->setAllowBlank(false);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setShowDropDown(true);
			$objValidation->setErrorTitle('Error de entrada.');
			$objValidation->setError('Este valor no esta en la lista.');
			$objValidation->setPromptTitle('Seleccione uno de la lista.');
			$objValidation->setPrompt('Por favor seleccione uno de la lista.');
			//$objValidation->setFormula1('"1 - Colombia,2 - Peru"');
			$objValidation->setFormula1('"' . implode(",", $pais_array) . '"');
			
			
			 //Lista ciudad_id
			$ciudad = $conn->fetchAll('SELECT id,nombre FROM Ciudad WHERE principal=1 ORDER BY id ASC');
			$ciudad_array=Array();
			$indice=1;
			foreach($ciudad as $key => $value){
			    array_push($ciudad_array, $value['id'].' - '.$value['nombre']);
			    $indice+=1;
			}
			$objValidation = $objPHPExcel->getActiveSheet()->getCell('C2')->getDataValidation();
			$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
			$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
			$objValidation->setAllowBlank(false);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setShowDropDown(true);
			$objValidation->setErrorTitle('Error de entrada.');
			$objValidation->setError('Este valor no esta en la lista.');
			$objValidation->setPromptTitle('Seleccione uno de la lista.');
			$objValidation->setPrompt('Por favor seleccione uno de la lista.');
			//$objValidation->setFormula1('"1 - Bogota,2 - Cali"');
			$objValidation->setFormula1('"' . implode(",", $ciudad_array) . '"');
			

	 		////Lista estado
			//$departamento = $conn->fetchAll('SELECT id,nombre FROM Departamento ORDER BY id ASC');
			//$departamento_array=Array();
			//$indice=1;
			//foreach($departamento as $key => $value){
			//   array_push($departamento_array, $value['id'].' - '.$value['nombre']);
			//    $indice+=1;
			//}
			$objValidation = $objPHPExcel->getActiveSheet()->getCell('P2')->getDataValidation();
			$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
			$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
			$objValidation->setAllowBlank(false);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setShowDropDown(true);
			$objValidation->setErrorTitle('Error de entrada.');
			$objValidation->setError('Este valor no esta en la lista.');
			$objValidation->setPromptTitle('Seleccione uno de la lista.');
			$objValidation->setPrompt('Por favor seleccione uno de la lista.');
			$objValidation->setFormula1('"1 - Activo,0 - Inactivo"');
			
			
			
			 //Lista regimen_id
			$regimen = $conn->fetchAll('SELECT nombre FROM Regimen ORDER BY id ASC');
			$regimen_array=Array();
			$indice=1;
			foreach($regimen as $key => $value){
			    array_push($regimen_array, $indice.' - '.$value['nombre']);
			    $indice+=1;
			}
			$objValidation = $objPHPExcel->getActiveSheet()->getCell('D2')->getDataValidation();
			$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
			$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
			$objValidation->setAllowBlank(false);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setShowDropDown(true);
			$objValidation->setErrorTitle('Error de entrada.');
			$objValidation->setError('Este valor no esta en la lista.');
			$objValidation->setPromptTitle('Seleccione uno de la lista.');
			$objValidation->setPrompt('Por favor seleccione uno de la lista.');
			$objValidation->setFormula1('"' . implode(",", $regimen_array) . '"');
			
			
			
			 //Lista categoria_id
			$categoria = $conn->fetchAll('SELECT nombre FROM Categoria ORDER BY id ASC');
			$categoria_array=Array();
			$indice=1;
			foreach($categoria as $key => $value){
			    array_push($categoria_array, $indice.' - '.$value['nombre']);
			    $indice+=1;
			}
			$objValidation = $objPHPExcel->getActiveSheet()->getCell('R2')->getDataValidation();
			$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
			$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
			$objValidation->setAllowBlank(false);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setShowDropDown(true);
			$objValidation->setErrorTitle('Error de entrada.');
			$objValidation->setError('Este valor no esta en la lista.');
			$objValidation->setPromptTitle('Seleccione uno de la lista.');
			$objValidation->setPrompt('Por favor seleccione uno de la lista.');
			$objValidation->setFormula1('"' . implode(",", $categoria_array) . '"');
			
			
			 //Lista sedes
			$objValidation = $objPHPExcel->getActiveSheet()->getCell('M2')->getDataValidation();
			$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
			$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
			$objValidation->setAllowBlank(false);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setShowDropDown(true);
			$objValidation->setErrorTitle('Error de entrada.');
			$objValidation->setError('Este valor no esta en la lista.');
			$objValidation->setPromptTitle('Seleccione uno de la lista.');
			$objValidation->setPrompt('Por favor seleccione uno de la lista.');
			$objValidation->setFormula1('"1 - Si,2 - No"');
			
			
			 //Lista tipo_id
			$tipo = $conn->fetchAll('SELECT nombre FROM ProveedoresTipo ORDER BY id ASC');
			$tipo_array=Array();
			$indice=1;
			foreach($tipo as $key => $value){
			    array_push($tipo_array, $indice.' - '.$value['nombre']);
			    $indice+=1;
			}
			$objValidation = $objPHPExcel->getActiveSheet()->getCell('X2')->getDataValidation();
			$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
			$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
			$objValidation->setAllowBlank(false);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setShowDropDown(true);
			$objValidation->setErrorTitle('Error de entrada.');
			$objValidation->setError('Este valor no esta en la lista.');
			$objValidation->setPromptTitle('Seleccione uno de la lista.');
			$objValidation->setPrompt('Por favor seleccione uno de la lista.');
			$objValidation->setFormula1('"' . implode(",", $tipo_array) . '"');
			
			
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
			//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
			$objWriter->save('Formato_Proveedor.xlsx');  //send it to user, of course you can save it to disk also!

			
			 // prepare BinaryFileResponse
			$basePath = $this->container->getParameter('kernel.root_dir').'/../web';
			$filename = 'Formato_Proveedor.xlsx';
			$filePath = $basePath.'/'.$filename; 
			 

			$response = new BinaryFileResponse($filePath);
			$response->trustXSendfileTypeHeader();
			$response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
			
			return $response;

		//}
	    //return $this->render('IncentivesOperacionesBundle:Proveedor:formato.html.twig');		
    }

    public function valorCal($id){

    	$em = $this->getDoctrine()->getManager();

    	$qb = $em->createQueryBuilder();
	    $qb->select('c.calificacion');
	    $qb->from('IncentivesOperacionesBundle:ProveedoresCalificacion','c');
	    $qb->where('c.proveedor = :id');
	    $qb->where('c.proveedor = :id');
	    $qb->orderBy('c.id', 'DESC');
	    $qb->setParameter('id', $id);
	    $qb->setMaxResults(1);

	    $total = $qb->getQuery()->getOneOrNullResult();

		return $total['calificacion'];
    }

    public function totalDocumentos($id){

    	$em = $this->getDoctrine()->getManager();

    	$qb = $em->createQueryBuilder();
	    $qb->select('count(distinct a.tipoarchivo)');
	    $qb->from('IncentivesOperacionesBundle:Archivos','a');
	    $qb->where('a.proveedor = :id');
	    $qb->setParameter('id', $id);

	    $total = $qb->getQuery()->getSingleScalarResult();

		return $total;
    }

    public function ultimoCatalogo($id){

    	$em = $this->getDoctrine()->getManager();

    	$qb = $em->createQueryBuilder();
	    $qb->select('c.fecha');
	    $qb->from('IncentivesOperacionesBundle:Catalogo','c');
	    $qb->where('c.proveedor = :id');
	    $qb->orderBy('c.fecha', 'DESC');
	    $qb->setParameter('id', $id);
	    $qb->setMaxResults(1);

	    try {
		    $ultimoCatalogo = $qb->getQuery()->getSingleResult();
		} catch (\Doctrine\Orm\NoResultException $e) {
		    $ultimoCatalogo = null;
		}
		return $ultimoCatalogo;
    }

    public function calificacionAction(Request $request, $id)
    {
    	if ($this->get('security.context')->isGranted('ROLE_USER')) {
            $user =  $this->getUser();
      	}
    	$em = $this->getDoctrine()->getManager();
    	$proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($id);
     	$calificacion = new ProveedoresCalificacion();
     	$calificacion->setFecha(date_create("now"));
     	$calificacion->setUsuario($user);
     	$calificacion->setEstado("0");

	    $form = $this->createForm(new ProveedoresCalificacionType(), $calificacion);
	       
		if ($request->isMethod('POST')) {

            $form->bind($request);

            if ($form->isValid()) {
				$proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($id);
                $calificacion->setProveedor($proveedor);

                $pro=($this->get('request')->request->get('proveedorescalificacion'));
                $qb = $em->createQueryBuilder();
			    $qb->select('count(c)');
			    $qb->from('IncentivesOperacionesBundle:ProveedoresCalificacion','c');
			    
			    $strcal = 'c.proveedor ='.$proveedor->getId();
			    $strcal .= ' AND c.periodo ='.$pro['periodo'];
			    $strcal .= ' AND c.estado !=2';
			    $qb->where($strcal);
			    $qb->setMaxResults(1);

	    		$total = $qb->getQuery()->getOneOrNullResult();
                $calificacion->setNumero($total[1]+1);
                $em->persist($calificacion);
                $em->flush();

               return $this->redirect($this->generateUrl('proveedores_datos').'/'.$id);
            }

        }

		return $this->render('IncentivesOperacionesBundle:Proveedor:calificacion.html.twig', array(
	            'form' => $form->createView(), 'id'=>$id, 'proveedor'=>$proveedor, 'user'=>$user
		));

    }

    public function cargaPlanAction(Request $request, $id){

     	$calificacion = new ProveedoresCalificacion();

	    $form = $this->createForm(new ProveedoresPlanType(), $calificacion);

	    $proveedor =  $this->getUser()->getProveedor();
	       
		if ($request->isMethod('POST')) {

            $form->bind($request);

            if ($form->isValid()) {
            	$em = $this->getDoctrine()->getManager();

                $pro=($this->get('request')->request->get('cargaplan'));	

                $id=($this->get('request')->request->get('id'));
				$calificacion = $em->getRepository('IncentivesOperacionesBundle:ProveedoresCalificacion')->find($id);

                $calificacion->setObservacionproveedor($pro["observacionproveedor"]);

                $file = $form["planaccion"]->getData();
                
                $uploadDir=dirname($this->container->getParameter('kernel.root_dir')).'/web/Proveedores/'.$proveedor->getNumeroDocumento().'/Calificacion/';

                $nombreArchivo =  $file->getClientOriginalName();
                $file->move($uploadDir,$nombreArchivo);
                $calificacion->setPlanAccion($uploadDir.$nombreArchivo);
                $calificacion->setEstadoplan(0);

                $calificacion->setFechaPlan(new \DateTime("now"));

                $em->persist($calificacion);

                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'El formato se cargo correctamente.');
               
               	return $this->redirect($this->generateUrl('proveedores_datos').'/'.$id);

            }

        }

		return $this->render('IncentivesOperacionesBundle:Proveedor:cargaplan.html.twig', array(
	            'form' => $form->createView(), 'id'=>$id
		));

    }


    public function comprobaridentificacionAction(Request $request, $id){
    	//Cantidad de tipos de documentos a cargar
    	$em = $this->getDoctrine()->getManager();

    	$qb = $em->createQueryBuilder();
	    $qb->select('p');
	    $qb->from('IncentivesOperacionesBundle:Proveedores','p');
	    $qb->where('p.numero_documento = :id');
	    $qb->setParameter('id', $id);

	    $respuesta = '<div class="alert alert-success">
				<button class="close" data-dismiss="alert" type="button">×</button>
					Ok
				</div>';

	   if($proveedor = $qb->getQuery()->getOneOrNullResult()){
	        $respuesta = '<div class="alert alert-error">
				<button class="close" data-dismiss="alert" type="button">×</button>
					El documento ya se encuentra creado en las base de proveedores.
				</div>';
	    }else{

	    	$qb = $em->createQueryBuilder();
			$qb->select('u');
			$qb->from('IncentivesBaseBundle:Usuario','u');
			$qb->where('u.username = :id');
			$qb->setParameter('id', $id);

			if($usuario = $qb->getQuery()->getOneOrNullResult()){
	        $respuesta = '<div class="alert alert-error">
				<button class="close" data-dismiss="alert" type="button">×</button>
					El documento ya se encuentra creado en las base de usuarios.
				</div>';
	    	}
	    }

		return new Response($respuesta);

    }

    public function comprobarcorreoAction(Request $request, $id){
	
		//Cantidad de tipos de documentos a cargar
    	$em = $this->getDoctrine()->getManager();

    	$qb = $em->createQueryBuilder();
	    $qb->select('p');
	    $qb->from('IncentivesOperacionesBundle:Proveedores','p');
	    $qb->where('p.correo = :id');
	    $qb->setParameter('id', $id);

	    $respuesta = '<div class="alert alert-success">
				<button class="close" data-dismiss="alert" type="button">×</button>
					Ok
				</div>';
	    
	   if($proveedor = $qb->getQuery()->getOneOrNullResult()){
	        $respuesta = '<div class="alert alert-error">
				<button class="close" data-dismiss="alert" type="button">×</button>
					El correo ya se encuentra creado en las base de proveedores.
				</div>';
	    }else{

	    	$qb = $em->createQueryBuilder();
			$qb->select('u');
			$qb->from('IncentivesBaseBundle:Usuario','u');
			$qb->where('u.email = :id');
			$qb->setParameter('id', $id);

			if($usuario = $qb->getQuery()->getOneOrNullResult()){
	        $respuesta = '<div class="alert alert-error">
				<button class="close" data-dismiss="alert" type="button">×</button>
					El correo ya se encuentra creado en las base de usuarios.
				</div>';
	    	}
	    }

		return new Response($respuesta);

    }
    
    
    
    
    public function importarproductoproveedorAction(Request $request, $id)
    {
    	$excelForm = new Excel();
        $form = $this->createFormBuilder($excelForm)
            ->setAction($this->generateUrl('proveedores_importar_proveedor'))
            ->setMethod('POST')
            ->add('excel', 'file')
            ->add('cargar', 'submit')
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->bind($request);

            $excel = $form['excel']->getData();

            $objPHPExcel = PHPExcel_IOFactory::load($excel);

            

            //$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            $sheetData = $objPHPExcel->getSheet(0)->toArray(null,true,true,true);

            $worksheet  = $objPHPExcel->setActiveSheetIndex('0');
            $ultimaFila = $worksheet->getHighestRow(); // e.g. 10
		   
		   
	    
            $conn = $this->get('database_connection');
            //$excelcar = $conn->insert('Cargaexcel', array('username' => 'jwage'));
                // INSERT INTO user (username) VALUES (?) (jwage)

            $date = date_create();
	    $fecha = date_format($date, 'Y-m-d');
	    
	    
	    //$repetidos_corr = array();
	    //$repetidos_doc = array();
            //$fila=1;
            
            //foreach ($sheetData as $row) {
            	//if($fila > 1){
					//$rep_doc = $this->buscarepetidos($row['F'],'numero_documento');
					//$rep_correo = $this->buscarepetidos($row['I'],'correo');
					
					//if(count($rep_doc)) array_push($repetidos_doc, $rep_doc);
					//if(count($rep_correo)) array_push($repetidos_corr, $rep_correo);
					
				//}
				//$fila =$fila + 1;
            //}
            
          /*  
            echo count($repetidos_doc).'</br>';
            echo count($repetidos_corr).'</br>';*/
            
            //$proveedor_id = $this->get('request')->query->get('id');
            //$pro = $this->getRequest();
			//$pro->query->get('id'); 
			//$pro->query->get('id');
            //$pro_id =  $_GET['id'];
            $fila=1;
            foreach ($sheetData as $row) {
            	if($fila > 1){
            		//	try
            		//echo "ULTIMA: ".$ultimaFila;
            		//print_r($row);
            		$tipoDoc = explode(" ", $row['A']);
	            	$pais = explode(" ", $row['B']);
	            	$ciudad = explode(" ", $row['C']);
	            	$regimen = explode(" ", $row['D']);
	            	$sedes = explode(" ", $row['M']);
	            	$categoria = explode(" ", $row['R']);
	            	$tipo = explode(" ", $row['X']);
	            	$estado = explode(" ", $row['P']);
					
									//$request->query->get('id');
	            	//echo "Proveedor: ".$pro_id;
					//if (count($repetidos_doc) == 0 && count($repetidos_corr) == 0) {
						$excelcar = $conn->insert('Productoprecio', array('producto_id' => $row['A'], 'proveedor_id' => $row['U'], 'precio' => $row['S'], 'estado' => $row['M'], 'principal' => $row['T'], 'fecha' => $fecha));
								//$idInsert = $conn->last_insert_id();
								//$excelcar = $conn->insert('Contacto', array('nombres' => $row['P'], 'correo' => $row['Q'], 'telefono' => $row['R'], 'movil' => $row['S'], 'cargo' => $row['T'], 'estado' => '1'));
					//}
	                
	            }
	            $fila =$fila + 1;
            }
            $docsrep='';
            $corrsrep='';
            if (count($repetidos_doc) || count($repetidos_corr)) {
				foreach($repetidos_doc as $key => $value) $docsrep .= ','.$value[0];
				foreach($repetidos_corr as $key => $value) $corrsrep .= ','.$value[0];
				if(count($repetidos_doc)) {
					$this->get('session')->getFlashBag()->add(
					'warning',
					'No se ha podido cargar el documento porque existen documentos repetidos: '.$docsrep
					);
				}
				//if(count($repetidos_corr)) {
					//$this->get('session')->getFlashBag()->add(
					//'warning',
					//'No se ha podido cargar el documento porque existen correos repetidos: '.$corrsrep
					//);
				//}
				// 		echo '<h3 style="background-color:red;">No se ha podido cargar el documento porque existen datos repetidos: <br/>';
				// 		if(count($repetidos_doc)) {
				// 		    echo 'Numeros de documento: ';
				// 		    print_r($repetidos_doc);
				// 		}
				// 		if(count($repetidos_corr)) {
				// 		    echo '<br/>Correos: ';
				// 		    print_r($repetidos_corr);
				// 		}
				// 		echo '</h3>';
			}
            //return $this->redirect($this->generateUrl('importar'));
        }

        

        return $this->render('IncentivesOperacionesBundle:Proveedor:productoporproveedor.html.twig', array('id'=>$id,
            'form' => $form->createView(),));

    }
    
    
    public function catalogoProveedorEstadoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $archivo = $em->getRepository('IncentivesOperacionesBundle:Catalogo')->find($id);
        $proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($archivo->getProveedor()->getId());

        if ($archivo->getEstado()->getId() == 1){
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(2);
            $archivo->setEstado($estado);
        }else{
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
            $archivo->setEstado($estado);
        }       
        $em->flush();
        
        return $this->redirect($this->generateUrl('proveedores_datos')."/".$proveedor->getId());
    }
    
     public function archivoProveedorEstadoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $archivo = $em->getRepository('IncentivesOperacionesBundle:Archivos')->find($id);
        $proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($archivo->getProveedor()->getId());

        if ($archivo->getEstado()->getId() == 1){
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(2);
            $archivo->setEstado($estado);
        }else{
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
            $archivo->setEstado($estado);
        }       
        $em->flush();
        
        return $this->redirect($this->generateUrl('proveedores_datos')."/".$proveedor->getId());
    }
    
}
