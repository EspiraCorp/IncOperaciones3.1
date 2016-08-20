<?php

namespace Incentives\SolicitudesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Incentives\OperacionesBundle\Entity\ProveedoresRepository;

class CotizacionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaCreacion', 'date', array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ));

        $builder
            ->add('fechaVencimiento', 'date', array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ));

        $builder
            ->add('logistica','number', array('label' => 'Logistica Consolidada'));

        $builder
            ->add('condiciones','text', array('label' => 'Condiciones Comerciales'));

        $builder
            ->add('observaciones');

         $builder->add('estado', 'entity', array(
            'class' => 'IncentivesSolicitudesBundle:CotizacionesEstado',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Estado'
        ));

        $builder->add('Enviar', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\SolicitudesBundle\Entity\Cotizacion',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cotizacion';
    }
}
