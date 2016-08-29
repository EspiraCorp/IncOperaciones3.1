<?php

namespace Incentives\OrdenesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OrdenesCompraproductoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ordenesProducto', CollectionType::class, array(
             'type'  => new OrdenesProductoType(),
                'label'          => 'Productos',
                'by_reference'   => false,
                'allow_delete'   => true,
                'allow_add'      => true
        ));

        $builder->add('Enviar', SubmitType::class);
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
