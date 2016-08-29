<?php

namespace Incentives\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductocatalogoProdType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('activo', 'checkbox', array(
            'required' => false
        ) )
            ->add('puntosTemporal')
            ->add('precioTemporal')
            ->add('incrementoTemporal')
            ->add('logisticaTemporal')
            ->add('agotado');
            
        $builder->add('catalogos', 'entity', array(
            'class' => 'IncentivesCatalogoBundle:Catalogos',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'query_builder' => function(\Doctrine\ORM\EntityRepository $er) { 
                return $er->createQueryBuilder('u')->orderBy('u.nombre', 'ASC')
					->where('u.estado = :id')->setParameter('id', '1')
					->orderBy('u.nombre', 'ASC');
            },
        ));
        
         $builder->add('categoria', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Categoria',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Subcategoria',
        ));

        $builder->add('actualizacion', 'choice', array(
            'choices'   => array(
                0   => 'Automatica',
                1 => 'Manual',
            ),
            'expanded'  => true,
        ));
        $builder->add('Enviar', 'submit');
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\CatalogoBundle\Entity\Productocatalogo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'productocatalogo';
    }
}
