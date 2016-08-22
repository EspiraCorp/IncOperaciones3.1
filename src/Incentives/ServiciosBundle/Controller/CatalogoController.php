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
            $qb->select('pc');
            $qb->from('IncentivesCatalogoBundle:Productocatalogo','pc');
            $qb->leftJoin('pc.producto', 'p');
           //Comprobar estado del producto y del producto en el catalogo
            $str_filtro = 'p.estado = 1 AND pc.activo = 1 AND pc.aproboOperaciones = 1 AND pc.aproboComercial = 1 AND pc.aproboDirector = 1 AND pc.aproboCliente = 1 AND pc.catalogos = :id_catalogo';

            $str_filtro .= ' AND pc.puntos!=0 AND pc.puntos IS NOT NULL';

            //Filtros
            if(isset($parametros->categoria)){
                 $str_filtro .= ' AND pc.categoria = :id_categoria';
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
                 $str_filtro .= ' AND (pc.puntos >= :puntos_min)';
                 $arrayParametros['puntos_min'] =$parametros->puntos_min;
            }

             if(isset($parametros->puntos_max)){
                 $str_filtro .= ' AND (pc.puntos <= :puntos_max)';
                 $arrayParametros['puntos_max'] =$parametros->puntos_max;
            }

             if(isset($parametros->id)){
                 $str_filtro .= ' AND pc.id = :id_producto';
                 $arrayParametros['id_producto'] = $parametros->id;
            }

            //Temporal
            if($idCatalogo==16){
                 $str_filtro .= ' AND pc.categoria != 37';
            }

            $qb->where($str_filtro);

            //Definicion de parametros para filtros
            
            $arrayParametros['id_catalogo'] = $idCatalogo;
            $qb->setParameters($arrayParametros);
            $qb->orderBy('pc.puntos', 'ASC');
            $productos = $qb->getQuery()->getResult();

            $listado = array();
            $idP = 0;
            
             //Revisar si se esta consultando algun idioma
            if(isset($parametros->idioma) && $parametros->idioma!='es'){

                $qb = $em->createQueryBuilder();            
                $qb->select('i');
                $qb->from('IncentivesCatalogoBundle:Idiomas','i');
                $qb->where('i.codigo = :codigo');
                $qb->setParameter('codigo', $parametros->idioma);
                $idioma = $qb->getQuery()->getOneOrNullResult();

            }
            
            foreach ($productos as $keyP => $valueP) {
            	
            	$listado[$idP]['id'] = $valueP->getId();
            	$listado[$idP]['nombre'] = $valueP->getProducto()->getNombre();
            	$listado[$idP]['referencia'] = $valueP->getProducto()->getReferencia();
            	$listado[$idP]['marca'] = $valueP->getProducto()->getMarca();
            	$listado[$idP]['sku'] = $valueP->getProducto()->getCodinc();
            	$listado[$idP]['descripcion'] = $valueP->getProducto()->getDescripcion();
            	$listado[$idP]['puntos'] = $valueP->getPuntos();
                $listado[$idP]['categoria_id'] = $valueP->getCategoria()->getId();
                $listado[$idP]['agotado'] = $valueP->getAgotado();
            	
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
                $parametrosT['producto'] =  $valueP->getProducto()->getId();
                $qb->setParameters($parametrosT);
                $imagenes = $qb->getQuery()->getResult();

            	$im = 0;
            	foreach ($imagenes as $keyI => $valueI) {
    				$cadena   = '/web';
    				$pos = strpos($valueI->getPath(), $cadena);
    				$ruta = substr($valueI->getPath(), $pos);
    				$ruta_min = substr($ruta, 0, -4)."_min".substr($ruta,-4);
    				
            		$listado[$idP]['imagenes'][$im]['full'] = $ruta;
            		$listado[$idP]['imagenes'][$im]['min'] = $ruta_min;
            		
            		$im++;
            	}

                //Atributos
                $atributos = $em->getRepository('IncentivesCatalogoBundle:Atributosproducto')->findByProducto($valueP->getProducto()->getId());
                foreach ($atributos as $keyA => $valueA) {                
                    $listado[$idP]['atributos'][$valueA->getTipo()->getNombre()][$valueA->getId()] = $valueA->getValor();
                    
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

	
    /*public function ProductosAction(Request $request)
    {
        
    	// obtener el objeto de la petición
		

		// obtiene el valor de un parámetro $_GET
		$parametros = $request->query->get('parametros');
		$parametros = json_decode(stripslashes($parametros));

		$idCatalogo = $parametros->catalogo;;

		$em = $this->getDoctrine()->getManager();

        $catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($idCatalogo);

        $qb = $em->createQueryBuilder();            
        $qb->select('pc');
        $qb->from('IncentivesCatalogoBundle:Productocatalogo','pc');
        $qb->where('pc.catalogos = :id_catalogo');
        $qb->setParameter('id_catalogo', $idCatalogo);
        $productos = $qb->getQuery()->getResult();

        $listado = array();
        $idP = 0;
        foreach ($productos as $keyP => $valueP) {
        	
        	$listado[$idP]['id'] = $valueP->getId();
        	$listado[$idP]['nombre'] = $valueP->getProducto()->getNombre();
        	$listado[$idP]['referencia'] = $valueP->getProducto()->getReferencia();
        	$listado[$idP]['marca'] = $valueP->getProducto()->getMarca();
        	$listado[$idP]['sku'] = $valueP->getProducto()->getCodinc();
        	$listado[$idP]['descripcion'] = $valueP->getProducto()->getDescripcion();
        	$listado[$idP]['puntos'] = $valueP->getPuntos();

        	$imagenes = $em->getRepository('IncentivesCatalogoBundle:Imagenproducto')->findByProducto($valueP->getProducto()->getId());
        	$im = 0;
        	foreach ($imagenes as $keyI => $valueI) {
				$cadena   = '/operaciones/web';
				$pos = strpos($valueI->getPath(), $cadena);
				$ruta = substr($valueI->getPath(), $pos);
				$ruta_min = substr($ruta, 0, -4)."_min".substr($ruta,-4);
				
        		$listado[$idP]['imagenes'][$im]['full'] = $ruta;
        		$listado[$idP]['imagenes'][$im]['min'] = $ruta_min;
        		
        		$im++;
        	}

			$idP++;
        }

        $listado = json_encode($listado);

        echo($listado);
            
		$response = new Response();
		return $response->send();
    
    }*/
    
    public function CategoriasAction(Request $request)
    {
        
        // obtener el objeto de la petición
        

        // obtiene el valor de un parámetro $_GET
        $parametros = $request->query->get('parametros');
        $parametros = json_decode(urldecode($parametros));

        $idCatalogo = $parametros->catalogo;

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();            
        $qb->select('c.id,c.nombre');
        $qb->from('IncentivesCatalogoBundle:Productocatalogo','pc');
        $qb->leftJoin('pc.producto', 'p');
        $qb->leftJoin('pc.categoria', 'c');
        $str_filtro = 'pc.activo = 1 AND pc.aproboOperaciones = 1 AND pc.aproboComercial = 1 AND pc.aproboDirector = 1 AND pc.aproboCliente = 1 AND pc.catalogos = :id_catalogo';
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


}

