<?php

namespace Incentives\InventarioBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CierreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cierreEstado', 'entity', array(
                'empty_value' => 'Select',
                'label' => 'Estado Cierre', 
                'class' => 'IncentivesInventarioBundle:CierreEstado', 
                'property' => 'nombre',
            ));
        $builder->add('observacion');
        $builder->add('fechaEntrega','date', array(
            'widget' => 'single_text',
        ));
        
        $builder->add('devolucionTipo', 'entity', array(
            'mapped' => false,
            'class' => 'IncentivesGarantiasBundle:NovedadesDevolucionTipo',
        ));

        $builder->add('Enviar', 'submit');
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

