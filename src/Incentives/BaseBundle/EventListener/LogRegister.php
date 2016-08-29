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

 		if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 		$entity->setFechaModificacion(new \DateTime("now"));
    }

    public function preUpdate(LifeCycleEventArgs $args)
    {
     	if($this->container->get('security.token_storage')->getToken()) $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

 		if(isset($user) && $user!="anon.") $entity->setUsuario($user);
 		$entity->setFechaModificacion(new \DateTime("now"));

        $update  = $entityManager->getUnitOfWork();
	    $meta = $entityManager->getClassMetadata(get_class($entity));
	    $update->recomputeSingleEntityChangeSet($meta, $entity);
    }
}
