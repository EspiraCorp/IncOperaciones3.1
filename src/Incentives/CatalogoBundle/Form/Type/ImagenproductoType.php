<?php

namespace Incentives\CatalogoBundle\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

 
class ImagenproductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('path', 'file');
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
   {
       $resolver->setDefaults(array(
           'data_class' => 'Incentives\CatalogoBundle\Entity\Imagenproducto',
           'cascade_validation' => true,
       ));
   }

 
    public function getName()
    {
        return 'imagenproducto';
    }
}