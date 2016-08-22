<?php

namespace Incentives\InventarioBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AgregarType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre');
        $builder->add('documento');
        $builder->add('ciudadNombre');
        $builder->add('direccion');
        $builder->add('departamentoNombre');
        $builder->add('telefono');
        $builder->add('celular');
        $builder->add('barrio');
        
        $builder->add('nombreContacto');
        $builder->add('documentoContacto');
        $builder->add('ciudadContacto');
        $builder->add('direccionContacto');
        $builder->add('barrioContacto');
        $builder->add('telefonoContacto');
        $builder->add('celularContacto');
        $builder->add('departamentoContacto');
        
        $builder->add('observaciones','textarea');

        $builder->add('Enviar', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\InventarioBundle\Entity\Requisicionesenvios',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'envio';
    }
}
