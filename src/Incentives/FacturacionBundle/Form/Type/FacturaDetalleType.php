<?php

namespace Incentives\FacturacionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FacturaDetalleType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion')
            ->add('cantidad')
            ->add('valorUnitario')
        ;

        $builder->add('area', EntityType::class, array(
            'class' => 'IncentivesFacturacionBundle:Areas',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
            'label' => 'Area'
        ));

        $builder->add('tipo', EntityType::class, array(
            'class' => 'IncentivesFacturacionBundle:Tipocostos',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
            'label' => 'Tipo'
        ));

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\FacturacionBundle\Entity\FacturaDetalle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'facturadetalle';
    }
}
