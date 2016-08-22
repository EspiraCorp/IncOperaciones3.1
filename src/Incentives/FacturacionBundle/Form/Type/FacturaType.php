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
     
     
    function __construct($parametros) {
        
        $this->id_programa = $parametros['programa'];
    }
     
     
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $id_programa = $this->id_programa;

        $builder
            ->add('fecha', DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ))
            ->add('fechaInicio', DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ))
            ->add('fechaFin', DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'single_text',
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
                'choice_label' => 'nombre', 
                'query_builder' => function(\Doctrine\ORM\EntityRepository $er) use ($id_programa) {
                    return $er->createQueryBuilder('p')
                    ->addSelect('c')
                    ->Leftjoin('p.catalogo', 'c')
                    ->where('c.programa='.$id_programa)
                    ;

               }
            ))
           ;
        
        $builder->add('periodo', EntityType::class, array(
            'class' => 'IncentivesFacturacionBundle:Periodos',
            'choice_label' => 'periodo',
            //'empty_value' => 'Seleccione una opcion',
            'label' => 'Periodo'
        ));

        $builder->add('detalle', CollectionType::class, array(
             'type'  => new FacturaDetalleType(),
                'label'          => 'Detalle',
                'by_reference'   => false,
                'allow_delete'   => true,
                'allow_add'      => true
        ));

        $builder->add('Enviar', SubmitType::class);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\FacturacionBundle\Entity\Factura'
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
