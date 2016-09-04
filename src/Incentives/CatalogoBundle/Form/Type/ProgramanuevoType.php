<?php

namespace Incentives\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Incentives\CatalogoBundle\Form\Type\CatalogoprogramaType;

class ProgramanuevoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cliente', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Cliente',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
        ));
        $builder
            ->add('nombre')
            ->add('descripcion')
            ->add('fechainicio', DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ))
            ->add('fechafin', DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'single_text',
        ))
            ->add('diasentrega', IntegerType::class, array('label' => 'Días de Entrega'))
        ;

        $builder->add('centroCostos', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:CentroCostos',
            'choice_label' => 'centrocostos',
            //'empty_value' => 'Seleccione una opción',
            'label' => 'Centro Costos',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('p')
                    ->orderBy('p.centrocostos', 'ASC');
            },
        ));

        $builder->add('iva', ChoiceType::class, array(
            'choices'   => array(
                'Si' => 1,
                'No' => 0,
            ),
            'expanded'  => true,
        ));

        $builder->add('catalogos', CollectionType::class, array(
            'entry_type'  => CatalogoprogramaType::class,
            'label'          => 'Catalogo',
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
