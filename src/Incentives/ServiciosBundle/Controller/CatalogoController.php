<?php

namespace Incentives\ServiciosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Incentives\CatalogoBundle\Entity\ProductoCalificacion;

use Symfony\Component\HttpFoundation\Response;

class CatalogoController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    public function ProductosAction(Request $request)
    {
        
        // obtener el objeto de la petición
        

        // obtiene el valor de un parámetro $_GET
        $parametros = $request->query->get('parametros');
        $parametros = json_decode(urldecode($parametros));

        $idCatalogo = $parametros->catalogo;

        $em = $this->getDoctrine()->getManager();

        $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($idCatalogo);

        //Verificar que el estado del catalogo sea activo

        if($catalogo->getEstado()->getId() == 1){

            $qb = $em->createQueryBuilder();            
            $qb->select('pr','pp','p','ct','promo');
            $qb->from('IncentivesCatalogoBundle:Premios','pr');
            $qb->Join('pr.premiosproductos', 'pp');
            $qb->Join('pp.producto', 'p');
            $qb->leftJoin('pr.categoria', 'ct');
            $qb->leftJoin('pr.promocion', 'promo', 'WITH','promo.estado=1');
           //Comprobar estado del producto y del producto en el catalogo
            $str_filtro = 'p.estado=1 AND pr.estado = 1 AND pr.aproboOperaciones = 1 AND pr.aproboComercial = 1 AND pr.aproboDirector = 1 AND pr.aproboCliente = 1 AND pr.catalogos = :id_catalogo';

            $str_filtro .= ' AND pr.puntos!=0 AND pr.puntos IS NOT NULL';

            //Filtros
            if(isset($parametros->categoria)){
                 $str_filtro .= ' AND pr.categoria = :id_categoria';
                 $arrayParametros['id_categoria'] = $parametros->categoria;
            }

            if(isset($parametros->clasificacion)){
                 $str_filtro .= ' AND p.clasificacion = :id_clasificacion';
                 $arrayParametros['id_clasificacion'] = $parametros->clasificacion;
            }

            if(isset($parametros->sku)){
                 $str_filtro .= ' AND p.codInc IN ('.$parametros->sku.')';
                 //$arrayParametros['sku'] = $parametros->sku;
            }

            if(isset($parametros->keyword)){
                 $str_filtro .= ' AND (p.nombre LIKE :keyword OR p.descripcion LIKE :keyword)';
                 $arrayParametros['keyword'] = "%".$parametros->keyword."%";
            }

            if(isset($parametros->puntos_min)){
                 $str_filtro .= ' AND (pr.puntos >= :puntos_min)';
                 $arrayParametros['puntos_min'] =$parametros->puntos_min;
            }

             if(isset($parametros->puntos_max)){
                 $str_filtro .= ' AND (pr.puntos <= :puntos_max)';
                 $arrayParametros['puntos_max'] =$parametros->puntos_max;
            }

             if(isset($parametros->id)){
                 $str_filtro .= ' AND pr.id = :id_producto';
                 $arrayParametros['id_producto'] = $parametros->id;
            }

            //Temporal
            if($idCatalogo==16){
                 $str_filtro .= ' AND pr.categoria != 37';
            }

            $qb->where($str_filtro);

            //Definicion de parametros para filtros
            
            $arrayParametros['id_catalogo'] = $idCatalogo;
            $qb->setParameters($arrayParametros);
            $qb->orderBy('promo.id', 'DESC');
            $qb->addOrderBy('pr.puntos', 'ASC');
            $premios = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            //echo "<pre>"; print_r($premios); echo "</pre>"; exit;
            $listado = array();
            $idP = 0;
            
             //Revisar si se esta consultando algun idioma
            if(isset($parametros->idioma) && $parametros->idioma!='es'){

                $qb = $em->createQueryBuilder();            
                $qb->select('i');
                $qb->from('IncentivesCatalogoBundle:Idiomas','i');
                $qb->where('i.codigo = :codigo');
                $qb->setParameter('codigo', $parametros->idioma);
                $idioma = $qb->getQuery()->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            }
            
            foreach ($premios as $keyP => $valueP) {
            	
                $datosPremio = $valueP['premiosproductos'][0]['producto'];

            	$listado[$idP]['id'] = $valueP['id'];
            	
                if($valueP['nombre']!="") $listado[$idP]['nombre'] = $valueP['nombre']; else $listado[$idP]['nombre'] = $datosPremio['nombre'];
                if($valueP['marca']!="") $listado[$idP]['marca'] = $valueP['marca']; else $listado[$idP]['marca'] = $datosPremio['marca'];
                if($valueP['descripcion']!="") $listado[$idP]['descripcion'] = $valueP['descripcion']; else $listado[$idP]['descripcion'] = $datosPremio['descripcion'];
                $listado[$idP]['sku'] = $datosPremio['codInc'];
            	
                $listado[$idP]['puntos'] = $valueP['puntos'];
                $listado[$idP]['categoria_id'] = $valueP['categoria']['id'];
                $listado[$idP]['agotado'] = $valueP['agotado'];
                $listado[$idP]['promocion'] = 0;

                //comprobar promocion
                if($valueP['promocion']){
                    $datosPromo = $valueP['promocion'][0];

                    //echo "<pre>"; print_r($datosPromo); echo "</pre>";

                    $hoy = date("Y-m-d H:i:s");

                    $fechaInicio = $datosPromo['fechaInicio']->format('Y-m-d H:i:s');
                    $fechaFin = $datosPromo['fechaFin']->format('Y-m-d H:i:s');

                    $fechaFin = strtotime ( '+1 day' , strtotime ( $fechaFin ) ) ;
                    $fechaFin = strtotime ( '-1 second' , $fechaFin ) ;
                    $fechaFin = date ( 'Y-m-d H:i:s' , $fechaFin );

                    if($hoy >= $fechaInicio && $hoy <= $fechaFin && $datosPromo['disponibles']>0){

                        $listado[$idP]['promocion'] = ($valueP['promocion'])? 1 : 0;
                        $listado[$idP]['datosPromocion']['nombre'] = $datosPromo['nombre'];
                        $listado[$idP]['datosPromocion']['descripcion'] = $datosPromo['descripcion'];
                        $listado[$idP]['datosPromocion']['puntosSinPromocion'] = $valueP['puntos'];
                        $listado[$idP]['datosPromocion']['fechaInico'] = $fechaInicio;
                        $listado[$idP]['datosPromocion']['fechaFin'] = $fechaFin;
                        $listado[$idP]['datosPromocion']['cantidadTotal'] = $datosPromo['cantidad'];
                        $listado[$idP]['datosPromocion']['cantidadDisponible'] = $datosPromo['disponibles'];
                        $listado[$idP]['puntos'] = $datosPromo['puntos'];

                    }

                }
            	
            	//Si el idioma es diferente a español consultar si el producto tiene traduccion
                if(isset($idioma)){

                    $parametrosT = array();
                    $qb = $em->createQueryBuilder();            
                    $qb->select('t');
                    $qb->from('IncentivesCatalogoBundle:ProductoIdiomas','t');
                    $qb->where('t.idioma = :idioma AND t.producto = :producto');
                    $parametrosT['idioma'] =  $idioma->getId();
                    $parametrosT['producto'] =  $valueP->getProducto()->getId();
                    $qb->setParameters($parametrosT);
                    $traduccion = $qb->getQuery()->getOneOrNullResult();

                    //Sobreescribir atributos con traduccion
                    if(isset($traduccion)){

                        $listado[$idP]['nombre'] = $traduccion->getNombre();
                        $listado[$idP]['descripcion'] = $traduccion->getDescripcion();
                    }

                }

                $qb = $em->createQueryBuilder();            
                $qb->select('i');
                $qb->from('IncentivesCatalogoBundle:Imagenproducto','i');
                $qb->where('i.estado = 1 AND i.producto = :producto AND i.estado=1');
                $parametrosT['producto'] =  $datosPremio['id'];
                $qb->setParameters($parametrosT);
                
                $imagenes = $qb->getQuery()->getResult();

            	$im = 0;
            	foreach ($imagenes as $keyI => $valueI) {
    				$cadena   = '/bundles';
    				$pos = strpos($valueI->getPath(), $cadena);
    				$ruta = substr($valueI->getPath(), $pos);
    				$ruta_min = substr($ruta, 0, -4)."_min".substr($ruta,-4);
    				
            		$listado[$idP]['imagenes'][$im]['full'] = $ruta;
            		$listado[$idP]['imagenes'][$im]['min'] = $ruta_min;
            		
            		$im++;
            	}

                //Atributos
                $atributos = $em->getRepository('IncentivesCatalogoBundle:Atributosproducto')->findByProducto($datosPremio['id']);
                foreach ($atributos as $keyA => $valueA) {                
                    $listado[$idP]['atributos'][$valueA->getTipo()->getNombre()][$valueA->getId()]['valor'] = $valueA->getValor();
                    $listado[$idP]['atributos'][$valueA->getTipo()->getNombre()][$valueA->getId()]['imagen'] = $valueA->getImagen();
                    
                }   

    			$idP++;
            }

            $listado = json_encode($listado);

            echo $listado;
          
        }else{
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'Catalogo Inactivo.';

            print_r(json_encode($respuesta));

        }
        
        $response = new Response();
        return $response->send();
    
    }

    
    public function CategoriasAction(Request $request)
    {
        
        // obtiene el valor de un parámetro $_GET
        $parametros = $request->query->get('parametros');
        $parametros = json_decode(urldecode($parametros));

        $idCatalogo = $parametros->catalogo;

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();            
        $qb->select('c.id,c.nombre');
        $qb->from('IncentivesCatalogoBundle:Premios','pr');
        $qb->leftJoin('pr.categoria', 'c');
        $str_filtro = 'pr.estado = 1 AND pr.aproboOperaciones = 1 AND pr.aproboComercial = 1 AND pr.aproboDirector = 1 AND pr.aproboCliente = 1 AND pr.catalogos = :id_catalogo';
        $qb->where($str_filtro);
        $qb->groupBy('c.id');
        $qb->setParameter('id_catalogo', $idCatalogo);

        $categorias = $qb->getQuery()->getResult();

        $listado = json_encode($categorias);

        echo $listado;
      
        $response = new Response();
        return $response->send();
    
    }

	public function CalificacionAction(Request $request)
    {
        
        // obtener el objeto de la petición
        

        // obtiene el valor de un parámetro $_GET
        $parametros = $request->query->get('parametros');
        $parametros = json_decode(urldecode($parametros));
        
        if(!(isset($parametros->sku) && $parametros->sku!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio SKU del producto';
        }elseif(!(isset($parametros->valor) && $parametros->valor!="")){
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'No se recibio calificacion del producto';
        }else{

            $em = $this->getDoctrine()->getManager();

            $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($parametros->catalogo);

            $qb = $em->createQueryBuilder();            
            $qb->select('p');
            $qb->from('IncentivesCatalogoBundle:Producto','p');
            $qb->where('p.codInc = :sku');
            $qb->setParameter('sku', $parametros->sku);
            $producto = $qb->getQuery()->getSingleResult();

            $calificacion = new ProductoCalificacion();

            $calificacion->setProducto($producto);
            $calificacion->setValor($parametros->valor);
            $calificacion->setCatalogo($catalogo);
         
            $em->persist($calificacion);
            $em->flush();

            $respuesta['estado'] = 1;
            $respuesta['mensaje'] = 'Operación exitosa.'; 
        }
           
        print_r(json_encode($respuesta));
      
        $response = new Response();
        return $response->send();
    
    }


    public function TestAction(Request $request)
    {
        
        // obtiene el valor de un parámetro $_GET
        $parametros = $request->query->get('parametros');
        $parametros = json_decode(urldecode($parametros));

        $idCatalogo = $parametros->catalogo;

        $em = $this->getDoctrine()->getManager();

        $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($idCatalogo);

        //Verificar que el estado del catalogo sea activo

        if(!isset($parametros->apiKey) || !isset($parametros->apiSecret) || $parametros->apiKey=="" || $parametros->apiSecret==""){
            
            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'Error de autenticacion - No se encontraron los parametros de seguridad.';

            print_r(json_encode($respuesta));

            $response = new Response();
            return $response->send();

        }else{

            if(!($parametros->apiKey == $catalogo->getPrograma()->getApiKey() && $parametros->apiSecret == $catalogo->getPrograma()->getApiSecret())){

                $respuesta['estado'] = 0;
                $respuesta['mensaje'] = 'Error de autenticacion - Parametros de seguridad no validos.';

                print_r(json_encode($respuesta));

                $response = new Response();
                return $response->send();
            }
        }


        if($catalogo->getEstado()->getId() == 1){

            $respuesta['estado'] = 1;
            $respuesta['mensaje'] = 'Validacion correcta.';

            print_r(json_encode($respuesta));
          
        }else{

            $respuesta['estado'] = 0;
            $respuesta['mensaje'] = 'Catalogo Inactivo.';

            print_r(json_encode($respuesta));

        }
        
        $response = new Response();
        return $response->send();
    
    }



}

