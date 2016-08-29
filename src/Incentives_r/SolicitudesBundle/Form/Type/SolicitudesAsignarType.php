<?php

namespace Incentives\SolicitudesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class SolicitudesAsignarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('responsable', 'entity', array(
            'class' => 'IncentivesBaseBundle:Usuario',
            'query_builder' => function(EntityRepository $repository) { 
                return $repository->createQueryBuilder('u')
					->join('u.grupos','g')
					->where('u.isActive = 1 AND g.id IN (2,3,7,12,13)')
					->orderBy('u.nombre', 'ASC');
            },
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opción',
            'label' => 'Responsable'
        ));
        
        
        $builder->add('Enviar', 'submit');

    }
 
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\SolicitudesBundle\Entity\SolicitudesAsignar', //Como collection
        ));
    }

    public function getName()
    {
        return 'responsable';
    }
}
