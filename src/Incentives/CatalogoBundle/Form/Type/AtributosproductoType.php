<?php

namespace Incentives\CatalogoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AtributosproductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tipo', EntityType::class, array(
            'class' => 'IncentivesCatalogoBundle:Atributostipo',
            'choice_label' => 'nombre',
            'placeholder' => 'Seleccionar',
            'label'  => 'Tipo',
        ));
        $builder->add('valor');
        $builder->add('imagen', FileType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\CatalogoBundle\Entity\Atributosproducto',
            'cascade_validation' => false
        ));
    }

    public function getName()
    {
        return 'atributos';
    }
}
