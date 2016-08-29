<?php

namespace Incentives\FacturacionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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

        /*$builder->add('tipo', 'entity', array(
            'class' => 'IncentivesFacturacionBundle:Tipocostos',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Tipo'
        ));*/

        $builder->add('Enviar', 'submit');
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
