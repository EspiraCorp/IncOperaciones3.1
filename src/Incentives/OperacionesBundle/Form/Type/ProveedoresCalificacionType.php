<?php

namespace Incentives\OperacionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProveedoresCalificacionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha', 'date', array(
            'widget' => 'single_text',
        ))
            ->add('observacion')
            ->add('ce')
            ->add('cpi')
            ->add('bep')
            ->add('pd')
            ->add('aoc')
            ->add('cfp')
            ->add('calificacion')
        ;

        $builder->add('periodo', 'choice', array(
            'choices' => array('2015' => '2015', '2016' => '2016', '2017' => '2017', '2018' => '2018', '2019' => '2019', '2020' => '2020', '2021' => '2021')
        ));

        $builder->add('proveedor', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Proveedores',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Proveedor'
        ));

        $builder->add('Enviar', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\OperacionesBundle\Entity\ProveedoresCalificacion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'proveedorescalificacion';
    }
}
