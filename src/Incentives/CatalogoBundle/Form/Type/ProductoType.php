<?php

namespace Incentives\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Incentives\CatalogoBundle\Form\Type\ImagenproductoType;
use Incentives\CatalogoBundle\Form\Type\ProductoprecioType;
use Incentives\CatalogoBundle\Form\EventListener\AddImagenproductoFieldSubscriber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre');
        $builder->add('categoria', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Categoria',
            'choice_label' => 'nombre',
            'empty_data' => null,
            'placeholder' => 'Seleccionar',
            'query_builder' => function(\Doctrine\ORM\EntityRepository $er) { 
                return $er->createQueryBuilder('u')->orderBy('u.nombre', 'ASC')
                    ->orderBy('u.nombre', 'ASC');
            },
        ));
        $builder->add('referencia');
        $builder->add('marca');
        $builder->add('descripcion');
        $builder->add('codEAN',TextType::class,array('label'  => 'EAN', 'required' => false));
        $builder->add('codInc');
        $builder->add('alto',IntegerType::class,array('label'  => 'Alto (cm)'));
        $builder->add('largo',IntegerType::class,array('label'  => 'Largo (cm)'));
        $builder->add('ancho',IntegerType::class,array('label'  => 'Ancho (cm)'));
        $builder->add('peso',IntegerType::class,array('label'  => 'Peso (Kg)'));
        $builder->add('estadoIva', ChoiceType::class, array(
            'choices'   => array(
                'Si' => 1,
                'No' => 0,
            ),
            'expanded'  => true,
        ));
        $builder->add('tipo', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:ProductoTipo',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
        ));
        $builder->add('precio');
        $builder->add('iva',IntegerType::class,array('label'  => 'Iva (%)'));
        $builder->add('incremento',IntegerType::class,array('label'  => 'Incremento (%)'));
        $builder->add('logistica');

        $builder->add('productoprecio', CollectionType::class, array(
            'entry_type'  => ProductoprecioType::class,
            'label'          => 'Precio producto',
            'by_reference'   => false,
            'allow_delete'   => true,
            'allow_add'      => true
        ));

        $builder->add('productoclasificacion', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Productoclasificacion',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'label'  => 'Clasificación',
        ));
        
        $builder->add('estado', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Estados',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'label'  => 'Estado',
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
        return 'producto';
    }
}
