<?php

namespace Incentives\InventarioBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CourierType extends AbstractType
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
            ->add('telefono')
            ->add('direccion')
            ->add('correo');

        $builder->add('tipodocumento', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Tipodocumento',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
        ));

        $builder->add('Enviar', SubmitType::class);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\InventarioBundle\Entity\Courier'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'courier';
    }
}
