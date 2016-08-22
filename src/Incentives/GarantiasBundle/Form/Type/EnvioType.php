<?php

namespace Incentives\GarantiasBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EnvioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('documento')
            ->add('ciudadNombre')
            ->add('direccion')
	    ->add('barrio')
            ->add('telefono')
	    ->add('celular')
	    ->add('departamentoNombre')
	    ->add('nombreContacto')
            ->add('documentoContacto')
            ->add('ciudadContacto')
            ->add('direccionContacto')
            ->add('barrioContacto')
            ->add('telefonoContacto')
            ->add('celularContacto')
            ->add('departamentoContacto');


        $builder->add('Enviar', SubmitType::class);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\RedencionesBundle\Entity\Redencionesenvios'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'envios';
    }
}
