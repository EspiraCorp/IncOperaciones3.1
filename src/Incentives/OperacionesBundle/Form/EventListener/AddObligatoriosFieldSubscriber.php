<?php
namespace Incentives\OperacionesBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AddObligatoriosFieldSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // Informa al despachador que deseas escuchar el evento
        // form.pre_set_data y se debe llamar al método 'preSetData'.
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        // check if the product object is "new"
        // If you didn't pass any data to the form, the data is "null".
        // This should be considered a new "Product"
        if (null === $data) {
            return;
        }

        // comprueba si el objeto producto es "nuevo"
        if (!$data->getId()) {
            $form->add('nombre');
            $form->add('tipodocumento', 'entity', array(
                'class' => 'IncentivesOperacionesBundle:Tipodocumento',
                'property' => 'nombre',
            ));
            $form->add('numero_documento');
            $form->add('correo');
        }
    }
}
