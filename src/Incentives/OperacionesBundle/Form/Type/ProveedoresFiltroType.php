<?php

// src/Sinaptica/OperacionesBundle/Form/Type/ProveedoresType.php
namespace Incentives\OperacionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class ProveedoresFiltroType extends AbstractType
{
    
     public $pais_id;
     public $nombre;
     public $ciudad_id;
     public $numero_documento;
     public $correo;
     public $estado_id;
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
     
     
    function valores($filtros) {
        
        $this->pais_id = (isset($filtros['pais'])) ? $filtros['pais'] : "";
        $this->ciudad_id = (isset($filtros['ciudad'])) ? $filtros['ciudad'] : "";
        $this->nombre = (isset($filtros['nombre'])) ? $filtros['nombre'] : "";
        $this->numero_documento = (isset($filtros['numero_documento'])) ? $filtros['numero_documento'] : "";
        $this->correo = (isset($filtros['correo'])) ? $filtros['correo'] : "";
        $this->estado_id = (isset($filtros['estado'])) ? $filtros['estado'] : "";
        
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', TextType::class, array('data' => $this->nombre ));
        $builder->add('numero_documento', TextType::class, array('required' => false, 'data' => $this->numero_documento ));  
        $builder->add('pais', EntityType::class, array(
            'class' => 'IncentivesOperacionesBundle:Pais',
            'choice_label' => 'nombre',
            'empty_data' => 'Seleccione una opcion',
            'required' => false,
            'data' => $this->pais_id ,
        ));
        $builder->add('ciudad', EntityType::class, array(
			'class' => 'IncentivesOperacionesBundle:Ciudad',
			'choice_label' => 'nombre',
            'empty_data' => 'Seleccione una opcion',
            'required' => false,
            'data' => $this->ciudad_id ,
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

        $builder->add('estado', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Estados',
            'choice_label' => 'nombre',
            'label' => 'Estado',
            'placeholder' => 'Seleccionar',
            'data' => $this->estado_id,
        ));

        $builder->add('correo', TextType::class, array('data' => $this->correo ));

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
