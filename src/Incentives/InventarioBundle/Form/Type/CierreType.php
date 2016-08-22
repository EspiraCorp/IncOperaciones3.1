<?php

namespace Incentives\InventarioBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CierreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cierreEstado', EntityType::class, array(
                //'empty_value' => 'Select',
                'label' => 'Estado Cierre', 
                'class' => 'IncentivesInventarioBundle:CierreEstado', 
                'choice_label' => 'nombre',
            ));
        $builder->add('observacion');
        $builder->add('fechaEntrega',DateType::class, array(
            'widget' => 'single_text',
        ));
        
        $builder->add('devolucionTipo', EntityType::class, array(
            'mapped' => false,
            'class' => 'IncentivesGarantiasBundle:NovedadesDevolucionTipo',
        ));

        $builder->add('Enviar', SubmitType::class);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\InventarioBundle\Entity\InventarioGuia'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cierre';
    }
}

