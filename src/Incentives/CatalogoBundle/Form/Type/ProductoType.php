<?php

namespace Incentives\catalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Incentives\CatalogoBundle\Form\Type\ImagenproductoType;
use Incentives\CatalogoBundle\Form\Type\ProductoprecioType;
use Incentives\CatalogoBundle\Form\EventListener\AddImagenproductoFieldSubscriber;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre');
        $builder->add('categoria', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Categoria',
            'property' => 'nombre',
            'empty_value' => 'Seleccionar',
        ));
        $builder->add('referencia');
        $builder->add('marca');
        $builder->add('descripcion');
        $builder->add('codEAN','text',array('label'  => 'EAN', 'required' => false));
        $builder->add('codInc');
        $builder->add('alto','integer',array('label'  => 'Alto (cm)',));
        $builder->add('largo','integer',array('label'  => 'Largo (cm)',));
        $builder->add('ancho','integer',array('label'  => 'Ancho (cm)',));
        $builder->add('peso','integer',array('label'  => 'Peso (Kg)',));
        $builder->add('estadoIva', 'choice', array(
            'choices'   => array(
                1   => 'Si',
                0 => 'No',
            ),
            'expanded'  => true,
        ));
        $builder->add('tipo', 'entity', array(
            'class' => 'IncentivesCatalogoBundle:ProductoTipo',
            'property' => 'nombre',
            'empty_value' => 'Seleccionar',
        ));
        $builder->add('iva');
        $builder->add('incremento');
        $builder->add('logistica');
        $builder->addEventSubscriber(new AddImagenproductoFieldSubscriber());
        // $builder->add('imagenproducto', 'collection', array(
        //     'type'  => new ImagenproductoType(),
        //     'label'          => 'Imagen producto',
        //     'by_reference'   => false,
        //     'allow_delete'   => true,
        //     'allow_add'      => true
        // ));
        $builder->add('productoprecio', 'collection', array(
            'type'  => new ProductoprecioType(),
            'label'          => 'Precio producto',
            'by_reference'   => false,
            'allow_delete'   => true,
            'allow_add'      => true
        ));

        $builder->add('productoclasificacion', 'entity', array(
            'class' => 'IncentivesCatalogoBundle:Productoclasificacion',
            'property' => 'nombre',
            'empty_value' => 'Seleccionar',
            'label'  => 'Clasificación',
        ));
        
        $builder->add('estado', 'entity', array(
            'class' => 'IncentivesCatalogoBundle:Estados',
            'property' => 'nombre',
            'empty_value' => 'Seleccionar',
            'label'  => 'Estado',
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
        return 'producto';
    }
}
