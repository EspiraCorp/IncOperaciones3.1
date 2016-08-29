<?php
// src/Incentives/BaseBundle/Form/Type/RegistrationType.php
namespace Incentives\BaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('user', new UserType());
        $builder->add(
            'Terminos y condiciones',
            CheckboxType::classs,
            array('property_path' => 'termsAccepted')
        );
    }

    public function getName()
    {
        return 'registration';
    }
}