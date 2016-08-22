<?php

// src/incentives_operacionesbundle_convocatoriasproveedores/OperacionesBundle/Form/Type/ConvocatoriasProveedoresType.php
namespace Incentives\OperacionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConvocatoriasProveedoresType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('archivo', 'file')
            ->add('observacion','textarea');
        $builder->add('Enviar', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\OperacionesBundle\Entity\ConvocatoriasProveedores'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'convocatoriasproveedores';
    }
}
