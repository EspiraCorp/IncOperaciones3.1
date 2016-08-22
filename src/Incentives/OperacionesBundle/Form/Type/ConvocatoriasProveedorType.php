<?php
// src/Incentives/OperacionesBundle/Form/Type/ConvocatoriasProveedorType.php
namespace Incentives\OperacionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class ConvocatoriasProveedorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder->add('proveedor', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Proveedores',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opcion',
            'required' => false
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\OperacionesBundle\Entity\ConvocatoriasProveedores', //Como collection
        ));
    }

    public function getName()
    {
        return 'proveedor';
    }
}
