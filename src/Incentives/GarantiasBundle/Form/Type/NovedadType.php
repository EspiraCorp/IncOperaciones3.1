<?php

namespace Incentives\GarantiasBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NovedadType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('observacion')
            ->add('fecha')
        ;

        $builder->add('estado', EntityType::class, array(
            'class' => 'IncentivesGarantiasBundle:Novedadesestado',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
        ));

        $builder->add('tipo', EntityType::class, array(
            'class' => 'IncentivesGarantiasBundle:Novedadestipo',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
        ));
        
        $builder->add('devolucionTipo', EntityType::class, array(
            'class' => 'IncentivesGarantiasBundle:NovedadesDevolucionTipo',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
        ));


        $builder->add('Enviar', SubmitType::class);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\GarantiasBundle\Entity\Novedades'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'novedad';
    }
}
