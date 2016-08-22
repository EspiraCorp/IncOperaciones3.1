<?php

namespace Incentives\OrdenesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\CatalogoBundle\Entity\Productocatalogo;
use Incentives\OrdenesBundle\Entity\OrdenesCompra;
use Incentives\OrdenesBundle\Entity\OrdenesProducto;
use Incentives\InventarioBundle\Entity\Inventario;
use Incentives\InventarioBundle\Entity\Despachos;
use Incentives\OrdenesBundle\Entity\Tracking;
use Incentives\RedencionesBundle\Entity\Redenciones;
use Incentives\RedencionesBundle\Entity\RedencionesHistorico;
use Incentives\OrdenesBundle\Form\Type\OrdenesCompraType;
use Incentives\OrdenesBundle\Form\Type\OrdenesCompraCantidadType;
use Incentives\OrdenesBundle\Form\Type\OrdenesProductoCantidadType;
use Incentives\OrdenesBundle\Form\Type\OrdenesProductoType;
use Incentives\OrdenesBundle\Form\Type\OrdenesTrackingType;
use Incentives\OrdenesBundle\Form\Type\OrdenesGenerarType;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Cell_DataValidation;
use PHPExcel_Style_Fill;

use Dompdf\Dompdf;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

//use BG\BarcodeBundle\Util\Base1DBarcode as barCode;
//use BG\BarcodeBundle\Util\Base2DBarcode as matrixCode;

class OrdenRedencionController extends Controller
{
    /**
     * @Route("/ordenredencion")
     * @Template()
     */
    public function listadoAction()
    {
    }


    /**
    * simple cache path returning method (sample cache path: "upload/barcode/cache" )
    *
    * @param bool $public
    *
    * @return string
    *
    */
   protected function getBarcodeCachePath($public = false)
   {

       return (!$public) ? $this->get('kernel')->getRootDir(). '/../web/upload/barcode/cache' : '/upload/barcode/cache';
   }

    /**
     * @Route("/ordenredencion/generar")
     * @Template()
     */
    public function generarAction()
    {

      $em = $this->getDoctrine()->getManager();

      //Consultar si hay inventario para las redenciones autorizadas
      //Lista de redenciones autorizadas agrupadas por producto y pais
      $qb = $em->createQueryBuilder()
           ->select('i')
           ->from('IncentivesInventarioBundle:Inventario','i')
           ->where('i.redencion IS NULL AND i.salio IS NULL AND i.ingreso=1 AND i.planilla IS NULL');
      $InventarioD = $qb->getQuery()->getResult();
      
      //Si hay productos en inventario asignarlos y dejarlos listos para despachar
      foreach($InventarioD as $keyD => $valueD){
        
        $qb = $em->createQueryBuilder()
           ->select('r')
           ->from('IncentivesRedencionesBundle:Redenciones','r')
           ->Join('r.productocatalogo', 'p')
           ->Join('p.producto', 'pr')
           ->where('r.redencionestado = 2 AND pr.id='.$valueD->getProducto()->getId())
           ->setMaxResults(1);
           
           $RedencionD = $qb->getQuery()->getOneOrNullResult();
           
           if(isset($RedencionD)){
             
              $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('4'); 
              $inventario = $em->getRepository('IncentivesInventarioBundle:Inventario')->find($valueD->getId());
              $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($RedencionD->getId());
              
              $redencion->setRedencionestado($estado);
              $inventario->setRedencion($redencion);
              
              $em->persist($inventario);
              $em->persist($redencion);
              
              $em->flush();
              
           }
      }

      //Lista de redenciones autorizadas agrupadas por producto y pais
      $qb = $em->createQueryBuilder()
           ->select('r')
           ->from('IncentivesRedencionesBundle:Redenciones','r')
           ->Join('r.productocatalogo', 'p')
           ->Join('p.producto', 'pr')
           ->Join('p.catalogos', 'c')
	   ->Join('pr.productoprecio', 'pp')
           ->Join('pp.proveedor', 'prov')
           ->where('r.redencionestado = :id AND prov.id != 327')
           ->groupby('p.producto','c.pais')          
           ->setParameters(array(
                'id'=> '2',                
            ));
      $ProductosR = $qb->getQuery()->getResult();

      $ProvProd = array();

      //Buscar proveedores y armar un arreglo para luego asignar las ordenes
      foreach($ProductosR as $keyP => $valueP){
        $id_producto = $valueP->getProductocatalogo()->getProducto()->getId();

        //Buscar los proveedores para cada producto
         $qb = $em->createQueryBuilder()
             ->select('precio')
             ->from('IncentivesCatalogoBundle:Productoprecio','precio')
             ->Join('precio.proveedor', 'pro')
             ->Join('precio.producto', 'pr')
             ->where('precio.principal = 1 AND precio.estado = 1 AND pr.id='.$id_producto)
	     ->setMaxResults(1);
        $proveedor = $qb->getQuery()->getOneOrNullResult();

        //armar el arreglo de proveedores - pais - productos
        if(isset($proveedor)){
          $ProvProd[$proveedor->getProveedor()->getId()][$valueP->getProductocatalogo()->getCatalogos()->getPais()->getId()][$proveedor->getProducto()->getId()] = $proveedor->getId();
        }

      }

      foreach($ProvProd as $keyProv => $keyPais){
        foreach($keyPais as $kpais => $valueProv){
        
          $id_prov = $keyProv;
          $id_pais = $kpais;

          $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('1');        
          $tipo = $em->getRepository('IncentivesOrdenesBundle:OrdenesTipo')->find('2');  
          $ordenes = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->findByOrdenesTipo($tipo);
          
          //revisar si exise una orden abierta para el proveedor
          $qb1 = $em->createQueryBuilder();            
          $qb1->select('o');
          $qb1->from('IncentivesOrdenesBundle:OrdenesCompra','o');
          $str_filtro = 'o.proveedor = '.$id_prov;
          $str_filtro .= ' AND o.pais = '.$id_pais;
          $str_filtro .= " AND o.ordenesEstado = 1 AND o.ordenesTipo = 2";
          $qb1->where($str_filtro);
          $qb1->setMaxResults(1);
          $orden = $qb1->getQuery()->getOneOrNullResult();

          $i = 0;
          //Si no existe, crear una nueva
        if(!isset($orden)){

            $prov = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($id_prov);
            $pais = $em->getRepository('IncentivesOperacionesBundle:Pais')->find($id_pais);

            $orden = new OrdenesCompra();
            $orden->setProveedor($prov);
            $orden->setPais($pais);
            $orden->setOrdenesEstado($estado);
            $orden->setOrdenesTipo($tipo);
            $orden->setFechaVencimiento(date_add(date_create("now"), date_interval_create_from_date_string($prov->getTiempoEntrega()." days")));
            $orden->setConsecutivo(str_pad(count($ordenes)+1, 3, '0', STR_PAD_LEFT)."-".date_create("now")->format('y')."R");
            $orden->setObservaciones("Orden generada para las redenciones aprobadas al ".date_create("now")->format('Y-m-d H:i:s'));
            $em->persist($orden);
            $em->flush();
          // si la orden es nueva agregar los productos
        
          //Recorrer los productos del porveedor y asignarlos a la orden
          foreach($valueProv as $keyProd => $valueProd){
              
              $productos = new OrdenesProducto();  
              
              $qb = $em->createQueryBuilder()
                 ->select('count(r.id)')
                 ->from('IncentivesRedencionesBundle:Redenciones','r')
                 ->Join('r.productocatalogo', 'p')
                 ->Join('p.producto', 'pr')
                 ->where('r.redencionestado = :id AND pr.id='.$keyProd)          
                 ->setParameters(array(
                      'id'=> '2',                
                  ));

              $cantidad = $qb->getQuery()->getSingleScalarResult();              

              $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($keyProd);
              $productoPrec = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($valueProd); 
              $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('3');
              $estadoProducto = $em->getRepository('IncentivesCatalogoBundle:Estados')->find('1');
              $i++;

              $productos->setEstado($estadoProducto);
              $productos->setCantidad($cantidad);
              $productos->setProducto($producto); 
              $productos->setValorunidad($productoPrec->getPrecio());
              $productos->setValortotal($productoPrec->getPrecio()*$cantidad);

              $productos->setOrdenesCompra($orden);
              $orden->addOrdenesProducto($productos);                    
              $em->persist($productos);

              //Actualizar estado de redenciones
              $qb = $em->createQueryBuilder()
                   ->select('r')
                   ->from('IncentivesRedencionesBundle:Redenciones','r')
                   ->Join('r.productocatalogo', 'p')
                   ->Join('p.producto', 'pr')
                   ->where('r.redencionestado = 2 AND pr.id='.$keyProd);

              $redenciones = $qb->getQuery()->getResult();
              foreach ($redenciones as $keyRed => $valueRed) {
                //if ($valueRed->getRedencionestado()==$estadoredencion){
                  $valueRed->setOrdenesProducto($productos);
                  $valueRed->setRedencionestado($estado);
                  $em->persist($valueRed);
                  $em->flush();
                  
                  //Almacenar Historico
                  $redencionH = $this->get('incentives_redenciones');
                  $redencionH->insertar($valueRed);
                //}
              }
          }
        }else{
          //Si existe revisar cantidades y actualizar
          
          //Recorrer los productos del porveedor y asignarlos a la orden
          foreach($valueProv as $keyProd => $valueProd){
              
              $qb = $em->createQueryBuilder()
                 ->select('count(r.id)')
                 ->from('IncentivesRedencionesBundle:Redenciones','r')
                 ->Join('r.productocatalogo', 'p')
                 ->Join('p.producto', 'pr')
                 ->where('r.redencionestado = :id AND pr.id='.$keyProd)          
                 ->setParameters(array(
                      'id'=> '2',                
                  ));

              $cantidad = $qb->getQuery()->getSingleScalarResult();

              //$productos = new OrdenesProducto();
                $qb = $em->createQueryBuilder()
                   ->select('o')
                   ->from('IncentivesOrdenesBundle:Ordenesproducto','o')
                   ->where('o.ordenesCompra = '.$orden->getId().' AND o.producto='.$keyProd);
                //Productos faltantes
                $productos  = $qb->getQuery()->getOneOrNullResult();

              if(!isset($productos)){

                $productos = new OrdenesProducto();  

                $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($keyProd);
                $productoPrec = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($valueProd); 
                $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('3');  
                $i++;
                $productos->setCantidad($cantidad);
                $productos->setProducto($producto); 
                $productos->setValorunidad($productoPrec->getPrecio());
                $productos->setValortotal($productoPrec->getPrecio()*$cantidad);

                $productos->setOrdenesCompra($orden);
                $orden->addOrdenesProducto($productos);                    
                $em->persist($productos);

              }else{              

                $cantidadT = $cantidad + $productos->getCantidad();

                $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($keyProd);
                $productoPrec = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($valueProd); 
                $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('3');  
                $i++;
                $productos->setCantidad($cantidadT);
                $productos->setValorunidad($productoPrec->getPrecio());
                $productos->setValortotal($productoPrec->getPrecio()*$cantidadT);                   
                $em->persist($productos);
              }

              //Actualizar estado de redenciones
              $qb = $em->createQueryBuilder()
                   ->select('r')
                   ->from('IncentivesRedencionesBundle:Redenciones','r')
                   ->Join('r.productocatalogo', 'p')
                   ->Join('p.producto', 'pr')
                   ->where('r.redencionestado = 2 AND pr.id='.$keyProd);

              $redenciones = $qb->getQuery()->getResult();
              foreach ($redenciones as $keyRed => $valueRed) {
                //if ($valueRed->getRedencionestado()==$estadoredencion){
                  $valueRed->setOrdenesProducto($productos);
                  $valueRed->setRedencionestado($estado);
                  $em->persist($valueRed);
                  $em->flush();

                  //Almacenar Historico
                  $redencionH = $this->get('incentives_redenciones');
                  $redencionH->insertar($valueRed);
                  //$this->historicoAction($valueRed->getId());
                //}
              }
          }

        }

        if ($i!=0){
            $em->persist($orden);
            $em->flush();
            $this->pdfAction($orden->getId()); 
            $this->pdfCodesAction($orden->getId()); 
            $this->totalordenAction($orden->getId());
        }

        }
      }


     /* //recorrer cada proveedor para crear ordenes y asignar productos
      foreach($ProvProd as $keyProv => $valueProv){
        $id_prov = $keyProv;

        $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('1');        
        $tipo = $em->getRepository('IncentivesOrdenesBundle:OrdenesTipo')->find('2');  
        $ordenes = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->findByOrdenesTipo($tipo);
        
        //revisar si exise una orden abierta para el proveedor
        $qb1 = $em->createQueryBuilder();            
        $qb1->select('o');
        $qb1->from('IncentivesOrdenesBundle:OrdenesCompra','o');
        $str_filtro = 'o.proveedor = '.$id_prov;
        $str_filtro .= " AND o.ordenesEstado = 1 AND o.ordenesTipo = 2";
        $qb1->where($str_filtro);
        $qb1->setMaxResults(1);
        $orden = $qb1->getQuery()->getOneOrNullResult();

        $i = 0;

        //Si no existe, crear una nueva
        if(!isset($orden)){

            $prov = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($id_prov);
            $pais = $em->getRepository('IncentivesOperacionesBundle:Pais')->find($id_prov);

            $orden = new OrdenesCompra();
            $orden->setProveedor($prov);
            $orden->setPais($pais);
            $orden->setOrdenesEstado($estado);
            $orden->setOrdenesTipo($tipo);
            $orden->setFechaVencimiento(date_add(date_create("now"), date_interval_create_from_date_string($prov->getTiempoEntrega()." days")));
            $orden->setConsecutivo(str_pad(count($ordenes)+1, 3, '0', STR_PAD_LEFT)."-".date_create("now")->format('y')."R");
            $orden->setObservaciones("Orden generada para las redenciones aprobadas al ".date_create("now")->format('Y-m-d H:i:s'));

          // si la orden es nueva agregar los productos
        
          //Recorrer los productos del porveedor y asignarlos a la orden
          foreach($valueProv as $keyProd => $valueProd){
              
              $productos = new OrdenesProducto();  
              
              $qb = $em->createQueryBuilder()
                 ->select('count(r.id)')
                 ->from('IncentivesRedencionesBundle:Redenciones','r')
                 ->Join('r.productocatalogo', 'p')
                 ->Join('p.producto', 'pr')
                 ->where('r.redencionestado = :id AND pr.id='.$keyProd)          
                 ->setParameters(array(
                      'id'=> '2',                
                  ));

              $cantidad = $qb->getQuery()->getSingleScalarResult();              

              $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($keyProd);
              $productoPrec = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($valueProd); 
              $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('3');  
              $i++;
              $productos->setCantidad($cantidad);
              $productos->setProducto($producto); 
              $productos->setValorunidad($productoPrec->getPrecio());
              $productos->setValortotal($productoPrec->getPrecio()*$cantidad);

              $productos->setOrdenesCompra($orden);
              $orden->addOrdenesProducto($productos);                    
              $em->persist($productos);

              //Actualizar estado de redenciones
              $qb = $em->createQueryBuilder()
                   ->select('r')
                   ->from('IncentivesRedencionesBundle:Redenciones','r')
                   ->Join('r.productocatalogo', 'p')
                   ->Join('p.producto', 'pr')
                   ->where('r.redencionestado = 2 AND pr.id='.$keyProd);

              $redenciones = $qb->getQuery()->getResult();
              foreach ($redenciones as $keyRed => $valueRed) {
                //if ($valueRed->getRedencionestado()==$estadoredencion){
                  $valueRed->setOrdenesProducto($productos);
                  $valueRed->setRedencionestado($estado);
                  $em->persist($valueRed);
                  $em->flush();
                  
                  //Almacenar Historico
                  $redencionH = $this->get('incentives_redenciones');
                  $redencionH->insertar($valueRed);
                //}
              }
          }
        }else{
          //Si existe revisar cantidades y actualizar
          
          //Recorrer los productos del porveedor y asignarlos a la orden
          foreach($valueProv as $keyProd => $valueProd){
              
              $qb = $em->createQueryBuilder()
                 ->select('count(r.id)')
                 ->from('IncentivesRedencionesBundle:Redenciones','r')
                 ->Join('r.productocatalogo', 'p')
                 ->Join('p.producto', 'pr')
                 ->where('r.redencionestado = :id AND pr.id='.$keyProd)          
                 ->setParameters(array(
                      'id'=> '2',                
                  ));

              $cantidad = $qb->getQuery()->getSingleScalarResult();

              //$productos = new OrdenesProducto();
                $qb = $em->createQueryBuilder()
                   ->select('o')
                   ->from('IncentivesOrdenesBundle:Ordenesproducto','o')
                   ->where('o.ordenesCompra = '.$orden->getId().' AND o.producto='.$keyProd);
                //Productos faltantes
                $productos  = $qb->getQuery()->getOneOrNullResult();

              if(!isset($productos)){

                $productos = new OrdenesProducto();  

                $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($keyProd);
                $productoPrec = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($valueProd); 
                $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('3');  
                $i++;
                $productos->setCantidad($cantidad);
                $productos->setProducto($producto); 
                $productos->setValorunidad($productoPrec->getPrecio());
                $productos->setValortotal($productoPrec->getPrecio()*$cantidad);

                $productos->setOrdenesCompra($orden);
                $orden->addOrdenesProducto($productos);                    
                $em->persist($productos);

              }else{              

                $cantidadT = $cantidad + $productos->getCantidad();

                $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($keyProd);
                $productoPrec = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($valueProd); 
                $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('3');  
                $i++;
                $productos->setCantidad($cantidadT);
                $productos->setValorunidad($productoPrec->getPrecio());
                $productos->setValortotal($productoPrec->getPrecio()*$cantidadT);                   
                $em->persist($productos);
              }

              //Actualizar estado de redenciones
              $qb = $em->createQueryBuilder()
                   ->select('r')
                   ->from('IncentivesRedencionesBundle:Redenciones','r')
                   ->Join('r.productocatalogo', 'p')
                   ->Join('p.producto', 'pr')
                   ->where('r.redencionestado = 2 AND pr.id='.$keyProd);

              $redenciones = $qb->getQuery()->getResult();
              foreach ($redenciones as $keyRed => $valueRed) {
                //if ($valueRed->getRedencionestado()==$estadoredencion){
                  $valueRed->setOrdenesProducto($productos);
                  $valueRed->setRedencionestado($estado);
                  $em->persist($valueRed);
                  $em->flush();

                  //Almacenar Historico
                  $redencionH = $this->get('incentives_redenciones');
                  $redencionH->insertar($valueRed);
                  //$this->historicoAction($valueRed->getId());
                //}
              }
          }

        }

        if ($i!=0){
            $em->persist($orden);
            $em->flush();
            $this->barcodes($orden->getId());
            $this->pdfAction($orden->getId()); 
            $this->pdfCodesAction($orden->getId()); 
        }
      }*/
      return $this->redirect($this->generateUrl('ordenes'));
    }


	public function generarTotalPassAction($id)
    {

      $em = $this->getDoctrine()->getManager();

      //Lista de redenciones autorizadas agrupadas para total pass por producto y pais
      $qb = $em->createQueryBuilder()
           ->select('r')
           ->from('IncentivesRedencionesBundle:Redenciones','r')
           ->Join('r.productocatalogo', 'p')
           ->Join('p.producto', 'pr')
           ->Join('pr.productoprecio', 'pp')
           ->Join('pp.proveedor', 'prov')
           ->Join('p.catalogos', 'c')
           ->where('r.redencionestado = :id AND prov.id = 327 AND c.programa='.$id) 
           ->groupby('p.producto','c.pais')        
           ->setParameters(array(
                'id'=> '2',                
            ));
      $ProductosR = $qb->getQuery()->getResult();

      //Consultar de nuevo la lista de redenciones pendientes por OC


      $ProvProd = array();

      //Buscar proveedores y armar un arreglo para luego asignar las ordenes
      foreach($ProductosR as $keyP => $valueP){
        $id_producto = $valueP->getProductocatalogo()->getProducto()->getId();

        //Buscar los proveedores para cada producto
         $qb = $em->createQueryBuilder()
             ->select('precio')
             ->from('IncentivesCatalogoBundle:Productoprecio','precio')
             ->Join('precio.proveedor', 'pro')
             ->Join('precio.producto', 'pr')
             ->where('precio.principal = :principal AND pr.id='.$id_producto)
             ->setParameters(array(
                  'principal'=> '1',
              ));
        $proveedor = $qb->getQuery()->getOneOrNullResult();

        //armar el arreglo de proveedores - pais - productos
        if(isset($proveedor)){
          $ProvProd[$proveedor->getProveedor()->getId()][$valueP->getProductocatalogo()->getCatalogos()->getPais()->getId()][$proveedor->getProducto()->getId()] = $proveedor->getId();
        }

      }

      foreach($ProvProd as $keyProv => $keyPais){
        foreach($keyPais as $kpais => $valueProv){
        
          $id_prov = $keyProv;
          $id_pais = $kpais;

          $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('1');        
          $tipo = $em->getRepository('IncentivesOrdenesBundle:OrdenesTipo')->find('2');  
          $ordenes = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->findByOrdenesTipo($tipo);
          
          //revisar si exise una orden abierta para el proveedor
          $qb1 = $em->createQueryBuilder();            
          $qb1->select('o');
          $qb1->from('IncentivesOrdenesBundle:OrdenesCompra','o');
          $str_filtro = 'o.proveedor = '.$id_prov;
          $str_filtro .= ' AND o.pais = '.$id_pais;
          $str_filtro .= " AND o.ordenesEstado = 1 AND o.ordenesTipo = 2";
          $qb1->where($str_filtro);
          $qb1->setMaxResults(1);
          $orden = $qb1->getQuery()->getOneOrNullResult();

          $i = 0;
          //Si no existe, crear una nueva
        if(!isset($orden)){

            $prov = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($id_prov);
            $pais = $em->getRepository('IncentivesOperacionesBundle:Pais')->find($id_pais);
            $categ = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find(10);

            $orden = new OrdenesCompra();
            $orden->setProveedor($prov);
            $orden->setPais($pais);
            $orden->setCategoria($categ);
            $orden->setOrdenesEstado($estado);
            $orden->setOrdenesTipo($tipo);
            $orden->setFechaVencimiento(date_add(date_create("now"), date_interval_create_from_date_string($prov->getTiempoEntrega()." days")));
            $orden->setConsecutivo(str_pad(count($ordenes)+1, 3, '0', STR_PAD_LEFT)."-".date_create("now")->format('y')."R");
            $orden->setObservaciones("Orden Total Pass generada para las redenciones aprobadas al ".date_create("now")->format('Y-m-d H:i:s'));

          // si la orden es nueva agregar los productos
        
          //Recorrer los productos del porveedor y asignarlos a la orden
          foreach($valueProv as $keyProd => $valueProd){
              
              $productos = new OrdenesProducto();  
              
              $qb = $em->createQueryBuilder()
                 ->select('count(r.id)')
                 ->from('IncentivesRedencionesBundle:Redenciones','r')
                 ->Join('r.productocatalogo', 'p')
                 ->Join('p.producto', 'pr')
                 ->where('r.redencionestado = :id AND pr.id='.$keyProd)          
                 ->setParameters(array(
                      'id'=> '2',                
                  ));

              $cantidad = $qb->getQuery()->getSingleScalarResult();              

              $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($keyProd);
              $productoPrec = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($valueProd); 
              $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('3');  
              $i++;
              $productos->setCantidad($cantidad);
              $productos->setProducto($producto); 
              $productos->setValorunidad($productoPrec->getPrecio());
              $productos->setValortotal($productoPrec->getPrecio()*$cantidad);

              $productos->setOrdenesCompra($orden);
              $orden->addOrdenesProducto($productos);                    
              $em->persist($productos);

              //Actualizar estado de redenciones
              $qb = $em->createQueryBuilder()
                   ->select('r')
                   ->from('IncentivesRedencionesBundle:Redenciones','r')
                   ->Join('r.productocatalogo', 'p')
                   ->Join('p.producto', 'pr')
                   ->where('r.redencionestado = 2 AND pr.id='.$keyProd);

              $redenciones = $qb->getQuery()->getResult();
              foreach ($redenciones as $keyRed => $valueRed) {
                //if ($valueRed->getRedencionestado()==$estadoredencion){
                  $valueRed->setOrdenesProducto($productos);
                  $valueRed->setRedencionestado($estado);
                  $em->persist($valueRed);
                  $em->flush();
                  
                  //Almacenar Historico
                  $redencionH = $this->get('incentives_redenciones');
                  $redencionH->insertar($valueRed);
                //}
              }
          }
        }else{
          //Si existe revisar cantidades y actualizar
          
          //Recorrer los productos del porveedor y asignarlos a la orden
          foreach($valueProv as $keyProd => $valueProd){
              
              $qb = $em->createQueryBuilder()
                 ->select('count(r.id)')
                 ->from('IncentivesRedencionesBundle:Redenciones','r')
                 ->Join('r.productocatalogo', 'p')
                 ->Join('p.producto', 'pr')
                 ->where('r.redencionestado = :id AND pr.id='.$keyProd)          
                 ->setParameters(array(
                      'id'=> '2',                
                  ));

              $cantidad = $qb->getQuery()->getSingleScalarResult();

              //$productos = new OrdenesProducto();
                $qb = $em->createQueryBuilder()
                   ->select('o')
                   ->from('IncentivesOrdenesBundle:Ordenesproducto','o')
                   ->where('o.ordenesCompra = '.$orden->getId().' AND o.producto='.$keyProd);
                //Productos faltantes
                $productos  = $qb->getQuery()->getOneOrNullResult();

              if(!isset($productos)){

                $productos = new OrdenesProducto();  

                $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($keyProd);
                $productoPrec = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($valueProd); 
                $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('3');  
                $i++;
                $productos->setCantidad($cantidad);
                $productos->setProducto($producto); 
                $productos->setValorunidad($productoPrec->getPrecio());
                $productos->setValortotal($productoPrec->getPrecio()*$cantidad);

                $productos->setOrdenesCompra($orden);
                $orden->addOrdenesProducto($productos);                    
                $em->persist($productos);

              }else{              

                $cantidadT = $cantidad + $productos->getCantidad();

                $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($keyProd);
                $productoPrec = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($valueProd); 
                $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('3');  
                $i++;
                $productos->setCantidad($cantidadT);
                $productos->setValorunidad($productoPrec->getPrecio());
                $productos->setValortotal($productoPrec->getPrecio()*$cantidadT);                   
                $em->persist($productos);
              }

              //Actualizar estado de redenciones
              $qb = $em->createQueryBuilder()
                   ->select('r')
                   ->from('IncentivesRedencionesBundle:Redenciones','r')
                   ->Join('r.productocatalogo', 'p')
                   ->Join('p.producto', 'pr')
                   ->where('r.redencionestado = 2 AND pr.id='.$keyProd);

              $redenciones = $qb->getQuery()->getResult();
              foreach ($redenciones as $keyRed => $valueRed) {
                //if ($valueRed->getRedencionestado()==$estadoredencion){
                  $valueRed->setOrdenesProducto($productos);
                  $valueRed->setRedencionestado($estado);
                  $em->persist($valueRed);
                  $em->flush();

                  //Almacenar Historico
                  $redencionH = $this->get('incentives_redenciones');
                  $redencionH->insertar($valueRed);
                  //$this->historicoAction($valueRed->getId());
                //}
              }
          }

        }

        if ($i!=0){
            $em->persist($orden);
            $em->flush();
            $this->pdfAction($orden->getId()); 
            $this->pdfCodesAction($orden->getId()); 
            $this->totalordenAction($orden->getId());
        }

        }
      }

      return $this->redirect($this->generateUrl('ordenes'));
    }

    /**
     * @Route("/ordenredencion/generar2")
     * @Template()
     */
    public function generar2Action()
    {
        $em = $this->getDoctrine()->getManager();

        // $redenciones = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->findByRedencionestado("2");
        // $productos = $em->getRepository('IncentivesCatalogoBundle:Productocatalogo')->findAll();
        // $precio = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->findAll();
        // $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->findAll();

        /*****************
        *Consulta SQL
        ******************
        SELECT r.id, r.valor, r.codigoredencion, pr.id AS producto, pr.nombre, precio.precio, pro.nombre, count( r.productocatalogo_id )
        FROM `Redenciones` AS r
        JOIN Productocatalogo AS p ON r.productocatalogo_id = p.id
        JOIN Producto AS pr ON p.producto_id = pr.id
        JOIN Productoprecio AS precio ON precio.producto_id = pr.id
        JOIN Proveedores AS pro ON precio.proveedor_id = pro.id
        WHERE r.`redencionestado_id` = "2"
        AND precio.principal = "1"
        GROUP BY r.productocatalogo_id
        */

      //Lista de redenciones autorizadas
      $qb = $em->createQueryBuilder()
           ->select('r.id as redencion','r.valor', 'r.codigoredencion', 'p.puntos', 'p.id as productocatalogo' ,'pr.nombre', 'pr.id as producto', 'COUNT (r.productocatalogo) as cantidad')
           ->from('IncentivesRedencionesBundle:Redenciones','r')
           ->Join('r.productocatalogo', 'p')
           ->Join('p.producto', 'pr')
           ->where('r.redencionestado = :id') 
           ->groupby('r.productocatalogo')          
           ->setParameters(array(
                'id'=> '2',                
            ));
       $listado = $qb->getQuery()->getResult();




      //Lista de productos y precios
      $qb = $em->createQueryBuilder()
           ->select('pr.id as producto','pr.nombre', 'precio.precio', 'pro.correo', 'pro.nombre as nombre_proveedor')
           ->from('IncentivesCatalogoBundle:Productoprecio','precio')
           ->Join('precio.proveedor', 'pro')
           ->Join('precio.producto', 'pr')
           ->where('precio.principal = :principal')
           ->setParameters(array(
                'principal'=> '1',
            ));
      $listado2 = $qb->getQuery()->getResult();

      $proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->findAll();
      $tipo = $em->getRepository('IncentivesOrdenesBundle:OrdenesTipo')->find("2");
       

       foreach ($proveedor as $key => $value) {
        $i=0;
        $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('1');        
        $tipo = $em->getRepository('IncentivesOrdenesBundle:OrdenesTipo')->find('2');  
        $ordenes = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->findByOrdenesTipo($tipo);
        
        //revisar si exise una orden abierta para el proveedor
        //$orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find(array('proveedor'=>$value->getId())); 

        $qb1 = $em->createQueryBuilder();            
        $qb1->select('o');
        $qb1->from('IncentivesOrdenesBundle:OrdenesCompra','o');
        $str_filtro = 'o.proveedor = '.$value->getId();
        $str_filtro .= " AND o.ordenesEstado = 1 AND ordenestipo = 2";
        $qb1->where($str_filtro);
        $qb1->setMaxResults(1);
        $orden = $qb1->getQuery()->getOneOrNullResult();

        //si no crear una nueva
        if(!isset($orden)){
            $orden = new OrdenesCompra();
            $orden->setProveedor($value);
            $orden->setOrdenesEstado($estado);
            $orden->setOrdenesTipo($tipo);
            $orden->setFechaVencimiento(date_add(date_create("now"), date_interval_create_from_date_string($value->getTiempoEntrega()." days")));
            $orden->setConsecutivo(str_pad(count($ordenes)+1, 3, '0', STR_PAD_LEFT)."-".date_create("now")->format('y')."R");
            $orden->setObservaciones("Orden generada para las redenciones aprobadas al ".date_create("now")->format('Y-m-d H:i:s'));

            // si la orden es nueva agregar los porductos


        }

        foreach ($listado as $key1 => $value1) {
            foreach ($listado2 as $key2 => $value2) {
              if ($value2["correo"]==$value->getCorreo() and $value2["producto"]==$value1["producto"]){
                $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($value1["producto"]);
                $estadoredencion = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('2');  
                $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->findByProductocatalogo($value1["productocatalogo"]);
                
                $inventario=$em->getRepository('IncentivesInventarioBundle:Inventario')->findByProducto($producto);
                $total=0;
                foreach ($inventario as $key3 => $value3) {

                  if ($value3->getIngreso()==1 && $value3->getSalio()==0  && $value3->getRedencion()==null){
                      $total=$total+1;
                  }elseif ($value3->getIngreso()==0 && $value3->getSalio()==1) {
                      $total=$total-1;
                   }
                }
                //echo $value1["producto"]." dd ".$value1["cantidad"]." ll ".$total."<br>";
                $productos = new OrdenesProducto();  
                $productos->setProducto($producto); 
                $productos->setValorunidad($value2["precio"]);

                if ($value1["cantidad"]-$total > 0){
                  $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('3');  
                  $i++;
                  $productos->setCantidad($value1["cantidad"]-$total);
                  $productos->setValortotal($value2["precio"]*($value1["cantidad"]-$total));
                  $productos->setOrdenesCompra($orden);
                  $orden->addOrdenesProducto($productos);                    
                  $em->persist($productos);
                  foreach ($redencion as $key3 => $value3) {
                    if ($value3->getRedencionestado()==$estadoredencion){
                      $value3->setOrdenesProducto($productos);
                      $value3->setRedencionestado($estado);
                      $em->persist($value3);
                      $em->flush();
                      //$this->historicoAction($value3->getId());
                      //Almacenar Historico
                      $redencionH = $this->get('incentives_redenciones');
                      $redencionH->insertar($value3);
                    }
                  }
                }/*else{
                  $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('4');  
                  $salida = new Inventario();
                  $salida->setProducto($producto);
                  $salida->setSalio("1");
                  $salida->setFechaSalida(date_create("now"));
                  foreach ($redencion as $key3 => $value3) {    
                    if ($value3->getRedencionestado()==$estadoredencion){
                      $salida->setRedencion($value3);
                      $salida->setObservacion("Salida asociada a la redencion ".$value3->getId());
                      $em->persist($salida);                  
                      $value3->setRedencionestado($estado);
                      $em->persist($value3);
                      $em->flush();
                      $this->historicoAction($value3->getId());
                    }
                  }
                }*/
              }
            }
          } 
           
          if ($i!=0){
            $em->persist($orden);
            $em->flush();
            $this->pdfAction($orden->getId()); 
            $this->totalordenAction($orden->getId());
            //$this->correoAction($orden->getId()); 
            //$this->redirect($this->generateUrl('ordenes_correo').'/'.$orden->getId());
          }
       } 
       
      return $this->redirect($this->generateUrl('ordenes'));
      /*$response = new Response();
      $response->setContent('Hello World');
      return $response;  */
    }

    /**
     * @Route("/ordenredencion/estado/{id}")
     * @Template()
     */
    public function aprobarAction($id)
    {
      $em = $this->getDoctrine()->getManager();
      $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
      $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('2'); 

      $orden->setOrdenesEstado($estado);
      $orden->setAprobo($this->getUser());
      $em->persist($orden);
      $em->flush();

      if($orden->getProveedor()->getId() == 327) $this->aprobarTotalpassAction($orden->getId());
      $this->correoAction($orden->getId(), "aprobar");
    	if($orden->getProveedor()->getDirecto() == 1){ 	
    		$this->correoLogisticaAction($orden->getId());
    	}
    	
    	//actualizar precios de compra en redenciones
    	$ordenProducto = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findByOrdenesCompra($id);
    	
    	foreach($ordenProducto as $keyP => $valueP){
    	  
    	  $idOP = $valueP->getId();
    	  //redenciones por Orden Producto
    	  $redenciones = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->findByOrdenesProducto($idOP);
    	  
    	  foreach($redenciones as $keyR => $valueR){
    	    
    	    $valueR->setValorOrden($valueP->getValorunidad());
    	    
    	    $em->persist($valueR);
          $em->flush();
    	    
    	  }
    	  
    	}
    	
      return $this->redirect($this->generateUrl('ordenes'));
    }


    public function cancelarAction($id)
    {
      $em = $this->getDoctrine()->getManager();
      $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
      $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('3'); 

	  $estadoactual = $orden->getordenesEstado()->getId();

      $orden->setOrdenesEstado($estado);

      $qb = $em->createQueryBuilder();            
      $qb->select('r');
      $qb->from('IncentivesRedencionesBundle:Redenciones','r');
      $qb->leftJoin('r.ordenesProducto', 'op');
      $str_filtro = 'op.ordenesCompra = :orden';
      $qb->where($str_filtro);

      //Definicion de parametros para filtros   
      $arrayParametros['orden'] = $orden->getId();
      $qb->setParameters($arrayParametros);
           
      $redenciones = $qb->getQuery()->getResult();

      $i=0;
      foreach ($redenciones as $keyR => $valueR) {
            $redencion[$i] = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($valueR->getId());
            $estado = $em->getRepository('IncentivesRedencionesBundle:RedencionesEstado')->find('2');
            $redencion[$i]->setRedencionestado($estado);
            $redencion[$i]->setOrdenesProducto(null);
            $em->persist($redencion[$i]);
            $i++;
      }

      $em->persist($orden);
      $em->flush();

      //Guardar historicos
      $i=0;
      foreach ($redenciones as $keyR => $valueR) {
            $observacion = "";
            $redencionH = $this->get('incentives_redenciones');
            $redencionH->insertar($valueR);
            //$this->historicoAction($valueR->getId(),$observacion);
      }

      if($estadoactual>=2){
        $this->correoAction($id, "cancelar");
      }

      //$this->correoAction($orden->getId());
      return $this->redirect($this->generateUrl('ordenes'));
    }


    public function cerrarAction($id)
    {
      $em = $this->getDoctrine()->getManager();
      $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
      $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('5'); 

      $orden->setOrdenesEstado($estado);

      //Revisar cantidades de la orden
      $ordenesProducto = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findByordenesCompra($orden->getId());
      foreach($ordenesProducto as $keyO => $valueO){

          $arrayParametros = array();
          $qb = $em->createQueryBuilder();            
          $qb->select(array('cantidad'=>'COUNT(i.id)'));
          $qb->from('IncentivesInventarioBundle:Inventario','i');
          $str_filtro = 'i.orden = :orden';
          $str_filtro .= ' AND i.producto= :producto';
          $qb->where($str_filtro);

          //Definicion de parametros para filtros
          $arrayParametros['orden'] = $orden->getId();
          $arrayParametros['producto'] = $valueO->getProducto();
          $qb->setParameters($arrayParametros);
          $cantidad = $qb->getQuery()->getSingleScalarResult();

          $diferencia = $valueO->getCantidad() - $cantidad;
          if($diferencia > 0) {
            //liberar las redenciones que no llegaron
            for($id=1;$id<=$diferencia;$id++){
              $arrayParametros = array();
                $qb = $em->createQueryBuilder();            
                $qb->select('r');
                $qb->from('IncentivesRedencionesBundle:Redenciones','r');
                $qb->leftJoin('r.productocatalogo', 'pc');
                $qb->leftJoin('r.ordenesProducto', 'op');
                $str_filtro = 'op.ordenesCompra = :orden';
                $str_filtro .= ' AND pc.producto= :producto';
                $str_filtro .= ' AND r.redencionestado = 3';
                $qb->where($str_filtro);
                $qb->orderBy('r.fecha', 'desc');

                //Definicion de parametros para filtros
                $arrayParametros['orden'] = $orden->getId();
                $arrayParametros['producto'] = $valueO->getProducto();
                $qb->setParameters($arrayParametros);
                $qb->setMaxResults(1);
                $redencion = $qb->getQuery()->getOneOrNullResult();

                if(isset($redencion)){
                  $redencion->setOrdenesProducto(null);
                  $estadoredencion = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('2');
                  $redencion->setRedencionestado($estadoredencion);

                  $em->persist($redencion);
                  $em->flush();
                }

            }

          }

      }      
      $em->persist($orden);
      $em->flush();

      return $this->redirect($this->generateUrl('ordenes'));
    }

  public function correoAction($id, $accion)
    {

        $em = $this->getDoctrine()->getManager();

        $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
        $productos = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findByOrdenesCompra($orden->getId());
        $destino = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($orden->getProveedor()->getId());
        $this->pdfAction($id);      
	$correos=  explode(',',$destino->getCorreo());

        // Create the Transport
        $transport = \Swift_SmtpTransport::newInstance('smtp.office365.com', 25, 'tls')
          ->setAuthMode('login')
          ->setUsername('operaciones@inc-group.co')
          ->setPassword('IncGroup2016!')
          ;

        if($accion=="cancelar"){
          $template = 'IncentivesOrdenesBundle:Ordenes:emailcancelar.txt.twig';
          $subjet = 'Cancelación orden de compra';
        }elseif($accion=="aprobar"){
          $template = 'IncentivesOrdenesBundle:Ordenes:email.txt.twig';
          $subjet = 'Nueva orden de compra';
        }
	//'manuelgb13@gmail.com','compras1@grupo-inc.com','compras2@grupo-inc.com','compras3@grupo-inc.com','compras4@grupo-inc.com',

        // Create the Mailer using your created Transport
        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance()
            ->setSubject($subjet)
            ->setFrom(array('operaciones@inc-group.co' => 'Grupo Inc'))
            //->setTo($destino->getCorreo())
            ->setTo(array_merge(array('alievano@inc-group.co','controloperaciones@inc-group.co','compras1@inc-group.co','compras2@inc-group.co','compras3@inc-group.co','compras4@inc-group.co'),$correos))
            ->attach(\Swift_Attachment::fromPath($this->container->getParameter('kernel.root_dir').'/..'.$orden->getRutapdf()))
            
            ->setBody(
                $this->renderView(
                    $template,
                    array('orden' => $orden, 'productos'=>$productos)
                )
            );
        
        //Send the message
        if($mailer->send($message)) {
            $this->get('session')->getFlashBag()->add('notice', 'El correo al proveedor ha sido enviado correctamente');
        }else{
            $this->get('session')->getFlashBag()->add('notice', 'El mensaje no pudo ser enviado');
        }

        return $this->redirect($this->generateUrl('ordenes_datos').'/'.$id);
    }

    public function correoLogisticaAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
        
        // Create the Transport
        $transport = \Swift_SmtpTransport::newInstance('smtp.office365.com', 25, 'tls')
          ->setAuthMode('login')
          ->setUsername('operaciones@inc-group.co')
          ->setPassword('IncGroup2016!')
          ;

          $template = 'IncentivesOrdenesBundle:Ordenes:emaillogistico.txt.twig';
          $subjet = 'Nueva orden para planilla';
        

        // Create the Mailer using your created Transport
        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance()
            ->setSubject($subjet)
            ->setFrom(array('operaciones@inc-group.co' => 'Grupo Inc'))
            //->setTo($destino->getCorreo())
            ->setTo(array('logistica1@inc-group.co','logistica2@inc-group.co','logistica3@inc-group.co','logistica4@inc-group.co'))
            
            ->setBody(
                $this->renderView(
                    $template,
                    array('orden' => $orden)
                )
            );
        
        //Send the message
        if($mailer->send($message)) {
            $this->get('session')->getFlashBag()->add('notice', 'El correo de alerta al logistico ha sido enviado correctamente');
        }else{
            $this->get('session')->getFlashBag()->add('notice', 'El correo de alerta al logistico no pudo ser enviado');
        }

    }


    public function pdfAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
        $productos = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findBy(array('ordenesCompra' => $orden->getId(), 'estado' => 1));
        $destino = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($orden->getProveedor()->getId());
        $contacto = $em->getRepository('IncentivesOperacionesBundle:Contacto')->findOneByProveedor($orden->getProveedor());

        //Cantidades por CC
        $ordenesOP = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
        $OrdenesProducto = $this->getDoctrine()->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findByOrdenesCompra($ordenesOP->getId());
        $cantCC = array();

        foreach($OrdenesProducto as $keyOP => $valueOP){
            //Determinar los CC

            $qb = $em->createQueryBuilder(); 
            $qb->select('r');
            $qb->from('IncentivesRedencionesBundle:Redenciones','r');
            $qb->leftJoin('r.ordenesProducto', 'op');
            $qb->leftJoin('r.participante', 'p');
            $str_filtro = "op.id=".$valueOP->getId();
            $str_filtro .= " AND op.estado=1";
            $qb->where($str_filtro);
            $qb->groupBy('p.programa');
            $ordenesProd = $qb->getQuery()->getResult();

            $datoCC = "";
            $totalCant = 0;

            foreach ($ordenesProd as $keyOP2 => $valueOP2) {
                # code...
                $cantidadOP = 0;

                $qb = $em->createQueryBuilder(); 
                $qb->select('count(r)');
                $qb->from('IncentivesRedencionesBundle:Redenciones','r');
                $qb->leftJoin('r.ordenesProducto', 'op');
                $qb->leftJoin('r.participante', 'p');
                $str_filtro = "op.id=".$valueOP->getId()." AND p.programa=".$valueOP2->getParticipante()->getPrograma()->getId();
                $qb->where($str_filtro);
                $cantidadOP = $qb->getQuery()->getSingleScalarResult();

                $totalCant += $cantidadOP;

                $datoCC .= $valueOP2->getParticipante()->getPrograma()->getCentrocostos()."(".$cantidadOP.") ";
            }

            $cantidadOP = $valueOP->getCantidad() - $totalCant;
             if($cantidadOP!=0) $datoCC .= "1002(".$cantidadOP.") ";
	     if($ordenesOP->getOrdenestipo()->getId()==1) $datoCC = $valueOP->getCentrocostos();

            //Determinar las cantidad
            $cantCC[$valueOP->getId()] = $datoCC;

            //las cantidades sobrantes van para inventario

        }

        $html = $this->renderView('IncentivesOrdenesBundle:Ordenes:pdf.html.twig', array(
            'orden' => $orden, 'id'=>$id, 'productos' => $productos, 'destino'=>$destino, 'contacto'=>$contacto,
            'cc' => $cantCC
        ));


        $rootDir = dirname($this->container->getParameter('kernel.root_dir'));
        $Dir = '/web/Ordenes/';
        $uploadDir = $rootDir.$Dir;

        $dompdf = new DOMPDF();
        $dompdf->load_html($html,'UTF-8');
        $dompdf->render();
        $pdf = $dompdf->output();
        file_put_contents($uploadDir.$orden->getConsecutivo().".pdf", $pdf);
        $orden->setRutapdf($Dir.$orden->getConsecutivo().".pdf");
        $em->flush();

        return $uploadDir.$orden->getConsecutivo().".pdf";

    }

    public function pdfCodesAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
        $productos = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findBy(array('ordenesCompra' => $orden->getId(), 'estado' => 1));
        $destino = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($orden->getProveedor()->getId());
        $contacto = $em->getRepository('IncentivesOperacionesBundle:Contacto')->findOneByProveedor($orden->getProveedor());

        //Cantidades por CC
        $ordenesOP = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
        $OrdenesProducto = $this->getDoctrine()->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findByOrdenesCompra($ordenesOP->getId());
        $cantCC = array();
    
        //$codes = $this->barcodes($id);
        //echo 'prueba'; exit;
        foreach($OrdenesProducto as $keyOP => $valueOP){
            //Determinar los CC

            $qb = $em->createQueryBuilder(); 
            $qb->select('r');
            $qb->from('IncentivesRedencionesBundle:Redenciones','r');
            $qb->leftJoin('r.ordenesProducto', 'op');
            $qb->leftJoin('r.participante', 'p');
            $str_filtro = "op.id=".$valueOP->getId();
            $str_filtro .= " AND op.estado=1";
            $qb->where($str_filtro);
            $qb->groupBy('p.programa');
            $ordenesProd = $qb->getQuery()->getResult();

            $datoCC = "";
            $totalCant = 0;

            foreach ($ordenesProd as $keyOP2 => $valueOP2) {
                # code...
                $cantidadOP = 0;

                $qb = $em->createQueryBuilder(); 
                $qb->select('count(r)');
                $qb->from('IncentivesRedencionesBundle:Redenciones','r');
                $qb->leftJoin('r.ordenesProducto', 'op');
                $qb->leftJoin('r.participante', 'p');
                $str_filtro = "op.id=".$valueOP->getId()." AND p.programa=".$valueOP2->getParticipante()->getPrograma()->getId();
                $qb->where($str_filtro);
                $cantidadOP = $qb->getQuery()->getSingleScalarResult();

                $totalCant += $cantidadOP;

                $datoCC .= $valueOP2->getParticipante()->getPrograma()->getCentrocostos()."(".$cantidadOP.") ";
            }

            $cantidadOP = $valueOP->getCantidad() - $totalCant;
             if($cantidadOP!=0) $datoCC .= "1002(".$cantidadOP.") ";
  	     if($ordenesOP->getOrdenestipo()->getId()==1) $datoCC = $valueOP->getCentrocostos();

            //Determinar las cantidad
            $cantCC[$valueOP->getId()] = $datoCC;

            //las cantidades sobrantes van para inventario

        }

        $html = $this->render('IncentivesOrdenesBundle:Ordenes:pdfcodes.html.twig', array(
            'orden' => $orden, 'id'=>$id, 'productos' => $productos, 'destino'=>$destino, 'contacto'=>$contacto,
            'cc' => $cantCC, 'codes' => $codes
        ));

        $rootDir = dirname($this->container->getParameter('kernel.root_dir'));
        $Dir = '/web/Ordenes/';
        $uploadDir = $rootDir.$Dir;

        $dompdf = new DOMPDF();
        $dompdf->set_option( 'dpi' , '120' );
        $dompdf->load_html($html,'UTF-8');
        $dompdf->render();
        $pdf = $dompdf->output();
        file_put_contents($uploadDir.$orden->getConsecutivo()."_codes.pdf", $pdf);
        $orden->setRutapdfcodes($Dir.$orden->getConsecutivo()."_codes.pdf");
        $em->flush();

        return $uploadDir.$orden->getConsecutivo()."_codes.pdf";

    }

    public function pendientesAction(Request $request)
    {        
        $em = $this->getDoctrine()->getManager();
        $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('2');
        $ordenes = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->findByOrdenesEstado($estado);
        $total = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->findAll();
        
        if(count($ordenes)>0) $productos= $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findByOrdenesCompra($ordenes);
        $orden = new OrdenesCompra();
        
        $productos=array();
        $form = $this->createForm(OrdenesCompraType::class, $orden);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('3');
                $agregar=($request->request->get('agregar'));
                $proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($request->request->get('proveedor'));

                $tipo = $em->getRepository('IncentivesOrdenesBundle:OrdenesTipo')->find("3");
                $orden->setProveedor($proveedor);
                $orden->setOrdenesTipo($tipo);
                $orden->setOrdenesEstado($estado);
                $orden->setConsecutivo(str_pad(count($total)+1, 3, '0', STR_PAD_LEFT)."-".date_create("now")->format('y'));
                //$orden->setFechaVencimiento(date_add(date_create("now"), "30 days"));
                $orden->setObservaciones("Orden generada para las ordenes cerradas con productos pendientes de entrega al ".date_create("now")->format('d-M-Y'));
                
                if (isset($agregar)) {
                  foreach ($agregar as $key => $value) {

                    $productoorden = new OrdenesProducto();
                    $inicial=$em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->find($value);
                    $redenciones= $em->getRepository('IncentivesRedencionesBundle:Redenciones')->findByOrdenesProducto($inicial);
                    $precio = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->findByProducto($inicial->getProducto());
                    $productoorden->setProducto($inicial->getProducto());
                    $productoorden->setCantidad($inicial->getCantidad()-$inicial->getCantidadrecibida());
                    foreach ($precio as $key2 => $value2) {
                        if ($value2->getProveedor()==$orden->getProveedor()){
                            $productoorden->setValorunidad($value2->getPrecio());
                            $productoorden->setValortotal($value2->getPrecio()*$productoorden->getCantidad());
                        }
                    }   
                    foreach ($redenciones as $key => $value) {
                      if ($value->getRedencionestado()->getId()==3){
                        $redencion=new Redenciones();
                        $redencion->setParticipante($value->getParticipante());
                        $redencion->setProductocatalogo($value->getProductocatalogo());
                        $redencion->setRedencionestado($value->getRedencionestado());
                        $redencion->setValor($value->getValor());
                        //$redencion->setEstado($value->getEstado());
                        $redencion->setAtributos($value->getAtributos());
                        $redencion->setCodigoredencion($value->getCodigoredencion());
                        $redencion->setOrdenesProducto($productoorden);
                        $redencion->setFecha(date_create("now"));
                        $estadored = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('7');
                        $value->setRedencionestado($estadored);
                        $em->persist($redencion);
                        $em->flush();
                        //$this->historicoAction($redencion->getId());
                        $redencionH = $this->get('incentives_redenciones');
                        $redencionH->insertar($redencion);
                      }
                    }
                    $inicial->setCantidadrecibida($inicial->getCantidad());
                    $productoorden->setOrdenesCompra($orden);
                    $orden->addOrdenesProducto($productoorden);
                    $em->persist($productoorden);
                    $em->flush();
                  } 
                }    
                $em->persist($orden);

                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'La orden con consecutivo '.$orden->getConsecutivo().' se creo correctamente');
                //$this->correoAction($orden->getId());

                return $this->redirect($this->generateUrl('ordenes'));
              return true;
            }
        }            

        return $this->render('IncentivesOrdenesBundle:OrdenRedencion:pendientes.html.twig', array(
            'form' => $form->createView(), 'productos' => $productos, 'ordenes'=>$ordenes, 
        ));
    }


    public function editarValoresAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $producto = new OrdenesProducto();
        $orden = new OrdenesCompra();
        $form = $this->createForm(OrdenesCompraCantidadType::class, $orden);       


        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $ordenes = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                
                if (0 != count($orden->getOrdenesProducto())) {
                    foreach ($orden->getOrdenesProducto() as $productos) {
                        $precio = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->findByProducto($productos->getProducto());
                        foreach ($precio as $key => $value) {
                            if ($value->getProveedor()->getId()==$ordenes->getProveedor()->getId()){
                                $productos->setValorunidad($value->getPrecio());
                                $productos->setValortotal($value->getPrecio()*$productos->getCantidad());
                            }
                        }      
                        $productos->setOrdenesCompra($ordenes);
                        $orden->addOrdenesProducto($productos);
                        $em->persist($productos);
                    }
                }      
                $em->persist($ordenes);
                $em->flush();
                
                $form=null;
                $form = $this->createForm(OrdenesCompraCantidadType::class, $orden);
            }
            
            $this->pdfAction($id);
			$this->pdfCodesAction($id); 
			$this->totalordenAction($id);
        }  
	    
	    $repository = $this->getDoctrine()
            ->getRepository('IncentivesOrdenesBundle:OrdenesCompra');

        $repository2 = $this->getDoctrine()
            ->getRepository('IncentivesOrdenesBundle:OrdenesProducto');

        $repository3 = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Productoprecio');

        $ordenes= $repository->find($id);
        $productos= $repository2->findBy(array('ordenesCompra' => $ordenes->getId(), 'estado'=> 1));
        $precios= $repository3->findByProveedor($ordenes->getProveedor());

        /*if ($ordenes->getordenesEstado()->getId()==1 or $ordenes->getordenesEstado()->getId()==2){
            $this->estadoAction($id);
        }*/

        return $this->render('IncentivesOrdenesBundle:OrdenRedencion:editarvalores.html.twig', 
            array('form' => $form->createView(), 'ordenes' => $ordenes, 
                'productos' => $productos, 'precios' => $precios
        ));
    }

    public function valoresAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        if (isset($id)){
            $productos = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->find($id);
        }else{
            $productos = new OrdenesProducto();
        }

        $form = $this->createForm(OrdenesProductoCantidadType::class, $productos);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $valores = $request->get('ordenesproducto');

            if ($form->isValid()) {
                $id=($request->request->get('id'));
                $ordenes=($request->request->get('ordenesproducto'));
                $productos = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->find($id);
                $cantidad_inicial = $productos ->getCantidad();
                $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($productos->getOrdenesCompra()->getId());
                $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($productos->getProducto()->getId());
                $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->findByOrdenesProducto($productos);

                //actualiza valores
                //if($cantidad_inicial > $valores['cantidad']) 
                $productos->setCantidad($valores['cantidad']);
                $productos->setValorunidad($valores['valorunidad']);
                $productos->setValortotal($valores['valorunidad']*$valores['cantidad']);
                $productos->setDescuento($valores['descuento']);
                $em->persist($productos);
                $em->flush();

                //libera ordenes

                $diferencia = $cantidad_inicial - $valores['cantidad'];
                if($diferencia > 0) {
                  //liberar las redenciones que no llegaron
                  for($id=1;$id<=$diferencia;$id++){
                    $arrayParametros = array();
                      $qb = $em->createQueryBuilder();            
                      $qb->select('r');
                      $qb->from('IncentivesRedencionesBundle:Redenciones','r');
                      $qb->leftJoin('r.productocatalogo', 'pc');
                      $qb->leftJoin('r.ordenesProducto', 'op');
                      $str_filtro = 'op.ordenesCompra = :orden';
                      $str_filtro .= ' AND pc.producto= :producto';
                      $str_filtro .= ' AND r.redencionestado = 3';
                      $qb->where($str_filtro);
                      $qb->orderBy('r.fecha', 'desc');

                      //Definicion de parametros para filtros
                      $arrayParametros['orden'] = $orden->getId();
                      $arrayParametros['producto'] = $producto->getId();
                      $qb->setParameters($arrayParametros);
                      $qb->setMaxResults(1);
                      $redencion = $qb->getQuery()->getOneOrNullResult();
                      
                      if(isset($redencion)){
                        $estadoredencion = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('2');
                        $redencion->setRedencionestado($estadoredencion);
                        $redencion->setOrdenesProducto(null);
                      }
                      $em->persist($redencion);
                      $em->flush();

                  }

                }
                
                $this->pdfAction($productos->getOrdenesCompra()->getId());
          			$this->pdfCodesAction($productos->getOrdenesCompra()->getId()); 
          			$this->totalordenAction($productos->getOrdenesCompra()->getId());
                                
                return $this->redirect($this->generateUrl('ordenredencion_editarvalores').'/'.$productos->getOrdenesCompra()->getId());
            }
            
        }          

        return $this->render('IncentivesOrdenesBundle:Ordenes:verificar.html.twig', array(
            'form' => $form->createView(), 'productos'=>$productos, 'id'=>$id
        ));
    }
    
    public function trackingAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        if (isset($id)){
            $productos = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->find($id);
            $tracking = new Tracking();
        }else{
           echo "error"; 
        }

        $form = $this->createForm(OrdenesTrackingType::class, $tracking);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $valores = $request->get('ordenestracking');

            if ($form->isValid()) {
                $id=($request->request->get('id'));
                $ordenes=($request->request->get('ordenesproducto'));
                $productos = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->find($id);

                //actualiza valores
                //if($productos->getCantidad() > $valores['cantidad']){
                  $tracking->setCantidad($valores['cantidad']);
                  $tracking->setTracking($valores['tracking']);
                  $tracking->setTarjeta($valores['tarjeta']);
                  $tracking->setOrdenAmazon($valores['ordenAmazon']);
                  $tracking->setPrecio($valores['precio']);
                  $tracking->setOrdenproducto($productos);
                  $em->persist($tracking);
                  $em->flush();
                //}else{
                //  $this->get('session')->getFlashBag()->add('notice', 'Las cantidades no son validas');
                //}
                
                                
                return $this->redirect($this->generateUrl('ordenes_datos').'/'.$productos->getOrdenesCompra()->getId());
            }
        }          

        return $this->render('IncentivesOrdenesBundle:Ordenes:tracking.html.twig', array(
            'form' => $form->createView(), 'productos'=>$productos, 'id'=>$id
        ));


    }

	public function trackingReporteAction()
	 {

		 // Create new PHPExcel object
            $PHPexcel = new PHPExcel();
            // Set document properties
            $PHPexcel->setActiveSheetIndex(0);
            $em = $this->getDoctrine()->getManager();
        
            $PHPexcel ->getActiveSheet()
                        ->setCellValue('A1','COMPRA No.')
                        ->setCellValue('B1','TARJETA No.')
                        ->setCellValue('C1','ID PRODUCTO')
                        ->setCellValue('D1','PRECIO EN PESOS')
                        ->setCellValue('E1','CANTIDAD')
                        ->setCellValue('F1','FECHA COMPRA')
                        ->setCellValue('G1','DESCRIPCIÓN ')
                        ->setCellValue('H1','ORDEN AMAZON')
                        ->setCellValue('I1','TRACKING')
                        ->setCellValue('J1','CENTRO DE COSTO')
                        ->setCellValue('K1','PROGRAMA')
                        ->setCellValue('L1','PERSONA COMPRA')
                        ->setCellValue('M1','OBSERVACIONES COMPRAS')
                        ->setCellValue('N1','FECHA INGRESO A MB129')
                        ->setCellValue('O1','OBSERVACIONES MB129');


	   $query = $em->createQueryBuilder()
                ->select('t tracking','op orden', 'p producto', 'r redencion', 'part participante', 'prog programa') 
                ->from('IncentivesOrdenesBundle:Tracking', 't')
                ->join('t.ordenproducto','op')
		->join('op.producto','p')
		->leftJoin('op.redenciones','r')
		->leftJoin('r.participante','part')
		->leftJoin('part.programa','prog');

          $tracking = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

	$fil=2;

	//print_r($tracking); exit;

	  foreach ($tracking as $key => $value) {

		$PHPexcel->getActiveSheet()
                        ->setCellValue('A'.$fil, $value['tracking']['id'])
                        ->setCellValue('B'.$fil, $value['tracking']['tarjeta'])
                        ->setCellValue('C'.$fil, $value['tracking']['ordenproducto']['producto']['id'])
                        ->setCellValue('D'.$fil, $value['tracking']['precio'])
                        ->setCellValue('E'.$fil, $value['tracking']['cantidad'])
//                        ->setCellValue('G'.$fil, $value['producto']['eanTemp'])
			->setCellValue('G'.$fil, $value['tracking']['ordenproducto']['producto']['nombre']." - ".$value['tracking']['ordenproducto']['producto']['marca']." - ".$value['tracking']['ordenproducto']['producto']['referencia'])
                        ->setCellValue('H'.$fil, $value['tracking']['ordenAmazon'])
                        ->setCellValue('I'.$fil, $value['tracking']['tracking'])
                        ->setCellValue('J'.$fil, $value['tracking']['ordenproducto']['centrocostos'])
			
                        ->setCellValue('L'.$fil, "")
                        ->setCellValue('M'.$fil, "")
                        ->setCellValue('N'.$fil, "")
                        ->setCellValue('O'.$fil, "");

if(isset($value['tracking']['ordenproducto']['redencion'])) {
	$PHPexcel->getActiveSheet()->setCellValue('K'.$fil, $value['tracking']['ordenproducto']['redencion']['participante']['programa']['nombre']);
}else{
	$PHPexcel->getActiveSheet()->setCellValue('K'.$fil, "Requisicion");
}

		$fil++;
	}

	    $objWriter = new PHPExcel_Writer_Excel2007($PHPexcel); 
            $objWriter->save('Tracking.xlsx');  //send it to user, of course you can save it to disk also!
             // prepare BinaryFileResponse
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
            $filename = 'Tracking.xlsx';
            $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
            $filePath = $basePath.'/'.$filename; 
             
            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
            return $response;


	}


    public function pdffinalAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
        $productos = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findBy(array('ordencompra' =>$orden->getId(),'estado' => 1));
        $destino = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($orden->getProveedor()->getId());
        $contacto = $em->getRepository('IncentivesOperacionesBundle:Contacto')->findOneByProveedor($orden->getProveedor());

        //Cantidades por CC
        $ordenesOP = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
        //$OrdenesProducto = $this->getDoctrine()->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findByOrdenesCompra($ordenesOP->getId());
        $qb = $em->createQueryBuilder(); 
        $qb->select('op');
        $qb->from('IncentivesOrdenesBundle:OrdenesProducto','op');
        $str_filtro = "op.ordenesCompra=".$ordenesOP->getId();
        $qb->where($str_filtro);
        $OrdenesProducto = $qb->getQuery()->getResult();

        $cantCC = array();

        foreach($OrdenesProducto as $keyOP => $valueOP){
            //Determinar los CC

            $qb = $em->createQueryBuilder(); 
            $qb->select('r');
            $qb->from('IncentivesRedencionesBundle:Redenciones','r');
            $qb->leftJoin('r.ordenesProducto', 'op');
            $qb->leftJoin('r.participante', 'p');
            $str_filtro = "op.id=".$valueOP->getId();
            $qb->where($str_filtro);
            $qb->groupBy('p.programa');
            $ordenesProd = $qb->getQuery()->getResult();

            $datoCC = "";
            $totalCant = 0;

            foreach ($ordenesProd as $keyOP2 => $valueOP2) {
                # code...
                $cantidadOP = 0;

                $qb = $em->createQueryBuilder(); 
                $qb->select('count(r)');
                $qb->from('IncentivesRedencionesBundle:Redenciones','r');
                $qb->leftJoin('r.ordenesProducto', 'op');
                $qb->leftJoin('r.participante', 'p');
                $str_filtro = "op.id=".$valueOP->getId()." AND p.programa=".$valueOP2->getParticipante()->getPrograma()->getId();
                $qb->where($str_filtro);
                $cantidadOP = $qb->getQuery()->getSingleScalarResult();

                $totalCant += $cantidadOP;

                $datoCC .= $valueOP2->getParticipante()->getPrograma()->getCentrocostos()."(".$cantidadOP.") ";
            }

            $cantidadOP = $valueOP->getCantidad() - $totalCant;
             if($cantidadOP!=0) $datoCC .= "1002(".$cantidadOP.") ";

            //Determinar las cantidad
            $cantCC[$valueOP->getId()] = $datoCC;

            //las cantidades sobrantes van para inventario

        }

        $html = $this->render('IncentivesOrdenesBundle:Ordenes:pdffinal.html.twig', array(
            'orden' => $orden, 'id'=>$id, 'productos' => $productos, 'destino'=>$destino, 'contacto'=>$contacto,
            'cc' => $cantCC
        ));

        $rootDir = dirname($this->container->getParameter('kernel.root_dir'));
        $Dir = '/web/Ordenes/';
        $uploadDir = $rootDir.$Dir;

        $dompdf = new DOMPDF();
        $dompdf->load_html($html,'UTF-8');
        $dompdf->render();
        $pdf = $dompdf->output();
        file_put_contents($uploadDir.$orden->getConsecutivo()."_final.pdf", $pdf);
        //$orden->setRutapdf($Dir.$orden->getConsecutivo()."_final.pdf");
        //$em->flush();

        $filename = $orden->getConsecutivo()."_final.pdf";

        $response = new BinaryFileResponse($uploadDir.$filename);
        $response->trustXSendfileTypeHeader();
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
          
        return $response;

    }

    public function barcodes($id)
    {
        $em = $this->getDoctrine()->getManager();
        $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
        $productos = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findByOrdenesCompra($orden->getId());

        $codes = array();

        foreach($productos as $keyP => $valueP){

          $code = str_pad($valueP->getId(), 12, "0", STR_PAD_LEFT);

          $myBarcode = new barCode();
          $myBarcode->savePath = 'Ordenes/barcodes/';
          $bcPathAbs = $myBarcode->getBarcodeHTML($code, 'ean13', 3, 90);

          $codes[$valueP->getId()] = $bcPathAbs;

        }
        
        return $codes;

    }

    public function totalordenAction($id) {

    $em = $this->getDoctrine()->getManager();

    $query = $em->createQueryBuilder()
                ->select('op orden','p producto')
                ->from('IncentivesOrdenesBundle:OrdenesProducto', 'op')
                ->leftJoin('op.producto','p');
        $str_filtro = "op.ordenesCompra = ".$id;
        $query->where($str_filtro);

        $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);       
      $productos = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

    $totaliva = 0;
    $subtotal = 0;
    foreach($productos as $keyP => $producto){
      
      $valor = $producto['orden']['valortotal'] - $producto['orden']['descuento'];
      
      $subtotal = $subtotal + $valor;
      if($producto['orden']['producto']['estadoIva'] == 1) $totaliva = $totaliva + ($valor*($producto['orden']['producto']['iva']/100));
    }

    $total = $subtotal + $totaliva;

        $orden->setTotal($total);

        $em->persist($orden);
        $em->flush();

  }

   public function aprobarTotalpassAction($id)
    {
      $em = $this->getDoctrine()->getManager();
      $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
      $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('2'); 

      if($orden->getProveedor()->getId() == 327){
        
        $qb = $em->createQueryBuilder();
        $qb->select('r redencion', 'op ordenesProducto', 'p participante', 'pr programa');
        $qb->from('IncentivesRedencionesBundle:Redenciones','r');
        $qb->leftJoin('r.ordenesProducto', 'op');
        $qb->leftJoin('r.participante', 'p');
        $qb->leftJoin('p.programa', 'pr');
        $str_filtro = "op.ordenesCompra=".$id." AND r.redencionestado=3";
        $qb->where($str_filtro);
        $redencionesT = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        foreach($redencionesT as $keyT => $valueT){

          $redencionTPass = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($valueT['redencion']['id']); 
          
          $datosT = array();
          $datosT['identificacion'] = $valueT['redencion']['participante']['documento'];
          //$datosT['identificacion'] = 55164340;
          $datosT['ccosto'] = $valueT['redencion']['participante']['programa']['centrocostos'];
          $datosT['valor'] = $valueT['redencion']['valor'];
          $datosT['cod_inc'] = str_pad($valueT['redencion']['id'],6,"0",STR_PAD_LEFT).str_pad($valueT['redencion']['codigoredencion'],12,"0",STR_PAD_LEFT);
          $datosT['mes'] = $valueT['redencion']['fecha']->format("m");
          
          $params = http_build_query($datosT);//preparar la cadena del arreglo
          
          //$params = $datosT;
          
          $url = "http://totalpass.co/api/recargainc";
          // Initialize the cURL session with the request URL
          $post = curl_init($url); 
          
          // Set the HTTP request authentication headers
          $headers = array();
          $headers = array('Content-type: application/x-www-form-urlencoded',
                          'X_ASCCPE_USERNAME:solinc',
                          'X_ASCCPE_PASSWORD:tknqYQrF');
           
          // Tell cURL to return the request data
          curl_setopt($post, CURLOPT_URL, $url);
          curl_setopt($post, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($post, CURLOPT_POST, 1);//parametrizar el envio por post
          curl_setopt($post, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($post, CURLOPT_POSTFIELDS, $params);//adicionar los parametros de envio

          // Execute cURL on the session handle
          $response = curl_exec($post);

          // Close the cURL session
          curl_close($post);
          
          //print_r($params); echo "<br>";
	   //echo "Envio<br>";print_r($params); echo "<br>";
           //echo "Respuesta<br>";print_r($response); echo "<br><br>";
          
          $respuesta = json_decode($response, true);

          if($respuesta['estado'] == 1){
            $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('4');
            $redencionTPass->setRedencionestado($estado);
            $redencionTPass->setTotalPass($respuesta['cod_inc']);
            $redencionTPass->setMensajeTotalPass($respuesta['mensaje']);
            $em->persist($redencionTPass);
            
          }else{
            
            $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('2');
            $redencionTPass->setRedencionestado($estado);
	    $redencionTPass->setOrdenesProducto(null);
            if(isset($respuesta['mensaje'])) $redencionTPass->setMensajeTotalPass($respuesta['mensaje']);
            $em->persist($redencionTPass);
            
          }
          
          $em->flush(); 
        }
      }
    }
    
    
    public function eliminarProductoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
       
       $producto = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->find($id);

      if($producto){

        $estadoProducto = $em->getRepository('IncentivesCatalogoBundle:Estados')->find('2');
        $estado = $em->getRepository('IncentivesRedencionesBundle:RedencionesEstado')->find('2');

        $redenciones = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->findByOrdenesProducto($producto->getId());
        $i=0;
        foreach ($redenciones as $keyR => $valueR) {
          
            $valueR->setRedencionestado($estado);
            $valueR->setOrdenesProducto(null);
            $em->persist($valueR);
            $i++;

            //Almacenar Historico
            $redencionH = $this->get('incentives_redenciones');
            $redencionH->insertar($valueR);
        }
      
        $producto->setEstado($estadoProducto); 
        $em->persist($producto);
        $em->flush();

        $qb = $em->createQueryBuilder();
        $qb->select('o','oc');
        $qb->from('IncentivesOrdenesBundle:Ordenesproducto','o');
        $qb->leftJoin('o.ordenesCompra','oc');
        $str_filtro = "o.id=".$id;
        $qb->where($str_filtro);
        $producto = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $idOrden = $producto[0]['ordenesCompra']['id'];

        $this->pdfAction($idOrden);
        $this->pdfCodesAction($idOrden); 
        //$this->totalordenAction($idOrden);

        return $this->redirect($this->generateUrl('ordenredencion_editarvalores').'/'.$idOrden);

      }
      
    }
    
    public function eliminarRedencionAction(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();
       
      $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($id);

      $idOrden = $redencion->getOrdenesProducto()->getOrdenesCompra()->getId();
      
      $estado = $em->getRepository('IncentivesRedencionesBundle:RedencionesEstado')->find('2');
      
      $producto = $em->getRepository('IncentivesOrdenesBundle:Ordenesproducto')->find($redencion->getOrdenesProducto()->getId());
      
      $redencion->setRedencionestado($estado);
      $redencion->setOrdenesProducto(null);
      $em->persist($redencion);

      //Almacenar Historico
      $redencionH = $this->get('incentives_redenciones');
      $redencionH->insertar($redencion);

      if($producto){

        //Actualizar cantidades
        
        $qb = $em->createQueryBuilder();
        $qb->select('COUNT(r) total');
        $qb->from('IncentivesRedencionesBundle:Redenciones','r');
        $str_filtro = "r.ordenesProducto=".$producto->getId();
        $qb->where($str_filtro);
        $CantidadProductos = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);;
        $CantidadProducto = $CantidadProductos[0]['total'];
        
        $producto->setCantidad($CantidadProducto);
        $producto->setValortotal($CantidadProducto * $producto->getValorunidad());

        $redenciones = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->findByOrdenesProducto($producto->getId());
        
        if($CantidadProducto==0){
          $estadoProducto = $em->getRepository('IncentivesCatalogoBundle:Estados')->find('2');      
          $producto->setEstado($estadoProducto); 
        }
        
        $em->persist($producto);
        $em->flush();

	$this->totalordenAction($idOrden);
        $this->pdfAction($idOrden);
        $this->pdfCodesAction($idOrden); 
      }
      
      return $this->redirect($this->generateUrl('ordenredencion_editarvalores').'/'.$idOrden);
      
    }

    public function generarSegmentadoAction(Request $request)
    {

      $em = $this->getDoctrine()->getManager();

      $qb = $em->createQueryBuilder()
                ->select('sum(CASE 
             WHEN pp.proveedor=327 THEN 0
             ELSE 1
           END) total','r','p','pr','c','cat','pais')
                ->from('IncentivesRedencionesBundle:Redenciones','r')
                ->leftJoin('r.productocatalogo', 'p')
                ->leftJoin('p.catalogos', 'cat')
                ->leftJoin('cat.pais', 'pais')
                ->leftJoin('p.producto', 'pr')
                ->leftJoin('pr.categoria', 'c')
                ->leftJoin('pr.productoprecio', 'pp','WITH','pp.principal=1')
                ->leftJoin('pp.proveedor', 'prov')
                ->where('r.redencionestado = 2')
                ->groupby('pr.categoria','cat.pais');
      $Redenciones =  $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

      if ($request->isMethod('POST')) {

              $pais = intval($request->get('pais'));
              $categoria = intval($request->get('categoria'));

              if($pais!="" && $categoria!=""){

                $ordenesNuevas = "";

                //Consultar si hay inventario para las redenciones autorizadas
                //Lista de redenciones autorizadas agrupadas por producto y pais
                $qb = $em->createQueryBuilder()
                     ->select('i')
                     ->from('IncentivesInventarioBundle:Inventario','i')
                     ->where('i.redencion IS NULL AND i.solicitud IS NULL AND i.salio IS NULL AND i.ingreso=1 AND i.planilla IS NULL');
                $InventarioD = $qb->getQuery()->getResult();
                
                //Si hay productos en inventario asignarlos y dejarlos listos para despachar
                foreach($InventarioD as $keyD => $valueD){
                  
                  $qb = $em->createQueryBuilder()
                     ->select('r')
                     ->from('IncentivesRedencionesBundle:Redenciones','r')
                     ->Join('r.productocatalogo', 'p')
                     ->Join('p.producto', 'pr')
                     ->where('r.redencionestado = 2 AND pr.id='.$valueD->getProducto()->getId())
                     ->setMaxResults(1);
                     
                     $RedencionD = $qb->getQuery()->getOneOrNullResult();
                     
                     if(isset($RedencionD)){
                       
                        $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('4'); 
                        $inventario = $em->getRepository('IncentivesInventarioBundle:Inventario')->find($valueD->getId());
                        $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($RedencionD->getId());
                        
                        $redencion->setRedencionestado($estado);
                        $redencion->setValororden($inventario->getValorcompra());
                        $inventario->setRedencion($redencion);
                        
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
                            $despacho->setRedencion($redencion);
                            $despacho->setProducto($valueD->getProducto());
                            $despacho->setCantidad(1);
                            $em->persist($despacho);
                        
                        $inventario->setDespacho($despacho);
                        $em->persist($inventario);
                        $em->persist($redencion);
                        
                        $redencionH = $this->get('incentives_redenciones');
                        $redencionH->insertar($redencion);
                        
                        $inventarioH = $this->get('incentives_inventario');
                        $inventarioH->insertar($inventario);
                        
                        $em->flush();
                        
                     }
                }//cierra foreach inventario

                //Lista de redenciones autorizadas agrupadas por producto y pais
                $qb = $em->createQueryBuilder()
                     ->select('r')
                     ->from('IncentivesRedencionesBundle:Redenciones','r')
                     ->Join('r.productocatalogo', 'p')
                     ->Join('p.producto', 'pr')
                     ->Join('p.catalogos', 'c')
                     ->Join('pr.productoprecio', 'pp')
                     ->Join('pp.proveedor', 'prov')
                     ->where('r.redencionestado = :id AND prov.id != 327 AND c.pais='.$pais.' AND pr.categoria='.$categoria)
                     ->groupby('p.producto')          
                     ->setParameters(array(
                          'id'=> '2',                
                      ));
                $ProductosR = $qb->getQuery()->getResult();

                $ProvProd = array();

                //Buscar proveedores y armar un arreglo para luego asignar las ordenes
                foreach($ProductosR as $keyP => $valueP){
                  $id_producto = $valueP->getProductocatalogo()->getProducto()->getId();

                  //Buscar los proveedores para cada producto
                   $qb = $em->createQueryBuilder()
                       ->select('precio')
                       ->from('IncentivesCatalogoBundle:Productoprecio','precio')
                       ->Join('precio.proveedor', 'pro')
                       ->Join('precio.producto', 'pr')
                       ->where('precio.principal = :principal AND pr.id='.$id_producto)
                       ->setParameters(array(
                            'principal'=> '1',
                        ))
                 ->setMaxResults(1);
                  $proveedor = $qb->getQuery()->getOneOrNullResult();

                  //armar el arreglo de proveedores - pais - productos
                  if(isset($proveedor)){
                    $ProvProd[$proveedor->getProveedor()->getId()][$proveedor->getProducto()->getId()] = $proveedor->getId();
                  }

                }//Cierra foreach de prveedores

                foreach($ProvProd as $keyProv => $valueProv){
                  
                    $id_prov = $keyProv;

                    $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('1');        
                    $tipo = $em->getRepository('IncentivesOrdenesBundle:OrdenesTipo')->find('2');  
                    $ordenes = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->findByOrdenesTipo($tipo);

                    //revisar si exise una orden abierta para el proveedor
                    $qb1 = $em->createQueryBuilder();            
                    $qb1->select('o');
                    $qb1->from('IncentivesOrdenesBundle:OrdenesCompra','o');
                    $str_filtro = 'o.proveedor = '.$id_prov;
                    $str_filtro .= ' AND o.pais = '.$pais;
                    $str_filtro .= ' AND o.categoria = '.$categoria;
                    $str_filtro .= " AND o.ordenesEstado = 1 AND o.ordenesTipo = 2";
                    //echo $str_filtro; exit;
                    $qb1->where($str_filtro);
                    $qb1->setMaxResults(1);
                    $orden = $qb1->getQuery()->getOneOrNullResult();

                    $i = 0;
                    //Si no existe, crear una nueva
                  if(!isset($orden)){

                      $prov = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($id_prov);
                      $paisO = $em->getRepository('IncentivesOperacionesBundle:Pais')->find($pais);
                      $categoriaO = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($categoria);

                      $orden = new OrdenesCompra();
                      $orden->setProveedor($prov);
                      $orden->setPais($paisO);
                      $orden->setCategoria($categoriaO);
                      $orden->setOrdenesEstado($estado);
                      $orden->setOrdenesTipo($tipo);
                      $orden->setAplicaIva(1);
                      $orden->setCreador($this->getUser());
                      $orden->setFechaVencimiento(date_add(date_create("now"), date_interval_create_from_date_string($prov->getTiempoEntrega()." days")));
                      $orden->setConsecutivo(str_pad(count($ordenes)+1, 3, '0', STR_PAD_LEFT)."-".date_create("now")->format('y')."R");
                      $orden->setObservaciones("Orden generada para las redenciones aprobadas al ".date_create("now")->format('Y-m-d H:i:s'));

                    // si la orden es nueva agregar los productos
                  
                    //Recorrer los productos del porveedor y asignarlos a la orden
                    foreach($valueProv as $keyProd => $valueProd){
                        
                        $productos = new OrdenesProducto();  
                        
                        $qb = $em->createQueryBuilder()
                           ->select('count(r.id)')
                           ->from('IncentivesRedencionesBundle:Redenciones','r')
                           ->Join('r.productocatalogo', 'p')
                           ->Join('p.producto', 'pr')
                           ->where('r.redencionestado = :id AND pr.id='.$keyProd)          
                           ->setParameters(array(
                                'id'=> '2',                
                            ));

                        $cantidad = $qb->getQuery()->getSingleScalarResult();              

                        $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($keyProd);
                        $productoPrec = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($valueProd); 
                        $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('3');
                        $estadoProducto = $em->getRepository('IncentivesCatalogoBundle:Estados')->find('1');
                        $i++;

                        $productos->setEstado($estadoProducto);
                        $productos->setCantidad($cantidad);
                        $productos->setProducto($producto); 
                        $productos->setValorunidad($productoPrec->getPrecio());
                        $productos->setValortotal($productoPrec->getPrecio()*$cantidad);

                        $productos->setOrdenesCompra($orden);
                        $orden->addOrdenesProducto($productos);                    
                        $em->persist($productos);

                        //Actualizar estado de redenciones
                        $qb = $em->createQueryBuilder()
                             ->select('r')
                             ->from('IncentivesRedencionesBundle:Redenciones','r')
                             ->Join('r.productocatalogo', 'p')
                             ->Join('p.producto', 'pr')
                             ->where('r.redencionestado = 2 AND pr.id='.$keyProd);

                        $redenciones = $qb->getQuery()->getResult();
                        foreach ($redenciones as $keyRed => $valueRed) {
                          //if ($valueRed->getRedencionestado()==$estadoredencion){
                            $valueRed->setOrdenesProducto($productos);
                            $valueRed->setRedencionestado($estado);
                            $em->persist($valueRed);
                            $em->flush();
                            
                            //Almacenar Historico
                            $redencionH = $this->get('incentives_redenciones');
                            $redencionH->insertar($valueRed);
                          //}
                        }
                    }
                  }else{
                    //Si existe revisar cantidades y actualizar
                    
                    //Recorrer los productos del porveedor y asignarlos a la orden
                    foreach($valueProv as $keyProd => $valueProd){
                        
                        $qb = $em->createQueryBuilder()
                           ->select('count(r.id)')
                           ->from('IncentivesRedencionesBundle:Redenciones','r')
                           ->Join('r.productocatalogo', 'p')
                           ->Join('p.producto', 'pr')
                           ->where('r.redencionestado = :id AND pr.id='.$keyProd)          
                           ->setParameters(array(
                                'id'=> '2',                
                            ));

                        $cantidad = $qb->getQuery()->getSingleScalarResult();

                        //$productos = new OrdenesProducto();
                          $qb = $em->createQueryBuilder()
                             ->select('o')
                             ->from('IncentivesOrdenesBundle:Ordenesproducto','o')
                             ->where('o.ordenesCompra = '.$orden->getId().' AND o.producto='.$keyProd.' AND o.estado=1');
                          //Productos faltantes
                          $productos  = $qb->getQuery()->getOneOrNullResult();

                        if(!isset($productos)){

                          $productos = new OrdenesProducto();  

                          $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($keyProd);
                          $productoPrec = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($valueProd); 
                          $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('3');  
                          $estadoProducto = $em->getRepository('IncentivesCatalogoBundle:Estados')->find('1');
                          $i++;
                          $productos->setCantidad($cantidad);
                          $productos->setProducto($producto); 
                          $productos->setValorunidad($productoPrec->getPrecio());
                          $productos->setValortotal($productoPrec->getPrecio()*$cantidad);
                          $productos->setEstado($estadoProducto);
                          $productos->setOrdenesCompra($orden);
                          $orden->addOrdenesProducto($productos);                    
                          $em->persist($productos);

                        }else{              

                          $cantidadT = $cantidad + $productos->getCantidad();

                          $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($keyProd);
                          $productoPrec = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($valueProd); 
                          $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('3');  
                          $i++;
                          $productos->setCantidad($cantidadT);
                          $productos->setValorunidad($productoPrec->getPrecio());
                          $productos->setValortotal($productoPrec->getPrecio()*$cantidadT);                   
                          $em->persist($productos);
                        }

                        //Actualizar estado de redenciones
                        $qb = $em->createQueryBuilder()
                             ->select('r')
                             ->from('IncentivesRedencionesBundle:Redenciones','r')
                             ->Join('r.productocatalogo', 'p')
                             ->Join('p.producto', 'pr')
                             ->where('r.redencionestado = 2 AND pr.id='.$keyProd);

                        $redenciones = $qb->getQuery()->getResult();
                        foreach ($redenciones as $keyRed => $valueRed) {
                          //if ($valueRed->getRedencionestado()==$estadoredencion){
                            $valueRed->setOrdenesProducto($productos);
                            $valueRed->setRedencionestado($estado);
                            $em->persist($valueRed);
                            $em->flush();

                            //Almacenar Historico
                            $redencionH = $this->get('incentives_redenciones');
                            $redencionH->insertar($valueRed);
                            //$this->historicoAction($valueRed->getId());
                          //}
                        }
                    }

                  }

                  if ($i!=0){
                      $em->persist($orden);
                      $em->flush();
                      $this->pdfAction($orden->getId()); 
                      $this->pdfCodesAction($orden->getId()); 
                      $this->totalordenAction($orden->getId());
                      $ordenesNuevas .= $orden->getConsecutivo().",";
                  }

                }//Cierra foreach proveedores

                $this->get('session')->getFlashBag()->add('notice', 'Se generaron las siguientes ordenes nuevas: '.$ordenesNuevas);
              
              }else{
                $this->get('session')->getFlashBag()->add('warning', 'Asegurese de seleccionar los filtros para generar ordenes');
              }//Cierra if pais cateogoria

            return $this->redirect($this->generateUrl('ordenes'));
    }

    return $this->render('IncentivesOrdenesBundle:OrdenRedencion:generarsegmentado.html.twig', 
          array('redenciones' => $Redenciones
      ));

  }

  public function detalleSegmentadoAction($categoria = 1, $pais = 1)
    {

      $em = $this->getDoctrine()->getManager();

      $qb = $em->createQueryBuilder()
                ->select('r','p','pr','c','cat','pais','pt','pg','pp','prov')
                ->from('IncentivesRedencionesBundle:Redenciones','r')
                ->leftJoin('r.productocatalogo', 'p')
                ->leftJoin('p.catalogos', 'cat')
                ->leftJoin('cat.pais', 'pais')
                ->leftJoin('p.producto', 'pr')
                ->leftJoin('pr.categoria', 'c')
                ->leftJoin('pr.productoprecio', 'pp')
                ->leftJoin('pp.proveedor', 'prov')
                ->leftJoin('r.participante', 'pt')
                ->leftJoin('pt.programa', 'pg')
                ->orderBy('pp.id,pt.id');
      $str = "r.redencionestado = 2";
      $str .= " AND pr.categoria=".$categoria;
      $str .= " AND cat.pais=".$pais;
      
      $qb->where($str);
      $Redenciones =  $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

      //echo "<pre>"; print_r($Redenciones); echo "</pre>";

      return $this->render('IncentivesOrdenesBundle:OrdenRedencion:detallesegmentado.html.twig', 
          array('redenciones' => $Redenciones
      ));

  }

  public function totalPassAction(Request $request)
    {

      $em = $this->getDoctrine()->getManager();

      $qb = $em->createQueryBuilder()
                ->select('count(r) total','r','p','pr','c','cat','pais','prog')
                ->from('IncentivesRedencionesBundle:Redenciones','r')
                ->leftJoin('r.productocatalogo', 'p')
                ->leftJoin('p.catalogos', 'cat')
                ->leftJoin('cat.programa', 'prog')
                ->leftJoin('cat.pais', 'pais')
                ->leftJoin('p.producto', 'pr')
                ->leftJoin('pr.categoria', 'c')
                ->leftJoin('pr.productoprecio', 'pp')
                ->leftJoin('pp.proveedor', 'prov')
                ->where('r.redencionestado = 2 AND prov.id=327')
                ->groupby('cat.programa');
      $Redenciones =  $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

    //echo "<pre>"; print_r($Redenciones); echo "</pre>"; exit;

    return $this->render('IncentivesOrdenesBundle:OrdenRedencion:generartotalpass.html.twig', 
          array('redenciones' => $Redenciones
      ));

  }

}

