<?php
 
namespace Incentives\OperacionesBundle\Form\EventListener;
 
use Symfony\Component\Form\FormEvent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;
use Incentives\OperacionesBundle\Entity\Country;
 
class AddCityFieldSubscriber implements EventSubscriberInterface
{
    private $factory;
 
    public function __construct(FormFactoryInterface $factory)
    {
        $this->factory = $factory;
    }
 
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_BIND     => 'preBind'
        );
    }
 
    private function addCityForm($form, $country)
    {
        $form->add($this->factory->createNamed('city',EntityType::class, null, array(
            'class'         => 'MainBundle:City',
            //'empty_value'   => 'Ciudad',
            'query_builder' => function (EntityRepository $repository) use ($country) {
                $qb = $repository->createQueryBuilder('city')
                    ->innerJoin('city.country', 'country');
                if ($country instanceof City) {
                    $qb->where('city.country = :country')
                    ->setParameter('country', $country);
                } elseif (is_numeric($country)) {
                    $qb->where('country.id = :country')
                    ->setParameter('country', $country);
                } else {
                    $qb->where('country.name = :country')
                    ->setParameter('country', null);
                }
 
                return $qb;
            }
        )));
    }
 
    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
        $country = ($data->city) ? $data->ciudad->getPais() : null ;
        $this->addCiudadForm($form, $country);
    }
 
    public function preBind(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
        $country = array_key_exists('country', $data) ? $data['country'] : null;
        $this->addCityForm($form, $country);
    }
}