<?php
// src/Incentives/OperacionesBundle/Form/Type/ContactoType.php
namespace Incentives\BaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class PassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Las dos contraseñas deben coincidir',
                'first_options'  => array('label' => 'Nueva Contraseña'),
                'second_options' => array('label' => 'Repetir Contraseña'),
                'required' => false));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\BaseBundle\Entity\Usuario',
            'validation_groups' => array('clave') //Como collection
        ));
    }

    public function getName()
    {
        return 'password';
    }
}
