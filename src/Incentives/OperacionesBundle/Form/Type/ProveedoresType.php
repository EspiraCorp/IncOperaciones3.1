<?php

// src/Sinaptica/OperacionesBundle/Form/Type/ProveedoresType.php
namespace Incentives\OperacionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Incentives\OperacionesBundle\Form\EventListener\AddContactoFieldSubscriber;
use Incentives\OperacionesBundle\Form\EventListener\AddAeconomicaFieldSubscriber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class ProveedoresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre');
        $builder->add('tipodocumento', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Tipodocumento',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'label' => 'Tipo de Documento',
        ));
        $builder->add('numero_documento', TextType::class); 
        $builder->add('registro_camara', TextType::class, array('required' => false)); 
        $builder->add('regimen', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Regimen',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'required' => false
        ));
        $builder->add('sede_principal', TextType::class, array('required' => false)); 

        $builder->add('pais', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Pais',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'required' => false
        ));
        $builder->add('ciudad', 'PUGX\AutocompleterBundle\Form\Type\AutocompleteType', array(
			'class' => 'IncentivesOperacionesBundle:Ciudad',
			//'choice_label' => 'nombre',
            //'placeholder' => 'Seleccionar',
            'required' => false
		));
        $builder->add('categoria', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Categoria',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'required' => false
        ));

        $builder->add('proveedortipo', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:ProveedoresTipo',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'label' => 'Tipo'
        ));

        $builder->add('proveedorclasificacion', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:ProveedoresClasificacion',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'label' => 'Clasificacion'
        ));
		$builder->add('proveedorarea', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:ProveedoresArea',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'label' => 'Area'
        ));
		$builder->add('directo');
		$builder->add('direccion', TextType::class, array('required' => false));
        $builder->add('telefono', TextType::class, array('required' => false));
        $builder->add('correo');
        $builder->add('pagina', TextType::class, array('required' => false));
        $builder->add('sedes', CheckboxType::class, array('required' => false));
        $builder->add('datos_sedes', TextareaType::class, array('required' => false));
        $builder->add('tiempo_entrega', IntegerType::class, array('required' => false));
        $builder->add('lineaAtencion', TextType::class, array('required' => false));

         $builder->add('Enviar', SubmitType::class);

    }
 
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Incentives\OperacionesBundle\Entity\Proveedores'
        );
    }

    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\OperacionesBundle\Entity\Proveedores',
            'cascade_validation' => true,
            'validation_groups' => array('registro')
        ));
    }

    public function getName()
    {
        return 'proveedores';
    }
}
