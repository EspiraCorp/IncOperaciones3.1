<?php

namespace Incentives\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClienteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('direccion')
            ->add('telefono')
            ->add('correo')
        ;

        $builder->add('tipodocumento', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Tipodocumento',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
        ));
        $builder->add('numero_documento', 'text', array('required' => false)); 

        $builder->add('programa', 'collection', array(
            'type'  => new ProgramaclienteType(),
            'label'          => 'Programa',
            'by_reference'   => false,
            'allow_delete'   => true,
            'allow_add'      => true
        ));

        $builder->add('Enviar', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\CatalogoBundle\Entity\Cliente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cliente';
    }
}
