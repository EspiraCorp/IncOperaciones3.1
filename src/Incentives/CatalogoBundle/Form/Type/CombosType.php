<?php

namespace Incentives\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CombosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('descripcion')
            ->add('marca')
            ->add('referencia')
            ->add('puntosTemporal')
            ->add('precioTemporal')
            ->add('incrementoTemporal')
            ->add('logisticaTemporal')
            ->add('agotado')
            ->add('imagen', FileType::class);
        
        $builder->add('categoria', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Categoria',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'label' => 'Subcategoria',
        ));

        $builder->add('premiosproductos',CollectionType::class, array(
            // each entry in the array will be an "email" field
            'entry_type' => EntityType::class,
            'entry_options' => array
                (
                    'class' => 'IncentivesCatalogoBundle:Producto',
                    'choice_label' => 'codInc',
                    'attr' => array('class' => 'form-control producto-combo'),
                    'query_builder' => function(\Doctrine\ORM\EntityRepository $er){
                        return $er->createQueryBuilder('p')
                        ->addSelect('p')
                        ->where('p.estado = 1')
                        ->orderBy('p.codInc');
                    }
                ),
            'allow_add' => true,
            'prototype' => true,
            'prototype_data' => 'Seleccionar',
            'attr' => array('class' => 'form-control productoCombo'),
        ));


        $builder->add('Enviar', SubmitType::class);
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\CatalogoBundle\Entity\Premios'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'premio';
    }
}
