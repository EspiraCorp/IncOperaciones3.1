<?php

// src/Sinaptica/OperacionesBundle/Form/Type/ProveedoresType.php
namespace Incentives\OperacionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Incentives\OperacionesBundle\Form\EventListener\AddProveedorFieldSubscriber;

class ConvocatoriasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titulo');
        $builder->add('descripcion','textarea');
        $builder->add('fechaInicio', 'date', array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ));
        $builder->add('fechaFin', 'date', array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ));
        $builder->add('estado', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:ConvocatoriasEstado',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
        ));
            
        $builder->add('archivo', 'file');
        $builder->addEventSubscriber(new AddProveedorFieldSubscriber());
        $builder->add('Enviar', 'submit');

    }
 
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Incentives\OperacionesBundle\Entity\Convocatorias'
        );
    }

    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\OperacionesBundle\Entity\Convocatorias',
            'cascade_validation' => true,
            'validation_groups' => array('registro')
        ));
    }

    public function getName()
    {
        return 'convocatorias';
    }
}
