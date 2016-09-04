<?php

// src/Sinaptica/OperacionesBundle/Form/Type/ProveedoresType.php
namespace Incentives\OperacionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
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
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Incentives\OperacionesBundle\Form\Type\AeconomicaType;

class ProveedoresedicionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre');
        $builder->add('tipodocumento', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Tipodocumento',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
        ));
        $builder->add('numero_documento'); 
        $builder->add('registro_camara', TextType::class, array('required' => false)); 
        $builder->add('regimen', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Regimen',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
        ));
        $builder->add('sede_principal'); 
        $builder->add('pais', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Pais',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'required' => false
        ));
        $builder->add('ciudad', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Ciudad',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'required' => false
        ));
        $builder->add('categoria', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Categoria',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
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
        $builder->add('direccion');
        $builder->add('telefono');
        $builder->add('lineaAtencion', TextType::class, array('required' => false));
        $builder->add('correo');
        $builder->add('pagina', UrlType::class, array('required' => false));
        $builder->add('codigo_postal', TextType::class, array('required' => false));
        $builder->add('cobertura', TextType::class, array('required' => false));
        $builder->add('condiciones_comerciales', TextType::class, array('required' => false));
        $builder->add('tiempo_entrega', IntegerType::class, array('required' => false));
        $builder->add('cupo_asignado', NumberType::class, array('required' => false));

        $builder->add('aeconomica', CollectionType::class, array(
                'entry_type'  => AeconomicaType::class,
                'label'          => 'Actividad economica',
                'by_reference'   => false,
                //'prototype_data' => new Address(),
                'allow_delete'   => true,
                'allow_add'      => true
        ));
        $builder->add('sedes', CheckboxType::class, array('required' => false));
        $builder->add('datos_sedes', TextType::class, array('required' => false));
        $builder->add('Enviar', SubmitType::class);
			
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\OperacionesBundle\Entity\Proveedores',
            'cascade_validation' => true,
        ));
    }

    public function getName()
    {
        return 'proveedores';
    }
}







