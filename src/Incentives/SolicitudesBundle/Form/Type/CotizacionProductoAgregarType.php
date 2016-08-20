<?php

namespace Incentives\SolicitudesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Incentives\CatalogoBundle\Entity\ProductoRepository;
use Doctrine\ORM\EntityRepository;

class CotizacionProductoAgregarType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad', 'integer', array('attr' => array('step'=>'1',
                'min'=>'0',
                'max'=>'100000')))
        ->add('valorunidad', 'number', array('label' => 'Valor Unidad'))
        ->add('logistica', 'number', array('label' => 'Logistica Unidad'))
        ->add('incremento', 'number', array('label' => 'Incremento'))
        ;

        $builder->add('producto', 'entity', array(
            'class' => 'IncentivesCatalogoBundle:Producto',
            'query_builder' => function(EntityRepository $repository) { 
                return $repository->createQueryBuilder('p')
					->where('p.estado = 1')
					->orderBy('p.codInc', 'ASC');
            },
            'property' => 'nombreId',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Producto'
        ));

        $builder->add('Enviar', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\SolicitudesBundle\Entity\CotizacionProducto',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cotizacionproducto';
    }
}
