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
    	$request = $this->getRequest();

        $cliente = $_SERVER['REMOTE_ADDR'];
        $ruta = $_SERVER['PATH_INFO'];
        $datos = $_SERVER['REQUEST_URI'];

        // obtiene el valor de un parámetro $_GET
        $parametros = $request->getContent();
        $parametrosAlm = $parametros;
        //$parametros = "results=%5B%7B%22orden%22%3A+%2200000005090%22%2C+%22codigos%22%3A+%5B%22101066%22%2C+%22101067%22%2C+%22101068%22%2C+%22101069%22%5D%2C+%22cantidad%22%3A+1.0%2C+%22ean%22%3A+%22123%22%7D%5D";
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
		$ServiciosLog ->setUrl($ruta);
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
		                    $qb->select('r','o','op','pt','pg','p','re','c');
		                    $qb->from('IncentivesRedencionesBundle:Redenciones','r');
		                    $qb->leftJoin('r.ordenesProducto', 'op');
		                    $qb->leftJoin('r.participante', 'pt');
		                    $qb->leftJoin('pt.programa', 'pg');
						    $qb->leftJoin('pg.cliente', 'c');
		                    $qb->leftJoin('op.producto', 'p');
		                    $qb->leftJoin('r.redencionesenvios', 're');
		                    $qb->leftJoin('op.ordenesCompra', 'o');
		                    $str_filtro = 'op.id = '.$id_prod;
		                    //$str_filtro .= ' AND r.redencionestado = 3';
		                    $qb->where($str_filtro);
		                    $qb->orderBy('r.fecha', 'asc');
		                    $qb->setMaxResults(1);
		                    $redencion = $qb->getQuery()->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
	//echo "<pre>"; print_r($redencion); echo "</pre>";exit;
	
		                    if(isset($redencion)){
	
		                        $redencionA = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($redencion['id']);
		                        $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('4');
		                        $redencionA->setRedencionestado($estado);
		                        $em->persist($redencionA);
		                        $em->flush();
	
		                        //Almacenar Historico
		                        $redencionH = $this->get('incentives_redenciones');
		                        $redencionH->insertar($redencionA);
		
		                        $codInventario = $valueC;
		                        $inventarioP->setRedencion($redencionA);
		                        $inventarioP->setCodigo($codInventario);
	
		                        $label[$iC]['codigo'] = "$codInventario";
		                        $label[$iC]['cliente'] = $redencion['participante']['programa']['cliente']['nombre'];
		                        $label[$iC]['programa'] = $redencion['participante']['programa']['nombre'];
		                        $label[$iC]['orden_compra']= $redencion['ordenesProducto']['ordenesCompra']['consecutivo'];
		                        $label[$iC]['redencion'] = $redencion['codigoredencion'];
		                        $label[$iC]['nombre_receptor'] = $redencion['participante']['nombre'];
								//echo "<pre>"; print_r($redencion['redencionesenvios']); echo "</pre>"; exit;
								//ultimos datos envio
								$indice = count($redencion['redencionesenvios']) - 1;
								$redencionesenvios = $redencion['redencionesenvios'][$indice];
		                        $label[$iC]['identificacion']  = $redencionesenvios['documento'];
		                        $label[$iC]['departamento_id'] = $redencionesenvios['departamentoNombre'];
								$label[$iC]['ciudad_id'] = $redencionesenvios['ciudadNombre'];
		                        $label[$iC]['barrio'] = $redencionesenvios['barrio'];
		                        $label[$iC]['direccion'] = $redencionesenvios['direccion'];
		                        $label[$iC]['telefono'] = $redencionesenvios['telefono'];
		                        $label[$iC]['celular'] = $redencionesenvios['celular'];
		                        $label[$iC]['producto'] = $redencion['ordenesProducto']['producto']['nombre'];
		                        $label[$iC]['marca'] = $redencion['ordenesProducto']['producto']['marca'];
		                        $label[$iC]['referencia'] = $redencion['ordenesProducto']['producto']['referencia'];
	
		                    }
	
		                    $em->persist( $inventarioP );
		                    
		                    $inventarioH = $this->get('incentives_inventario');
                            $inventarioH->insertar($inventarioP);
                            
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
    public function salidaAction()
    {

        // obtener el objeto de la petición
        $request = $this->getRequest();

        $cliente = $_SERVER['REMOTE_ADDR'];
        $ruta = $_SERVER['PATH_INFO'];
        $datos = $_SERVER['REQUEST_URI'];
        $parametros = $request->getContent();

        //Almacenar Log de Servicios
        $em = $this->getDoctrine()->getManager();   
        $servicio = $em->getRepository('IncentivesServiciosBundle:Servicios')->find(5);
		$ServiciosLog = new ServiciosLog();
		$ServiciosLog ->setServicio($servicio);
		$ServiciosLog ->setFecha(date_create("now"));
		$ServiciosLog ->setCliente($cliente);
		$ServiciosLog ->setUrl($ruta);
		$ServiciosLog ->setDatos($parametros);
		$em->persist($ServiciosLog);
		$em->flush();

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
    public function devolucionAction()
    {

        // obtener el objeto de la petición
        $request = $this->getRequest();

        $cliente = $_SERVER['REMOTE_ADDR'];
        $ruta = $_SERVER['PATH_INFO'];
        $datos = $_SERVER['REQUEST_URI'];
        $parametros = $request->getContent();

        //Almacenar Log de Servicios
        $em = $this->getDoctrine()->getManager();   
        $servicio = $em->getRepository('IncentivesServiciosBundle:Servicios')->find(5);
		$ServiciosLog = new ServiciosLog();
		$ServiciosLog ->setServicio($servicio);
		$ServiciosLog ->setFecha(date_create("now"));
		$ServiciosLog ->setCliente($cliente);
		$ServiciosLog ->setUrl($ruta);
		$ServiciosLog ->setDatos($parametros);
		$em->persist($ServiciosLog);
		$em->flush();

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

    public function datoscompraAction()
    {

                // obtener el objeto de la petición
    	$request = $this->getRequest();

        $cliente = $_SERVER['REMOTE_ADDR'];
        $ruta = $_SERVER['PATH_INFO'];
        $datos = $_SERVER['REQUEST_URI'];

        // obtiene el valor de un parámetro $_GET
        $parametros = $request->getContent();
        $parametrosAlm = $parametros;
        //$parametros = "results=%5B%7B%22orden%22%3A+%22000000019279%22%7D%5D";
        $parametros = explode("=",urldecode($parametros));

	$parametros = json_decode($parametros[1]);
	$parametros = $parametros[0];

        //Almacenar Log de Servicios
        $em = $this->getDoctrine()->getManager();   
        $servicio = $em->getRepository('IncentivesServiciosBundle:Servicios')->find(5);
		$ServiciosLog = new ServiciosLog();
		$ServiciosLog ->setServicio($servicio);
		$ServiciosLog ->setFecha(date_create("now"));
		$ServiciosLog ->setCliente($cliente);
		$ServiciosLog ->setUrl($ruta);
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