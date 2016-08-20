<?php

namespace Incentives\catalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class FiltrosProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', 'text', array('required' => false));
        $builder->add('categoria', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Categoria',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'required' => false
        ));
        $builder->add('referencia', 'text', array('required' => false));
        $builder->add('marca', 'text', array('required' => false));
        $builder->add('codEAN', 'text', array('required' => false));
        $builder->add('codInc', 'text', array('required' => false));
        $builder->add('productoclasificacion', 'entity', array(
            'class' => 'IncentivesCatalogoBundle:Productoclasificacion',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'required' => false
        ));

        $builder->add('Enviar', 'submit');
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\CatalogoBundle\Entity\Producto',
            'cascade_validation' => true
        ));
    }

    public function getName()
    {
        return 'filtros';
    }
}
