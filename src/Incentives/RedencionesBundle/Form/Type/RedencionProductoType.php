<?php

namespace Incentives\RedencionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class RedencionProductoType extends AbstractType
{
	
	public $id_catalogo;
	
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
     
    function __construct($parametros) {
        $this->id_catalogo = $parametros['id_catalogo'];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		
		$id_catalogo = $this->id_catalogo;

        $builder->add('productocatalogo', EntityType::class, array(
                //'empty_value' => 'Select',
                'label' => 'Producto', 
                'class' => 'IncentivesCatalogoBundle:Productocatalogo', 
                'choice_label' => 'producto.nombreId', 
                'query_builder' => function(\Doctrine\ORM\EntityRepository $er) use ($id_catalogo) {
                    return $er->createQueryBuilder('p')
                    ->addSelect('pd')
                    ->Leftjoin('p.producto', 'pd')
                    ->where('p.catalogos='.$id_catalogo)
                    ;

               }
            ))
           ;

        $builder->add('Enviar', SubmitType::class);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\RedencionesBundle\Entity\Redenciones'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'redencionproducto';
    }
    
}
