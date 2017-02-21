<?php

namespace Incentives\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProgramaclienteType extends AbstractType
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
            ->add('fechainicio',DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ))
            ->add('fechafin',DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ))
        ;

        $builder->add('logistica', PercentType::class);

         $builder->add('iva', ChoiceType::class, array(
            'choices'   => array(
                0   => 'Si',
                1 => 'No',
            ),
            'expanded'  => true,
        ));


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
