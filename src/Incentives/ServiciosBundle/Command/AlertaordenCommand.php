<?php
namespace Incentives\ServiciosBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
 
class AlertaordenCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('incentives:alertaorden')
            ->setDescription('Descripción de lo que hace el comando');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

	    //Consultar puntos redimidos
		$qb = $em->createQueryBuilder();            
	    $qb->select('o');
	    $qb->from('IncentivesOrdenesBundle:OrdenesCompra','o');
	    $str_filtro = "o.ordenesEstado = 4";
	    $qb->where($str_filtro);
	        
	    $ordenescompra = $qb->getQuery()->getResult();

        $ordenes = "";
        if(count($ordenescompra)>0){

            foreach($ordenescompra as $key => $value){
                $ordenes .= $value->getConsecutivo().",";
            }

            $transport = \Swift_SmtpTransport::newInstance('mail.sociosyamigos.com', 25)
              ->setAuthMode('login')
              ->setUsername('pruebas@sociosyamigos.com')
              ->setPassword('7d7_r47@fqxo')
              ;
    
            // Create the Mailer using your created Transport
            $mailer = \Swift_Mailer::newInstance($transport);
    
            $message = \Swift_Message::newInstance()
                ->setSubject('Plataforma Operaciones - Orden Incompleta')
                ->setFrom(array('test@grupo-inc.com' => 'Grupo Inc'))
                ->setTo("manuelgb13@gmail.com,jrengifo@inc-group.co,lferro@inc-group.co,controloperaciones@inc-group.co")
                ->setBody("La siguientes ordenes se encuentran incompletas: ".$ordenes);

            $mailer->send($message);

            $output->writeln('El correo de alerta ha sido enviado correctamente');
        }
    }
}