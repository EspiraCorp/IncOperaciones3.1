<?php

namespace Incentives\FacturacionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FacturaLogisticaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', TextareaType::class)
            ->add('cantidad')
            ->add('valorUnitario')
        ;
        
        $builder->add('Enviar', SubmitType::class);

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\FacturacionBundle\Entity\FacturaLogistica'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'facturalogistica';
    }
}
