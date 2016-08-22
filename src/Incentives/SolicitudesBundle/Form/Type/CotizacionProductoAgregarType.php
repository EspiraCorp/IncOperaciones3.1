<?php

namespace Incentives\SolicitudesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Incentives\CatalogoBundle\Entity\ProductoRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class CotizacionProductoAgregarType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad', IntegerType::class, array('attr' => array('step'=>'1',
                'min'=>'0',
                'max'=>'100000')))
        ->add('valorunidad', NumberType::class, array('label' => 'Valor Unidad'))
        ->add('logistica', NumberType::class, array('label' => 'Logistica Unidad'))
        ->add('incremento', NumberType::class, array('label' => 'Incremento'))
        ;

        $builder->add('producto', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Producto',
            'query_builder' => function(EntityRepository $repository) { 
                return $repository->createQueryBuilder('p')
					->where('p.estado = 1')
					->orderBy('p.codInc', 'ASC');
            },
            'choice_label' => 'nombreId',
            //'empty_value' => 'Seleccione una opcion',
            'label' => 'Producto'
        ));

        $builder->add('Enviar', SubmitType::class);
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
