<?php

namespace Incentives\OrdenesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Incentives\CatalogoBundle\Entity\ProductoRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class OrdenesProductoAgregarType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad', IntegerType::class, array('attr' => array('step'=>'1',
                'min'=>'0',
                'max'=>'100000')))
	    ->add('centrocostos')
        ->add('valorunidad', NumberType::class, array('label' => 'Precio Compra'))
        ->add('descuento')
        ->add('precioCliente')
        ->add('incremento')
        ->add('logistica')
        ;

        $builder->add('producto', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Producto',
	    'query_builder' => function(ProductoRepository $repository) { 
                return $repository->createQueryBuilder('u')->orderBy('u.nombre', 'ASC')
					->where('u.estado = :id')->setParameter('id', '1')
					->orderBy('u.codInc', 'ASC');
            },
            'choice_label' => 'nombreId',
            //'empty_value' => 'Seleccione una opcion',
            'label' => 'Producto'
        ));

        $builder->add('programa', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Programa',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
            'label' => 'Programa'
        ));

        $builder->add('Enviar', SubmitType::class);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\OrdenesBundle\Entity\OrdenesProducto',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ordenesproducto';
    }
}
