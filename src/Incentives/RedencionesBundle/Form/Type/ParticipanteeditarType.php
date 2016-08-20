<?php

namespace Incentives\RedencionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ParticipanteeditarType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('documento')
            ->add('direccion')
            ->add('telefono')
            ->add('celular')
            ->add('barrio')
        ;

        $builder->add('tipodocumento', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Tipodocumento',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
        ));

        $builder->add('ciudad', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Ciudad',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
        ));

        $builder->add('programa', 'entity', array(
            'class' => 'IncentivesCatalogoBundle:Programa',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
        ));

        $builder->add('participanteEstado', 'entity', array(
            'class' => 'IncentivesRedencionesBundle:Participantesestado',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
        ));

        $builder->add('Enviar', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\RedencionesBundle\Entity\Participantes'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'participante';
    }
}
