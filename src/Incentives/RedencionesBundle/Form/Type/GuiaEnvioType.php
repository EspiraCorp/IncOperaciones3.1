<?php

namespace Incentives\RedencionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GuiaEnvioType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('guia')
            ->add('valor')
        ;

        $builder->add('ordenProducto', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:OrdenesProducto',
            'choice_label' => 'id',
            //'empty_value' => 'Seleccione una opcion',
        ));

        $builder->add('courier', EntityType::class, array(
            'class' => 'IncentivesInventarioBundle:Courier',
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
            'data_class' => 'Incentives\RedencionesBundle\Entity\GuiaEnvio'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'guiaenvio';
    }
}
