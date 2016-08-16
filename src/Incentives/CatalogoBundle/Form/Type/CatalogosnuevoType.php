<?php

namespace Incentives\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CatalogosnuevoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('programa', 'entity', array(
            'class' => 'IncentivesCatalogoBundle:Programa',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
        ));

        $builder->add('pais', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Pais',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
        ));
        
        $builder->add('catalogotipo', 'entity', array(
            'class' => 'IncentivesCatalogoBundle:CatalogoTipo',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
        ));
        
        $builder
            ->add('nombre')
            ->add('descripcion')
            ->add('valorPunto')
            ->add('puntosMaximos')
        ;

        $builder->add('Enviar', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\CatalogoBundle\Entity\Catalogos'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'catalogos';
    }
}
