<?php

namespace Incentives\RedencionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GuiaEnvioType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('guia')
            ->add('valor')
        ;

        $builder->add('ordenProducto', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:OrdenesProducto',
            'property' => 'id',
            'empty_value' => 'Seleccione una opcion',
        ));

        $builder->add('courier', 'entity', array(
            'class' => 'IncentivesInventarioBundle:Courier',
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
            'data_class' => 'Incentives\RedencionesBundle\Entity\GuiaEnvio'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'guiaenvio';
    }
}
