<?php
namespace Incentives\ServiciosBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
 
class AlertaDespachoCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('incentives:alertadespacho')
            ->setDescription('Descripción de lo que hace el comando');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        // Hacemos lo que sea
        $hoy = date("Y-m-d H:i:s");
    	$fecha = strtotime('-2 day', strtotime($hoy));
   		$fecha = date('Y-m-d H:i:s', $fecha);

	    //Consultar puntos redimidos
		$qb = $em->createQueryBuilder();            
	    $qb->select('i');
	    $qb->from('IncentivesInventarioBundle:Inventario','i');
	    $str_filtro = "i.ingreso = 1 AND i.salio = 0 AND i.redencion IS NULL AND i.planilla IS NULL AND i.fechaEntrada <= '".$fecha."'";
	    $qb->where($str_filtro);
	        
	    $inventario = $qb->getQuery()->getResult();

        if(count($inventario)>0){

            $transport = \Swift_SmtpTransport::newInstance('mail.sociosyamigos.com', 25)
              ->setAuthMode('login')
              ->setUsername('pruebas@sociosyamigos.com')
              ->setPassword('7d7_r47@fqxo')
              ;
    
            // Create the Mailer using your created Transport
            $mailer = \Swift_Mailer::newInstance($transport);
    
            $message = \Swift_Message::newInstance()
                ->setSubject('Plataforma Operaciones - Inventario Sin Despachar')
                ->setFrom(array('test@grupo-inc.com' => 'Grupo Inc'))
                ->setTo("manuelgb13@gmail.com,jrengifo@inc-group.co,lferro@inc-group.co,controloperaciones@inc-group.co,
                        logistica1@inc-group.co,logistica2@inc-group.co,logistica3@inc-group.co,logistica4@inc-group.co")
                ->setBody("Hay inventario ingresado con mas de dos dias sin despachar.");

            $mailer->send($message);

            $output->writeln('El correo de alerta ha sido enviado correctamente');
        }
    }
}