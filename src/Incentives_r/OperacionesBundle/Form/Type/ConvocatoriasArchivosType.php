<?php
// src/Incentives/OperacionesBundle/Form/Type/ContactoType.php
namespace Incentives\OperacionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConvocatoriasArchivosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder->add('archivo', 'file');
		
		$builder->add('Enviar', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\OperacionesBundle\Entity\ConvocatoriasArchivos', //Como collection
        ));
    }

    public function getName()
    {
        return 'archivos';
    }
}
