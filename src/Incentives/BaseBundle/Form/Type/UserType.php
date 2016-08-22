<?php
// src/Incentives/BaseBundle/Form/Type/UserType.php

namespace Incentives\BaseBundle\Form\Type;
 

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class, array('label' => 'Usuario'));
        $builder->add('nombre', TextType::class, array('label' => 'Nombre'));
        $builder->add('email', EmailType::class);
        $builder->add('grupos', EntityType::class, array(
            'class' => 'IncentivesBaseBundle:Grupo',
            'choice_label'=>'nombre',
            'label' => 'Grupo',
            'multiple'  => true,
            //'empty_value' => '--Seleccionar--'
        ));
        $builder->add('proveedor', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Proveedores',
            'choice_label'=>'nombre',
            'label' => 'Proveedor',
            //'empty_value' => '--Seleccionar--',
            'required' => false
        ));
        $builder->add('cliente', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Cliente',
            'choice_label'=>'nombre',
            'label' => 'Cliente',
            //'empty_value' => '--Seleccionar--',
            'required' => false
        ));
        $builder->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Las dos contraseñas deben coincidir',
                'options' => array('label' => 'Contraseña'),
                'required' => false,
        ));

        $builder->add('isActive');
        $builder->add('Enviar', SubmitType::class);
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
