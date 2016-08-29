<?php

namespace Incentives\RedencionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class JustificacionEnvioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('justificacion', EntityType::class, array(
                //'empty_value' => 'Select',
                'label' => 'Justificacion', 
                'class' => 'IncentivesRedencionesBundle:Justificacion', 
                'choice_label' => 'nombre', 
            ))
           ;
           
        $builder->add('observacionJustificacion');

        $builder->add('Enviar', SubmitType::class);
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
