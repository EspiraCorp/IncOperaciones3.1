<?php

namespace Incentives\GarantiasBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NovedadaccionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('observacionaccion')
        ;

        /*$builder->add('estado', EntityType::class, array(
            'class' => 'IncentivesGarantiasBundle:Novedadesestado',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
        ));*/

        $builder->add('accion', EntityType::class, array(
            'class' => 'IncentivesGarantiasBundle:Novedadesaccion',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
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
