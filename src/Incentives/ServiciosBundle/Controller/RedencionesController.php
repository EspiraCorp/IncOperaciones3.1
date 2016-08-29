<?php

namespace Incentives\ServiciosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Incentives\RedencionesBundle\Entity\Participantes;
use Incentives\RedencionesBundle\Entity\Redenciones;
use Incentives\RedencionesBundle\Entity\RedencionesHistorico;
use Incentives\RedencionesBundle\Entity\Redencionesenvios;
use Incentives\RedencionesBundle\Entity\Redencionesatributos;

use Symfony\Component\HttpFoundation\Response;

class RedencionesController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    public function NuevaAction(Request $request)
    {

    	$mensaje = "";
        
    	// obtener el objeto de la petición
		

		// obtiene el valor de un parámetro $_GET
		if(null !== $request->query->get('parametros')) {
			$parametros = $request->query->get('parametros');
		}else{
			$parametros = $request->request->get('parametros');
		}
		$parametros = json_decode(urldecode($parametros));
		
		if(!(isset($parametros->participante->id) && $parametros->participante->id!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio cédula del participante';
        }elseif(!(isset($parametros->catalogo) && $parametros->catalogo!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio identificacion del catalogo';
        }else{

        	$em = $this->getDoctrine()->getManager();
        	$catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($parametros->catalogo);

        	$programa = $catalogo->getPrograma()->getId();

        	//comprobar si el participante existe o no para este programa
        	$qb = $em->createQueryBuilder();            
	        $qb->select('p');
	        $qb->from('IncentivesRedencionesBundle:Participantes','p');
	        $str_filtro = 'p.programa = :id_programa';

	        if(isset($parametros->participante->id)){
	             $str_filtro .= ' AND (p.participante LIKE :participante)';
	             $arrayParametros['participante'] = $parametros->participante->id;
	        }

	        $qb->where($str_filtro);

	        //Definicion de parametros para filtros
	        $arrayParametros['id_programa'] = $programa;
	        $qb->setParameters($arrayParametros);
	            
	        $participante = $qb->getQuery()->getOneOrNullResult(); 

		    if(isset($participante)){
		    	$id_participante = $participante->getId();
		    }else{
		    	$participante = new Participantes();

		    	$participante->setLlave($parametros->participante->id."_".$programa);
		    	$participante->setNombre($parametros->participante->nombre_completo);
		    	$participante->setDocumento($parametros->participante->cedula);
		    	$participante->setParticipante($parametros->participante->id);
		    	$tipodocumento = $em->getRepository('IncentivesOperacionesBundle:Tipodocumento')->find("1");
		    	$participante->setTipodocumento($tipodocumento);
		    	if(isset($parametros->participante->correo)) $participante->setCorreo($parametros->participante->correo);
		    	if(isset($parametros->info_envio->direccion)) $participante->setDireccion($parametros->info_envio->direccion);
		    	if(isset($parametros->info_envio->ciudad)) $participante->setCiudadNombre($parametros->info_envio->ciudad);
		    	if(isset($parametros->info_envio->telefono)) $participante->setTelefono($parametros->info_envio->telefono);
		    	if(isset($parametros->info_envio->celular)) $participante->setCelular($parametros->info_envio->celular);
		    	if(isset($parametros->info_envio->barrio)) $participante->setBarrio($parametros->info_envio->barrio);
                $participante->setEstado("1");
                $estado = $em->getRepository('IncentivesRedencionesBundle:Participantesestado')->find("1");
                $participante->setParticipanteestado($estado);
                $programaP = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($programa);
                $participante->setPrograma($programaP);
                $em->persist($participante);
                $em->flush();

                $id_participante = $participante->getId();
		    }

			$parametros->redencion->fecha;

			//Generar codigo de redencion
			$random_cod = rand(1, 10000);
			$codRedencion = $programa.$id_participante.$random_cod;
			
			$exitoso = 0;

			//Productos redimidos
			foreach($parametros->redencion->productos as $keyP){
				
				$productoR = explode(";", $keyP);
				$sku = $productoR[0];				
				$cantidad = $productoR[1];
				$puntos = 0 ;
				$valor = 0;
				if(isset( $productoR[2])) $puntos = $productoR[2];
				if(isset( $productoR[3])) $valor = $productoR[3];

				$arrayParametros = array();

				//buscar producto redimido
				$qb = $em->createQueryBuilder();            
		        $qb->select('pr');
		        $qb->from('IncentivesCatalogoBundle:Premios','pr');
		        $qb->leftJoin('pr.premiosproductos', 'pp');
		        $qb->leftJoin('pp.producto', 'p');
		        $str_filtro = 'pr.catalogos = :id_catalogo';
		        $str_filtro .= ' AND (p.codInc LIKE :sku)';
		        $str_filtro .= ' AND pr.activo=1 AND pr.aproboCliente=1';
		        $qb->groupBy('pr.id');

		        //Definicion de parametros para filtros
		        $arrayParametros['sku'] = $sku;
		        $arrayParametros['id_catalogo'] = $parametros->catalogo;
		        $qb->setParameters($arrayParametros);
		            
		        $premio = $qb->getQuery()->getOneOrNullResult();

		        if(isset($producto)){//Si el producto existe almacenar y esta activo y aprobado

			        $idproductoC = $producto->getId();

			        //Identificar atributos
			        if(isset($productoR[4])){
			        	$atributos = $productoR[4];
				        $atributos = explode(',', $atributos);
			        } 

			        //Almacenar redencion
			        for($i=1;$i<=$cantidad;$i++){
				    
			        	$noNulo = 0;

			        	//Almacenar Redencion
				        $redencion = new Redenciones();

		                $redencion->setParticipante($participante);
		                $redencion->setPremio($premio);
		                $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('1');
		                $redencion->setRedencionestado($estado);
		                $redencion->setCodigoredencion($codRedencion);
		                $redencion->setFecha(new \DateTime($parametros->redencion->fecha));
		                $redencion->setRedimidopor($parametros->redencion->redimidopor);
		                if(isset($parametros->redencion->otros)) $redencion->setOtros($parametros->redencion->otros);
		                
		                //if(isset($parametros->redencion->puntos) && $parametros->redencion->puntos!="" && $parametros->redencion->puntos!=0 && isset($parametros->redencion->valor) && $parametros->redencion->valor!="" && $parametros->redencion->valor!=0){
							
							if(isset($valor) && $valor!="" && $valor>0){
								$redencion->setValor($valor);
								$noNulo++;
							} 

							if(isset($puntos) && $puntos!="" && $puntos>0) {
								$redencion->setPuntos($puntos);
								$noNulo++;
							}elseif($producto->getPuntos() != ""){
								$redencion->setPuntos($producto->getPuntos());
								$noNulo++;
							}

							if($noNulo>0){
								
								$exitoso++;

								$em->persist($redencion);

								//Almacenar Atributos
								if(isset($atributos)){
									foreach ($atributos as $keyAt => $valueAt) {
										$atributoP = $em->getRepository('IncentivesCatalogoBundle:Atributosproducto')->find($valueAt);

										$atributoR = new Redencionesatributos();
										$atributoR->setRedencion($redencion);
										$atributoR->setAtributos($atributoP);
										$em->persist($atributoR);
									}
								}

								//Almacenar Datos de Envio
								$envio = new RedencionesEnvios();
								
								if(isset($parametros->info_envio->cedula)){
									$envio->setDocumento($parametros->info_envio->cedula);	
								}elseif(isset($parametros->participante->cedula)){
									$envio->setDocumento($parametros->participante->cedula);
								}
								
								if(isset($parametros->info_envio->nombre)){
									$envio->setNombre($parametros->info_envio->nombre);	
								}elseif(isset($parametros->participante->nombre_completo)){
									$envio->setNombre($parametros->participante->nombre_completo);
								}
								
								if(isset($parametros->info_envio->direccion)) $envio->setDireccion($parametros->info_envio->direccion);
								if(isset($parametros->info_envio->ciudad)) $envio->setCiudadNombre($parametros->info_envio->ciudad);
								if(isset($parametros->info_envio->departamento)) $envio->setDepartamentoNombre($parametros->info_envio->departamento);
								if(isset($parametros->info_envio->telefono)) $envio->setTelefono($parametros->info_envio->telefono);
								if(isset($parametros->info_envio->celular)) $envio->setCelular($parametros->info_envio->celular);
								if(isset($parametros->info_envio->barrio)) $envio->setBarrio($parametros->info_envio->barrio);
//								if(isset($parametros->participante->cedula)) $envio->setDocumento($parametros->participante->cedula);

								if(isset($parametros->info_envio->contacto_nombre)) $envio->setNombreContacto($parametros->info_envio->contacto_nombre);
								if(isset($parametros->info_envio->contacto_direccion)) $envio->setDireccionContacto($parametros->info_envio->contacto_direccion);
								if(isset($parametros->info_envio->contacto_ciudad)) $envio->setCiudadContacto($parametros->info_envio->contacto_ciudad);
								if(isset($parametros->info_envio->contacto_departamento)) $envio->setDepartamentoContacto($parametros->info_envio->contacto_departamento);
								if(isset($parametros->info_envio->contacto_telefono)) $envio->setTelefonoContacto($parametros->info_envio->contacto_telefono);
								if(isset($parametros->info_envio->contacto_celular)) $envio->setCelularContacto($parametros->info_envio->contacto_celular);
								if(isset($parametros->info_envio->contacto_barrio)) $envio->setBarrioContacto($parametros->info_envio->contacto_barrio);
								if(isset($parametros->info_envio->contacto_documento)) $envio->setDocumentoContacto($parametros->info_envio->contacto_documento);
								$envio->setRedencion($redencion);
								$em->persist($envio);

								$em->flush();

								//Almacenar Historico
								$redencionH = $this->get('incentives_redenciones');
								$redencionH->insertar($redencion);


							}else{					
								$mensaje .= " El producto: ".$productoR[0]."  no cuenta con puntos validos.";
							}
		                
		                
						}
	            }else{

	            	$mensaje .= " Lo sentimos, el producto solicitado ya se encuentra agotado, por favor redima otro producto del catalogo de premios.";
	            }
				
			}

			if($exitoso>0){
				$respuesta['estado'] = 1;
        		$respuesta['mensaje'] = $codRedencion; 
			}else{
				$respuesta['estado'] = 0;
				$respuesta['mensaje']="";
			}
        	
        }
           
        $respuesta['mensaje'].=$mensaje;

        print_r(json_encode($respuesta));
      
		$response = new Response();
		return $response->send();
    
    }

    public function PremioAction(Request $request)
    {

    	$mensaje = "";
        
    	// obtener el objeto de la petición
		

		// obtiene el valor de un parámetro $_GET
		if(null !== $request->query->get('parametros')) {
			$parametros = $request->query->get('parametros');
		}else{
			$parametros = $request->request->get('parametros');
		}
		$parametros = json_decode(urldecode($parametros));
		
		if(!(isset($parametros->participante->id) && $parametros->participante->id!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio cédula del participante';
        }elseif(!(isset($parametros->catalogo) && $parametros->catalogo!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio identificacion del catalogo';
        }else{

        	$em = $this->getDoctrine()->getManager();
        	$catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($parametros->catalogo);

        	$programa = $catalogo->getPrograma()->getId();

        	//comprobar si el participante existe o no para este programa
        	$qb = $em->createQueryBuilder();            
	        $qb->select('p');
	        $qb->from('IncentivesRedencionesBundle:Participantes','p');
	        $str_filtro = 'p.programa = :id_programa';

	        if(isset($parametros->participante->id)){
	             $str_filtro .= ' AND (p.participante LIKE :participante)';
	             $arrayParametros['participante'] = $parametros->participante->id;
	        }

	        $qb->where($str_filtro);

	        //Definicion de parametros para filtros
	        $arrayParametros['id_programa'] = $programa;
	        $qb->setParameters($arrayParametros);
	            
	        $participante = $qb->getQuery()->getOneOrNullResult(); 

		    if(isset($participante)){
		    	$id_participante = $participante->getId();
		    }else{
		    	$participante = new Participantes();

		    	$participante->setLlave($parametros->participante->id."_".$programa);
		    	$participante->setNombre($parametros->participante->nombre_completo);
		    	$participante->setDocumento($parametros->participante->cedula);
		    	$participante->setParticipante($parametros->participante->id);
		    	$tipodocumento = $em->getRepository('IncentivesOperacionesBundle:Tipodocumento')->find("1");
		    	$participante->setTipodocumento($tipodocumento);
		    	if(isset($parametros->participante->correo)) $participante->setCorreo($parametros->participante->correo);
		    	if(isset($parametros->info_envio->direccion)) $participante->setDireccion($parametros->info_envio->direccion);
		    	if(isset($parametros->info_envio->ciudad)) $participante->setCiudadNombre($parametros->info_envio->ciudad);
		    	if(isset($parametros->info_envio->telefono)) $participante->setTelefono($parametros->info_envio->telefono);
		    	if(isset($parametros->info_envio->celular)) $participante->setCelular($parametros->info_envio->celular);
		    	if(isset($parametros->info_envio->barrio)) $participante->setBarrio($parametros->info_envio->barrio);
                $participante->setEstado("1");
                $estado = $em->getRepository('IncentivesRedencionesBundle:Participantesestado')->find("1");
                $participante->setParticipanteestado($estado);
                $programaP = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($programa);
                $participante->setPrograma($programaP);
                $em->persist($participante);
                $em->flush();

                $id_participante = $participante->getId();
		    }

			$parametros->redencion->fecha;

			//Generar codigo de redencion
			$random_cod = rand(1, 10000);
			$codRedencion = $programa.$id_participante.$random_cod;
			
			$exitoso = 0;

			//Productos redimidos
			foreach($parametros->redencion->productos as $keyP){
				
				$productoR = explode(";", $keyP);
				$idPremio = $productoR[0];				
				$cantidad = $productoR[1];
				$puntos = 0 ;
				$valor = 0;
				if(isset( $productoR[2])) $puntos = $productoR[2];
				if(isset( $productoR[3])) $valor = $productoR[3];

				$arrayParametros = array();

				//buscar producto redimido
				$qb = $em->createQueryBuilder();            
		        $qb->select('pr');
		        $qb->from('IncentivesCatalogoBundle:Premios','pr');
		        $qb->leftJoin('pr.premiosproductos', 'pp');
		        $qb->leftJoin('pp.producto', 'p');
		        $str_filtro = 'pr.catalogos = :id_catalogo';
		        $str_filtro .= ' AND (pr.id LIKE :idPremio)';
		        $str_filtro .= ' AND pr.activo=1 AND pr.aproboCliente=1';
		        $qb->where($str_filtro);
		        $qb->groupBy('pr.id');

		        //Definicion de parametros para filtros
		        $arrayParametros['idPremio'] = $idPremio;
		        $arrayParametros['id_catalogo'] = $parametros->catalogo;
		        $qb->setParameters($arrayParametros);
		            
		        $premio = $qb->getQuery()->getOneOrNullResult();

		        if(isset($producto)){//Si el producto existe almacenar y esta activo y aprobado

			        $idproductoC = $producto->getId();

			        //Identificar atributos
			        if(isset($productoR[4])){
			        	$atributos = $productoR[4];
				        $atributos = explode(',', $atributos);
			        } 

			        //Almacenar redencion
			        for($i=1;$i<=$cantidad;$i++){
				    
			        	$noNulo = 0;

			        	//Almacenar Redencion
				        $redencion = new Redenciones();

		                $redencion->setParticipante($participante);
		                $redencion->setPremio($premio);
		                $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('1');
		                $redencion->setRedencionestado($estado);
		                $redencion->setCodigoredencion($codRedencion);
		                $redencion->setFecha(new \DateTime($parametros->redencion->fecha));
		                $redencion->setRedimidopor($parametros->redencion->redimidopor);
		                if(isset($parametros->redencion->otros)) $redencion->setOtros($parametros->redencion->otros);
		                
		                //if(isset($parametros->redencion->puntos) && $parametros->redencion->puntos!="" && $parametros->redencion->puntos!=0 && isset($parametros->redencion->valor) && $parametros->redencion->valor!="" && $parametros->redencion->valor!=0){
							
							if(isset($valor) && $valor!="" && $valor>0){
								$redencion->setValor($valor);
								$noNulo++;
							} 

							if(isset($puntos) && $puntos!="" && $puntos>0) {
								$redencion->setPuntos($puntos);
								$noNulo++;
							}elseif($producto->getPuntos() != ""){
								$redencion->setPuntos($producto->getPuntos());
								$noNulo++;
							}

							if($noNulo>0){
								
								$exitoso++;

								$em->persist($redencion);

								//Almacenar Atributos
								if(isset($atributos)){
									foreach ($atributos as $keyAt => $valueAt) {
										$atributoP = $em->getRepository('IncentivesCatalogoBundle:Atributosproducto')->find($valueAt);

										$atributoR = new Redencionesatributos();
										$atributoR->setRedencion($redencion);
										$atributoR->setAtributos($atributoP);
										$em->persist($atributoR);
									}
								}

								//Almacenar Datos de Envio
								$envio = new RedencionesEnvios();
								
								if(isset($parametros->info_envio->cedula)){
									$envio->setDocumento($parametros->info_envio->cedula);	
								}elseif(isset($parametros->participante->cedula)){
									$envio->setDocumento($parametros->participante->cedula);
								}
								
								if(isset($parametros->info_envio->nombre)){
									$envio->setNombre($parametros->info_envio->nombre);	
								}elseif(isset($parametros->participante->nombre_completo)){
									$envio->setNombre($parametros->participante->nombre_completo);
								}
								
								if(isset($parametros->info_envio->direccion)) $envio->setDireccion($parametros->info_envio->direccion);
								if(isset($parametros->info_envio->ciudad)) $envio->setCiudadNombre($parametros->info_envio->ciudad);
								if(isset($parametros->info_envio->departamento)) $envio->setDepartamentoNombre($parametros->info_envio->departamento);
								if(isset($parametros->info_envio->telefono)) $envio->setTelefono($parametros->info_envio->telefono);
								if(isset($parametros->info_envio->celular)) $envio->setCelular($parametros->info_envio->celular);
								if(isset($parametros->info_envio->barrio)) $envio->setBarrio($parametros->info_envio->barrio);
//								if(isset($parametros->participante->cedula)) $envio->setDocumento($parametros->participante->cedula);

								if(isset($parametros->info_envio->contacto_nombre)) $envio->setNombreContacto($parametros->info_envio->contacto_nombre);
								if(isset($parametros->info_envio->contacto_direccion)) $envio->setDireccionContacto($parametros->info_envio->contacto_direccion);
								if(isset($parametros->info_envio->contacto_ciudad)) $envio->setCiudadContacto($parametros->info_envio->contacto_ciudad);
								if(isset($parametros->info_envio->contacto_departamento)) $envio->setDepartamentoContacto($parametros->info_envio->contacto_departamento);
								if(isset($parametros->info_envio->contacto_telefono)) $envio->setTelefonoContacto($parametros->info_envio->contacto_telefono);
								if(isset($parametros->info_envio->contacto_celular)) $envio->setCelularContacto($parametros->info_envio->contacto_celular);
								if(isset($parametros->info_envio->contacto_barrio)) $envio->setBarrioContacto($parametros->info_envio->contacto_barrio);
								if(isset($parametros->info_envio->contacto_documento)) $envio->setDocumentoContacto($parametros->info_envio->contacto_documento);
								$envio->setRedencion($redencion);
								$em->persist($envio);

								$em->flush();

								//Almacenar Historico
								$redencionH = $this->get('incentives_redenciones');
								$redencionH->insertar($redencion);


							}else{					
								$mensaje .= " El producto: ".$productoR[0]."  no cuenta con puntos validos.";
							}
		                
		                
						}
	            }else{

	            	$mensaje .= " Lo sentimos, el producto solicitado ya se encuentra agotado, por favor redima otro producto del catalogo de premios.";
	            }
				
			}

			if($exitoso>0){
				$respuesta['estado'] = 1;
        		$respuesta['mensaje'] = $codRedencion; 
			}else{
				$respuesta['estado'] = 0;
				$respuesta['mensaje']="";
			}
        	
        }
           
        $respuesta['mensaje'].=$mensaje;

        print_r(json_encode($respuesta));
      
		$response = new Response();
		return $response->send();
    
    }


    public function AutorizadaAction(Request $request)
    {
        
    	// obtener el objeto de la petición
		

		// obtiene el valor de un parámetro $_GET
		if(null !== $request->query->get('parametros')) {
			$parametros = $request->query->get('parametros');
		}else{
			$parametros = $request->request->get('parametros');
		}
		$parametros = json_decode(urldecode($parametros));
		
		if(!(isset($parametros->participante->cedula) && $parametros->participante->cedula!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio cédula del participante';
        }elseif(!(isset($parametros->catalogo) && $parametros->catalogo!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio identificacion del catalogo';
        }else{

        	$em = $this->getDoctrine()->getManager();
        	$catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($parametros->catalogo);

        	$programa = $catalogo->getPrograma()->getId();

        	//comprobar si el participante existe o no para este programa
        	$qb = $em->createQueryBuilder();            
	        $qb->select('p');
	        $qb->from('IncentivesRedencionesBundle:Participantes','p');
	        $str_filtro = 'p.programa = :id_programa';

	        if(isset($parametros->participante->id)){
	             $str_filtro .= ' AND (p.participante LIKE :participante)';
	             $arrayParametros['participante'] = $parametros->participante->cedula;
	        }

	        $qb->where($str_filtro);

	        //Definicion de parametros para filtros
	        $arrayParametros['id_programa'] = $programa;
	        $qb->setParameters($arrayParametros);
	            
	        $participante = $qb->getQuery()->getOneOrNullResult(); 

		    if(isset($participante)){
		    	$id_participante = $participante->getId();
		    }else{
		    	$participante = new Participantes();

		    	$participante->setLlave($parametros->participante->cedula."_".$programa);
		    	$participante->setNombre($parametros->participante->nombre_completo);
		    	$participante->setDocumento($parametros->participante->cedula);
		    	$participante->setParticipante($parametros->participante->id);
		    	$tipodocumento = $em->getRepository('IncentivesOperacionesBundle:Tipodocumento')->find("1");
		    	$participante->setTipodocumento($tipodocumento);
		    	if(isset($parametros->participante->correo)) $participante->setCorreo($parametros->participante->correo);
		    	if(isset($parametros->info_envio->direccion)) $participante->setDireccion($parametros->info_envio->direccion);
		    	if(isset($parametros->info_envio->ciudad)) $participante->setCiudadNombre($parametros->info_envio->ciudad);
		    	if(isset($parametros->info_envio->telefono)) $participante->setTelefono($parametros->info_envio->telefono);
		    	if(isset($parametros->info_envio->celular)) $participante->setCelular($parametros->info_envio->celular);
		    	if(isset($parametros->info_envio->barrio)) $participante->setBarrio($parametros->info_envio->barrio);
                $participante->setEstado("1");
                $estado = $em->getRepository('IncentivesRedencionesBundle:Participantesestado')->find("1");
                $participante->setParticipanteestado($estado);
                $programaP = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($programa);
                $participante->setPrograma($programaP);
                $em->persist($participante);
                $em->flush();

                $id_participante = $participante->getId();
		    }

			$parametros->redencion->fecha;

			//Generar codigo de redencion
			$random_cod = rand(1, 10000);
			$codRedencion = $programa.$id_participante.$random_cod;
			
			//Productos redimidos
			foreach($parametros->redencion->productos as $keyP){
				
				$productoR = explode(";", $keyP);
				$sku = $productoR[0];				
				$cantidad = $productoR[1];

				$arrayParametros = array();

				//buscar producto redimido
				$qb = $em->createQueryBuilder();            
		        $qb->select('pc');
		        $qb->from('IncentivesCatalogoBundle:Productocatalogo','pc');
		        $qb->leftJoin('pc.producto', 'p');
		        $str_filtro = 'pc.catalogos = :id_catalogo';
		        $str_filtro .= ' AND (p.codInc LIKE :sku)';
		        $qb->where($str_filtro);

		        //Definicion de parametros para filtros
		        $arrayParametros['sku'] = $sku;
		        $arrayParametros['id_catalogo'] = $parametros->catalogo;
		        $qb->setParameters($arrayParametros);
		            
		        $producto = $qb->getQuery()->getOneOrNullResult();

		        $idproductoC = $producto->getId();

		        //Identificar atributos
		        if(isset($productoR[2])){
		        	$atributos = $productoR[2];
			        $atributos = explode(',', $atributos);
		        } 

		        //Almacenar redencion
		        for($i=1;$i<=$cantidad;$i++){
			    
		        	//Almacenar Redencion
			        $redencion = new Redenciones();

	                $redencion->setParticipante($participante);
	                $redencion->setProductocatalogo($producto);
	                $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('1');
	                $redencion->setRedencionestado($estado);
	                $redencion->setCodigoredencion($codRedencion);
	                $redencion->setFecha(new \DateTime($parametros->redencion->fecha));
	                $redencion->setValor($producto->getPuntos());
	                $redencion->setRedimidopor($parametros->redencion->redimidopor);
			if(isset($parametros->redencion->valor)) $envio->setValor($parametros->redencion->valor);			

	                $em->persist($redencion);

	                //Almacenar Atributos
	                if(isset($atributos)){
		                foreach ($atributos as $keyAt => $valueAt) {
		                	$atributoP = $em->getRepository('IncentivesCatalogoBundle:Atributosproducto')->find($valueAt);

		                	$atributoR = new Redencionesatributos();
		                	$atributoR->setRedencion($redencion);
		                	$atributoR->setAtributos($atributoP);
		                	$em->persist($atributoR);
		                }
		            }

	                //Almacenar Historico
	                $redencionH = $this->get('incentives_redenciones');
            		$redencionH->insertar($redencion);

	                //Almacenar Datos de Envio
	                $envio = new RedencionesEnvios();
	               	if(isset($parametros->info_envio->direccion)) $envio->setDireccion($parametros->info_envio->direccion);
			if(isset($parametros->info_envio->ciudad)) $envio->setCiudadNombre($parametros->info_envio->ciudad);
			if(isset($parametros->info_envio->departamento)) $envio->setDepartamentoNombre($parametros->info_envio->departamento);
			if(isset($parametros->info_envio->telefono)) $envio->setTelefono($parametros->info_envio->telefono);
			if(isset($parametros->info_envio->celular)) $envio->setCelular($parametros->info_envio->celular);
			if(isset($parametros->info_envio->barrio)) $envio->setBarrio($parametros->info_envio->barrio);

			if(isset($parametros->info_envio->contacto_nombre)) $envio->setNombreContacto($parametros->info_envio->contacto_nombre);
			if(isset($parametros->info_envio->contacto_direccion)) $envio->setDireccionContacto($parametros->info_envio->contacto_direccion);
			if(isset($parametros->info_envio->contacto_ciudad)) $envio->setCiudadContacto($parametros->info_envio->contacto_ciudad);
			if(isset($parametros->info_envio->contacto_departamento)) $envio->setDepartamentoContacto($parametros->info_envio->contacto_departamento);
			if(isset($parametros->info_envio->contacto_telefono)) $envio->setTelefonoContacto($parametros->info_envio->contacto_telefono);
			if(isset($parametros->info_envio->contacto_celular)) $envio->setCelularContacto($parametros->info_envio->contacto_celular);
			if(isset($parametros->info_envio->contacto_barrio)) $envio->setBarrioContacto($parametros->info_envio->contacto_barrio);
			if(isset($parametros->info_envio->contacto_documento)) $envio->setDocumentoContacto($parametros->info_envio->contacto_documento);

			$envio->setRedencion($redencion);
			$em->persist($envio);

	                $em->flush();
            	}
				
			}

			//echo $parametros->redencion->puntos_acumulados;
			//echo $parametros->redencion->cod_redencion;

			//echo $parametros->participante->nombre_completo;
			//echo $parametros->participante->cedula;	
		
			//echo $parametros->info_envio->direccion;
			//echo $parametros->info_envio->barrio;
			//echo $parametros->info_envio->ciudad;

        	$respuesta['estado'] = 1;
        	$respuesta['mensaje'] = $codRedencion; 
        }
           

        print_r(json_encode($respuesta));
      
		$response = new Response();
		return $response->send();
    
    }


    public function PuntosRedimidosAction(Request $request)
    {
        
		// obtener el objeto de la petición
		

		// obtiene el valor de un parámetro $_GET
		if(null !== $request->query->get('parametros')) {
			$parametros = $request->query->get('parametros');
		}else{
			$parametros = $request->request->get('parametros');
		}
		$parametros = json_decode(urldecode($parametros));
		
		if(!(isset($parametros->info_participante->id) && $parametros->info_participante->id!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio cédula del participante';
        }elseif(!(isset($parametros->programa) && $parametros->programa!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio identificacion del programa';
        }else{

        	$em = $this->getDoctrine()->getManager();
        	$programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($parametros->programa);

        	//comprobar si el participante existe o no para este programa
        	$qb = $em->createQueryBuilder();            
	        $qb->select('p');
	        $qb->from('IncentivesRedencionesBundle:Participantes','p');
	        $str_filtro = 'p.programa = :id_programa';

	        if(isset($parametros->info_participante->id)){
	             $str_filtro .= ' AND (p.participante = :participante)';
	             $arrayParametros['participante'] = $parametros->info_participante->id;
	        }

	        $qb->where($str_filtro);

	        //Definicion de parametros para filtros
	        $arrayParametros['id_programa'] = $programa;
	        $qb->setParameters($arrayParametros);
	            
	        $participante = $qb->getQuery()->getOneOrNullResult();
	        
	        if(isset($participante)){
				//Consultar puntos redimidos
				$qb1 = $em->createQueryBuilder();            
				$qb1->select('SUM(r.puntos)');
				$qb1->from('IncentivesRedencionesBundle:Redenciones','r');
				$str_filtro = 'r.participante = '.$participante->getId();
				$str_filtro .= " AND r.redencionestado != 7";
				
				if(isset($parametros->fecha_inicio)){
					$str_filtro .= " AND r.fecha >= '$parametros->fecha_inicio'";
				}

				if(isset($parametros->fecha_fin)){
					$str_filtro .= " AND r.fecha <= '$parametros->fecha_fin'";
				}

				$qb1->where($str_filtro);

				//Definicion de parametros para filtros
				//$arrayParametros['id_participante'] = $participante->getId();
				//$qb1->setParameters($arrayParametros);
					
				$redimidos = $qb1->getQuery()->getSingleScalarResult();
				
			}else{
				$redimidos = 0;
			}

	        $respuesta['estado'] = 1;
	       	$respuesta['mensaje'] = $redimidos;
	       	//$respuesta['mensaje']['puntos_poraprobar'] = $porAprobar;          
       }

        print_r(json_encode($respuesta));
      
		$response = new Response();
		return $response->send();
    
    }


    public function RedencionesParticipanteAction(Request $request)
    {
        
		// obtener el objeto de la petición
		

		// obtiene el valor de un parámetro $_GET
		if(null !== $request->query->get('parametros')) {
			$parametros = $request->query->get('parametros');
		}else{
			$parametros = $request->request->get('parametros');
		}
		$parametros = json_decode(urldecode($parametros));
		
		if(!(isset($parametros->info_participante->id) && $parametros->info_participante->id!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio cédula del participante';
        }elseif(!(isset($parametros->programa) && $parametros->programa!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio identificacion del programa';
        }else{

        	$em = $this->getDoctrine()->getManager();
	        //Consultar puntos redimidos

        	//comprobar si el participante existe o no para este programa
        	$qb = $em->createQueryBuilder();            
	        $qb->select('p');
	        $qb->from('IncentivesRedencionesBundle:Participantes','p');
	        $str_filtro = 'p.programa = :id_programa';
	        $str_filtro .= ' AND (p.participante = :participante)';
	        $arrayParametros['participante'] = $parametros->info_participante->id;
	        
	        $qb->where($str_filtro);

	         //Definicion de parametros para filtros
	        $arrayParametros['id_programa'] = $parametros->programa;
	        $qb->setParameters($arrayParametros);
	            
	        $participante = $qb->getQuery()->getOneOrNullResult();
	        
	        $qb1 = $em->createQueryBuilder();            
            $qb1->select('r');
	        $qb1->from('IncentivesRedencionesBundle:Redenciones','r');
	        $str_filtro = 'r.participante = '.$participante->getId();
	        $str_filtro .= " AND r.redencionestado != 7";

	        if(isset($parametros->fecha_inicio)){
                 $str_filtro .= " AND r.fecha >= '".$parametros->fecha_inicio."'";
            }

             if(isset($parametros->fecha_fin)){
                  $str_filtro .= " AND r.fecha <= '".$parametros->fecha_fin."'";
            }

	        $qb1->where($str_filtro);

	        //Definicion de parametros para filtros
	        //$arrayParametros['id_participante'] = $participante->getId();
	        //$qb1->setParameters($arrayParametros);
	            
	        $redenciones = $qb1->getQuery()->getResult();

	        $redencionesP = array();
	        foreach($redenciones as $key => $value){
	        	$redencionesP[$key]['cedula'] = $value->getParticipante()->getDocumento();
	        	$redencionesP[$key]['participante'] = $value->getParticipante()->getParticipante();
	        	$redencionesP[$key]['codigo'] = $value->getCodigoredencion();
				$redencionesP[$key]['sku'] = $value->getProductocatalogo()->getProducto()->getCodinc();
				$redencionesP[$key]['producto'] = $value->getProductocatalogo()->getProducto()->getNombre();
				$redencionesP[$key]['fecha'] = $value->getFecha()->format('Y-m-d');
				//if(isset($value->getFechaAutorizacion())) $redencionesP[$key]['fechaAutorizacion'] = $value->getFechaAutorizacion()->format('Y-m-d'); else $redencionesP[$key]['fechaAutorizacion'] = "";
				//if(isset($value->getFechaDespacho())) $redencionesP[$key]['fechaDespacho'] = $value->getFechaDespacho()->format('Y-m-d'); else $redencionesP[$key]['fechaDespacho'] = "";
				//if(isset($value->getFechaEntrega())) $redencionesP[$key]['fechaEntrega'] = $value->getFechaEntrega()->format('Y-m-d'); else $redencionesP[$key]['fechaEntrega'] = "";
				$redencionesP[$key]['estado'] = $value->getRedencionestado()->getNombre();
				$redencionesP[$key]['estado_id'] = $value->getRedencionestado()->getId();
				$redencionesP[$key]['valor'] = $value->getValor();
				$redencionesP[$key]['puntos'] = $value->getPuntos();
				$redencionesEnvios = $value->getRedencionesenvios();
				$redencionesP[$key]['departamento'] = $redencionesEnvios[0]->getDepartamentoNombre();
				$redencionesP[$key]['ciudad'] = $redencionesEnvios[0]->getCiudadNombre();
				$redencionesP[$key]['barrio'] = $redencionesEnvios[0]->getBarrio();
				$redencionesP[$key]['telefonos'] = $redencionesEnvios[0]->getTelefono();
				$redencionesP[$key]['celular'] = $redencionesEnvios[0]->getCelular();
				$redencionesP[$key]['redimidopor'] = $value->getRedimidopor();
				/*if($guias = $value->getOrdenesProducto()){
					$guias = $value->getOrdenesProducto()->getGuiaEnvio();
					if($guias[0]){
						$redencionesP[$key]['guia'] = $guias[0]->getGuia();
					}
				}*/
				$redencionesP[$key]['guia'] = "";
				$redencionesP[$key]['operador'] = "";
				if($value->getDespacho()){
				    $despacho = $value->getDespacho();
				    foreach($despacho as $keyD => $valueD){
				    	$despachoguias = $valueD->getDespachoguia();
				    	foreach($despachoguias as $keyDG => $valueDG){
					    	$guias = $valueDG->getGuia();
					    	$redencionesP[$key]['guia'] .= $guias->getGuia()." - ";
						    $redencionesP[$key]['operador'] .= $guias->getOperador()." - ";
					    }
				    }
				}
				
				
				$otros = $value->getOtros();
				if($otros!=""){
					
					$otros = explode(";", $otros);
				
					foreach($otros as $keyO){
						$camposO = explode(":", $keyO);
							$redencionesP[$key][$camposO[0]] = $camposO[1];
					}
				}
				//$redencionesP[$key]['otros'] = $value->getOtros();

	        }

	        $respuesta['estado'] = 1;
	       	$respuesta['mensaje'] = $redencionesP;
	       	//$respuesta['mensaje']['puntos_poraprobar'] = $porAprobar;          
       }

        print_r(json_encode($respuesta));
      
		$response = new Response();
		return $response->send();
    
    }

    public function RedencionesListadoAction(Request $request)
    {
        
		// obtener el objeto de la petición
		

		// obtiene el valor de un parámetro $_GET
		if(null !== $request->query->get('parametros')) {
			$parametros = $request->query->get('parametros');
		}else{
			$parametros = $request->request->get('parametros');
		}
		$parametros = json_decode(urldecode($parametros));
		
		if(!(isset($parametros->programa) && $parametros->programa!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio identificacion del programa';
        }else{

        	$em = $this->getDoctrine()->getManager();
        	$em->getConnection()->getConfiguration()->setSQLLogger(null);
	        //Consultar puntos redimidos
	        
	        $qb1 = $em->createQueryBuilder();            
            $qb1->select('r','pc','pd','pt','estado','d','dg','guia','envio');
	        $qb1->from('IncentivesRedencionesBundle:Redenciones','r');
            $qb1->leftJoin('r.productocatalogo', 'pc');
            $qb1->leftJoin('pc.catalogos', 'c');
            $qb1->leftJoin('pc.producto', 'pd');
            $qb1->leftJoin('r.participante', 'pt');
            $qb1->leftJoin('r.redencionestado', 'estado');
            $qb1->leftJoin('r.redencionesenvios', 'envio');
            $qb1->leftJoin('r.despacho', 'd');
            $qb1->leftJoin('d.despachoguia', 'dg');
            $qb1->leftJoin('dg.guia', 'guia');
	        $str_filtro = 'c.programa = '.$parametros->programa;
	        $str_filtro .= " AND r.redencionestado != 7";

	        if(isset($parametros->fecha_inicio)){
                 $str_filtro .= " AND r.fecha >= '$parametros->fecha_inicio'";
            }

             if(isset($parametros->fecha_fin)){
                  $str_filtro .= " AND r.fecha <= '$parametros->fecha_fin'";
            }

	        $qb1->where($str_filtro);

	        //Definicion de parametros para filtros
	        //$arrayParametros['id_participante'] = $participante->getId();
	        //$qb1->setParameters($arrayParametros);
	            
	        $redenciones = $qb1->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
			//echo "<pre>"; print_r($redenciones); echo "</pre>"; exit;			
			$redencionesP = array();
	        
	        foreach($redenciones as $key => $value){
				$redencionesP[$key]['id'] = $value['id'] ;
	        	$redencionesP[$key]['cedula'] = $value['participante']['documento'];
	        	$redencionesP[$key]['participante'] = $value['participante']['participante'];
	        	$redencionesP[$key]['codigo'] = $value['codigoredencion'];
				$redencionesP[$key]['sku'] = $value['productocatalogo']['producto']['codInc'];
				$redencionesP[$key]['producto'] = $value['productocatalogo']['producto']['nombre'];
				$redencionesP[$key]['fecha'] = $value['fecha']->format('Y-m-d');
				if(isset($value['fechaAutorizacion'])) $redencionesP[$key]['fechaAutorizacion'] = $value['fechaAutorizacion']->format('Y-m-d'); else $redencionesP[$key]['fechaAutorizacion'] = "";
				if(isset($value['fechaDespacho'])) $redencionesP[$key]['fechaDespacho'] = $value['fechaDespacho']->format('Y-m-d'); else $redencionesP[$key]['fechaDespacho'] = "";
				if(isset($value['fechaEntrega'])) $redencionesP[$key]['fechaEntrega'] = $value['fechaEntrega']->format('Y-m-d'); else $redencionesP[$key]['fechaEntrega'] = "";
				$redencionesP[$key]['estado'] = $value['redencionestado']['nombre'];
				$redencionesP[$key]['estado_id'] = $value['redencionestado']['id'];
				$redencionesP[$key]['valor'] = $value['valor'];
				$redencionesP[$key]['puntos'] = $value['puntos'];
				$redencionesP[$key]['departamento'] = $value['redencionesenvios'][0]['departamentoNombre'];
				$redencionesP[$key]['ciudad'] = $value['redencionesenvios'][0]['ciudadNombre'];
				$redencionesP[$key]['barrio'] = $value['redencionesenvios'][0]['barrio'];
				$redencionesP[$key]['direccion'] = $value['redencionesenvios'][0]['direccion'];
				$redencionesP[$key]['telefonos'] = $value['redencionesenvios'][0]['telefono'];
				$redencionesP[$key]['celular'] = $value['redencionesenvios'][0]['celular'];
				$redencionesP[$key]['redimidopor'] = $value['redimidopor'];
				/*if($guias = $value->getOrdenesProducto()){
					$guias = $value->getOrdenesProducto()->getGuiaEnvio();
					if(isset($guias[0])) $redencionesP[$key]['guia'] = $guias[0]->getGuia();
				}*/
				
				$redencionesP[$key]['guia'] = "";
				$redencionesP[$key]['operador'] = "";
				if($value['despacho']){
				    $despacho = $value['despacho'];
				    foreach($despacho as $keyD => $valueD){
				    	$despachoguias = $valueD['despachoguia'];
				    	foreach($despachoguias as $keyDG => $valueDG){
					    	$guias = $valueDG['guia'];
					    	$redencionesP[$key]['guia'] .= $guias['guia']." - ";
						    $redencionesP[$key]['operador'] .= $guias['operador']." - ";
					    }
				    }
				}

				$otros = $value['otros'];
				if($otros!=""){
					
					$otros = explode(";", $otros);
				
					foreach($otros as $keyO){
						$camposO = explode(":", $keyO);
							$redencionesP[$key][$camposO[0]] = utf8_encode($camposO[1]);
					}
				}

	        }
			//echo "<pre>"; print_r($redencionesP); echo "</pre>"; exit;
	        $respuesta['estado'] = 1;
	       	$respuesta['mensaje'] = $redencionesP;
	       	//$respuesta['mensaje']['puntos_poraprobar'] = $porAprobar;          
       }

        print_r(json_encode($respuesta));
      
		$response = new Response();
		return $response->send();
    
    }


	public function listadoPuntosRedimidosAction(Request $request)
    {
        
		// obtener el objeto de la petición
		

		// obtiene el valor de un parámetro $_GET
		if(null !== $request->query->get('parametros')) {
			$parametros = $request->query->get('parametros');
		}else{
			$parametros = $request->request->get('parametros');
		}
		$parametros = json_decode(urldecode($parametros));
		
		if(!(isset($parametros->programa) && $parametros->programa!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio identificacion del programa';
        }else{

        	$em = $this->getDoctrine()->getManager();
        	$programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($parametros->programa);
        
	        //Consultar puntos redimidos
			$qb = $em->createQueryBuilder();            
	        $qb->select('p.participante,SUM(r.puntos) puntos,SUM(r.valor) valor');
	        $qb->from('IncentivesRedencionesBundle:Redenciones','r');
	        $qb->Join('r.participante','p');
	        $str_filtro = 'p.programa = '.$programa->getId();
	        $str_filtro .= " AND r.redencionestado != 7";
	        $qb->groupBy('p.id');

	        $qb->where($str_filtro);
	        
	        $redimidos = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

	        $arregloPuntos = array();
	        
	        foreach($redimidos as $key => $value){
	        	
	        	$arregloPuntos[$value["participante"]]['puntos'] = $value["puntos"];
			$arregloPuntos[$value["participante"]]['valor'] = $value["valor"];
	        	
	        }

	        $respuesta['estado'] = 1;
	       	$respuesta['mensaje'] = $arregloPuntos;       
       }

        print_r(json_encode($respuesta));
      
		$response = new Response();
		return $response->send();
    
    }

	public function entregadoAction(Request $request)
    {

		// obtiene el valor de un parámetro $_GET
		$em = $this->getDoctrine()->getManager();
        
        $hoy = date("Y-m-d H:i:s");
    	$fecha = strtotime('-2 day', strtotime($hoy));
   		$fecha = date('Y-m-d H:i:s', $fecha);

	    //Consultar puntos redimidos
		$qb = $em->createQueryBuilder();            
	    $qb->select('r');
	    $qb->from('IncentivesRedencionesBundle:Redenciones','r');
	    $str_filtro = "r.redencionestado = 5 AND r.fechaModificacion <= '".$fecha."'";
	    $qb->where($str_filtro);
	        
	    $redenciones = $qb->getQuery()->getResult();

		$estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('6');
		
        foreach($redenciones as $key => $value){
	     
	     	$value->setRedencionestado($estado);
	     	$em->persist($value);
            $em->flush();
	     
	     	//Almacenar Historico
		 	$redencionH = $this->get('incentives_redenciones');
	        $redencionH->insertar($value);
	        	
        }
        
        $respuesta['estado'] = 1;
	   	$respuesta['mensaje'] = "estados actualizados";       
       
        print_r(json_encode($respuesta));
      
		$response = new Response();
		return $response->send();
    }

    public function PuntosRechazadosAction(Request $request)
    {
        
		// obtener el objeto de la petición
		

		// obtiene el valor de un parámetro $_GET
		if(null !== $request->query->get('parametros')) {
			$parametros = $request->query->get('parametros');
		}else{
			$parametros = $request->request->get('parametros');
		}
		$parametros = json_decode(urldecode($parametros));
		
		if(!(isset($parametros->info_participante->id) && $parametros->info_participante->id!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio cédula del participante';
        }elseif(!(isset($parametros->programa) && $parametros->programa!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio identificacion del programa';
        }else{

        	$em = $this->getDoctrine()->getManager();
        	$programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($parametros->programa);

        	//comprobar si el participante existe o no para este programa
        	$qb = $em->createQueryBuilder();            
	        $qb->select('p');
	        $qb->from('IncentivesRedencionesBundle:Participantes','p');
	        $str_filtro = 'p.programa = :id_programa';

	        if(isset($parametros->info_participante->id)){
	             $str_filtro .= ' AND (p.participante = :participante)';
	             $arrayParametros['participante'] = $parametros->info_participante->id;
	        }

	        $qb->where($str_filtro);

	        //Definicion de parametros para filtros
	        $arrayParametros['id_programa'] = $programa;
	        $qb->setParameters($arrayParametros);
	            
	        $participante = $qb->getQuery()->getOneOrNullResult();
	        
	        if(isset($participante)){
				//Consultar puntos redimidos
				$qb1 = $em->createQueryBuilder();            
				$qb1->select('SUM(r.puntos)');
				$qb1->from('IncentivesRedencionesBundle:Redenciones','r');
				$str_filtro = 'r.participante = '.$participante->getId();
				$str_filtro .= " AND r.redencionestado = 7";
				
				if(isset($parametros->fecha_inicio)){
					$str_filtro .= " AND r.fecha >= '$parametros->fecha_inicio'";
				}

				if(isset($parametros->fecha_fin)){
					$str_filtro .= " AND r.fecha <= '$parametros->fecha_fin'";
				}

				$qb1->where($str_filtro);

				//Definicion de parametros para filtros
				//$arrayParametros['id_participante'] = $participante->getId();
				//$qb1->setParameters($arrayParametros);
					
				$rechazados = $qb1->getQuery()->getSingleScalarResult();
				
			}else{
				$redimidos = 0;
			}

	        $respuesta['estado'] = 1;
	       	$respuesta['mensaje'] = $rechazados;
	       	//$respuesta['mensaje']['puntos_poraprobar'] = $porAprobar;          
       }

        print_r(json_encode($respuesta));
      
		$response = new Response();
		return $response->send();
    
    }

}
