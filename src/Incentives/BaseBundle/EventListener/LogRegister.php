<?php
// src/Acme/SearchBundle/EventListener/SearchIndexer.php
namespace Incentives\BaseBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;

class LogRegister
{
	protected $container;

    public function __construct(ContainerInterface $container)
    {   
        $this->container = $container;
    }

    public function prePersist(LifeCycleEventArgs $args)
    {
     	if($this->container->get('security.token_storage')->getToken()) $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($entity instanceof \Incentives\CatalogoBundle\Entity\Programa) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\CatalogoBundle\Entity\Productocatalogo) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\CatalogoBundle\Entity\Producto) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\RedencionesBundle\Entity\GuiaEnvio) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
        
        if ($entity instanceof \Incentives\InventarioBundle\Entity\Despachos) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
	
		if ($entity instanceof \Incentives\InventarioBundle\Entity\DespachoGuia) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
        
        if ($entity instanceof \Incentives\InventarioBundle\Entity\Inventario) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
        
        if ($entity instanceof \Incentives\InventarioBundle\Entity\InventarioGuia) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\InventarioBundle\Entity\Planilla) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\RedencionesBundle\Entity\RedencionesHistorio) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
            $entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\RedencionesBundle\Entity\Redenciones) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
            $entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\InventarioBundle\Entity\Planilla) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\RedencionesBundle\Entity\RedencionesEnvios) {
            if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\RedencionesBundle\Entity\Participantes) {
            if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\SolicitudesBundle\Entity\Solicitud) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\SolicitudesBundle\Entity\Cotizacion) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\OrdenesBundle\Entity\OrdenesCompra) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\OrdenesBundle\Entity\OrdenesProducto) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\SolicitudesBundle\Entity\CotizacionProducto) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
        
        if ($entity instanceof \Incentives\SolicitudesBundle\Entity\CotizacionProducto) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
        
        if ($entity instanceof \Incentives\SolicitudesBundle\Entity\SolicitudesArchivos) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
        
        if ($entity instanceof \Incentives\SolicitudesBundle\Entity\SolicitudesObservaciones) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
        
        if ($entity instanceof \Incentives\FacturacionBundle\Entity\Factura) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
        
        if ($entity instanceof \Incentives\FacturacionBundle\Entity\FacturaProductos) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
    }

    public function preUpdate(LifeCycleEventArgs $args)
    {
     	if($this->container->get('security.token_storage')->getToken()) $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($entity instanceof \Incentives\CatalogoBundle\Entity\Programa) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\CatalogoBundle\Entity\Productocatalogo) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\CatalogoBundle\Entity\Producto) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\RedencionesBundle\Entity\GuiaEnvio) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
        
        if ($entity instanceof \Incentives\InventarioBundle\Entity\Despachos) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
	
		if ($entity instanceof \Incentives\InventarioBundle\Entity\DespachoGuia) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\InventarioBundle\Entity\Inventario) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
        
        if ($entity instanceof \Incentives\InventarioBundle\Entity\InventarioGuia) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\InventarioBundle\Entity\Planilla) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\RedencionesBundle\Entity\RedencionesHistorio) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
            
        }

        if ($entity instanceof \Incentives\RedencionesBundle\Entity\Redenciones) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
            
        }

        if ($entity instanceof \Incentives\InventarioBundle\Entity\Planilla) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\RedencionesBundle\Entity\RedencionesEnvios) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\RedencionesBundle\Entity\Participantes) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\SolicitudesBundle\Entity\Solicitud) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\SolicitudesBundle\Entity\Cotizacion) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
        
        if ($entity instanceof \Incentives\SolicitudesBundle\Entity\CotizacionProducto) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\OrdenesBundle\Entity\OrdenesCompra) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\OrdenesBundle\Entity\OrdenesProducto) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        if ($entity instanceof \Incentives\SolicitudesBundle\Entity\SolicitudesArchivos) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
        
        if ($entity instanceof \Incentives\SolicitudesBundle\Entity\SolicitudesObservaciones) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
        
        if ($entity instanceof \Incentives\FacturacionBundle\Entity\Factura) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }
        
        if ($entity instanceof \Incentives\FacturacionBundle\Entity\FacturaProductos) {
 			if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 			$entity->setFechaModificacion(new \DateTime("now"));
        }

        $update  = $entityManager->getUnitOfWork();
	    $meta = $entityManager->getClassMetadata(get_class($entity));
	    $update->recomputeSingleEntityChangeSet($meta, $entity);
    }
}
