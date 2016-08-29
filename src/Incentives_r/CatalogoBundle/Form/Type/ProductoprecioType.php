<?php

namespace Incentives\catalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ProductoprecioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('proveedor', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Proveedores',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
        ));
        $builder->add('precio');
        $builder->add('precioDolares');
        $builder->add('principal', 'checkbox', array(
            'label'     => '¿Es el proveedor principal para el producto?',
            'required'  => false,
        ));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\CatalogoBundle\Entity\Productoprecio',
            'cascade_validation' => false
        ));
    }

    public function getName()
    {
        return 'productoprecio';
    }
}
