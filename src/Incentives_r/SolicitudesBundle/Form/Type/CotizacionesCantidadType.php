<?php

namespace Incentives\OrdenesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CotizacionesCantidadType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('cotizacionesProducto', 'collection', array(
             'type'  => new CotizacionesProductoType(),
                'label'          => 'Productos',
                'by_reference'   => false,
                'allow_delete'   => true,
                'allow_add'      => true
        ));

        $builder->add('Enviar', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\OrdenesBundle\Entity\OrdenesCompra'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ordenescompra';
    }
}
