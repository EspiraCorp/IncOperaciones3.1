<?php
// src/Incentives/OperacionesBundle/Form/Type/ContactoType.php
namespace Incentives\OperacionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ConvocatoriasArchivosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder->add('archivo', FileType::class);
		
		$builder->add('Enviar', SubmitType::class);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\OperacionesBundle\Entity\ConvocatoriasArchivos',
        ));
    }

    public function getName()
    {
        return 'archivos';
    }
}
