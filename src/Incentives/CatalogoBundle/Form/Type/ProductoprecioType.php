<?php

namespace Incentives\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProductoprecioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('proveedor', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Proveedores',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
        ));
        $builder->add('precio');
        $builder->add('precioDolares');
        $builder->add('principal', CheckboxType::class, array(
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
