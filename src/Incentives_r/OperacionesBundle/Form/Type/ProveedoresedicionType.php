<?php

// src/Sinaptica/OperacionesBundle/Form/Type/ProveedoresType.php
namespace Incentives\OperacionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Incentives\OperacionesBundle\Form\EventListener\AddContactoFieldSubscriber;
use Incentives\OperacionesBundle\Form\EventListener\AddAeconomicaFieldSubscriber;

class ProveedoresedicionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre');
        $builder->add('tipodocumento', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Tipodocumento',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
        ));
        $builder->add('numero_documento'); 
        $builder->add('registro_camara', 'text', array('required' => false)); 
        $builder->add('regimen', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Regimen',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
        ));
        $builder->add('sede_principal'); 
        $builder->add('pais', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Pais',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'required' => false
        ));
        $builder->add('ciudad', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Ciudad',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'required' => false
        ));
        $builder->add('categoria', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Categoria',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
        ));

        $builder->add('proveedorclasificacion', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:ProveedoresClasificacion',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Clasificacion'
        ));
        $builder->add('proveedorarea', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:ProveedoresArea',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Area'
        ));
		$builder->add('directo');
        $builder->add('direccion');
        $builder->add('telefono');
        $builder->add('lineaAtencion', 'text', array('required' => false));
        $builder->add('correo');
        $builder->add('pagina','url', array('required' => false));
        $builder->add('codigo_postal', 'text', array('required' => false));
        $builder->add('cobertura', 'text', array('required' => false));
        $builder->add('condiciones_comerciales', 'text', array('required' => false));
        $builder->add('tiempo_entrega', 'integer', array('required' => false));
        $builder->add('cupo_asignado','number', array('required' => false));

        $builder->add('aeconomica', 'collection', array(
                'type'  => new AeconomicaType(),
                'label'          => 'Actividad economica',
                'by_reference'   => false,
                //'prototype_data' => new Address(),
                'allow_delete'   => true,
                'allow_add'      => true
        ));
        $builder->add('sedes', 'checkbox', array('required' => false));
        $builder->add('datos_sedes', 'text', array('required' => false));
        $builder->add('Enviar', 'submit');
			
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







