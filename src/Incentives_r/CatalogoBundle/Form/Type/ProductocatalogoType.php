<?php

namespace Incentives\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductocatalogoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('activo', 'checkbox', array(
            'required' => false
        ) )
            ->add('puntosTemporal')
            ->add('precioTemporal')
            ->add('incrementoTemporal')
            ->add('logisticaTemporal')
            ->add('agotado');

        $builder->add('actualizacion', 'choice', array(
            'choices'   => array(
                0   => 'Automatica',
                1 => 'Manual',
            ),
            'expanded'  => true,
        ));
        $builder->add('Enviar', 'submit');
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\CatalogoBundle\Entity\Productocatalogo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'productocatalogo';
    }
}
