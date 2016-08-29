<?php

namespace Incentives\InventarioBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class PlanillaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('planillatipo', EntityType::class, array(
            'class' => 'IncentivesInventarioBundle:PlanillaTipo',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
            'required' => false
        ));
        
        $builder->add('categoria', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Categoria',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
            'required' => false
        ));

        $builder->add('pais', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Pais',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
            'required' => false
        ));

        $builder->add('Enviar', SubmitType::class);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\InventarioBundle\Entity\Planilla',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'planilla';
    }
}
