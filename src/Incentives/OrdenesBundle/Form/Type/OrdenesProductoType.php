<?php

namespace Incentives\OrdenesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Incentives\CatalogoBundle\Entity\ProductoRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class OrdenesProductoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cantidad', IntegerType::class, array('attr' => array('step'=>'1',
                'min'=>'0',
                'max'=>'100000')))
	           ->add('centrocostos');

        $builder->add('producto', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Producto',
            'query_builder' => function(ProductoRepository $repository) { 
                return $repository->createQueryBuilder('u')->orderBy('u.nombre', 'ASC')
					->where('u.estado = :id')->setParameter('id', '1');
            },
            'choice_label' => 'label',
            'placeholder' => 'Seleccionar',
            'label' => 'Producto'
        ));
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
