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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ConvocatoriasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titulo');
        $builder->add('descripcion',TextareaType::class);
        $builder->add('fechaInicio', DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ));
        $builder->add('fechaFin', DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ));
        $builder->add('estado', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:ConvocatoriasEstado',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
        ));
            
        $builder->add('archivo', FileType::class);
        $builder->addEventSubscriber(new AddProveedorFieldSubscriber());
        $builder->add('Enviar', SubmitType::class);

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
