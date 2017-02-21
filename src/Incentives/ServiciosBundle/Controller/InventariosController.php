<?php

namespace Incentives\ServiciosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Incentives\InventarioBundle\Entity\Inventario;
use Incentives\RedencionesBundle\Entity\Redenciones;
use Incentives\RedencionesBundle\Entity\RedencionesHistorico;
use Incentives\GarantiasBundle\Entity\Novedades;
use Incentives\RedencionesBundle\Entity\GuiaEnvio;
use Incentives\InventarioBundle\Entity\InventarioGuia;
use Incentives\ServiciosBundle\Entity\Servicios;
use Incentives\ServiciosBundle\Entity\ServiciosLog;
use Incentives\InventarioBundle\Entity\Despachos;

use Symfony\Component\HttpFoundation\Response;

class InventariosController extends Controller
{
    /**
     * @Route("/entrada")
     * @Template()
     */
    public function entradaAction(Request $request)
    {

        // obtener el objeto de la petición
    	

        $cliente = $_SERVER['REMOTE_ADDR'];
        //$ruta = $_SERVER['PATH_INFO'];
        $datos = $_SERVER['REQUEST_URI'];

        // obtiene el valor de un parámetro $_GET
        $parametros = $request->getContent();
        //$parametros = "results=%5B%7B%22orden%22%3A+%22000000098250%22%2C+%22codigos%22%3A+%5B%2210101738%22%5D%2C+%22cantidad%22%3A+1.0%2C+%22ean%22%3A+%22075020030924%22%7D%5D";
        $parametrosAlm = $parametros;
        $parametros = explode("=",urldecode($parametros));
		$parametros = json_decode($parametros[1]);
		$parametros = $parametros[0];
//echo "<pre>"; print_r($parametros); echo "</pre>";
        //Almacenar Log de Servicios
        $em = $this->getDoctrine()->getManager();   
        $servicio = $em->getRepository('IncentivesServiciosBundle:Servicios')->find(5);
		$ServiciosLog = new ServiciosLog();
		$ServiciosLog ->setServicio($servicio);
		$ServiciosLog ->setFecha(date_create("now"));
		$ServiciosLog ->setCliente($cliente);
		//$ServiciosLog ->setUrl($ruta);
		$ServiciosLog ->setDatos($parametrosAlm);
		$em->persist($ServiciosLog);
		$em->flush();
        $respuesta = array();

        if(!(isset($parametros->orden) || $parametros->orden!="")){

            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio código de compra';

        }else{

			$id_prod = $parametros->orden;
			$id_prod = substr($id_prod, 0, 11);
			$label = array();
			$iC= 0;

			$cantidadR = $parametros->cantidad; 

			$ordenesProducto = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->find($id_prod);
			$orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($ordenesProducto->getOrdenesCompra()->getId());
	
			//Obtener las cantidades del inventario
			$arrayParametros = array();
			$qb = $em->createQueryBuilder();            
			$qb->select(array('cantidad'=>'COUNT(i.id)'));
			$qb->from('IncentivesInventarioBundle:Inventario','i');
			$str_filtro = 'i.orden = '.$orden->getId();
			$str_filtro .= ' AND i.producto= '.$ordenesProducto->getProducto()->getId();
			$str_filtro .= ' AND i.ordenproducto= '.$ordenesProducto->getId();
			$qb->where($str_filtro);
			$cantidadInv = 0 + $qb->getQuery()->getSingleScalarResult();
				
			$cantidad_inicial = $ordenesProducto->getCantidad();					
			//Cantidades acumuladas
			$cantidadTotal = $cantidadR + $cantidadInv;
			
			//echo $cantidadTotal; exit;
			
		        if(isset($ordenesProducto)){
		    
		            //Comprobar que no supere las cantidades solicitadas
		            if($cantidadTotal > $cantidad_inicial){
	
		            	$respuesta['estado'] = 0;
	            		$respuesta['mensaje'] = 'La cantidad recibida no puede ser superior a la solicitada.';
		            
		            }else{
						foreach($parametros->codigos as $keyC => $valueC){
						
						$codInventario = $valueC;
						
						if($iC < $cantidadR){
							$iC++;
		            		
		                    //Ingresar unidades al inventario
		                    $inventarioP = new Inventario();
		                    $inventarioP->setProducto($ordenesProducto->getProducto());
		                    $inventarioP->setOrden($orden);
		                    $inventarioP->setOrdenproducto($ordenesProducto);
		                    $inventarioP->setIngreso(1);
		                    $fecha = date_create();
		                    $inventarioP->setfechaEntrada($fecha);
	
		                    //Buscar la redencion mas antigua o prioritaria en estado de compra
		                    $qb = $em->createQueryBuilder();            
		                    $qb->select('rp');
		                    $qb->from('IncentivesRedencionesBundle:RedencionesProductos','rp');
		                    $qb->leftJoin('rp.ordenesProducto', 'op');
		                    $str_filtro = 'op.id = '.$id_prod;
		                    $str_filtro .= ' AND rp.estado = 3';
		                    $qb->where($str_filtro);
		                    $qb->orderBy('rp.fecha', 'asc');
		                    $qb->setMaxResults(1);
		                    $RedencionesProductos = $qb->getQuery()->getOneOrNullResult();
							
							if(isset($RedencionesProductos)){

	                            $redencionProducto = $em->getRepository('IncentivesRedencionesBundle:RedencionesProductos')->find($RedencionesProductos->getId());
	                            $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('4');
	                            $redencionProducto->setEstado($estado);
	                            $em->persist($redencionProducto);

	                            $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($redencionProducto->getRedencion()->getId());
	                            $redencion->setRedencionestado($estado);
	                            $em->persist($redencionProducto);
	                            
	                            //traer los datos de envio para el despacho
	                            $despacho = new Despachos();
	                            
	                            //Traer los ultimos datos de envio
	                            $qb = $em->createQueryBuilder();            
	                            $qb->select('e');
	                            $qb->from('IncentivesRedencionesBundle:RedencionesEnvios','e');
	                            $str_filtro = 'e.redencion ='.$redencion->getId();
	                            $qb->where($str_filtro);
	                            $qb->orderBy('e.id', 'DESC');
	                            $qb->setMaxResults(1);
	                            $datosEnvio = $qb->getQuery()->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
	                    
	                            $despacho->setDocumento($datosEnvio['documento']);
	                            $despacho->setNombre($datosEnvio['nombre']);
	                            $despacho->setObservaciones($datosEnvio['observaciones']);
	                            $despacho->setCiudadNombre($datosEnvio['ciudadNombre']);
	                            $despacho->setDireccion($datosEnvio['direccion']);
	                            $despacho->setBarrio($datosEnvio['barrio']);
	                            $despacho->setTelefono($datosEnvio['telefono']);
	                            $despacho->setCelular($datosEnvio['celular']);
	                            $despacho->setDepartamentoNombre($datosEnvio['departamentoNombre']);
	                            $despacho->setNombreContacto($datosEnvio['nombreContacto']);
	                            $despacho->setDocumentoContacto($datosEnvio['documentoContacto']);
	                            $despacho->setCiudadContacto($datosEnvio['ciudadContacto']);
	                            $despacho->setDireccionContacto($datosEnvio['direccionContacto']);
	                            $despacho->setBarrioContacto($datosEnvio['barrioContacto']);
	                            $despacho->setTelefonoContacto($datosEnvio['telefonoContacto']);
	                            $despacho->setCelularContacto($datosEnvio['celularContacto']);
	                            $despacho->setDepartamentoContacto($datosEnvio['departamentoContacto']);
	                            $despacho->setRedencionesProductos($redencionProducto);
	                            $despacho->setProducto($ordenesProducto->getProducto());
	                            $despacho->setOrdenProducto($ordenesProducto);
	                            $despacho->setCantidad(1);
	                            $em->persist($despacho);

	                            $codInventario = time().$redencion->getId();
	                            $inventarioP->setRedencionProducto($redencionProducto);
	                            $inventarioP->setDespacho($despacho);
	                            $inventarioP->setCodigo($codInventario);
	                            
	                            $em->flush();

	                            $label[$iC]['codigo'] = $codInventario;
		                        $label[$iC]['cliente'] = $RedencionesProductos->getRedencion()->getParticipante()->getPrograma()->getCliente()->getNombre();
		                        $label[$iC]['programa'] = $RedencionesProductos->getRedencion()->getParticipante()->getPrograma()->getNombre();
		                        $label[$iC]['orden_compra']= $orden->getConsecutivo();
		                        $label[$iC]['redencion'] = $RedencionesProductos->getRedencion()->getCodigoredencion();
		                        $label[$iC]['nombre_receptor'] = $datosEnvio['nombre'];
								//echo "<pre>"; print_r($redencion['redencionesenvios']); echo "</pre>"; exit;
								//ultimos datos envio

		                        $label[$iC]['identificacion']  = $datosEnvio['documento'];
		                        $label[$iC]['departamento_id'] = $datosEnvio['departamentoNombre'];
								$label[$iC]['ciudad_id'] = $datosEnvio['ciudadNombre'];
		                        $label[$iC]['barrio'] = $datosEnvio['barrio'];
		                        $label[$iC]['direccion'] = $datosEnvio['direccion'];
		                        $label[$iC]['telefono'] = $datosEnvio['telefono'];
		                        $label[$iC]['celular'] = $datosEnvio['celular'];
		                        $label[$iC]['producto'] = $ordenesProducto->getProducto()->getNombre();
		                        $label[$iC]['marca'] = $ordenesProducto->getProducto()->getMarca();
		                        $label[$iC]['referencia'] = $ordenesProducto->getProducto()->getReferencia();
		                    }

		                    $em->persist($inventarioP);                    
		                    $em->flush();

		                }

		                $ordenesProducto->setCantidadrecibida($cantidadTotal);
		                $em->persist($ordenesProducto);
		                $em->flush();
		                
			            $this->cerrarOrdenAction($orden->getId());

						$respuesta['estado'] = 1;
						$respuesta['mensaje'] = $label;

						}
		            }
				}else{
					$respuesta['estado'] = 0;
					$respuesta['mensaje'] = 'No se encontro la orden de compra No. '.$parametros->ordencompra;
				}

        }

        //$ServiciosLog->setResultado($respuesta['estado']);
        //$ServiciosLog->setMEnsaje($respuesta['mensaje']);
		//$em->persist($ServiciosLog);
		//$em->flush();

        print_r(json_encode($respuesta));
     
        $response = new Response();
        return $response->send();

    }

    /**
     * @Route("/salida")
     * @Template()
     */
    public function salidaAction(Request $request)
    {

        // obtener el objeto de la petición
        

        //$cliente = $_SERVER['REMOTE_ADDR'];
        //$ruta = $_SERVER['PATH_INFO'];
        //$datos = $_SERVER['REQUEST_URI'];
        $parametros = $request->getContent();

        //Almacenar Log de Servicios
        $em = $this->getDoctrine()->getManager();   
        /*$servicio = $em->getRepository('IncentivesServiciosBundle:Servicios')->find(5);
		$ServiciosLog = new ServiciosLog();
		$ServiciosLog ->setServicio($servicio);
		$ServiciosLog ->setFecha(date_create("now"));
		$ServiciosLog ->setCliente($cliente);
		$ServiciosLog ->setUrl($ruta);
		$ServiciosLog ->setDatos($parametros);
		$em->persist($ServiciosLog);
		$em->flush();*/

	//$parametros = "results=%5B%7B%22codigo%22%3A+%2210101%22%2C+%22valor_guia%22%3A+%2212345%22%2C+%22guia%22%3A+%22123%22%7D%5D";
        $parametros = explode("=",urldecode($parametros));
	$parametros = json_decode($parametros[1]);
	$parametros = $parametros[0];

        $respuesta = array();

        //Almacenar salida de inventario

	$qb = $em->createQueryBuilder();          
	$qb->select('i');
	$qb->from('IncentivesInventarioBundle:Inventario','i');
	$str_filtro = "i.codigo = '".$parametros->codigo."'";
	$qb->where($str_filtro);
	$qb->setMaxResults(1);
	$inventarioP = $qb->getQuery()->getOneOrNullResult();

	$inventarioP->setSalio(1);
	$inventarioP->setFechaSalida(date_create("now"));

	$em->persist( $inventarioP );

	        //Cambiar estado a redencion
	$qb = $em->createQueryBuilder();          
	$qb->select('r');
	$qb->from('IncentivesRedencionesBundle:Redenciones','r');
	$str_filtro = "r.id = ".$inventarioP->getId();
	$qb->where($str_filtro);
	$redencion = $qb->getQuery()->getOneOrNullResult();

	$estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('5');
	$redencion->setRedencionestado($estado);
	$redencion->setFechaDespacho(date_create("now"));

	//Almacenar Guia

                        //Determinar si la guia ya existe
                        $qb = $em->createQueryBuilder();            
                        $qb->select('g');
                        $qb->from('IncentivesRedencionesBundle:GuiaEnvio','g');
                        $str_filtro = "g.guia LIKE '".$parametros->guia."' ";
                        $qb->where($str_filtro);
                        $qb->setMaxResults(1);
                        $guia = $qb->getQuery()->getOneOrNullResult();
    
                        if(!isset($guia) || $guia==Null){
                            //Si no existe guardar la guia nueva y la relacion con la redencion
                            $guia= new GuiaEnvio();
                            $guia->setOrdenProducto($redencion->getOrdenesProducto());
                            $guia->setGuia($parametros->guia);
                            //$guia->setOperador($row['W']);
                            $guia->setEstado("1");
                            $guia->setFecha(date_create("now"));
                            $guia->setValor($parametros->valor_guia);                        
                        }
                        
                        //Si existe guardar la relacion con la redencion
                        $inventarioguia = new InventarioGuia();
                        $inventarioguia->setGuia($guia);
                        $inventarioguia->setInventario($inventarioP);
                        $estado = $em->getRepository('IncentivesInventarioBundle:CierreEstado')->find('1');
                        $inventarioguia->setCierreEstado($estado);

			$em->persist($inventarioguia);
    

	$em->persist($redencion);
	$em->persist($inventarioP);
	
	$em->flush();


        //Asignar a requision para despacho

        if(!(isset($parametros->codigo) && $parametros->codigo!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio el codigo de despacho';
        }elseif(!(isset($parametros->guia) && $parametros->guia!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio el numero de guia';
        }else{
            $respuesta['estado'] = 1;
            $respuesta['mensaje'] = 'Salida exitosa';            
        }

        $ServiciosLog->setResultado($respuesta['estado']);
        $ServiciosLog->setMEnsaje($respuesta['mensaje']);
		$em->persist($ServiciosLog);
		$em->flush();

        print_r(json_encode($respuesta));
      
        $response = new Response();
        return $response->send();

    }

	/**
     * @Route("/salida")
     * @Template()
     */
    public function devolucionAction(Request $request)
    {

        // obtener el objeto de la petición
        

        //$cliente = $_SERVER['REMOTE_ADDR'];
        //$ruta = $_SERVER['PATH_INFO'];
        //$datos = $_SERVER['REQUEST_URI'];
        $parametros = $request->getContent();

        //Almacenar Log de Servicios
        $em = $this->getDoctrine()->getManager();   
        /*$servicio = $em->getRepository('IncentivesServiciosBundle:Servicios')->find(5);
		$ServiciosLog = new ServiciosLog();
		$ServiciosLog ->setServicio($servicio);
		$ServiciosLog ->setFecha(date_create("now"));
		$ServiciosLog ->setCliente($cliente);
		$ServiciosLog ->setUrl($ruta);
		$ServiciosLog ->setDatos($parametros);
		$em->persist($ServiciosLog);
		$em->flush();*/

	//$parametros = "results=%5B%7B%22devolucion%22%3A+%22roto%22%2C+%22codigo%22%3A+%2210106%22%7D%5D";
        $parametros = explode("=",urldecode($parametros));
	$parametros = json_decode($parametros[1]);
	$parametros = $parametros[0];

        $respuesta = array();

        //Registrar la novedad
	$qb = $em->createQueryBuilder();          
	$qb->select('i');
	$qb->from('IncentivesInventarioBundle:Inventario','i');
	$str_filtro = "i.codigo = '".$parametros->codigo."'";
	$qb->where($str_filtro);
	$qb->setMaxResults(1);
	$inventarioP = $qb->getQuery()->getOneOrNullResult();

	//$inventarioP->setSalio(1);
	//$inventarioP->setFechaSalida(date_create("now"));

	//$em->persist( $inventarioP );

	//Cambiar estado a redencion
	$qb = $em->createQueryBuilder();          
	$qb->select('r');
	$qb->from('IncentivesRedencionesBundle:Redenciones','r');
	$str_filtro = "r.id = ".$inventarioP->getId();
	$qb->where($str_filtro);
	$redencion = $qb->getQuery()->getOneOrNullResult();

	//$estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('5');
	//$redencion->setRedencionestado($estado);
	//$redencion->setFechaDespacho(date_create("now"));

	$novedad = new Novedades();
	$novedad->setRedencion($redencion);
        $estado = $em->getRepository('IncentivesGarantiasBundle:Novedadesestado')->find(1);
        $novedad->setEstado($estado);
        $tipo = $em->getRepository('IncentivesGarantiasBundle:Novedadestipo')->find(1);
        $novedad->setTipo($tipo);
        $novedad->setFecha(new \DateTime());
        $novedad->setObservacion($parametros->devolucion);
        $em->persist($novedad);

        if(!(isset($parametros->codigo) && $parametros->codigo!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio el codigo de inventario.';
        }else{
            $respuesta['estado'] = 1;
            $respuesta['mensaje'] = 'Registro exitoso.';            
        }

        $ServiciosLog->setResultado($respuesta['estado']);
        $ServiciosLog->setMEnsaje($respuesta['mensaje']);
	$em->persist($ServiciosLog);
	$em->flush();

        print_r(json_encode($respuesta));
      
        $response = new Response();
        return $response->send();

    }

    public function datoscompraAction(Request $request)
    {

                // obtener el objeto de la petición
    	

        //$cliente = $_SERVER['REMOTE_ADDR'];
        //$ruta = $_SERVER['PATH_INFO'];
        //$datos = $_SERVER['REQUEST_URI'];

        // obtiene el valor de un parámetro $_GET
        $parametros = $request->getContent();
        $parametrosAlm = $parametros;
        //$parametros = "results=%5B%7B%22orden%22%3A+%22000000019279%22%7D%5D";
        $parametros = explode("=",urldecode($parametros));

	$parametros = json_decode($parametros[1]);
	$parametros = $parametros[0];

        //Almacenar Log de Servicios
        $em = $this->getDoctrine()->getManager();   
        /*$servicio = $em->getRepository('IncentivesServiciosBundle:Servicios')->find(5);
		$ServiciosLog = new ServiciosLog();	
		$ServiciosLog ->setServicio($servicio);
		$ServiciosLog ->setFecha(date_create("now"));
		$ServiciosLog ->setCliente($cliente);
		$ServiciosLog ->setUrl($ruta);
		$ServiciosLog ->setDatos($parametrosAlm);
		$em->persist($ServiciosLog);
		$em->flush();*/
        $respuesta = array();

        if(!(isset($parametros->orden) || $parametros->orden!="")){

            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio código de compra';

        }else{

			$id_prod = $parametros->orden;
			$id_prod = substr($id_prod, 0, 11);

			$label = array();
			$iC= 0;

			$ordenesProducto = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->find($id_prod);
			//$ordenesProducto = 1;
			//$ordenesProducto->getId();
		        if(isset($ordenesProducto)){
		        		            		
		                    //Buscar la redencion mas antigua o prioritaria en estado de compra
		                    $qb = $em->createQueryBuilder();            
		                    $qb->select('op','p');
		                    $qb->from('IncentivesOrdenesBundle:OrdenesProducto','op');
		                    $qb->leftJoin('op.producto', 'p');
		                    $str_filtro = 'op.id = '.$id_prod;
		                    //$str_filtro .= ' AND r.redencionestado = 3';
		                    $qb->where($str_filtro);
		                    $qb->setMaxResults(1);
		                    $producto = $qb->getQuery()->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
	//echo "<pre>"; print_r($producto); echo "</pre>";exit;
	
		                    if(isset($producto)){
		                        $label['producto'] = $producto['producto']['nombre'];
		                        $label['marca'] = $producto['producto']['marca'];
					$label['referencia'] = $producto['producto']['referencia'];
					$label['sku'] = $producto['producto']['codInc'];

					$respuesta['estado'] = 1;
					$respuesta['mensaje'] = $label;

				    }else{
					$respuesta['estado'] = 0;
					$respuesta['mensaje'] = "No se encontraron los datos del producto.";
				    }
					
				}else{
					$respuesta['estado'] = 0;
					$respuesta['mensaje'] = 'No se encontro la orden de compra No. '.$id_prod;
				}


        }

        //$ServiciosLog->setResultado($respuesta['estado']);
        //$ServiciosLog->setMEnsaje($respuesta['mensaje']);
		//$em->persist($ServiciosLog);
		//$em->flush();

        print_r(json_encode($respuesta));
     
        $response = new Response();
        return $response->send();

    }

    public function historicoAction($id)
    {
      $em = $this->getDoctrine()->getManager();
      $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($id);
      $historico = new RedencionesHistorico();

      $historico->setRedencion($redencion);
      $historico->setParticipante($redencion->getParticipante());
      $historico->setProductocatalogo($redencion->getProductocatalogo());
      $historico->setRedencionestado($redencion->getRedencionestado());
      $historico->setValor($redencion->getValor());
      $historico->setFecha(new \DateTime());
      $historico->setAtributos($redencion->getAtributos());
      $historico->setCodigoredencion($redencion->getCodigoredencion());
      $historico->setOrdenesProducto($redencion->getOrdenesProducto());

      $em->persist($historico);
      $em->flush();
      return $id;
    }


    public function cerrarOrdenAction($id){
        
        $this->actualizarCantidadAction($id);
        
        $em = $this->getDoctrine()->getManager();
        $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
        
        $arrayParametros = array();
        $qb = $em->createQueryBuilder();            
        $qb->select(array('cantidad'=>'COUNT(op.id)'));
        $qb->from('IncentivesOrdenesBundle:OrdenesProducto','op');
        $str_filtro = 'op.ordenesCompra = '.$orden->getId();
        $str_filtro .= ' AND op.cantidad!=op.cantidadrecibida';
        $qb->where($str_filtro);
        $cantidad = $qb->getQuery()->getSingleScalarResult();

        if($cantidad==0){
            $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('5'); 
        }else{
            $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('4'); 
        }
        
        $orden->setOrdenesEstado($estado);
        $em->persist($orden);
        $em->flush();
    }
    
    public function actualizarCantidadAction($id){
        
        $em = $this->getDoctrine()->getManager();
        $ordenesProducto = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findByordenesCompra($id);
        
        foreach($ordenesProducto as $keyO => $valueO){

            $arrayParametros = array();
            $qb = $em->createQueryBuilder();            
            $qb->select(array('cantidad'=>'COUNT(i.id)'));
            $qb->from('IncentivesInventarioBundle:Inventario','i');
            $str_filtro = 'i.orden = '.$id;
            $str_filtro .= ' AND i.producto ='.$valueO->getProducto()->getId();
            $str_filtro .= ' AND i.ordenproducto ='.$valueO->getId();
            $qb->where($str_filtro);
            $cantidad = $qb->getQuery()->getSingleScalarResult();

            $valueO->setCantidadrecibida($cantidad);
            $em->persist($valueO);
            $em->flush();
        } 
    }

}