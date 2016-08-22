<?php

namespace Incentives\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProgramaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('descripcion')
            ->add('fechainicio','date', array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ))
            ->add('fechafin','date', array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ))
            ->add('diasentrega')
        ;
        
        $builder->add('centrocostos');

         $builder->add('iva', 'choice', array(
            'choices'   => array(
                0   => 'Si',
                1 => 'No',
            ),
            'expanded'  => true,
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
