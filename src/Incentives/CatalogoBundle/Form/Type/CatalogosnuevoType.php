<?php

namespace Incentives\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Doctrine\ORM\EntityRepository;

class CatalogosnuevoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('programa', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Programa',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->orderBy('u.nombre', 'ASC');
            },
        ));

        $builder->add('pais', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Pais',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
        ));
        
        $builder->add('catalogotipo', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:CatalogoTipo',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
        ));

        $builder->add('estado', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Estados',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
        ));

        $builder->add('catalogotipo', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:CatalogoTipo',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
        ));
        
        $builder
            ->add('nombre')
            ->add('descripcion')
            ->add('valorPunto')
            ->add('puntosMaximos')
        ;

        $builder->add('Enviar', SubmitType::class);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\CatalogoBundle\Entity\Catalogos'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'catalogos';
    }
}
