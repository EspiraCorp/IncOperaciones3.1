<?php

namespace Incentives\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Incentives\CatalogoBundle\Entity\Producto;
use Incentives\CatalogoBundle\Form\Type\ProductoType;
use Incentives\CatalogoBundle\Entity\Imagenproducto;
use Incentives\CatalogoBundle\Form\Type\ImagenproductoType;
use Incentives\CatalogoBundle\Entity\Productoprecio;
use Incentives\CatalogoBundle\Form\Type\ProductoprecioType;
use Incentives\CatalogoBundle\Entity\Preciohistorico;
use Incentives\OperacionesBundle\Entity\Proveedores;
use Symfony\Component\HttpFoundation\Session\Session;

use Incentives\CatalogoBundle\Entity\Excel;
use Incentives\CatalogoBundle\Entity\Excelmas;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Cell_DataValidation;
use PHPExcel_Worksheet_Drawing;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

define ("MAX_SIZE","1500");
ini_set('max_execution_time', 300); 

class ProductoController extends Controller
{
    /**
     * @Route("/producto/nuevo")
     * @Template()
     */
    public function nuevoAction(Request $request)
    {
        $producto = new Producto();
        $imagen = new Imagenproducto();
        $precio = new Productoprecio();

        $form = $this->createForm(ProductoType::class, $producto);
                    
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $cod=$producto->getCategoria()->getAbreviatura();        
                $consecutivo = 0;
                
                $query = $em->createQueryBuilder()
                    ->select('MAX(p.codInc)') 
                    ->from('IncentivesCatalogoBundle:Producto', 'p')
                    ->where("p.codInc LIKE '".$cod."%' ")
                    ->orderBy('p.codInc', 'DESC')
                    ->setMaxResults(1);

                $preCodInc = $query->getQuery()->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
                if(isset($preCodInc) && count($preCodInc[1])>0) $consecutivo = substr($preCodInc[1],3); 
                $productos = $em->getRepository('IncentivesCatalogoBundle:Producto')->findByCategoria($producto->getCategoria());
                $num=str_pad($consecutivo+1, 4, '0', STR_PAD_LEFT);

                $producto->setCodInc($cod.$num);
                $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
                $producto->setEstado($estado);
                if (0 != count($producto->getProductoprecio())) {
                    foreach ($producto->getProductoprecio() as $precio) {

                        $precio->setProducto($producto);
                        $producto->addProductoprecio($precio);
                        $em->persist($precio);
                    }
                }   
                if (0 != count($producto->getImagenproducto())) {
                    $conteo=1;
                    define (MAX_SIZE,1500);
                    foreach ($producto->getImagenproducto() as $imagen) {
                        $imagen->setProducto($producto);
                        $file = $imagen->getPath();
                        //Tamaño de imagen
                        $original_info = getimagesize($file);
                        $original_w = $original_info[0];
                        $original_h = $original_info[1];
                        list($width,$height)=getimagesize($file);
                        $extension = $file->guessExtension();
                        if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
                          echo 'Extensión invalida.';
                        } else {
                       
                          $size=filesize($file);
             
                          if ($size > MAX_SIZE*5120)
                          {
                            echo "Supero limite de tamaño de archivo.";
                            $errors=1;
                          } else {
                            if($extension=="jpg" || $extension=="jpeg" )
                            {
                              $original_img = imagecreatefromjpeg($file);
                            }
                            else if($extension=="png")
                            {
                              $original_img = imagecreatefrompng($file);
                            }
                            else
                            {
                              $original_img = imagecreatefromgif($file);
                            }

                            $newwidth=300;
                            $newheight=($original_h/$original_w)*$newwidth;                           
                            $tmp=imagecreatetruecolor($newwidth,$newheight);

                            imagecopyresampled($tmp,$original_img,0,0,0,0,$newwidth,$newheight,$width,$height);
                            imagejpeg($tmp,$file,100);

                            $uploadDir='../web/bundles/CatalogoBundle/Archivos/'.$value->getCodInc().'/';
			    //dirname($this->container->getParameter('kernel.root_dir')).'/web/bundles/CatalogoBundle/Archivos/'.$producto->getCodInc().'/';
                            $imagenes=$em->getRepository('IncentivesCatalogoBundle:Imagenproducto')->findByProducto($producto->getId());
                            $num=str_pad(count($imagenes)+$conteo, 4, '0', STR_PAD_LEFT);
                            $conteo++;
                            $nombreArchivo = $producto->getCodInc().'_'.$num.'.jpg';            //.'.$extension
                            $nombreArchivo2 = $producto->getCodInc().'_'.$num.'_min.jpg';            //.$extension;

                            $file->move($uploadDir,$nombreArchivo);
                            copy($uploadDir.$nombreArchivo,$uploadDir.$nombreArchivo2);
                            $file2=$uploadDir.$nombreArchivo2;
                            list($width2,$height2)=getimagesize($file2);
                            $ext = explode(".", $file2);
                            $extension2 = $ext[1];
                            $original_info2 = getimagesize($file2);
                            $original_w2 = $original_info2[0];
                            $original_h2 = $original_info2[1];
                            $original_img2 = imagecreatefromjpeg($file2);
                            $newwidth2=200;
                            $newheight2=($original_h/$original_w)*$newwidth2;
                            $tmp2=imagecreatetruecolor($newwidth2,$newheight2);
                            imagecopyresampled($tmp2,$original_img2,0,0,0,0,$newwidth2,$newheight2,$width2,$height2);               
                            imagejpeg($tmp2,$file2,100);

                            $imagen->setNombre($nombreArchivo);
                            $imagen->setPath($uploadDir.$nombreArchivo);
                            $producto->addImagenproducto($imagen);
                            $em->persist($imagen);
                          }
                        }                        
                    }
                }  
                $em->persist($producto);

                try {
                    $em->flush();

                    if (0 != count($producto->getProductoprecio())) {
                        foreach ($producto->getProductoprecio() as $precio) {
                            $this->historico($precio->getId());
                        }
                    }
                   
                    $this->get('session')->getFlashBag()->add('notice', 'Se creo el producto con SKU: '.$producto->getCodInc());
                    return $this->redirect($this->generateUrl('producto'));
         
                } catch(\Exception $e){
                    //throw new \Exception('Ya existe un producto con el código EAN dado.');
                    //$this->get('session')->getFlashBag()->add('warning', 'Ya existe un producto con el código EAN dado.');

                    echo($e); exit;
                }

            }
        }            

        return $this->render('IncentivesCatalogoBundle:Producto:nuevo.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/producto/editar")
     * @Template()
     */
    public function editarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        if (isset($id)){
            $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($id);
            $form = $this->createForm(ProductoType::class, $producto);
        }else{
            $form = $this->createForm(ProductoType::class);
            $producto = new Producto();
        }

        if ($request->isMethod('POST')) {
            $pro = $request->request->all()['producto'];
            $form->handleRequest($request);


            if ($form->isValid()) {
                
                $pro = $request->request->all()['producto'];
                $id = $request->request->all()['id'];
                $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($id);
                $producto->setNombre($pro["nombre"]);
                $producto->setDescripcion($pro["descripcion"]);
                $producto->setReferencia($pro["referencia"]);
                $producto->setMarca($pro["marca"]);
                $producto->setCodEAN($pro["codEAN"]);
                $producto->setAlto($pro["alto"]);
                $producto->setLargo($pro["largo"]);
                $producto->setAncho($pro["ancho"]);
                $producto->setPeso($pro["peso"]);
                $producto->setIva($pro["iva"]);
                $producto->setestadoIva($pro["estadoIva"]);
                $producto->setLogistica($pro["logistica"]);
                $producto->setIncremento($pro["incremento"]);
                $producto->setfechaactualizacion(new \DateTime("now"));
                $categoria = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($pro["categoria"]);
                $producto->setCategoria($categoria);
                $tipo = $em->getRepository('IncentivesCatalogoBundle:ProductoTipo')->find($pro["tipo"]);
                $producto->setTipo($tipo);
                $clasificacion = $em->getRepository('IncentivesCatalogoBundle:Productoclasificacion')->find($pro["productoclasificacion"]);
                $producto->setProductoclasificacion($clasificacion);

                $em->persist($producto);   
                $em->flush();

                return $this->redirect($this->generateUrl('producto_datos').'/'.$id);
            }
        }


        return $this->render('IncentivesCatalogoBundle:Producto:editar.html.twig', array(
            'form' => $form->createView(), 'producto' => $producto, 'id'=>$id,
        ));
    }

    /**
     * @Route("/producto")
     * @Template()
     */
    public function listadoAction(Request $request)
    {
            $form = $this->createForm(ProductoType::class);
            
            $em = $this->getDoctrine()->getManager();
            
            $session = $this->get('session');
            
            $page = $request->get('page');
            if(!$page) $page= 1;
            
            if($pro = $request->request->all()['producto']){
                $page = 1;
                $session->set('filtros_productos', $pro);
            }

            $sqlFiltro = "";

            if($filtros = $session->get('filtros_productos')){

               foreach($filtros as $Filtro => $valueF){
                   
                   if($valueF!=""){
                       if($Filtro=="categoria"){
                            $sqlFiltro .= " AND c.id=".$valueF."";
                       }elseif($Filtro=="estado"){
                            $sqlFiltro .= " AND e.id=".$valueF."";
                       }elseif($Filtro=="precio_min"){
                            $sqlFiltro .= " AND pp.precio>=".$valueF."";
                       }elseif($Filtro=="precio_max"){
                            $sqlFiltro .= " AND pp.precio<=".$valueF."";
                       }else{
                            $sqlFiltro .= " AND p.".$Filtro." LIKE '%".$valueF."%'";
                       }
                       
                   };
               } 
                
            }

            if(!isset($filtros['estado']) || $filtros['estado']==""){
                $sqlFiltro .= " AND p.estado=1";
            }

            $sqlFiltro = 'p.tipo=2 '.$sqlFiltro;

            $query = $em->createQueryBuilder()
                ->select('p producto','pp precio', 'c categoria','e estado', 'ct') 
                ->from('IncentivesCatalogoBundle:Producto', 'p')
                ->leftJoin('p.productoprecio','pp', "WITH", "pp.principal=1")
                ->leftJoin('p.categoria', 'c')
                ->leftJoin('p.productocatalogo', 'ct', "WITH", "ct.activo=1")
                ->leftJoin('p.estado', 'e')
                ->where($sqlFiltro);
            
            if($request->get('sort')){
                $query->orderBy($request->get('sort'), $request->get('direction'));    
            }
            
            $productos = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            /*echo "<pre>"; print_r($productos); echo "</pre>"; exit;*/
            
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $productos,
                $page/*page number*/,
                50 /*limit per page*/
            );
            
//echo "<pre>"; print_r($productos); echo "</pre>"; exit;
        return $this->render('IncentivesCatalogoBundle:Producto:listado.html.twig', 
            array('productos' => $pagination, 'form' => $form->createView(), 'filtros' => $filtros));
    }
    
        /**
     * @Route("/producto")
     * @Template()
     */
    public function listadouniversalAction(Request $request)
    {
            $form = $this->createForm(ProductoType::class);
            
            $em = $this->getDoctrine()->getManager();
            
            $session = $this->get('session');
            
            $page = $request->get('page');
            if(!$page) $page= 1;
            
            if($pro = $request->request->all()['producto']){
                $page = 1;
                $session->set('filtros_productos', $pro);
            }

            $sqlFiltro = "";

            if($filtros = $session->get('filtros_productos')){
               
               foreach($filtros as $Filtro => $valueF){
                   
                   if($valueF!=""){
                       if($Filtro=="categoria"){
                            $sqlFiltro .= " AND c.id=".$valueF."";
                       }elseif($Filtro=="estado"){
                            $sqlFiltro .= " AND e.id=".$valueF."";
                       }else{
                            $sqlFiltro .= " AND p.".$Filtro." LIKE '%".$valueF."%'";
                       }
                       
                   };
               } 
                
            }

            $sqlFiltro = ' 1=1 '.$sqlFiltro;

           $query = $em->createQueryBuilder()
            ->select('p producto','pp precio', 'c categoria','e estado') 
            ->from('IncentivesCatalogoBundle:Producto', 'p')
            ->leftJoin('p.productoprecio','pp')
            ->leftJoin('p.categoria', 'c')
            ->leftJoin('p.estado', 'e')
            ->where($sqlFiltro);
            
            if($request->get('sort')){
                $query->orderBy($request->get('sort'), $request->get('direction'));    
            }
            
            //$productos = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query,
                $page/*page number*/,
                50 /*limit per page*/
            );
            
//echo "<pre>"; print_r($productos); echo "</pre>"; exit;
        return $this->render('IncentivesCatalogoBundle:Producto:listadouniversal.html.twig', 
            array('productos' => $pagination, 'form' => $form->createView()));
    }
    
    /**
     * @Route("/producto")
     * @Template()
     */
    /*public function listadouniversalAction()
    {
         $em = $this->getDoctrine()->getManager();

        $query = $em->createQueryBuilder()
            ->select('p producto','pp precio', 'c categoria','e estado') 
            ->from('IncentivesCatalogoBundle:Producto', 'p')
            ->leftJoin('p.productoprecio','pp')
            ->leftJoin('p.categoria', 'c')
            ->leftJoin('p.estado', 'e');
                
            
        $productos = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $productos,
            $request->query->get('page', 1),
            50 
        );
//echo "<pre>"; print_r($productos); echo "</pre>"; exit;
        return $this->render('IncentivesCatalogoBundle:Producto:listadouniversal.html.twig', 
            array('productos' => $pagination));
    }*/

    /**
     * @Route("/producto/datos/{id}")
     * @Template()
     */
    public function datosAction($id)
    {
        $repositoryp = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Producto');

        $repositoryi = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Imagenproducto');

        $repositorypp = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Productoprecio');
        
        $repositorypc = $this->getDoctrine()
            ->getRepository('IncentivesCatalogoBundle:Productocatalogo');

        $producto= $repositoryp->find($id);
        $imagen= $repositoryi->findByProducto($id);
        $productoprecio= $repositorypp->findByProducto($id);
        $productocatalogo= $repositorypc->findByProducto($id);
        

        return $this->render('IncentivesCatalogoBundle:Producto:datos.html.twig', 
            array('producto' => $producto, 'id'=>$id, 'imagen' => $imagen, 'productoprecio'=>$productoprecio, 'productocatalogo'=>$productocatalogo));
    }

    /**
     * @Route("/producto/estado")
     * @Template()
     */
    public function estadoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($id);

        if ($producto->getEstado()->getId() == 1){
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(2);
            $producto->setEstado($estado);
            
            //inhabilitar de todos los catalogos
            /*$repositorypc = $this->getDoctrine()->getRepository('IncentivesCatalogoBundle:Productocatalogo');
            $productocatalogo= $repositorypc->findByProducto($id);
            
            foreach($productocatalogo as $keyP => $valueP){
                
                $valueP->setActivo(0);
                $em->persist($valueP);
                $em->flush();
            }*/
        
        }else{
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
            $producto->setEstado($estado);
        }       
        $em->flush();
        
        return $this->redirect($this->generateUrl('producto'));
    }

    public function estadoMaestroAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($id);

        if ($producto->getEstado()->getId() == 1){
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(2);
            $producto->setEstado($estado);
        }else{
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
            $producto->setEstado($estado);
        }       
        $em->flush();
        
        return $this->redirect($this->generateUrl('productocatalogo_maestro'));
    }

    /**
     * @Route("/producto/imagen")
     * @Template()
     */
    public function cargaImagenAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        if (isset($id)){
            $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($id);
        }else{
            $producto = new Producto();
        }
        $imagen = new Imagenproducto();
        $form = $this->createForm(ImagenproductoType::class, $imagen);
           
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $conteo=1;
                $em = $this->getDoctrine()->getManager(); 
                $id = $request->request->all()['id'];
                $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($id);

                $imagen->setProducto($producto);
                $file = $imagen->getPath();
                
                //Tamaño de imagen
                $original_info = getimagesize($file);
                $original_w = $original_info[0];
                $original_h = $original_info[1];
                list($width,$height)=getimagesize($file);
                $extension = $file->guessExtension();
                if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
                  echo 'Extensión invalida.';
                } else {
               
                  $size=filesize($file);
     
                  if ($size > MAX_SIZE*1024)
                  {
                    echo "Supero limite de tamaño de archivo.";
                    $errors=1;
                  } else {
                    if($extension=="jpg" || $extension=="jpeg" )
                    {
                      $original_img = imagecreatefromjpeg($file);
                    }
                    else if($extension=="png")
                    {
                      $original_img = imagecreatefrompng($file);
                    }
                    else
                    {
                      $original_img = imagecreatefromgif($file);
                    }

                    $newwidth=300;
                    $newheight=($original_h/$original_w)*$newwidth;                           
                    $tmp=imagecreatetruecolor($newwidth,$newheight);

                    imagecopyresampled($tmp,$original_img,0,0,0,0,$newwidth,$newheight,$width,$height);
                    imagejpeg($tmp,$file,100);

                    $uploadDir='../web/bundles/CatalogoBundle/Archivos/'.$producto->getCodInc().'/';
                    $imagenes=$em->getRepository('IncentivesCatalogoBundle:Imagenproducto')->findByProducto($producto->getId());
                    $num=str_pad(count($imagenes)+$conteo, 4, '0', STR_PAD_LEFT);
                    $conteo++;
                    $nombreArchivo = $producto->getCodInc().'_'.$num.'.jpg';            //.'.$extension
                    $nombreArchivo2 = $producto->getCodInc().'_'.$num.'_min.jpg';            //.$extension;
                    //$nombreArchivo = $producto->getCodInc().'_'.$num.'.'.$extension;

                    $file->move($uploadDir,$nombreArchivo);
                    copy($uploadDir.$nombreArchivo,$uploadDir.$nombreArchivo2);
                    $file2=$uploadDir.$nombreArchivo2;
                    list($width2,$height2)=getimagesize($file2);
                    $ext = explode(".", $file2);
                    $extension2 = $ext[1];
                    $original_info2 = getimagesize($file2);
                    $original_w2 = $original_info2[0];
                    $original_h2 = $original_info2[1];
                    $original_img2 = imagecreatefromjpeg($file2);
                    $newwidth2=200;
                    $newheight2=($original_h/$original_w)*$newwidth2;
                    $tmp2=imagecreatetruecolor($newwidth2,$newheight2);
                    imagecopyresampled($tmp2,$original_img2,0,0,0,0,$newwidth2,$newheight2,$width2,$height2);               
                    imagejpeg($tmp2,$file2,100);

                    $imagen->setNombre($nombreArchivo);
                    $imagen->setPath($uploadDir.$nombreArchivo);
                    $producto->addImagenproducto($imagen);
                    $em->persist($imagen);
                    }
                }
                $em->flush();

                return $this->redirect($this->generateUrl('producto_datos', array('id' => $id)));
            }
        }  

        return $this->render('IncentivesCatalogoBundle:Producto:cargaImagen.html.twig', array(
            'form' => $form->createView(), 'id'=>$id
        ));   
    }

    public function estadoImagenAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $imagen = $em->getRepository('IncentivesCatalogoBundle:Imagenproducto')->find($id);

        if ($imagen->getEstado()=='1'){
            $imagen->setEstado('0');
        }else{
            $imagen->setEstado('1');
        }       
        $em->flush();
        
        return $this->redirect($this->generateUrl('producto_datos', array('id' => $imagen->getProducto()->getId())));
    }

    public function agregarPrecioAction(Request $request, $id)
    {
        // crea una task y le asigna algunos datos ficticios para este ejemplo

        $em = $this->getDoctrine()->getManager();
        $producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($id);
        $precio = new Productoprecio();

        $form = $this->createForm(ProductoprecioType::class, $precio);
               
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                
                $pro = $request->request->all()['producto_precio'];
                $proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($pro['proveedor']);
                $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find(1);
                // realiza alguna acción, tal como guardar la tarea en la base de datos
                $precio->setProducto($producto);
                $precio->setProveedor($proveedor);
                $precio->setPrecio($pro['precio']);
                $precio->setPrecioDolares($pro['precioDolares']);
                $precio->setEstado($estado);

                if (isset($pro["principal"])){
                    //quitar la marca de principal a los demas
                    $otroprincipal = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->findBy(array( 'producto' => $precio->getProducto()->getId(), 'principal' => 1));
                    foreach ($otroprincipal as $key => $value) {
                        $value->setPrincipal(false);
                        $em->persist($value);
                    }

                    $precio->setPrincipal($pro["principal"]);
                }else{
                    $precio->setPrincipal(false);
                }

                $em->persist($precio);          
                $em->flush();
               
                //$this->historico($precio->getId());
                    
                return $this->redirect($this->generateUrl('producto_datos', array('id' => $precio->getProducto()->getId())));
            }else{
                die($form->getErrorsAsString());
                
            }   
        }         

        return $this->render('IncentivesCatalogoBundle:Producto:agregarPrecio.html.twig', array(
            'form' => $form->createView(), 'id'=>$id,
        ));
    }

    public function estadoPrecioAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $precio = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($id);

        if ($precio->getEstado()->getId()==1){
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find('0');
        }else{
            $estado = $em->getRepository('IncentivesCatalogoBundle:Estados')->find('1');
        }   
        $precio->setEstado($estado);    
        $em->flush();
        
        return $this->redirect($this->generateUrl('producto_datos', array('id' => $precio->getProducto()->getId())));
    }
    
    
    
     
    public function importarAction(Request $request)
    {
        $excelForm = new Excel();
        $form = $this->createFormBuilder($excelForm)
            ->setAction($this->generateUrl('producto_importar'))
            ->setMethod('POST')
            ->add('excel', 'file')
            ->add('cargar', SubmitType::class)
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            $excel = $form['excel']->getData();

            $objPHPExcel = PHPExcel_IOFactory::load($excel);
            

            //$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            $sheetData = $objPHPExcel->getSheet(0)->toArray(null,true,true,true);

            $worksheet  = $objPHPExcel->setActiveSheetIndex('0');
            $ultimaFila = $worksheet->getHighestRow(); // e.g. 10

            $conn = $this->get('database_connection');
            
            $date = date_create();

            $repetidos_codEAN = array();
            $fila=1;
            $codSKU = "";
                    
            /*foreach ($sheetData as $row) {
                if($fila > 1){
                    $rep_codEAN = $this->buscarepetidos($row['F'],'codEAN');
                    if(count($rep_codEAN)) array_push($repetidos_codEAN, $rep_codEAN);
                }
                $fila =$fila + 1;
            }*/
            
            $fila=1;
            foreach ($sheetData as $row) {
                if($fila > 1 && $fila <= $ultimaFila && $row['A']!=""){
                    $cat=explode(" ", $row['A']);
                    $cat=explode("-", $cat[0]);
                    $estado=explode(" ", $row['M']);
                    $clas=explode(" ", $row['T']);

                    if(isset($clas[0]) && $clas[0]!="" && $clas[0]!=0){
                        $clasificacion= $clas[0];
                    }else{
                        $clasificacion= 1;  
                    }

                    $producto = new Producto();
                    
                    $pm = $this->getDoctrine()->getManager(); 
                    
                    $em = $this->getDoctrine()->getManager(); 
                    $categori = $em->getRepository('IncentivesOperacionesBundle:Categoria')->find($cat[0]);

                    $cod=$categori->getAbreviatura();     //
        
                    $consecutivo = 0;
                    
                    $query = $em->createQueryBuilder()
                            ->select('MAX(p.codInc)') 
                            ->from('IncentivesCatalogoBundle:Producto', 'p')
                            ->where("p.codInc LIKE '".$cod."%' ")
                            ->orderBy('p.codInc', 'DESC')
                            ->setMaxResults(1);
    
                    $preCodInc = $query->getQuery()->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
                    if(isset($preCodInc) && count($preCodInc[1])>0) $consecutivo = substr($preCodInc[1],3); 
                    
                    $num=str_pad($consecutivo+1, 4, '0', STR_PAD_LEFT);

                    if (count($repetidos_codEAN) == 0) {
                        $excelcar = $conn->insert('Producto', array('categoria_id' => $cat[0], 'nombre' => eregi_replace("[\n|\r|\n\r]", ' ', $row['B']), 'referencia' => eregi_replace("[\n|\r|\n\r]", ' ', $row['C']), 'marca' => eregi_replace("[\n|\r|\n\r]", ' ', $row['D']), 'descripcion' => eregi_replace("[\n|\r|\n\r]", ' ', $row['E']), 'codEAN' => $row['F'], 'eanTemp' => $row['G'], 'codinc' => $cod.$num, 'alto' => $row['I'], 'largo' => $row['J'], 'ancho' => $row['K'], 'peso' => $row['L'], 'estado_id' => $estado[0], 'iva' => $row['N'], 'fechacreacion' => date_format($date, 'Y-m-d'), 'fechaactualizacion' => date_format($date, 'Y-m-d'), 'estadoIva'=>$row['Q'], 'logistica'=>$row['R'], 'incremento'=>$row['S'], 'clasificacion_id' => $clasificacion, 'codImg' => $row['U'], 'tipo_id'=> 2));
                    
                        $idProduct = $conn->lastInsertId('id');
                        
                        $codSKU .= $cod.$num." - "; 
                    
                        //5 Opciones de carga de proveedores
                        
                        //Proveedor 1
                        if($row['V']!=""){
                            //Quitar bandera de proveedor principal
                            $conn->update('Productoprecio', array('principal' => 0), array('producto_id' => $idProduct));
                            
                            $prov1=explode(" ", $row['V']);
                            $provedor1 = $conn->insert('Productoprecio',array('producto_id'=>$idProduct, 'proveedor_id'=>$prov1[0], 'precio'=>$row['W'], 'precioDolares'=>$row['X'], 'principal'=>1, 'estado_id'=>1));
                        }

                        //Proveedor 2
                        /*if($row['X']!=""){
                            $prov1=explode(" ", $row['X']);
                            $provedor1 = $conn->insert('Productoprecio',array('producto_id'=>$idProduct, 'proveedor_id'=>$prov1[0], 'precio'=>$row['Y'], 'principal'=>0, 'estado_id'=>1));
                        }

                        //Proveedor 3
                        if($row['Z']!=""){
                            $prov1=explode(" ", $row['Z']);
                            $provedor1 = $conn->insert('Productoprecio',array('producto_id'=>$idProduct, 'proveedor_id'=>$prov1[0], 'precio'=>$row['AA'], 'principal'=>0, 'estado_id'=>1));
                        }

                        //Proveedor 4
                        if($row['AB']!=""){
                            $prov1=explode(" ", $row['AB']);
                            $provedor1 = $conn->insert('Productoprecio',array('producto_id'=>$idProduct, 'proveedor_id'=>$prov1[0], 'precio'=>$row['AC'], 'principal'=>0, 'estado_id'=>1));
                        }

                        //Proveedor 5
                        if($row['AD']!=""){
                            $prov1=explode(" ", $row['AD']);
                            $provedor1 = $conn->insert('Productoprecio',array('producto_id'=>$idProduct, 'proveedor_id'=>$prov1[0], 'precio'=>$row['AE'], 'principal'=>0, 'estado_id'=>1));
                        }*/
                    }
          
                }
                $fila += 1;
            }
            
            $codEANsrep='';
            if (count($repetidos_codEAN)) {
              foreach($repetidos_codEAN as $key => $value) $codEANsrep .= ','.$value[0];
              $this->get('session')->getFlashBag()->add(
              'warning',
              'No se ha podido cargar el documento porque existen codigos EAN repetidos: '.$codEANsrep
              );
            }else{
                $this->get('session')->getFlashBag()->add(
              'notice',
              'Los productos se cargaron correctamente: '.$codSKU
              );

            }
        }

        return $this->render('IncentivesCatalogoBundle:Producto:importar.html.twig', array(
            'form' => $form->createView(),
        ));

    }
    
    private function buscarepetidos($buscar, $campo)
    {
      $conn = $this->get('database_connection');
      $res = $conn->fetchAll('SELECT '.$campo.' FROM Producto');
      
      $resultado = array();  
      foreach($res as $key => $value) {;
          if($buscar == $value[$campo]) array_push($resultado, $value[$campo]);
      }
      return $resultado;
    }
    
    public function exportarAction()
    {         
			
            $fp = fopen('php://temp','r+');

			// Header
			$row = array(
						'Categoria','Nombre','Referencia','Marca','Descripción','CodEAN','ean Temporal','CodInc','Alto','Largo','Ancho','Peso','Estado','Iva','Fecha de Creación','Fecha de actualización'
						,'Proveedor','Precio','Precio Dolares','Catalogos');

            $query = "SELECT p.id,p.nombre,p.referencia,p.marca,p.descripcion,p.codEAN,p.eanTemp,p.codInc,p.fechaModificacion,
                            p.alto,p.largo,p.ancho,p.peso,p.estadoiva,p.iva,p.fechacreacion,c.nombre categoria,e.id estaodId,e.nombre estado,
                            pp.precio,pp.precioDolares,pp.principal,pp.estado_id estadoprecio,pp.fecha fechaprecio,pv.id proveedorId,pv.nombre proveedor
                    	FROM Producto p LEFT JOIN Categoria c ON p.categoria_id=c.id";

            $query .= " LEFT JOIN Productoprecio pp ON p.id=pp.producto_id";
            $query .= " LEFT JOIN Proveedores pv ON (pv.id=pp.proveedor_id AND pp.principal=1)";
            $query .= " LEFT JOIN Estados e ON p.estado_id=e.id";

            $str_filtro = ' WHERE p.estado_id != 2';
            $str_filtro .= " GROUP BY p.id  ORDER BY p.id ASC";
            
            $conn = $this->get('database_connection'); 
            $productos = $conn->fetchAll($query.$str_filtro, array(1), 0);

			//echo "<pre>"; print_r($productos); echo "</pre>"; exit;
               
            $ir = 0;
            foreach($productos as $key => $value){  
               
                if($ir==0){
					fputcsv($fp,$row,';');
				}
               
                $ir++;
               
                $row = array();
                //Redencion, participante, producto
				$row[] = utf8_decode($value['categoria']);
				$row[] = utf8_decode($value['nombre']);
				$row[] = utf8_decode($value['referencia']);
				$row[] = utf8_decode($value['marca']);
				$row[] = utf8_decode($value['descripcion']);
				$row[] = utf8_decode($value['codEAN']);
				$row[] = $value['eanTemp'];
				$row[] = $value['codInc'];
				$row[] = $value['alto'];
				$row[] = $value['largo'];
				$row[] = $value['ancho'];
				$row[] = $value['peso'];
				$row[] = $value['estado'];
				$row[] = $value['iva'];
				$row[] = $value['fechacreacion'];
				$row[] = $value['fechaModificacion'];
				$row[] = utf8_decode($value['proveedor']);
				$row[] = $value['precio'];
				$row[] = $value['precioDolares'];
                
                $query = "SELECT pc.activo,pc.aproboOperaciones_id,pc.aproboOperaciones_id,pc.aproboDirector_id,pc.aproboOperaciones_id,
                                c.id catalogoId,c.nombre catalogo
                        	FROM Productocatalogo as pc JOIN Catalogos c ON pc.catalogos_id=c.id";
                $str_filtro = ' WHERE pc.producto_id = '.$value['id'];
                        
                $conn = $this->get('database_connection'); 
                $catalogos = $conn->fetchAll($query.$str_filtro, array(1), 0);
               
                $infCatalogos = "";
                
                foreach($catalogos as $keyC => $valueC){
                    if($valueC['activo'] ==1 && $valueC['aproboOperaciones_id'] != 2 && $valueC['aproboOperaciones_id'] != 2 && $valueC['aproboDirector_id'] != 2 && $valueC['aproboOperaciones_id'] != 2){
                        $infCatalogos .= utf8_decode($valueC['catalogo']).", ";   
                    }
                }
                $row[] = $infCatalogos;
                //echo "<pre>"; print_r($catalogos); echo "</pre>";
                
                fputcsv($fp,$row,';');
            }


			rewind($fp);
			$csv = stream_get_contents($fp);
			fclose($fp);
			
			$filename = 'Productos.csv';
			$response = new Response($csv);
			
			$response->headers->set('Content-Type', "text/csv");
			$response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $filename));            
			
            return $response;

    }
    
     public function exportarOldAction()
    {
    
        if(isset($_POST['producto'])) { // button name
            
            // Create new PHPExcel object
            $Descarga = new PHPExcel();

            // Set document properties
            $Descarga->setActiveSheetIndex(0);
    
            $em = $this->getDoctrine()->getManager();

            $query = $em->createQueryBuilder()
                ->select('p producto','pp precio', 'c categoria','e estado','pc','cat','est','pv','ao','ac','ad','acl') 
                ->from('IncentivesCatalogoBundle:Producto', 'p')
                ->leftJoin('p.productoprecio','pp','WITH','pp.principal=1')
                ->leftJoin('p.categoria', 'c')
                ->leftJoin('p.estado', 'e')
                ->leftJoin('p.productocatalogo','pc')
                ->leftJoin('pc.aproboOperaciones','ao')
                ->leftJoin('pc.aproboComercial','ac')
                ->leftJoin('pc.aproboDirector','ad')
                ->leftJoin('pc.aproboCliente','acl')
                ->leftJoin('pc.catalogos','cat')
                ->leftJoin('cat.estado','est')
                ->leftJoin('pp.proveedor','pv')
                ->groupBy('p.id');

            
            $producto = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            //echo "<pre>"; print_r($producto); echo "</pre>";
                                      
            $Descarga->getActiveSheet()
                        ->setCellValue('A1','Categoria')
                        ->setCellValue('B1','Nombre')
                        ->setCellValue('C1','Referencia')
                        ->setCellValue('D1','Marca')
                        ->setCellValue('E1','Descripción')
                        ->setCellValue('F1','CodEAN')
                        ->setCellValue('G1','ean Temporal')
                        ->setCellValue('H1','CodInc')
                        ->setCellValue('I1','Alto')
                        ->setCellValue('J1','Largo')
                        ->setCellValue('K1','Ancho')
                        ->setCellValue('L1','Peso')
                        ->setCellValue('M1','Estado')
                        ->setCellValue('N1','Iva')
                        ->setCellValue('O1','Fecha de Creación')
                        ->setCellValue('P1','Fecha de actualización')
                        ->setCellValue('R1','Proveedor')
                        ->setCellValue('S1','Precio')
                        ->setCellValue('T1','Precio Dolares')
                        ->setCellValue('U1','Catalogos');
            
            $fil=2;
            
            foreach ($producto as $key => $value) {

                $Descarga->getActiveSheet()->getRowDimension($fil)->setRowHeight('45');
                $Descarga->getActiveSheet()->getColumnDimension('P')->setWidth(10);
                
                $Descarga->getActiveSheet()
//                      ->setCellValue('A'.$fil, $value->getCategoria()->getNombre())
                        ->setCellValue('B'.$fil, $value['producto']['nombre'])
                        ->setCellValue('C'.$fil, $value['producto']['referencia'])
                        ->setCellValue('D'.$fil, $value['producto']['marca'])
                        ->setCellValue('E'.$fil, $value['producto']['descripcion'])
                        ->setCellValue('F'.$fil, $value['producto']['codEAN'])
                        ->setCellValue('G'.$fil, $value['producto']['eanTemp'])
                        ->setCellValue('H'.$fil, $value['producto']['codInc'])
                        ->setCellValue('I'.$fil, $value['producto']['alto'])
                        ->setCellValue('J'.$fil, $value['producto']['largo'])
                        ->setCellValue('K'.$fil, $value['producto']['ancho'])
                        ->setCellValue('L'.$fil, $value['producto']['peso'])
                        ->setCellValue('M'.$fil, $value['producto']['estado']['nombre'])
                        ->setCellValue('N'.$fil, $value['producto']['iva'])
                        ->setCellValue('O'.$fil, $value['producto']['fechacreacion']->format('Y-m-d'))   //$fechcre[0])
                        ->setCellValue('P'.$fil, $value['producto']['fechaactualizacion']->format('Y-m-d'));     //$fechact[0]);
                    
                    $pp = $value['producto']['productoprecio'];
                    if(isset($pp[0])){
                       $Descarga->getActiveSheet()->setCellValue('R'.$fil,$pp[0]['proveedor']['id']." - ".$pp[0]['proveedor']['nombre']);
                       $Descarga->getActiveSheet()->setCellValue('S'.$fil,$pp[0]['precio']);
                    }
                       
                //if(null == $value->getCategoria()->getNombre()) $Descarga->getActiveSheet()->setCellValue('A'.$fil, 'Nulo');
                //else $Descarga->getActiveSheet()->setCellValue('A'.$fil, $value->getCategoria()->getNombre());
                if(!isset( $value['producto']['categoria']['nombre'])) $Descarga->getActiveSheet()->setCellValue('A'.$fil, 'Nulo');
                else $Descarga->getActiveSheet()->setCellValue('A'.$fil, $value['producto']['categoria']['nombre']);   

                $catalogos= "";
                
                foreach($value['producto']['productocatalogo'] as $keyC => $valueC){
                    
                    $rechazado = 0;
                
                    if(isset($valueC['catalogos']['aproboOperaciones']) && $valueC['catalogos']['aproboOperaciones']['id'] == 2) $rechazado=1;
                    if(isset($valueC['catalogos']['aproboComercial']) && $valueC['catalogos']['aproboComercial']['id'] == 2) $rechazado=1;
                    if(isset($valueC['catalogos']['aproboDirector']) && $valueC['catalogos']['aproboDirector']['id'] == 2) $rechazado=1;
                    if(isset($valueC['catalogos']['aproboCliente']) && $valueC['catalogos']['aproboCliente']['id'] == 2) $rechazado=1;
                
                    if($valueC['activo']==1 && $rechazado==0){
                        
                        $catalogos .= $valueC['catalogos']['nombre'].", ";
                        
                    }
                }

                $Descarga->getActiveSheet()->setCellValue('U'.$fil, $catalogos);             

                $fil+=1;
            }

            $objWriter = new PHPExcel_Writer_Excel2007($Descarga); 
            $objWriter->save('Producto.xlsx');  //send it to user, of course you can save it to disk also!
             // prepare BinaryFileResponse
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
            $filename = 'Producto.xlsx';
            $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
            $filePath = $basePath.'/'.$filename; 
             
            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
            return $response;
            
        }


        return $this->render('IncentivesCatalogoBundle:Producto:exportar.html.twig');
    }

        public function formatoAction()
    {
            
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
            $columns = $sm->listTableColumns('Producto');
            $col = 0;
            $letters = range('A', 'Z');
            array_push($letters, "AA", "AB");

            foreach ($columns as $column) {
                if($column->getName()!="usuario_id" && $column->getName()!="fechaModificacion" && $column->getName()!="tipo_id"){
                    if($col>0){
                    $objPHPExcel->getActiveSheet()
                                ->setCellValue($letters[$col-1].'1',$column->getName());
                    }
                    $col += 1;
                }
            }

            
             //Lista categoria_id
            $categoria = $conn->fetchAll('SELECT nombre FROM Categoria ORDER BY id ASC');
            $categoria_array=Array();
            $indice=1;
            foreach($categoria as $key => $value){
                array_push($categoria_array, $indice.' - '.$value['nombre']);
                $indice+=1;
            }

            //Columnas para carga de proveedor y precio
            $objPHPExcel->getActiveSheet()
                        ->setCellValue($letters[$col-1].'1','Proveedor');
            $col += 1;
            $objPHPExcel->getActiveSheet()
                        ->setCellValue($letters[$col-1].'1','Valor Local');
            $col += 1;
            $objPHPExcel->getActiveSheet()
                        ->setCellValue($letters[$col-1].'1','Valor Dolares');


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
            $objValidation->setFormula1('"' . implode(",", $categoria_array) . '"');
            
            //Lista clasificacion_id
            $clasificacion = $conn->fetchAll('SELECT nombre FROM Productoclasificacion ORDER BY id ASC');
            $clasificacion_array=Array();
            $indice=1;
            foreach($clasificacion as $key => $value){
                array_push($clasificacion_array, $indice.' - '.$value['nombre']);
                $indice+=1;
            }


            $objValidation = $objPHPExcel->getActiveSheet()->getCell('T2')->getDataValidation();
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
            $objValidation->setFormula1('"' . implode(",", $clasificacion_array) . '"');
            
            //Lista estado
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
            $objValidation->setFormula1('"1 - Activo,0 - Inactivo"');
            
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
            //$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
            $objWriter->save('Formato_Producto.xlsx');  //send it to user, of course you can save it to disk also!
            
             // prepare BinaryFileResponse
            $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
            $filename = 'Formato_Producto.xlsx';
            $filePath = $basePath.'/'.$filename; 
             
            $response = new BinaryFileResponse($filePath);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
            
            return $response;
    }

        
    public function historico($id)
    {
        $em = $this->getDoctrine()->getManager();
        $historico=new Preciohistorico();
        $precio = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($id);
        $historico->setProducto($precio->getProducto());
        $historico->setProveedor($precio->getProveedor());
        $historico->setPrecio($precio->getPrecio());
        $historico->setEstado($precio->getEstado());
        $historico->setPrincipal($precio->getPrincipal());
        $historico->setFecha($precio->getFecha());
        $em->persist($historico);
        $em->flush();        
    }

    public function editarPrecioAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        if (isset($id)){
            $precio = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($id);
            $form = $this->createForm(ProductoprecioType::class, $precio);
        }else{
            $form = $this->createForm(ProductoprecioType::class);
            $precio = new Productoprecio();
        }

        if ($request->isMethod('POST')) {       
            $form->handleRequest($request);


            //if ($form->isValid()) {
                
                $pro = $request->request->all()['productoprecio'];
                $id = $request->request->all()['id'];
                $precio = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->find($id);
                $proveedor = $em->getRepository('IncentivesOperacionesBundle:Proveedores')->find($pro["proveedor"]);
                $precio->setPrecio($pro["precio"]);
                $precio->setPrecioDolares($pro["precioDolares"]);
                $precio->setProveedor($proveedor);
                if (isset($pro["principal"])){
                    //quitar la marca de principal a los demas
                    $otroprincipal = $em->getRepository('IncentivesCatalogoBundle:Productoprecio')->findBy(array( 'producto' => $precio->getProducto()->getId(), 'principal' => 1));
                    foreach ($otroprincipal as $key => $value) {
                        $value->setPrincipal(false);
                        $em->persist($value);
                    }

                    $precio->setPrincipal($pro["principal"]);
                }else{
                    $precio->setPrincipal(false);
                }
                $precio->setFecha(new \DateTime("now"));                
                $em->persist($precio);   
                $em->flush();
                //$this->historico($precio->getId());

                return $this->redirect($this->generateUrl('producto_datos').'/'.$precio->getProducto()->getId());
            //}
        }

        return $this->render('IncentivesCatalogoBundle:Producto:editarprecio.html.twig', array(
            'form' => $form->createView(), 'precio' => $precio, 'id'=>$id,
        ));
    }

       public function editarmasAction(Request $request)
    {
        $excelForm = new Excelmas();
        $form = $this->createFormBuilder($excelForm)
            ->setAction($this->generateUrl('producto_editar_mas'))
            ->setMethod('POST')
            ->add('excel', 'file')
            ->getForm();

            
    if ($request->isMethod('POST')) {
        $form->handleRequest($request);

        $excel = $form['excel']->getData();
        $objPHPExcel = PHPExcel_IOFactory::load($excel);
        //$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $sheetData = $objPHPExcel->getSheet(0)->toArray(null,true,true,true);
        $worksheet  = $objPHPExcel->setActiveSheetIndex('0');
        $conn = $this->get('database_connection');

        $fila=1;
            foreach ($sheetData as $row) {
                if($fila > 1){
                
                $categoria = explode(" ", $row['B']);
                
    //          if (count($repetidos_codEAN) == 0) {
                    $excelcar = $conn->update('Producto', array('categoria_id' => $categoria[0], 'nombre' => $row['C'], 'referencia' => $row['D'], 'marca' => $row['E'], 'descripcion' => $row['F'], 'codEAN' => $row['G'], 'alto' => $row['J'], 'largo' => $row['K'], 'ancho' => $row['L'], 'peso' => $row['M'], 'estado_id' => $row['N'], 'iva' => $row['O'], 'logistica' => $row['P'], 'incremento' => $row['Q'], 'fechacreacion' => $row['R'], 'fechaactualizacion' => $row['S']), array('id' => $row['A']));

                    $idProduct = $row['A'];
                    
                    //5 Opciones de carga de proveedores
                    //Proveedor 1
            
                    if($row['T']!=""){
                        if($row['V']!=""){
                            //consultar si ya tiene proveedor principal
                            $prov1=explode(" ", $row['T']);
                                    $provedor1 = $conn->update('Productoprecio',array('precio'=>$row['U'], 'precioDolares' => $row['W']), array('id' => $row['V']));
                        }else{
                            
                            $conn->update('Productoprecio', array('principal' => 0), array('producto_id' => $idProduct));
                             
                            //insertar      
                            $prov1=explode(" ", $row['T']);
                            $provedor1 = $conn->insert('Productoprecio',array('producto_id'=>$idProduct, 'proveedor_id'=>$prov1[0], 'precio' => $row['U'], 'precioDolares' => $row['W'], 'principal'=>1, 'estado_id'=>1));
                        }
                    }


    //          }
                    
                }
                $fila += 1;
            }
        
        }
        
        return $this->render('IncentivesCatalogoBundle:Producto:editarmas.html.twig', array(
                'form' => $form->createView(),
        )); 
    }

public function formatoeditarmasAction() {

          
      // Create new PHPExcel object
      $Descarga = new PHPExcel();

      // Set document properties
      $Descarga->setActiveSheetIndex(0);
    
    $em = $this->getDoctrine()->getManager();

      //$conn = $this->get('database_connection');                                         

      $Descarga->getActiveSheet()
              ->setCellValue('A1','id')
              ->setCellValue('B1','categoria_id')
              ->setCellValue('C1','nombre')
              ->setCellValue('D1','referencia')
              ->setCellValue('E1','marca')
              ->setCellValue('F1','descripcion')
              ->setCellValue('G1','codEAN')
              ->setCellValue('H1','Ean Temp')
              ->setCellValue('I1','codInc')
              ->setCellValue('J1','alto')
              ->setCellValue('K1','largo')
              ->setCellValue('L1','ancho')
              ->setCellValue('M1','peso')
              ->setCellValue('N1','estado')
              ->setCellValue('O1','iva')
              ->setCellValue('P1','logistica')
              ->setCellValue('Q1','incremento')
              ->setCellValue('R1','fechacreacion')
              ->setCellValue('S1','fechaactualizacion')
              ->setCellValue('T1','proveedor')
              ->setCellValue('U1','precio')
              ->setCellValue('V1','Id Precio (no borrar)')
              ->setCellValue('W1','precio dolares');

        $query = $em->createQueryBuilder()
                //->select('p producto','pp precio', 'c categoria', 'e estado', 'prov proveedor') 
		->select('p producto', 'c categoria', 'e estado') 
                ->from('IncentivesCatalogoBundle:Producto', 'p')
                //->leftJoin('p.productoprecio','pp')
        ->leftJoin('p.categoria', 'c')
        ->leftJoin('p.estado', 'e');
        //->leftJoin('pp.proveedor', 'prov');
        $str_filtro = 'p.estado = 1';   
                $query->where($str_filtro);    
                $query->groupBy('p.id');
            
            $producto = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
              

      //echo "<pre>"; print_r($producto); echo "</pre>"; exit;
      $fil=2;
      foreach ($producto as $key => $value) {

            //Lista categoria_id
            
            /*$objValidation = $Descarga->getActiveSheet()->getCell('B'.$fil)->getDataValidation();
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
            $objValidation->setFormula1('"' . implode(",", $categoria_array) . '"');*/


          $Descarga->getActiveSheet()
              ->setCellValue('A'.$fil, $value['producto']['id'])
              ->setCellValue('B'.$fil, $value['producto']['categoria']['id']." - ".$value['producto']['categoria']['nombre'])
              ->setCellValue('C'.$fil, $value['producto']['nombre'])
              ->setCellValue('D'.$fil, $value['producto']['referencia'])
              ->setCellValue('E'.$fil, $value['producto']['marca'])
              ->setCellValue('F'.$fil, $value['producto']['descripcion'])
              ->setCellValue('G'.$fil, $value['producto']['codEAN'])
              ->setCellValue('H'.$fil, $value['producto']['eanTemp'])
              ->setCellValue('I'.$fil, $value['producto']['codInc'])
              ->setCellValue('J'.$fil, $value['producto']['alto'])
              ->setCellValue('K'.$fil, $value['producto']['largo'])
              ->setCellValue('L'.$fil, $value['producto']['ancho'])
              ->setCellValue('M'.$fil, $value['producto']['peso'])
              ->setCellValue('N'.$fil, $value['producto']['estado']['id'])
              ->setCellValue('O'.$fil, $value['producto']['iva'])
              ->setCellValue('P'.$fil, $value['producto']['logistica'])
              ->setCellValue('Q'.$fil, $value['producto']['incremento']);
              //->setCellValue('R'.$fil, $value['producto']['fechacreacion']->format('Y-m-d'))
              //->setCellValue('S'.$fil, $value['producto']['fechaactualizacion']->format('Y-m-d'));
    /*if(isset($value['producto']['productoprecio'][0])){
              $Descarga->getActiveSheet()
        ->setCellValue('T'.$fil, $value['producto']['productoprecio'][0]['proveedor']['id']." - ".$value['producto']['productoprecio'][0]['proveedor']['nombre'])
              ->setCellValue('U'.$fil, $value['producto']['productoprecio'][0]['precio'])
        ->setCellValue('V'.$fil, $value['producto']['productoprecio'][0]['id'])
        ->setCellValue('W'.$fil, $value['producto']['productoprecio'][0]['precioDolares']);
              }*/
          $fil+=1;
      }
      
      
      
      $objWriter = new PHPExcel_Writer_Excel2007($Descarga); 
      $objWriter->save('Producto_Editar_Masivo.xlsx');  //send it to user, of course you can save it to disk also!
        // prepare BinaryFileResponse
      $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
      $filename = 'Producto_Editar_Masivo.xlsx';
      $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
      $filePath = $basePath.'/'.$filename; 
        
      $response = new BinaryFileResponse($filePath);
      $response->trustXSendfileTypeHeader();
      $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
      
      return $response;
    
    }   

    public function formatoporproveedorAction($id) {
          
      // Create new PHPExcel object
      $Descarga = new PHPExcel();

      // Set document properties
      $Descarga->setActiveSheetIndex(0);
      $em = $this->getDoctrine()->getManager();

      $Descarga->getActiveSheet()
              ->setCellValue('A1','id')
              ->setCellValue('B1','categoria_id')
              ->setCellValue('C1','nombre')
              ->setCellValue('D1','referencia')
              ->setCellValue('E1','marca')
              ->setCellValue('F1','descripcion')
              ->setCellValue('G1','codEAN')
              ->setCellValue('H1','Temporal')
              ->setCellValue('I1','codInc')
              ->setCellValue('J1','alto')
              ->setCellValue('K1','largo')
              ->setCellValue('L1','ancho')
              ->setCellValue('M1','peso')
              ->setCellValue('N1','estado')
              ->setCellValue('O1','iva')
              ->setCellValue('P1','logistica')
              ->setCellValue('Q1','incremento')
              ->setCellValue('R1','fechacreacion')
              ->setCellValue('S1','fechaactualizacion')
              ->setCellValue('T1','precio')
              ->setCellValue('U1','principal')
              ->setCellValue('V1','proveedor_id');
        
        $query = $em->createQueryBuilder()
                ->select('p producto','pp precio', 'c categoria', 'e estado') 
                ->from('IncentivesCatalogoBundle:Producto', 'p')
                ->leftJoin('p.productoprecio','pp')
                ->leftJoin('p.categoria', 'c')
                ->leftJoin('p.estado', 'e');
                $str_filtro = 'p.estado = 1';   
                $query->where($str_filtro);    
                $query->groupBy('p.id');
                
        $producto = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        $fil=2;
        foreach ($producto as $key => $value) {
            
             $Descarga->getActiveSheet()
              ->setCellValue('A'.$fil, $value['producto']['id'])
              ->setCellValue('B'.$fil, $value['producto']['categoria']['id']." - ".$value['producto']['categoria']['nombre'])
              ->setCellValue('C'.$fil, $value['producto']['nombre'])
              ->setCellValue('D'.$fil, $value['producto']['referencia'])
              ->setCellValue('E'.$fil, $value['producto']['marca'])
              ->setCellValue('F'.$fil, $value['producto']['descripcion'])
              ->setCellValue('G'.$fil, $value['producto']['codEAN'])
              ->setCellValue('H'.$fil, $value['producto']['eanTemp'])
              ->setCellValue('I'.$fil, $value['producto']['codInc'])
              ->setCellValue('J'.$fil, $value['producto']['alto'])
              ->setCellValue('K'.$fil, $value['producto']['largo'])
              ->setCellValue('L'.$fil, $value['producto']['ancho'])
              ->setCellValue('M'.$fil, $value['producto']['peso'])
              ->setCellValue('N'.$fil, $value['producto']['estado']['nombre'])
              ->setCellValue('O'.$fil, $value['producto']['iva'])
              ->setCellValue('P'.$fil, $value['producto']['logistica'])
              ->setCellValue('Q'.$fil, $value['producto']['incremento'])
              ->setCellValue('R'.$fil, $value['producto']['fechacreacion']->format('Y-m-d'))
              ->setCellValue('S'.$fil, $value['producto']['fechaactualizacion']->format('Y-m-d'))
              ->setCellValue('V'.$fil, $id);

            if(count($value['producto']['productoprecio'])>0){
                $Descarga->getActiveSheet()
                        ->setCellValue('T'.$fil, $value['producto']['productoprecio'][0]['precio'])
                        ->setCellValue('U'.$fil, $value['producto']['productoprecio'][0]['principal']);
            }
              
          $fil+=1;
        }
      
      $objWriter = new PHPExcel_Writer_Excel2007($Descarga); 
      $objWriter->save('Producto_por_Proveedor.xlsx');  //send it to user, of course you can save it to disk also!
      $basePath = $this->container->getParameter('kernel.root_dir').'/../web';
      $filename = 'Producto_por_Proveedor.xlsx';
      $objWriter->save($filename);  //send it to user, of course you can save it to disk also!
      $filePath = $basePath.'/'.$filename; 
        
      $response = new BinaryFileResponse($filePath);
      $response->trustXSendfileTypeHeader();
      $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename, iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
      
      return $response;
    
    }

     public function masivoImagenAction()
    {
        //Leer el directorio de imagenes temporales

        $em = $this->getDoctrine()->getManager();
        //$producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->findByCategoria(8);

        //Proveedor principal
        $qb = $em->createQueryBuilder();            
        $qb->select('p');
        $qb->from('IncentivesCatalogoBundle:Producto','p');
    $qb->leftJoin('p.imagenproducto','i');
        //$str_filtro = 'p.id > 3634';
    $str_filtro = 'i.id IS NULL';               
        $qb->where($str_filtro);                    
        $producto = $qb->getQuery()->getResult();

        //$producto = $em->getRepository('IncentivesCatalogoBundle:Producto')->findByCategoria(8);

        $conteo =0;
        foreach ($producto as $key => $value) {

            $ruta = "../web/bundles/CatalogoBundle/Archivos/Temp/";
            $file = $ruta.$value->getCodImg().".jpg";

            if($original_img = @imagecreatefromjpeg($file)){

                $original_info = getimagesize($file);
                $original_w = $original_info[0];
                $original_h = $original_info[1];
                list($width,$height)=getimagesize($file);
                        
                $extension = substr($file, -3);

                $newwidth=300;//acho de la imagen
                $newheight=($original_h/$original_w)*$newwidth;                           
                $tmp=imagecreatetruecolor($newwidth,$newheight);

                imagecopyresampled($tmp,$original_img,0,0,0,0,$newwidth,$newheight,$width,$height);
                imagejpeg($tmp,$file,100);

                $uploadDir='../web/bundles/CatalogoBundle/Archivos/'.$value->getCodInc().'/';
                
                if (!file_exists($uploadDir)) mkdir($uploadDir, 0700);
                $imagenes=$em->getRepository('IncentivesCatalogoBundle:Imagenproducto')->findByProducto($value->getId());
                $num=str_pad(count($imagenes)+$conteo, 4, '0', STR_PAD_LEFT);
                $conteo++;
                $nombreArchivo = $value->getCodInc().'_'.$num.'.jpg';            //.'.$extension
                $nombreArchivo2 = $value->getCodInc().'_'.$num.'_min.jpg';            //.$extension;

                //$file->move($uploadDir,$nombreArchivo);
                copy($file,$uploadDir.$nombreArchivo);
                //echo $file.",".$uploadDir.$nombreArchivo;
                copy($uploadDir.$nombreArchivo,$uploadDir.$nombreArchivo2);

                $imagen = new Imagenproducto();
                $productoO = $em->getRepository('IncentivesCatalogoBundle:Producto')->find($value->getId());
                //echo $productoO->getId()."<br>";
                //$producto->addImagenproducto($imagen);
                
                $imagen->setProducto($productoO);
                $imagen->setNombre($nombreArchivo);
                $imagen->setPath($uploadDir.$nombreArchivo);
                $imagen->setEstado(1);
                $em->persist($imagen);
                //$em->persist($productoO);
                $em->flush();

                unlink($file);

                //$conn = $this->get('database_connection');
                //$imagenProd = $conn->insert('Imagenproducto',array('producto_id'=>$value->getId(), 'nombre'=>$nombreArchivo, 'path' =>$uploadDir.$nombreArchivo, 'estado'=>1));

            }
            # code...
        }

        /*
        //listar imagenes y comparar con imagenes ya procesadas
        $ruta = "../web/bundles/CatalogoBundle/Archivos/Temp";
        //Obteenr array de directorios e imagenes
        $archivos = $this->leerDirectorio($ruta);

        $em = $this->getDoctrine()->getManager();

        //Recorrer el arreglo de directorios
        foreach($archivos as $keyD => $valueD){
        
            //Recorrer el arreglo de archivos
            foreach($valueD as $keyF => $valueF){
                $file = $ruta."/".$keyD."/".$valueF;

                //determinar el producto al que pertenece
                $qb = $em->createQueryBuilder();            
                $qb->select('p');
                $qb->from('IncentivesCatalogoBundle:Producto','p');
                $str_filtro = "p.codImg = :temp";
                $qb->where($str_filtro);

                //Definicion de parametros para filtros
                $arrayParametros['temp'] = $keyD;
                $qb->setParameters($arrayParametros);
                    
                if($producto = $qb->getQuery()->getOneOrNullResult()){

                    //revisar si ya se proceso este temporal en la tabla de imagenes
                    $idTemp = $em->getRepository('IncentivesCatalogoBundle:Imagenproducto')->findByTemp($keyD);

                    //si no ha sido procesado
                    if(!$idTemp){
                        
                        //Tamaño de imagen
                        $original_info = getimagesize($file);
                        $original_w = $original_info[0];
                        $original_h = $original_info[1];
                        list($width,$height)=getimagesize($file);
                        
                        $extension = substr($valueF, -3);

                        //Segun la extension crear la imagen
                        if($extension=="jpg" || $extension=="jpeg" )
                        {
                          $original_img = imagecreatefromjpeg($file);
                        }
                        else if($extension=="png")
                        {
                          $original_img = imagecreatefrompng($file);
                        }
                        else
                        {
                          $original_img = imagecreatefromgif($file);
                        }

                        $newwidth=300;//acho de la imagen
                        $newheight=($original_h/$original_w)*$newwidth;                           
                        $tmp=imagecreatetruecolor($newwidth,$newheight);

                        imagecopyresampled($tmp,$original_img,0,0,0,0,$newwidth,$newheight,$width,$height);
                        imagejpeg($tmp,$file,100);

                        $uploadDir=dirname($this->container->getParameter('kernel.root_dir')).'/web/bundles/CatalogoBundle/Archivos/'.$producto->getCodInc().'/';
                        $imagenes=$em->getRepository('IncentivesCatalogoBundle:Imagenproducto')->findByProducto($producto->getId());
                        $num=str_pad(count($imagenes)+$conteo, 4, '0', STR_PAD_LEFT);
                        $conteo++;
                        $nombreArchivo = $producto->getCodInc().'_'.$num.'.jpg';            //.'.$extension
                        $nombreArchivo2 = $producto->getCodInc().'_'.$num.'_min.jpg';            //.$extension;
                        $file->move($uploadDir,$nombreArchivo);
                        copy($uploadDir.$nombreArchivo,$uploadDir.$nombreArchivo2);                    

                    }

                }
                


            }
        
        }*/

        $this->get('session')->getFlashBag()->add('notice', 'Imagenes procesadas exitosamente');

    //return $this->render('IncentivesCatalogoBundle:Producto:imagenesmas.html.twig', array()); 

        return $this->redirect($this->generateUrl('producto_importar'));
        
    }
    
    public function catalogoproductoAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQueryBuilder()
            ->select('p producto', 'p','c') 
            ->from('IncentivesCatalogoBundle:Productocatalogo', 'p')
            ->leftJoin('p.catalogos','c');
        
        $str_filtro = 'p.activo = 1';
        $str_filtro .= 'AND p.producto ='.$id;
        $query->where($str_filtro);
            
        $catalogos = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        return $this->render('IncentivesCatalogoBundle:Producto:catalogoproducto.html.twig', 
            array('listado' => $catalogos));
    }

    public function productoreferenciaAction(Request $request, $id){
        //Cantidad de tipos de documentos a cargar
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb->select('p');
        $qb->from('IncentivesCatalogoBundle:Producto','p');
        $qb->where("p.referencia LIKE '".$id."'");
        $qb->setMaxResults(1);

        $respuesta = '0';

       if($producto = $qb->getQuery()->getOneOrNullResult()){
            $respuesta = '1';
        }

        return new Response($respuesta);

    }
    
    
    public function buscarAction(Request $request)
    {
            $form = $this->createForm(ProductoType::class);
            
            $em = $this->getDoctrine()->getManager();
            
            $session = $this->get('session');
            
            $productos = array();
            
            $page = $request->get('page');
            if(!$page) $page= 1;
            
            if($pro = $request->request->all()['producto']){
                $page = 1;
                $session->set('filtros_productos_busqueda', $pro);
            }

            $sqlFiltro = "";

            if($filtros = $session->get('filtros_productos_busqueda')){

               foreach($filtros as $Filtro => $valueF){
                   
                   if($valueF!=""){
                       if($Filtro=="categoria"){
                            $sqlFiltro .= " AND c.id=".$valueF."";
                       }elseif($Filtro=="estado"){
                            $sqlFiltro .= " AND e.id=".$valueF."";
                       }elseif($Filtro=="precio_min"){
                            $sqlFiltro .= " AND pp.precio>=".$valueF."";
                       }elseif($Filtro=="precio_max"){
                            $sqlFiltro .= " AND pp.precio<=".$valueF."";
                       }else{
                            $sqlFiltro .= " AND p.".$Filtro." LIKE '%".$valueF."%'";
                       }
                       
                   };
               } 
             if(!isset($filtros['estado']) || $filtros['estado']==""){
                $sqlFiltro .= " AND p.estado=1";
            }

            $sqlFiltro = 'p.tipo=2 '.$sqlFiltro;

            $query = $em->createQueryBuilder()
                ->select('p producto','pp precio', 'c categoria','e estado', 'ct') 
                ->from('IncentivesCatalogoBundle:Producto', 'p')
                ->leftJoin('p.productoprecio','pp', "WITH", "pp.principal=1")
                ->leftJoin('p.categoria', 'c')
                ->leftJoin('p.productocatalogo', 'ct', "WITH", "ct.activo=1")
                ->leftJoin('p.estado', 'e')
                ->where($sqlFiltro);
            
            if($request->get('sort')){
                $query->orderBy($request->get('sort'), $request->get('direction'));    
            }
            
            $productos = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            /*echo "<pre>"; print_r($productos); echo "</pre>"; exit;*/
            
            }
            
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $productos,
                $page/*page number*/,
                50 /*limit per page*/
            ); 
            
//echo "<pre>"; print_r($productos); echo "</pre>"; exit;
        return $this->render('IncentivesCatalogoBundle:Producto:buscar.html.twig', 
            array('productos' => $pagination, 'form' => $form->createView(), 'filtros' => $filtros));
    }
    


}
