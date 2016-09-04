<?php

namespace Incentives\FacturacionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PresupuestosType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('valor')
            ->add('mensual')
            ->add('descripcion')
        ;

        /*$builder->add('tipo', EntityType::class, array(
            'class' => 'IncentivesFacturacionBundle:Tipocostos',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'label' => 'Tipo'
        ));*/

        $builder->add('Enviar', SubmitType::class);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\FacturacionBundle\Entity\Presupuestos'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'presupuestos';
    }
}
