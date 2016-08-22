<?php

namespace Incentives\OrdenesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\OrdenesBundle\Entity\OrdenesCompra;
use Incentives\OrdenesBundle\Entity\OrdenesEstado;
use Incentives\OrdenesBundle\Form\Type\OrdenesCompraType;
use Incentives\OrdenesBundle\Form\Type\OrdenesCompraCantidadType;
use Incentives\OrdenesBundle\Form\Type\OrdenesProductoCantidadType;
use Incentives\OrdenesBundle\Entity\OrdenesProducto;
use Incentives\OrdenesBundle\Form\Type\OrdenesProductoType;
use Incentives\OrdenesBundle\Form\Type\OrdenesProductoAgregarType;
use Incentives\CatalogoBundle\Entity\Producto;
use Incentives\CatalogoBundle\Entity\Productoprecio;
use Incentives\InventarioBundle\Entity\Inventario;
use Incentives\RedencionesBundle\Entity\RedencionesHistorico;
use Incentives\InventarioBundle\Entity\Despachos;
use Incentives\RedencionesBundle\Entity\Redencionesenvios;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\ExpressionLanguage\Expression;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Cell_DataValidation;
use PHPExcel_Style_Fill;


class OrdenesController extends Controller
{
    /**
     * @Route("/nuevo")
     * @Template()
     */
    public function nuevaAction(Request $request)
    {        
        $em = $this->getDoctrine()->getManager();
        $ordenes = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->findAll();
        $orden = new OrdenesCompra();
        $productos = new OrdenesProducto();
        $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('1');

        $form = $this->createForm(new OrdenesCompraType(), $orden);
                    
        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                
                if (0 != count($orden->getOrdenesProducto())) {
                    foreach ($orden->getOrdenesProducto() as $productos) {
                        $precio = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->findByProducto($productos->getProducto());
                        foreach ($precio as $key => $value) {
                            if ($value->getProveedor()==$orden->getProveedor()){
                                $productos->setValorunidad($value->getPrecio());
                                $productos->setValortotal($value->getPrecio()*$productos->getCantidad());
                            }
                        }      
                        $productos->setOrdenesCompra($orden);
                        $orden->addOrdenesProducto($productos);
                        $em->persist($productos);
                    }
                }    
                $tipo = $em->getRepository('IncentivesOrdenesBundle:OrdenesTipo')->find("1");
                $orden->setOrdenesTipo($tipo);
                $orden->setOrdenesEstado($estado);
                $orden->setConsecutivo(str_pad(count($ordenes)+1, 3, '0', STR_PAD_LEFT)."-".date_create("now")->format('y'));
                //$orden->setFechaVencimiento(date_add(date_create("now"), date_interval_create_from_date_string($orden->getProveedor()->getTiempoEntrega()." days")));
                $em->persist($orden);

                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'La orden con consecutivo '.$orden->getConsecutivo().' se creo correctamente');
		        $this->pdfAction($orden->getId());
                $this->totalordenAction($orden->getId());

                return $this->redirect($this->generateUrl('ordenes_datos')."/".$orden->getId());
            }
        }            

        return $this->render('IncentivesOrdenesBundle:Ordenes:nueva.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function nuevaOrdenSolicitudAction(Request $request, $solicitudId)
    {        
        $em = $this->getDoctrine()->getManager();
        $orden = new OrdenesCompra();
        $productos = new OrdenesProducto();
        $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('1');

        $form = $this->createForm(new OrdenesCompraType(), $orden);
                    
        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                
                $qb = $em->createQueryBuilder(); 
                $qb->select('count(oc) cantidad');
                $qb->from('IncentivesOrdenesBundle:OrdenesCompra','oc');
                $ordenes = $qb->getQuery()->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
                
                if (0 != count($orden->getOrdenesProducto())) {
                    foreach ($orden->getOrdenesProducto() as $productos) {
                        $precio = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->findByProducto($productos->getProducto());
                        foreach ($precio as $key => $value) {
                            if ($value->getProveedor()==$orden->getProveedor()){
                                $productos->setValorunidad($value->getPrecio());
                                $productos->setValortotal($value->getPrecio()*$productos->getCantidad());
                            }
                        }      
                        $productos->setOrdenesCompra($orden);
                        $orden->addOrdenesProducto($productos);
                        $em->persist($productos);
                    }
                }    
                $tipo = $em->getRepository('IncentivesOrdenesBundle:OrdenesTipo')->find("1");
                $orden->setOrdenesTipo($tipo);
                $orden->setOrdenesEstado($estado);
                $orden->setConsecutivo(str_pad($ordenes['cantidad']+1, 3, '0', STR_PAD_LEFT)."-".date_create("now")->format('y'));
                $solicitud = $em->getRepository('IncentivesSolicitudesBundle:Solicitud')->find($solicitudId);
                $orden->setSolicitud($solicitud);

                //$orden->setFechaVencimiento(date_add(date_create("now"), date_interval_create_from_date_string($orden->getProveedor()->getTiempoEntrega()." days")));
                $em->persist($orden);

                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'La orden con consecutivo '.$orden->getConsecutivo().' se creo correctamente');
		        $this->pdfAction($orden->getId());
                $this->totalordenAction($orden->getId());

                return $this->redirect($this->generateUrl('solicitudes_datos')."/".$solicitudId);
            }
        }            

        return $this->render('IncentivesOrdenesBundle:Ordenes:nuevaordensolicitud.html.twig', array(
            'form' => $form->createView(), 'solicitudId' => $solicitudId
        ));
    }

    public function datosAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $producto = new OrdenesProducto();
        $orden = new OrdenesCompra();
        $form = $this->createForm(new OrdenesCompraCantidadType(), $orden);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $ordenes = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                
                if (0 != count($orden->getOrdenesProducto())) {
                    foreach ($orden->getOrdenesProducto() as $productos) {
                        
                        $qb = $em->createQueryBuilder(); 
                        $qb->select('p');
                        $qb->from('IncentivesRedencionesBundle:Productoprecio','p');
                        $str_filtro = "p.producto=".$productos->getProducto();
                        $str_filtro = " AND p.principal=1";
                        $qb->where($str_filtro);
                        $qb->groupBy('p.producto');
                        $precio = $qb->getQuery()->getResult();
                        
                        //$precio = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->findByProducto($productos->getProducto());
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
                $form = $this->createForm(new OrdenesCompraCantidadType(), $orden);
            }
        }  

        $repository = $this->getDoctrine()
            ->getRepository('IncentivesOrdenesBundle:OrdenesCompra');

        $repository2 = $this->getDoctrine()
            ->getRepository('IncentivesOrdenesBundle:OrdenesProducto');

        //Cantidades por CC
        $ordenesOP = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
        $OrdenesProducto = $this->getDoctrine()->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findBy(array('ordenesCompra' => $ordenesOP->getId(), 'estado' => 1));
        $cantCC = array();
	    $tracking = array();

        foreach($OrdenesProducto as $keyOP => $valueOP){
            //Determinar los CC

            $qb = $em->createQueryBuilder(); 
            $qb->select('r','oc','p','pr');
            $qb->from('IncentivesRedencionesBundle:Redenciones','r');
            $qb->leftJoin('r.productocatalogo', 'oc');
            $qb->leftJoin('r.ordenesProducto', 'op');
            $qb->leftJoin('r.participante', 'p');
            $qb->leftJoin('p.programa', 'pr');
            $str_filtro = "op.id=".$valueOP->getId();
            $qb->where($str_filtro);
            $qb->groupBy('r.productocatalogo');
            $ordenesProd = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY); 
            $totalCant = 0;

            $datoCC = array();

            foreach ($ordenesProd as $keyOP2 => $valueOP2) {
                # code...
                $cantidadOP = 0;

                $qb = $em->createQueryBuilder(); 
                $qb->select('count(r)');
                $qb->from('IncentivesRedencionesBundle:Redenciones','r');
                $qb->leftJoin('r.ordenesProducto', 'op');
                $qb->leftJoin('r.participante', 'p');
                $str_filtro = "op.id=".$valueOP->getId()." AND p.programa=".$valueOP2['participante']['programa']['id'];
                $qb->where($str_filtro);
                $cantidadOP = $qb->getQuery()->getSingleScalarResult();

                $totalCant += $cantidadOP;
                
                //rentabilidad
                $valorCompra = $valueOP->getValorunidad();
                $valorVenta = $valueOP2['productocatalogo']['precio'];
                $rentabilidad = "-";

                if($valorVenta > 0) $rentabilidad = (1 -($valorCompra/$valorVenta )) * 100;
                
                $datoCC[] = array("cc" => $valueOP2['participante']['programa']['centrocostos'], "cantidadcc" => $cantidadOP, "rentabilidad" => $rentabilidad, "valor" => $valorVenta);
                
            }

            //las cantidades sobrantes van para inventario
            //$cantidadOP = $valueOP->getCantidad() - $totalCant;
            //if($cantidadOP!=0) $datoCC .= "1002(".$cantidadOP.") ";
	     //if($ordenesOP->getOrdenestipo()->getId()==1) $datoCC = $valueOP->getCentrocostos();

            //Determinar las cantidad
            $cantCC[$valueOP->getId()] = $datoCC;

	    //consultar tracking cuando el proveedor es internacional
	    $qb = $em->createQueryBuilder(); 
            $qb->select('t');
            $qb->from('IncentivesOrdenesBundle:Tracking','t');
            $str_filtro = "t.ordenproducto=".$valueOP->getId();
            $qb->where($str_filtro);
            $trackingProd = $qb->getQuery()->getResult();

	    if(isset($trackingProd)){
		$tracking[$valueOP->getId()] = $trackingProd;
	    }

        }

        $ordenes= $repository->find($id);
        $productos= $repository2->findBy(array('ordenesCompra' => $ordenes->getId(), 'estado' => 1));

        $repository3 = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Productoprecio');
            
        $qb = $em->createQueryBuilder(); 
        $qb->select('p');
        $qb->from('IncentivesCatalogoBundle:Productoprecio','p');
        $str_filtro = "p.proveedor =".$ordenes->getProveedor()->getId();
        $qb->where($str_filtro);
        $qb->groupBy('p.producto');
        $precios = $qb->getQuery()->getResult();

        /*if ($ordenes->getordenesEstado()->getNombre()=="Abierta" or $ordenes->getordenesEstado()->getNombre()=="En compra"){
            $this->estadoAction($id);
        }*/

        return $this->render('IncentivesOrdenesBundle:Ordenes:datos.html.twig', 
            array('form' => $form->createView(), 'ordenes' => $ordenes, 
                'productos' => $productos, 'precios' => $precios,
                'cc' => $cantCC, 'tracking' => $tracking, 
        ));
    }

    /**
     * @Route("/listado")
     * @Template()
     */
    public function listadoAction()
    {
        /*if ($this->get('security.context')->isGranted('ROLE_PROV')) {
            $proveedor =  $this->getUser()->getProveedor();
            $id = $proveedor->getId();
            $listado = $repository->findByProveedor($id);
        }else{*/
        //}
        
        $em = $this->getDoctrine()->getManager();
        
        $arrayParametros = array();
        $qb = $em->createQueryBuilder();            
        $qb->select(array('oc','pr proveedor','pais','ct categoria','ot ordenestipo','oe ordenesEstado'));
        $qb->from('IncentivesOrdenesBundle:OrdenesCompra','oc');
        $qb->join('oc.proveedor','pr');
        $qb->join('oc.pais','pais');
        $qb->join('oc.categoria','ct');
        $qb->join('oc.ordenesTipo','ot');
        $qb->join('oc.ordenesEstado','oe');
        //$str_filtro = 'i.orden = '.$orden->getId();
        //$qb->where($str_filtro);
        $listado = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        //print_r($listado); exit;
        return $this->render('IncentivesOrdenesBundle:Ordenes:listado.html.twig', [
            'listado' => $listado,
        ]);
    }

    /**
     * @Route("/editar")
     * @Template()
     */
    public function editarAction(Request $request, $id)
    {
	$em = $this->getDoctrine()->getManager();

        if (isset($id)){
            $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
            $form = $this->createForm(new OrdenescompraType(), $orden);
        }else{
            $form = $this->createForm(new OrdenescompraType());
            $orden = new OrdenesCompra();
        }

        if ($request->isMethod('POST')) {
            $form->bind($request);

            //if ($form->isValid()) {
                
                $pro=($this->get('request')->request->get('ordenescompra'));
                $id=($this->get('request')->request->get('id'));
                $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
                $proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($pro['proveedor']);
                $orden->setProveedor($proveedor);
                $fecha = date_create();
                //date_date_set($fecha,$pro["fechaVencimiento"]["year"], $pro["fechaVencimiento"]["month"], $pro["fechaVencimiento"]["day"]);
                $orden->setFechaVencimiento($fecha);
                $orden->setObservaciones($pro["observaciones"]);
                $orden->setDescuento($pro["descuento"]);
                $orden->setDomicilio($pro["domicilio"]);
                $orden->setServicioLogistico($pro["servicioLogistico"]);
                $orden->setComisionBancaria($pro["comisionBancaria"]);
                $orden->setTrm($pro["trm"]);
                
                if(isset($pro["aplicaIva"]) && $pro["aplicaIva"]==1) $aplicaIva = 1; else $aplicaIva = 0;
                $orden->setAplicaIva($aplicaIva);
                if(isset($pro["facturarCostos"]) && $pro["facturarCostos"]==1) $factcostos = 1; else $factcostos = 0;
                $orden->setFacturarCostos($factcostos);

                $tipomoneda = $em->getRepository('IncentivesOrdenesBundle:MonedaTipo')->find($pro['monedaTipo']);
                $orden->setMonedaTipo($tipomoneda);
                
                $pais = $em->getRepository('IncentivesOperacionesBundle:Pais')->find($pro['pais']);
                $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($pro['categoria']);
                
                $orden->setPais($pais);
                $orden->setCategoria($categoria);

                $em->persist($orden);   
                $em->flush();

                $this->pdfAction($orden->getId());
                $this->totalordenAction($orden->getId());

                return $this->redirect($this->generateUrl('ordenes_datos').'/'.$id);
            //}
        }

        return $this->render('IncentivesOrdenesBundle:Ordenes:editar.html.twig', array(
            'form' => $form->createView(), 'orden' => $orden, 'id'=>$id,
        ));
    }

    public function verificarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        if (isset($id)){
            $productos = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->find($id);
        }else{
            $productos = new OrdenesProducto();
        }

        $form = $this->createForm(new OrdenesProductoCantidadType(), $productos);
                    
        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $id=($this->get('request')->request->get('id'));
                $ordenes=($this->get('request')->request->get('ordenesproducto'));
                
                $productos = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->find($id);
                $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($productos->getOrdenesCompra()->getId());
                $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($productos->getProducto()->getId());
                $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->findByOrdenesProducto($productos);
                $productos->setCantidadrecibida($ordenes["cantidadRecibida"]);

                for ($i=0; $i < ($ordenes["cantidadRecibida"]-$productos->getCantidadrecibida()); $i++) {                           
                    $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('3');               
                    $entrada = new Inventario();
                    $entrada->setProducto($producto);
                    $entrada->setIngreso("1");
                    $entrada->setFechaEntrada(date_create("now"));
                    $entrada->setOrden($orden);
                    $entrada->setObservacion("Ingreso asociado a la orden ".$orden->getId());
                    
                    $inventarioH = $this->get('incentives_inventario');
                    $inventarioH->insertar($entrada);
                    
                    $em->persist($entrada);
                    $em->flush();
                    foreach ($redencion as $key => $value) {
                        if($value->getRedencionEstado()==$estado){
                            $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('4');
                            $salida = new Inventario();
                            $salida->setProducto($producto);
                            $salida->setSalio("1");
                            $salida->setFechaSalida(date_create("now"));
                            $salida->setRedencion($value);
                            $salida->setObservacion("Salida asociada a la redencion ".$value->getId());
                            $em->persist($salida);                  
                            $value->setRedencionestado($estado);
                            $em->persist($value );
                            
                            $inventarioH = $this->get('incentives_inventario');
                            $inventarioH->insertar($salida);
                            
                            $em->flush();
                        }
                    }
                }

                $em->persist($productos);
                $em->flush();

                return $this->redirect($this->generateUrl('ordenes_datos').'/'.$productos->getOrdenesCompra()->getId());
            }
        }            

        return $this->render('IncentivesOrdenesBundle:Ordenes:verificar.html.twig', array(
            'form' => $form->createView(), 'productos'=>$productos, 'id'=>$id
        ));
    }

    public function estadoAction($id, $cierre=null)
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()
            ->getRepository('IncentivesOrdenesBundle:OrdenesCompra');

        $repository2 = $this->getDoctrine()
            ->getRepository('IncentivesOrdenesBundle:OrdenesProducto');

        $repository3 = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Productoprecio');

        $ordenes= $repository->find($id);
        $productos= $repository2->findByOrdenesCompra($ordenes->getId());
        $precios= $repository3->findByProveedor($ordenes->getProveedor());

        if ($cierre==null){
            foreach ($productos as $key => $value) {
                if ($value->getCantidad()==$value->getCantidadrecibida()){
                    $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('2');
                    $ordenes->setFechaRecepcion(new \DateTime("now"));
                }else{
                    if ($ordenes->getordenesEstado()->getId()==3 || $ordenes->getordenesEstado()->getId()==2){
                        $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('3');
                    }else{
                        $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('1');
                    }
                }
                $ordenes->setOrdenesEstado($estado);
            }
        }



        if ($cierre=='compra'){
            $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('3');
            $ordenes->setOrdenesEstado($estado);
        }

        if ($cierre=='cancelar'){
            $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('4');
            $ordenes->setOrdenesEstado($estado);
        }

        if ($cierre=='cerrar'){
            $estado = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find('2');
            $ordenes->setOrdenesEstado($estado);
        }


        
        $em->persist($ordenes);
        $em->flush();

        $cierre=null;

        return $this->redirect($this->generateUrl('ordenes_datos').'/'.$id);		//ordenes
    }

    public function correoAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
        $productos = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findBy(array('ordenesCompra' => $orden->getId(), 'estado' => 1));
        $destino = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($orden->getProveedor()->getId());
        $this->pdfAction($id);      
        $correos=  explode(',',$destino->getCorreo());
          
        // Create the Transport
        $transport = \Swift_SmtpTransport::newInstance('smtp.office365.com', 25, 'tls')
          ->setAuthMode('login')
          ->setUsername('operaciones@inc-group.co')
          ->setPassword('IncGroup2016!')
          ;

          $template = 'IncentivesOrdenesBundle:Ordenes:email.txt.twig';
          $subjet = 'Nueva orden de compra';
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

    public function pdfAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
        $productos = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findByOrdenesCompra($orden->getId());
        $destino = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($orden->getProveedor()->getId());
        $contacto = $em->getRepository('IncentivesOperacionesBundle:Contacto')->findOneByProveedor($orden->getProveedor());

        //Cantidades por CC
        $ordenesOP = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
        $OrdenesProducto = $this->getDoctrine()->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->findBy(array('ordenesCompra' => $ordenesOP->getId(), 'estado' => 1));
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

            //las cantidades sobrantes van para inventario
            $cantidadOP = $valueOP->getCantidad() - $totalCant;
             if($cantidadOP!=0) $datoCC .= "1002(".$cantidadOP.") ";
	     if($ordenesOP->getOrdenestipo()->getId()==1) $datoCC = $valueOP->getCentrocostos();

            //Determinar las cantidad
            $cantCC[$valueOP->getId()] = $datoCC;

        }

        $html = $this->renderView('IncentivesOrdenesBundle:Ordenes:pdf.html.twig', array(
            'orden' => $orden, 'id'=>$id, 'productos' => $OrdenesProducto, 'destino'=>$destino, 'contacto'=>$contacto,
            'cc' => $cantCC
        ));

        require_once($this->get('kernel')->getRootDir().'/config/dompdf_config.inc.php');
        $rootDir = dirname($this->container->getParameter('kernel.root_dir'));
        $Dir = '/web/Ordenes/';
        $uploadDir = $rootDir.$Dir;

        $dompdf = new \DOMPDF();
        $dompdf->load_html($html,'UTF-8');
        $dompdf->render();
        $pdf = $dompdf->output();
        file_put_contents($uploadDir.$orden->getConsecutivo().".pdf", $pdf);
        $orden->setRutapdf($Dir.$orden->getConsecutivo().".pdf");
        $em->flush();

        return $uploadDir.$orden->getConsecutivo().".pdf";

    }


    public function ingresolistadoAction()
    {

        $em = $this->getDoctrine()->getManager();
           
        $qb1 = $em->createQueryBuilder();            
        $qb1->select('o');
        $qb1->from('IncentivesOrdenesBundle:OrdenesCompra','o');
        $str_filtro = 'o.ordenesEstado in (2,4) ';
        $qb1->where($str_filtro);                
        $listado = $qb1->getQuery()->getResult();
        
        return $this->render('IncentivesOrdenesBundle:Ordenes:ingresolistado.html.twig', 
            array('listado' => $listado));
    }

    public function ingresoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $producto = new OrdenesProducto();
        $orden = new OrdenesCompra();

        $ordenes = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);

        /*if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                
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
                $form = $this->createForm(new OrdenesCompraCantidadType(), $orden);
            }
        } */ 

        $repository2 = $this->getDoctrine()
            ->getRepository('IncentivesOrdenesBundle:OrdenesProducto');
        $productos= $repository2->findBy(array('ordenesCompra' => $ordenes->getId(), 'estado' => 1));

        foreach($productos as $keyP => $valueP){

            $productoOrden = $this->getDoctrine()
                ->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->find($valueP->getId());

            $matriz[$valueP->getId()] = $this->createForm(new OrdenesProductoCantidadType())->createView();
        }

        //$matrizv[$value->getId()][$id] = $matriz[$value->getId()][$id] ->createView();

        $repository = $this->getDoctrine()
            ->getRepository('IncentivesOrdenesBundle:OrdenesCompra');

        $repository3 = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Productoprecio');

        $ordenes= $repository->find($id);
        $precios= $repository3->findByProveedor($ordenes->getProveedor());

        /*if ($ordenes->getordenesEstado()->getId()==1 or $ordenes->getordenesEstado()->getId()==2){
            $this->estadoAction($id);
        }*/

        return $this->render('IncentivesOrdenesBundle:Ordenes:ingreso.html.twig', 
            array('ordenes' => $ordenes, 
                'productos' => $productos, 'precios' => $precios, 'matriz' => $matriz,
        ));
    }

    public function valoresIngresoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        //Seteo de la consulta para productos
        $qb = $em->createQueryBuilder();            
        $qb->select('p');
        $qb->from('IncentivesCatalogoBundle:Producto','p');
        $qb->where($str_filtro);
        $parametros = json_decode($parametros, true);
        $qb->setParameters($parametros);
        $producto = $qb->getQuery()->getResult();

        //$producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->findAll();

        /*$catalogo = $em->getRepository('IncentivesCatalogoBundle:Catalogos')->find($id);
        $productoprecio = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->findAll();

        foreach ($pagination as $key => $value) {

            $qb = $em->createQueryBuilder();            
            $qb->select('pc');
            $qb->from('IncentivesCatalogoBundle:Productocatalogo','pc');
            $qb->where('pc.producto = :id_producto AND pc.catalogos = :id_catalogo');
            $qb->setParameter('id_producto', $value);
            $qb->setParameter('id_catalogo', $catalogo);

            if(!($productocatalogo = $qb->getQuery()->getOneOrNullResult())) $productocatalogo = new Productocatalogo();

            $matriz[$value->getId()][$id] = $this->createForm(new ProductocatalogoType(), $productocatalogo);
            $matrizv[$value->getId()][$id] = $matriz[$value->getId()][$id] ->createView();
        }

        $pagina=$this->get('request')->query->get('page', 1);

        return $this->render('IncentivesCatalogoBundle:Maestro:grupo.html.twig', array(
                'matrizv'=>$matrizv,
                'catalogo'=>$catalogo,
                'id' => $id,
                'productoprecio'=>$productoprecio,
        ));
        }  */        

        return $this->render('IncentivesOrdenesBundle:Ordenes:valoresingreso.html.twig', array(
            'form' => $form->createView(), 'productos'=>$productos, 'id'=>$id
        ));


    }


    public function procesarValoresAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $id_prod = ($this->get('request')->request->get('producto'));
        $OrdenesP = ($this->get('request')->request->get('ordenesproducto'));
        $cantidadR = $OrdenesP['cantidadrecibida'];

        $ordenesProducto = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->find($id_prod);
      
        if(isset($ordenesProducto)){

            $cantidad_inicial = 0 + @$ordenesProducto->getCantidad();

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
		$cantidadInv = $qb->getQuery()->getSingleScalarResult();

		//Cantidades acumuladas
		$cantidadTotal = $cantidadR + $cantidadInv;

            //Comprobar que no supere las cantidades solicitadas
            if($cantidadTotal > $cantidad_inicial){

                $this->get('session')->getFlashBag()->add('warning', 'La cantidad recibida no puede ser superior a la solicitada.');
            
            }else{

                for($i=1;$i<=$cantidadR;$i++){

                    //Ingresar unidades al inventario
                    $inventarioP = new Inventario();
                    $inventarioP->setProducto($ordenesProducto->getProducto());
                    $inventarioP->setOrden($orden);
                    $inventarioP->setOrdenproducto($ordenesProducto);
                    $inventarioP->setIngreso(1);
                    $inventarioP->setValorcompra($ordenesProducto->getValorunidad());
                    $fecha = date_create();
                    $inventarioP->setfechaEntrada($fecha);
                    
                    if ($orden->getSolicitud() !== null) $inventarioP->setSolicitud($orden->getSolicitud());

                    //Buscar la redencion mas antigua o prioritaria en estado de compra
                    $qb = $em->createQueryBuilder();            
                    $qb->select('r');
                    $qb->from('IncentivesRedencionesBundle:Redenciones','r');
                    $qb->leftJoin('r.ordenesProducto', 'op');
                    $str_filtro = 'op.id = '.$id_prod;
                    $str_filtro .= ' AND r.redencionestado = 3';
                    $qb->where($str_filtro);
                    $qb->orderBy('r.fecha', 'asc');
                    $qb->setMaxResults(1);
                    $redencion = $qb->getQuery()->getOneOrNullResult();

                    if(isset($redencion)){

                            $redencionA = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($redencion->getId());
                            $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('4');
                            $redencionA->setRedencionestado($estado);
                            $em->persist($redencionA);
                            
                            //traer los datos de envio para el despacho
                            $despacho = new Despachos();
                            
                            //Traer los ultimos datos de envio
                            $qb = $em->createQueryBuilder();            
                            $qb->select('e');
                            $qb->from('IncentivesRedencionesBundle:RedencionesEnvios','e');
                            $str_filtro = 'e.redencion ='.$redencionA->getId();
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
                            $despacho->setRedencion($redencionA);
                            $despacho->setProducto($ordenesProducto->getProducto());
                            $despacho->setOrdenProducto($ordenesProducto);
                            $despacho->setCantidad(1);
                            $em->persist($despacho);

                            //Almacenar Historico
                            $redencionH = $this->get('incentives_redenciones');
                            $redencionH->insertar($redencionA);

                            $codInventario = time().$redencion->getId();
                            $inventarioP->setRedencion($redencionA);
                            $inventarioP->setDespacho($despacho);
                            $inventarioP->setCodigo($codInventario);
                            
                            $em->flush();
                    }

                    $em->persist( $inventarioP );
                    
                    $inventarioH = $this->get('incentives_inventario');
                    $inventarioH->insertar($inventarioP);
                    
                    $em->flush();

                }

                $ordenesProducto->setCantidadrecibida($cantidadTotal);
                $em->persist($ordenesProducto);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'Las cantidades se registraron correctamente.');
                
                $this->cerrarOrdenAction($orden->getId());
            }
        }
        
        return $this->redirect($this->generateUrl('ordenes_ingreso').'/'.$orden->getId());
    }


	public function productosProveedorAction($id) {

		$em = $this->getDoctrine()->getManager();

		$query = $em->createQueryBuilder()
                ->select('p producto','pp precio') 
                ->from('IncentivesCatalogoBundle:Producto', 'p')
                ->leftJoin('p.productoprecio','pp');
		$str_filtro = 'p.estado = 1';
		$str_filtro .= ' AND pp.proveedor = '.$id;
                $query->where($str_filtro);    
                $query->groupBy('p.id');
	        $query->orderBy('p.nombre');
            
            $productos = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
	
		return $this->render('IncentivesOrdenesBundle:Ordenes:productosprecio.html.twig', array('productos'=>$productos));

	}

	public function totalordenAction($id) {

		$em = $this->getDoctrine()->getManager();

		$query = $em->createQueryBuilder()
                ->select('op orden','p producto')
                ->from('IncentivesOrdenesBundle:OrdenesProducto', 'op')
                ->leftJoin('op.producto','p');
		$str_filtro = "op.ordenesCompra = ".$id;
        $str_filtro .= " AND op.estado = 1";
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

    public function agregarProductoAction(Request $request, $id)
    {        
        $em = $this->getDoctrine()->getManager();
        $ordenproducto = new OrdenesProducto();

        $form = $this->createForm(new OrdenesProductoAgregarType(), $ordenproducto);
                    
        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                
                $id=($this->get('request')->request->get('id'));
                $pro=($this->get('request')->request->get('ordenesproducto'));
                
                $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
                $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
                $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($pro['producto']);
                $programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($pro['programa']);
                $ordenproducto->setCantidad($pro["cantidad"]);
                $ordenproducto->setValorunidad($pro["valorunidad"]);
                $ordenproducto->setDescuento($pro["descuento"]);
                //$ordenproducto->setCentrocostos($pro["centrocostos"]);
                
                $ordenproducto->setValortotal($pro["valorunidad"]*$pro["cantidad"]);
                $ordenproducto->setPrecioCliente($pro["precioCliente"]);
                $ordenproducto->setIncremento($pro["incremento"]);
                $ordenproducto->setLogistica($pro["logistica"]);
                
                $ordenproducto->setOrdenesCompra($orden);
                $ordenproducto->setEstado($estado);
                $ordenproducto->setProducto($producto);
                $ordenproducto->setPrograma($programa);

                $em->persist($ordenproducto);
                $em->flush();
                
                $this->pdfAction($id);
          		$this->totalordenAction($id);

                return $this->redirect($this->generateUrl('ordenredencion_editarvalores').'/'.$id);

            }
        }           

        return $this->render('IncentivesOrdenesBundle:Ordenes:agregarproducto.html.twig', array(
            'form' => $form->createView(), 'id' => $id
        ));
    }
    
    
    public function productoCotizacionesAction(Request $request, $id)
    {        
        $em = $this->getDoctrine()->getManager();
        
        $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($id);
        
        $qb = $em->createQueryBuilder()
                ->select('cp','p','e')
                ->from('IncentivesSolicitudesBundle:CotizacionProducto','cp')
                ->leftJoin('cp.cotizacion', 'c')
                ->leftJoin('c.solicitud', 's')
                ->leftJoin('s.ordencompra', 'oc')
                ->leftJoin('cp.producto', 'p')
                ->leftJoin('cp.estado', 'e');
        $str = "oc.id=".$id." AND cp.estado=2";
        $qb->where($str);
        
        $ProductosCotizaciones =  $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $this->render('IncentivesOrdenesBundle:Ordenes:agregarproductocotizaciones.html.twig', array(
            'productos' => $ProductosCotizaciones, 'ordenes' => $orden
        ));
    }
    
    public function agregarProductoCotizacionesAction(Request $request, $id, $ordencompra)
    {        
        $em = $this->getDoctrine()->getManager();
        
        $orden = $em->getRepository('IncentivesOrdenesBundle:OrdenesCompra')->find($ordencompra);
        $cotizacionProducto = $em->getRepository('IncentivesSolicitudesBundle:CotizacionProducto')->find($id);
        
        $ordenproducto = new OrdenesProducto();

        $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
        $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($cotizacionProducto->getProducto()->getId());
        $programa = $em->getRepository('IncentivesCatalogoBundle:Programa')->find($cotizacionProducto->getCotizacion()->getsolicitud()->getPrograma()->getId());
        $ordenproducto->setCantidad($cotizacionProducto->getCantidad());
        $ordenproducto->setValorunidad($cotizacionProducto->getValorunidad());
        
        $ordenproducto->setPrecioCliente($cotizacionProducto->getValorunidad());
        $ordenproducto->setIncremento($cotizacionProducto->getIncremento());
        $ordenproducto->setLogistica($cotizacionProducto->getLogistica());
        
        $ordenproducto->setOrdenesCompra($orden);
        $ordenproducto->setEstado($estado);
        $ordenproducto->setProducto($producto);
        $ordenproducto->setPrograma($programa);
        $ordenproducto->setValortotal($cotizacionProducto->getCantidad()*$cotizacionProducto->getValorunidad());
        $ordenproducto->setProductocotizacion($cotizacionProducto);

        $estadoCpt = $em->getRepository('IncentivesOrdenesBundle:OrdenesEstado')->find(5);
        $cotizacionProducto->setEstado($estadoCpt);
        
        $em->persist($ordenproducto);
        $em->flush();
        
        $this->totalordenAction($orden->getId());
        
        return $this->redirect($this->generateUrl('ordenes_datos').'/'.$ordencompra);

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
        $str_filtro .= ' AND op.cantidad!=op.cantidadrecibida AND op.estado=1';
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
    
    public function detalleProductoOrdenAction($productoOrden)
    {

      $em = $this->getDoctrine()->getManager();

      $qb = $em->createQueryBuilder()
                ->select('r','op','pt','pg','pc','p','pp','oc')
                ->from('IncentivesRedencionesBundle:Redenciones','r')
                ->leftJoin('r.ordenesProducto', 'op')
                ->leftJoin('op.ordenesCompra', 'oc')
                ->leftJoin('r.participante', 'pt')
                ->leftJoin('pt.programa', 'pg')
                ->leftJoin('r.productocatalogo', 'pc')
                ->leftJoin('pc.producto', 'p')
                ->leftJoin('p.productoprecio', 'pp');
      $str = "op.id=".$productoOrden;

      $qb->where($str);
      $Redenciones =  $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

    //echo "<pre>"; print_r($Redenciones); echo "</pre>";

      return $this->render('IncentivesOrdenesBundle:Ordenes:detalleproductoorden.html.twig', 
          array('redenciones' => $Redenciones,
      ));

  }

    public function editarProductoOrdenAction($productoOrden)
    {

      $em = $this->getDoctrine()->getManager();

      $qb = $em->createQueryBuilder()
                ->select('r','op','pt','pg','pc','p','pp')
                ->from('IncentivesRedencionesBundle:Redenciones','r')
                ->leftJoin('r.ordenesProducto', 'op')
                ->leftJoin('r.participante', 'pt')
                ->leftJoin('pt.programa', 'pg')
                ->leftJoin('r.productocatalogo', 'pc')
                ->leftJoin('pc.producto', 'p')
                ->leftJoin('p.productoprecio', 'pp');
      $str = "op.id=".$productoOrden;

      $qb->where($str);
      $Redenciones =  $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

    //echo "<pre>"; print_r($Redenciones); echo "</pre>";

      return $this->render('IncentivesOrdenesBundle:Ordenes:editarproductoorden.html.twig', 
          array('redenciones' => $Redenciones
      ));

  }
  
  
  public function reporteAmazonAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        /*$query = $em->createQueryBuilder()
                    ->select('i inventario', 'pr producto','SUM(i.ingreso) ingresada','SUM(i.salio) salida')
                     ->addSelect('(SELECT COUNT(i.planilla)
            FROM IncentivesInventarioBundle:Inventario inv
	    LEFT JOIN inv.orden oc
            WHERE inv.producto = i.producto AND (inv.planilla IS NOT NULL OR (inv.orden IS NOT NULL AND oc.ordenesTipo=2) OR inv.salio=1) GROUP BY inv.producto) AS asignada'
        )
                    ->from('IncentivesInventarioBundle:Inventario', 'i')
                    ->leftJoin('i.producto','pr')
                    ->groupBy('i.producto')
                    ->orderBy('i.producto', 'ASC');
        $productos = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        */
        require_once($this->get('kernel')->getRootDir().'/config/dompdf_config.inc.php');
        $uploadDir=dirname($this->container->getParameter('kernel.root_dir')).'/web/Planillas/';
        
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Incentives SAS")
                                         ->setLastModifiedBy("Icentives SAS")
                                         ->setCategory("");

            $objPHPExcel->getActiveSheet()
                        ->setCellValue('A1','COMPRA No.')
                        ->setCellValue('B1','TARJETA No.')
                        ->setCellValue('C1','CUPO DIPONIBLE')
                        ->setCellValue('D1','PRECIO DÓLARES')
                        ->setCellValue('E1','TRM')
                        ->setCellValue('F1','ID 2')
                        ->setCellValue('G1','PRECIO EN PESOS')
                        ->setCellValue('H1','PRECIO EN PESOS FINAL')
                        ->setCellValue('I1','CANTIDAD')
                        ->setCellValue('J1','FECHA COMPRA')
						->setCellValue('K1','FID')
						->setCellValue('L1','DESCRIPCIÓN')
						->setCellValue('M1','ORDEN AMAZON')
						->setCellValue('N1','OC INC')
						->setCellValue('O1','ORDEN COMPRA APLICATIVO')
						->setCellValue('P1','CENTRO DE COSTO')
						->setCellValue('Q1','PROGRAMA')
						->setCellValue('R1','PERSONA COMPRA')
						->setCellValue('S1','OBSERVACIONES COMPRAS')
						->setCellValue('T1','FECHA INGRESO A MB129')
						->setCellValue('U1','OBSERVACIONES MB1299');
                        
                $fil=2;
                 
                /*foreach ($productos as $key => $value) {

    				$objPHPExcel->getActiveSheet()
    					->setCellValue('A'.$fil, $value['inventario']['producto']['id'])
    					->setCellValue('B'.$fil, $value['inventario']['producto']['nombre'])
    					->setCellValue('C'.$fil, $value['inventario']['producto']['marca'])
    					->setCellValue('D'.$fil, $value['inventario']['producto']['referencia'])
    					->setCellValue('E'.$fil, $value['inventario']['producto']['descripcion'])
    					->setCellValue('F'.$fil, $value['inventario']['producto']['codInc'])
    					->setCellValue('G'.$fil, $value['ingresada'])
    					->setCellValue('H'.$fil, $value['salida'])
    					->setCellValue('I'.$fil, $value['asignada'])
    					->setCellValue('J'.$fil, $value['ingresada'] - $value['asignada']);
    					

    				$fil++;
    				
    			}*/
    
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
                $objWriter->save('Inventario.xlsx');  //send it to user, of course you can save it to disk also!
                 // prepare BinaryFileResponse
                $basePath = $this->container->getParameter('kernel.root_dir').'/../web/Planillas';
                $filename = 'reporte_Amazon.xlsx';
                $filePath = $basePath.'/'.$filename;
                $objWriter->save($filePath);  //send it to user, of course you can save it to disk also!
                 
                $response = new BinaryFileResponse($filePath);
                $response->trustXSendfileTypeHeader();
                $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
                return $response;
        
    }
    
    public function detalleIngresoAction($productoOrden)
    {

      $em = $this->getDoctrine()->getManager();

      $qb = $em->createQueryBuilder()
                ->select('r','op','pt','pg','pc','p','pp','e')
                ->from('IncentivesRedencionesBundle:Redenciones','r')
                ->leftJoin('r.ordenesProducto', 'op')
                ->leftJoin('r.participante', 'pt')
                ->leftJoin('pt.programa', 'pg')
                ->leftJoin('r.productocatalogo', 'pc')
                ->leftJoin('pc.producto', 'p')
                ->leftJoin('p.productoprecio', 'pp')
                ->leftJoin('r.redencionestado', 'e');
      $str = "op.id=".$productoOrden;

      $qb->where($str);
      $Redenciones =  $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

    //echo "<pre>"; print_r($Redenciones); echo "</pre>";

      return $this->render('IncentivesOrdenesBundle:Ordenes:detalleingreso.html.twig', 
          array('redenciones' => $Redenciones
      ));

  }
  
  public function detalleProductoRequisicionAction($productoOrden)
    {

      $em = $this->getDoctrine()->getManager();

      $qb = $em->createQueryBuilder()
                ->select('op','p','oc','s','pr')
                ->from('IncentivesOrdenesBundle:OrdenesProducto','op')
                ->leftJoin('op.producto', 'p')
                ->leftJoin('op.ordenesCompra', 'oc')
                ->leftJoin('oc.solicitud', 's')
                ->leftJoin('s.programa', 'pr');
      $str = "op.id=".$productoOrden;

      $qb->where($str);
      $productos =  $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

      return $this->render('IncentivesOrdenesBundle:Ordenes:detalleproductorequisicion.html.twig', 
          array('productos' => $productos
      ));

  }

  
  public function ingresoRedencionAction($redencion) {
        
        $em = $this->getDoctrine()->getManager();

        $id_prod = ($this->get('request')->request->get('producto'));
        $OrdenesP = ($this->get('request')->request->get('ordenesproducto'));
        $cantidadR = 1;

        $redencion = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($redencion);
        $ordenesProducto = $em->getRepository('IncentivesOrdenesBundle:OrdenesProducto')->find($redencion->getOrdenesProducto()->getId());
      
        if(isset($ordenesProducto)){

            $cantidad_inicial = 0 + @$ordenesProducto->getCantidad();

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
		    $cantidadInv = $qb->getQuery()->getSingleScalarResult();

		    //Cantidades acumuladas
		    $cantidadTotal = $cantidadR + $cantidadInv;

            //Comprobar que no supere las cantidades solicitadas
            if($cantidadTotal > $cantidad_inicial){

                $this->get('session')->getFlashBag()->add('warning', 'La cantidad recibida no puede ser superior a la solicitada.');
            
            }else{


                    //Ingresar unidades al inventario
                    $inventarioP = new Inventario();
                    $inventarioP->setProducto($ordenesProducto->getProducto());
                    $inventarioP->setOrden($orden);
                    $inventarioP->setOrdenproducto($ordenesProducto);
                    $inventarioP->setIngreso(1);
                    $inventarioP->setValorcompra($ordenesProducto->getValorunidad());
                    $fecha = date_create();
                    $inventarioP->setfechaEntrada($fecha);

                    if(isset($redencion)){

                            $redencionA = $em->getRepository('IncentivesRedencionesBundle:Redenciones')->find($redencion->getId());
                            $estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('4');
                            $redencionA->setRedencionestado($estado);
                            $em->persist($redencionA);
                            $em->flush();

                            //Almacenar Historico
                            $redencionH = $this->get('incentives_redenciones');
                            $redencionH->insertar($redencionA);

                            $codInventario = time().$redencion->getId();
                            $inventarioP->setRedencion($redencion);
                            $inventarioP->setCodigo($codInventario);
                            
                            //traer los datos de envio para el despacho
                            $despacho = new Despachos();
                            
                            //Traer los ultimos datos de envio
                            $qb = $em->createQueryBuilder();            
                            $qb->select('e');
                            $qb->from('IncentivesRedencionesBundle:RedencionesEnvios','e');
                            $str_filtro = 'e.redencion ='.$redencionA->getId();
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
                            $despacho->setRedencion($redencionA);
                            $despacho->setProducto($ordenesProducto->getProducto());
                            $despacho->setOrdenProducto($ordenesProducto);
                            $despacho->setCantidad(1);
                            $em->persist($despacho);
                            
                            $inventarioP->setDespacho($despacho);

                    }
                    
                    $inventarioH = $this->get('incentives_inventario');
                    $inventarioH->insertar($inventarioP);

                    $em->persist( $inventarioP );
                    $em->flush();

                $ordenesProducto->setCantidadrecibida($cantidadTotal);
                $em->persist($ordenesProducto);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'Las cantidades se registraron correctamente.');
                
                $this->cerrarOrdenAction($orden->getId());
            }
        }
        
        return $this->redirect($this->generateUrl('ordenes_ingreso').'/'.$orden->getId());
    }
    
        public function exportarAction()
    {         
            $fp = fopen('php://temp','r+');

			// Header
			$row = array('Id','Consecutivo','Fecha','Proveedor','Tipo','Estado','Valor Total','Aplica IVA','TRM','Servicios Logisticos','Descuento');
			
    	    $em = $this->getDoctrine()->getManager();

            $query = "SELECT oc.id,oc.consecutivo,oc.descuento,oc.fechaCreacion,pv.nombre proveedor,tp.nombre tipo,oc.trm,e.nombre estado,oc.aplicaIva,oc.total,oc.servicioLogistico
                    FROM OrdenesCompra oc
                    LEFT JOIN Proveedores pv ON pv.id=oc.proveedor_id
                    LEFT JOIN OrdenesTipo tp ON tp.id=oc.ordenesTipo_id
                    LEFT JOIN OrdenesEstado e ON e.id=oc.ordenesEstado_id;";
            
            $conn = $this->get('database_connection'); 
            $productos = $conn->fetchAll($query, array(1), 0);

			//echo "<pre>"; print_r($productos); echo "</pre>"; exit;
    			
            $ir = 0;
            foreach($productos as $key => $value){              
               
               if($ir==0){
				   
					fputcsv($fp,$row,';');
				}
               
                $ir++;
               
                $row = array();
                //Redencion, participante, producto
				$row[] = $value['id'];//1
    			$row[] = $value['consecutivo'];//2
    			$row[] = $value['fechaCreacion'];//3
    			$row[] = $value['proveedor'];//4
    			$row[] = $value['tipo'];//5
    			$row[] = $value['estado'];//6
    			$row[] = number_format($value['total'], 2, ',', '');//7
    			$row[] = $value['aplicaIva'];//8
    			$row[] = number_format($value['trm'], 2, ',', '');//9
    			$row[] = number_format($value['servicioLogistico'], 2, ',', '');//10
    			$row[] = number_format($value['descuento'], 2, ',', '');//10
    			
				fputcsv($fp,$row,';');
            }

			rewind($fp);
			$csv = stream_get_contents($fp);
			fclose($fp);
			
			$filename = 'Ordenes_Compra.csv';
			$response = new Response($csv);
			
			$response->headers->set('Content-Type', "text/csv");
			$response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $filename));            
			
            return $response;

    }
    
     public function exportarProductosAction()
    {         
            $fp = fopen('php://temp','r+');

			// Header
			$row = array('Id','Consecutivo','Fecha','Proveedor','Tipo','Estado','Producto','Referencia','Marca','Estado','Cantidad','Valor Unitario','Descuento','Total');
			
    	    $em = $this->getDoctrine()->getManager();

            $query = "SELECT op.id,op.cantidad,op.valorunidad,op.valortotal,op.descuento descuentoProducto,p.nombre producto,p.marca,p.referencia,ep.nombre estadoProducto,oc.consecutivo,oc.fechaCreacion,pv.nombre proveedor,tp.nombre tipo,oc.trm,e.nombre estado,oc.aplicaIva,oc.total,oc.servicioLogistico
                    FROM OrdenesProducto op
                    JOIN OrdenesCompra oc ON op.ordenesCompra_id=oc.id
                    LEFT JOIN Producto p ON p.id=op.producto_id
                    LEFT JOIN OrdenesEstado ep ON ep.id=op.estado_id
                    LEFT JOIN Proveedores pv ON pv.id=oc.proveedor_id
                    LEFT JOIN OrdenesTipo tp ON tp.id=oc.ordenesTipo_id
                    LEFT JOIN OrdenesEstado e ON e.id=oc.ordenesEstado_id;";
            
            $conn = $this->get('database_connection'); 
            $productos = $conn->fetchAll($query, array(1), 0);

			//echo "<pre>"; print_r($productos); echo "</pre>"; exit;
    			
            $ir = 0;
            foreach($productos as $key => $value){              
               
               if($ir==0){
				   
					fputcsv($fp,$row,';');
				}
               
                $ir++;
               
                $row = array();
                //Redencion, participante, producto
				$row[] = $value['id'];//1
    			$row[] = $value['consecutivo'];//2
    			$row[] = $value['fechaCreacion'];//3
    			$row[] = $value['proveedor'];//4
    			$row[] = $value['tipo'];//5
    			$row[] = $value['estado'];//6
    			$row[] = $value['producto'];//8
    			$row[] = $value['marca'];//9
    			$row[] = $value['referencia'];//10
    			$row[] = $value['estadoProducto'];//10
    			$row[] = $value['cantidad'];//10
    			$row[] = number_format($value['valorunidad'], 2, ',', '');//10
    			$row[] = number_format($value['descuentoProducto'], 2, ',', '');//10
    			$row[] = number_format($value['valortotal'], 2, ',', '');//10
    			
				fputcsv($fp,$row,';');
            }

			rewind($fp);
			$csv = stream_get_contents($fp);
			fclose($fp);
			
			$filename = 'Ordenes_Productos.csv';
			$response = new Response($csv);
			
			$response->headers->set('Content-Type', "text/csv");
			$response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $filename));            
			
            return $response;

    }
    
}
