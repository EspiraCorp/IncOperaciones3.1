<?php

namespace Incentives\SolicitudesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class SolicitudType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titulo');
        $builder->add('descripcion',TextareaType::class);
        $builder->add('mantis');
        
        $builder->add('tipo', EntityType::class, array(
            'class' => 'IncentivesSolicitudesBundle:SolicitudTipo',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opción',
            'label' => 'Tipo'
        ));
        
        $builder->add('prioridad', EntityType::class, array(
            'class' => 'IncentivesSolicitudesBundle:Prioridad',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opción',
            'label' => 'Prioridad'
        ));
        
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
        
        $builder->add('estado', EntityType::class, array(
            'class' => 'IncentivesSolicitudesBundle:SolicitudesEstado',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opción',
            'label' => 'Estado',
        ));
        
        $builder->add('solicitante', EntityType::class, array(
            'class' => 'IncentivesBaseBundle:Usuario',
            'choice_label' => 'nombre',
            //'empty_value' => 'Seleccione una opción',
            'label' => 'Solicitante',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->Join('u.grupos','g')
                    ->Where('g.id in (8,14)')
                    ->orderBy('u.nombre', 'ASC');
            },
        ));
       
        $builder->add('Enviar', SubmitType::class);

    }
 
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\SolicitudesBundle\Entity\Solicitud', //Como collection
        ));
    }

    public function getName()
    {
        return 'cotizaciones';
    }
}
