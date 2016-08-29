<?php

namespace Incentives\OrdenesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Incentives\OperacionesBundle\Entity\ProveedoresRepository;

class OrdenesCompraType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaCreacion', 'date', array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ));

        $builder
            ->add('fechaVencimiento', 'date', array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ));

        $builder
            ->add('descuento');

        $builder
            ->add('domicilio');
            
        $builder
            ->add('servicioLogistico');
        $builder
            ->add('comisionBancaria');
        $builder
            ->add('trm');
            
        $builder
            ->add('aplicaIva');
        $builder
            ->add('facturarCostos');

        $builder
            ->add('observaciones')
            ->add('cancelado')
        ;

        $builder->add('proveedor', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Proveedores',
	        'query_builder' => function(ProveedoresRepository $repository) { 
                return $repository->createQueryBuilder('u')->orderBy('u.nombre', 'ASC')
					->where('u.estado = :id')->setParameter('id', '1');
            },
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Proveedor'
        ));

        $builder->add('pais', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Pais',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Pais'
        ));
        
        $builder->add('categoria', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Categoria',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Categoria'
        ));
        
        $builder->add('programa', 'entity', array(
            'class' => 'IncentivesCatalogoBundle:Programa',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Programa'
        ));
        
        $builder->add('monedaTipo', 'entity', array(
            'class' => 'IncentivesOrdenesBundle:MonedaTipo',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Tipo de Moneda'
        ));

        $builder->add('ordenesEstado', 'entity', array(
            'class' => 'IncentivesOrdenesBundle:ordenesEstado',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Estado'
        ));

        $builder->add('ordenesProducto', 'collection', array(
             'type'  => new OrdenesProductoType(),
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
