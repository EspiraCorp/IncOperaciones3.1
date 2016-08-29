<?php
// src/Acme/operacionesBundle/Form/Type/ArchivosType.php

namespace Incentives\OperacionesBundle\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

 
class ArchivosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Tipoarchivo', EntityType::class, array(
    	    'class' => 'IncentivesOperacionesBundle:Tipoarchivo',
    	    'choice_label'=>'nombre',
          //'empty_value' => 'Seleccione una opcion',
  	     ));
        
        $builder->add('archivo', FileType::class);
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
   {
       $resolver->setDefaults(array(
           'data_class' => 'Incentives\OperacionesBundle\Entity\Archivos',
           'cascade_validation' => true,
       ));
   }

 
    public function getName()
    {
        return 'archivos';
    }
}
