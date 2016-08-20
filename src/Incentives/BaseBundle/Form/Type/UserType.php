<?php
// src/Incentives/BaseBundle/Form/Type/UserType.php

namespace Incentives\BaseBundle\Form\Type;
 

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text', array('label' => 'Usuario'));
        $builder->add('nombre', 'text', array('label' => 'Nombre'));
        $builder->add('email', 'email');
        $builder->add('grupos', 'entity', array(
            'class' => 'IncentivesBaseBundle:Grupo',
            'property'=>'nombre',
            'label' => 'Grupo',
            'multiple'  => true,
            'empty_value' => '--Seleccionar--'
        ));
        $builder->add('proveedor', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Proveedores',
            'property'=>'nombre',
            'label' => 'Proveedor',
            'empty_value' => '--Seleccionar--',
            'required' => false
        ));
        $builder->add('cliente', 'entity', array(
            'class' => 'IncentivesCatalogoBundle:Cliente',
            'property'=>'nombre',
            'label' => 'Cliente',
            'empty_value' => '--Seleccionar--',
            'required' => false
        ));
        $builder->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Las dos contraseñas deben coincidir',
                'options' => array('label' => 'Contraseña'),
                'required' => false,
        ));

        $builder->add('isActive');
        $builder->add('Enviar', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\BaseBundle\Entity\Usuario'
        ));
    }

    public function getName()
    {
        return 'usuario';
    }
}
