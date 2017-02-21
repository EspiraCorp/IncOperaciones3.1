<?php

namespace Incentives\FacturacionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollecctionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class FacturaType extends AbstractType
{
    
    public $id_programa;
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
     
     
     
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('fecha', DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'single_text',
            'required' => true
        ))
            ->add('fechaInicio', DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'single_text',
            'required' => true
        ))
            ->add('fechaFin', DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'single_text',
            'required' => true
        ))
            ->add('numero')
            ->add('requisiciones', CheckboxType::class, array('label' => 'Requisiciones'))
            ->add('premios', CheckboxType::class, array('label' => 'Redenciones', 'attr'  => array('checked'   => 'checked')))
            ->add('logistica', CheckboxType::class, array('label' => 'Premios Con Logistica', 'attr'  => array('checked'  => 'checked')))
        ;
        
        $builder->add('pais', EntityType::class, array(
                //'empty_value' => 'Select',
                'label' => 'Pais', 
                'class' => 'IncentivesOperacionesBundle:Pais', 
                'choice_label' => 'nombre'
            ))
           ;
        
        $builder->add('periodo', EntityType::class, array(
            'class' => 'IncentivesFacturacionBundle:Periodos',
            'choice_label' => 'periodo',
            'placeholder' => 'Seleccionar',
            'label' => 'Periodo',
            'required' => true
        ));

        /*$builder->add('detalle', CollectionType::class, array(
             'type'  => new FacturaDetalleType(),
                'label'          => 'Detalle',
                'by_reference'   => false,
                'allow_delete'   => true,
                'allow_add'      => true
        ));*/

        $builder->add('Enviar', SubmitType::class);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\FacturacionBundle\Entity\Factura',
            'cascade_validation' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'factura';
    }
}
