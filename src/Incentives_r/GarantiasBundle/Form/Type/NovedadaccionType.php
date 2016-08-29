<?php

namespace Incentives\GarantiasBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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

        /*$builder->add('estado', 'entity', array(
            'class' => 'IncentivesGarantiasBundle:Novedadesestado',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
        ));*/

        $builder->add('accion', 'entity', array(
            'class' => 'IncentivesGarantiasBundle:Novedadesaccion',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
        ));


        $builder->add('Enviar', 'submit');
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
