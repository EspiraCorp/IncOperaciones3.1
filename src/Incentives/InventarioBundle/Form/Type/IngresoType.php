<?php

namespace Incentives\InventarioBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Incentives\CatalogoBundle\Entity\ProductoRepository;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class IngresoType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('producto', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Producto',
        'query_builder' => function(ProductoRepository $repository) { 
                return $repository->createQueryBuilder('u')->orderBy('u.nombre', 'ASC')
                    ->where('u.estado = :id')->setParameter('id', '1')
                    ->orderBy('u.codInc', 'ASC');
            },
            'choice_label' => 'nombreId',
            'placeholder' => 'Seleccionar',
            'label' => 'Producto'
        ));

        $builder->add('cantidad', IntegerType::class, array(
                'mapped' => false,
            ));
        $builder->add('valorCompra');
        $builder->add('observacion');

        $builder->add('Enviar', SubmitType::class);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\InventarioBundle\Entity\Inventario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'inventario';
    }
}
