<?php

namespace Incentives\RedencionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JustificacionEnvioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('justificacion', 'entity', array(
                'empty_value' => 'Select',
                'label' => 'Justificacion', 
                'class' => 'IncentivesRedencionesBundle:Justificacion', 
                'property' => 'nombre', 
            ))
           ;
           
        $builder->add('observacionJustificacion');

        $builder->add('Enviar', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\RedencionesBundle\Entity\Redenciones'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'justificacion';
    }
    
}
