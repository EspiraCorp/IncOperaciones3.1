<?php

namespace Incentives\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PromocionesType extends AbstractType
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
            ->add('puntos')
            ->add('cantidad')
            ->add('fechaInicio', DateType::class, array(
                    'input'  => 'datetime',
                    'widget' => 'single_text',
                ))
            ->add('fechaFin', DateType::class, array(
                    'input'  => 'datetime',
                    'widget' => 'single_text',
                ));

        $builder->add('Enviar', SubmitType::class);
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\CatalogoBundle\Entity\Promociones'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'promociones';
    }
}
