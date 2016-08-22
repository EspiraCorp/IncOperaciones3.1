<?php

namespace Incentives\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class ProductocatalogoProdType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('activo', CheckboxType::class, array(
            'required' => false
        ) )
            ->add('puntosTemporal')
            ->add('precioTemporal')
            ->add('incrementoTemporal')
            ->add('logisticaTemporal')
            ->add('agotado');
            
        $builder->add('catalogos', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Catalogos',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
            'query_builder' => function(\Doctrine\ORM\EntityRepository $er) { 
                return $er->createQueryBuilder('u')->orderBy('u.nombre', 'ASC')
					->where('u.estado = :id')->setParameter('id', '1')
					->orderBy('u.nombre', 'ASC');
            },
        ));
        
         $builder->add('categoria', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Categoria',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
            'label' => 'Subcategoria',
        ));

        $builder->add('actualizacion', ChoiceType::class, array(
            'choices'   => array(
                0   => 'Automatica',
                1 => 'Manual',
            ),
            'expanded'  => true,
        ));
        $builder->add('Enviar', SubmitType::class);
        
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
