<?php

namespace Incentives\RedencionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class RedencionProductoType extends AbstractType
{
	
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('producto', EntityType::class, array(
                //'empty_value' => 'Select',
                'label' => 'Producto', 
                'class' => 'IncentivesCatalogoBundle:Producto',
                'choice_label' => 'codInc',
                //'choice_label' => 'producto.nombreId', 
                'query_builder' => function(\Doctrine\ORM\EntityRepository $er){
                    return $er->createQueryBuilder('p')
                    ->addSelect('p')
                    ->where('p.estado = 1')
                    ->orderBy('p.codInc');
               })
            );

        $builder->add('Enviar', SubmitType::class);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\RedencionesBundle\Entity\RedencionesProductos'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'redencionproducto';
    }
    
}
