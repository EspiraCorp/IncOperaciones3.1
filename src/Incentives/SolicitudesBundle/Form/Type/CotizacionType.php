<?php

namespace Incentives\SolicitudesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Incentives\OperacionesBundle\Entity\ProveedoresRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CotizacionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaCreacion', DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ));

        $builder
            ->add('fechaVencimiento', DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ));

        $builder
            ->add('logistica', NumberType::class, array('label' => 'Logistica Consolidada'));

        $builder
            ->add('condiciones',TextType::class, array('label' => 'Condiciones Comerciales'));

        $builder
            ->add('observaciones');

         $builder->add('estado', EntityType::class, array(
            'class' => 'IncentivesSolicitudesBundle:CotizacionesEstado',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
            'label' => 'Estado'
        ));

        $builder->add('Enviar', SubmitType::class);
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
