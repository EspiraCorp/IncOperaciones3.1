<?php
// src/Incentives/OperacionesBundle/Form/Type/ContactoType.php
namespace Incentives\OperacionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder->add('nombres')
				->add('correo')
				->add('telefono' )
                ->add('movil')
				->add('cargo');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\OperacionesBundle\Entity\Contacto',
        ));
    }

    public function getName()
    {
        return 'contacto';
    }
}
