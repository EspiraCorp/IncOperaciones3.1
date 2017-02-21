<?php

namespace Incentives\FacturacionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            ->add('fecha', 'date', array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ))
            ->add('fechaInicio', 'date', array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ))
            ->add('fechaFin', 'date', array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ))
            ->add('numero')
            ->add('requisiciones','checkbox', array('label' => 'Requisiciones'))
            ->add('premios','checkbox', array('label' => 'Redenciones', 'attr'  => array('checked'   => 'checked')))
            ->add('logistica','checkbox', array('label' => 'Premios Con Logistica', 'attr'  => array('checked'  => 'checked')))
        ;
        
        $builder->add('pais', 'entity', array(
                'empty_value' => 'Select',
                'label' => 'Pais', 
                'class' => 'IncentivesOperacionesBundle:Pais', 
                'property' => 'nombre', 
                'query_builder' => function(\Doctrine\ORM\EntityRepository $er) use ($id_programa) {
                    return $er->createQueryBuilder('p')
                    ->addSelect('c')
                    ->Leftjoin('p.catalogo', 'c')
                    ->where('c.programa='.$id_programa)
                    ;

               }
            ))
           ;
        
        $builder->add('periodo', 'entity', array(
            'class' => 'IncentivesFacturacionBundle:Periodos',
            'property' => 'periodo',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Periodo',
            'required' => true
        ));

        $builder->add('detalle', 'collection', array(
             'type'  => new FacturaDetalleType(),
                'label'          => 'Detalle',
                'by_reference'   => false,
                'allow_delete'   => true,
                'allow_add'      => true
        ));

        $builder->add('Enviar', 'submit');
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
