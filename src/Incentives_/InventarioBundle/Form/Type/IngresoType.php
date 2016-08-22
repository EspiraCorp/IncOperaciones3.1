<?php

namespace Incentives\InventarioBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IngresoType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('producto', 'entity', array(
            'class' => 'IncentivesCatalogoBundle:Producto',
            'property' => 'nombreid',
            'empty_value' => 'Seleccione una opcion',
        ));
        $builder->add('cantidad', 'integer', array(
                "mapped" => false,
            ));
        $builder->add('valorCompra');
        $builder->add('observacion');

        $builder->add('Enviar', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\InventarioBundle\Entity\Inventario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'inventario';
    }
}
