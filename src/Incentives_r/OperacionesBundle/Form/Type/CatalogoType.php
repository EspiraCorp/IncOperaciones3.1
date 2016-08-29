<?php
// src/Acme/operacionesBundle/Form/Type/ArchivosType.php

namespace Incentives\OperacionesBundle\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

 
class CatalogoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('descripcion');
        $builder->add('archivo', 'file');
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
   {
       $resolver->setDefaults(array(
           'data_class' => 'Incentives\OperacionesBundle\Entity\Catalogo',
           'cascade_validation' => true,
       ));
   }

 
    public function getName()
    {
        return 'catalogo';
    }
}