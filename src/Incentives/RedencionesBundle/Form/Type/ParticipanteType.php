<?php

namespace Incentives\RedencionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class ParticipanteType extends AbstractType
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

        $builder->add('tipodocumento', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Tipodocumento',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
        ));

        $builder->add('ciudad', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Ciudad',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
        ));

        $builder->add('programa', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Programa',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
        ));



        $builder->add('Enviar', SubmitType::class);
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
