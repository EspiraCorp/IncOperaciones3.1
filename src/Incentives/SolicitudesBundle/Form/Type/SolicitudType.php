<?php

namespace Incentives\SolicitudesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class SolicitudType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titulo');
        $builder->add('descripcion','textarea');
        $builder->add('mantis');
        
        $builder->add('tipo', 'entity', array(
            'class' => 'IncentivesSolicitudesBundle:SolicitudTipo',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opción',
            'label' => 'Tipo'
        ));
        
        $builder->add('prioridad', 'entity', array(
            'class' => 'IncentivesSolicitudesBundle:Prioridad',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opción',
            'label' => 'Prioridad'
        ));
        
        $builder->add('programa', 'entity', array(
            'class' => 'IncentivesCatalogoBundle:Programa',
            'property' => 'nombreCC',
            'empty_value' => 'Seleccione una opción',
            'label' => 'Centro Costos',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('p')
                    ->orderBy('p.centrocostos', 'ASC');
            },
        ));
        
        $builder->add('estado', 'entity', array(
            'class' => 'IncentivesSolicitudesBundle:SolicitudesEstado',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opción',
            'label' => 'Estado',
        ));
        
        $builder->add('solicitante', 'entity', array(
            'class' => 'IncentivesBaseBundle:Usuario',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opción',
            'label' => 'Solicitante',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->Join('u.grupos','g')
                    ->Where('g.id in (8,14)')
                    ->orderBy('u.nombre', 'ASC');
            },
        ));
       
        $builder->add('Enviar', 'submit');

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
