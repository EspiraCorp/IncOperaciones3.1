<?php

namespace Incentives\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProgramanuevoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cliente', 'entity', array(
            'class' => 'IncentivesCatalogoBundle:Cliente',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
        ));
        $builder
            ->add('nombre')
            ->add('descripcion')
            ->add('fechainicio', 'date', array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ))
            ->add('fechafin', 'date', array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ))
            ->add('centrocostos', 'text', array('label' => 'Centro de Costos'))
            ->add('diasentrega', 'integer', array('label' => 'Días de Entrega'))
        ;

        $builder->add('iva', 'choice', array(
            'choices'   => array(
                1   => 'Si',
                0 => 'No',
            ),
            'expanded'  => true,
        ));

        $builder->add('catalogos', 'collection', array(
            'type'  => new CatalogoprogramaType(),
            'label'          => 'Catalogo',
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
            'data_class' => 'Incentives\CatalogoBundle\Entity\Programa'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'programa';
    }
}
