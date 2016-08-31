<?php

namespace Incentives\OrdenesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Incentives\OperacionesBundle\Entity\ProveedoresRepository;
use Incentives\OrdenesBundle\Form\Type\OrdenesProductoType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class OrdenesCompraType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaCreacion', DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ));

        $builder
            ->add('fechaVencimiento', DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ));

        $builder->add('descuento');
        $builder->add('domicilio'); 
        $builder->add('servicioLogistico');
        $builder->add('comisionBancaria');
        $builder->add('trm');
        $builder->add('aplicaIva');
        $builder->add('facturarCostos');
        $builder->add('observaciones')
                ->add('cancelado');

        $builder->add('proveedor', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Proveedores',
	        'query_builder' => function(ProveedoresRepository $repository) { 
                return $repository->createQueryBuilder('u')->orderBy('u.nombre', 'ASC')
					->where('u.estado = :id')->setParameter('id', '1');
            },
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
            'label' => 'Proveedor'
        ));

        $builder->add('pais', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Pais',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
            'label' => 'Pais'
        ));
        
        $builder->add('categoria', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Categoria',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
            'label' => 'Categoria'
        ));
        
        $builder->add('programa', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Programa',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
            'label' => 'Programa'
        ));
        
        $builder->add('monedaTipo', EntityType::class, array(
            'class' => 'IncentivesOrdenesBundle:MonedaTipo',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
            'label' => 'Tipo de Moneda'
        ));

        $builder->add('ordenesEstado', EntityType::class, array(
            'class' => 'IncentivesOrdenesBundle:OrdenesEstado',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
            'label' => 'Estado'
        ));

        /*$builder->add('ordenesProducto', CollectionType::class, array(
                'entry_type'  => OrdenesProductoType::class,
                'label'          => 'Productos',
                'by_reference'   => false,
                'allow_delete'   => true,
                'allow_add'      => true
        ));*/

        $builder->add('Enviar', SubmitType::class);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\OrdenesBundle\Entity\OrdenesCompra',
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
