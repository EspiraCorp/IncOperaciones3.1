<?php

namespace Incentives\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class FiltrosProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', TextType::class, array('required' => false));
        $builder->add('categoria', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Categoria',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'required' => false
        ));
        $builder->add('referencia', TextType::class, array('required' => false));
        $builder->add('marca', TextType::class, array('required' => false));
        $builder->add('codEAN', TextType::class, array('required' => false));
        $builder->add('codInc', TextType::class, array('required' => false));
        $builder->add('productoclasificacion', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Productoclasificacion',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'required' => false
        ));

        $builder->add('Enviar', SubmitType::class);
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
