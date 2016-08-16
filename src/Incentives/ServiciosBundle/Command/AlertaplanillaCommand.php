<?php
namespace Incentives\ServiciosBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
 
class AlertaplanillaCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('incentives:alertaplanilla')
            ->setDescription('Descripción de lo que hace el comando');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        // Hacemos lo que sea
        $hoy = date("Y-m-d");
    	$fecha = strtotime('-1 day', strtotime($hoy));
   		$fecha = date('Y-m-d', $fecha);

	    //Consultar puntos redimidos
		$qb = $em->createQueryBuilder();            
	    $qb->select('p');
	    $qb->from('IncentivesInventarioBundle:Planilla','p');
	    $str_filtro = "p.planillaEstado = 1 AND p.fecha <= '".$fecha."'";
	    $qb->where($str_filtro);
	        
	    $inventario = $qb->getQuery()->getResult();

        $planillas = "";
        if(count($inventario)>0){

            foreach($inventario as $key => $value){
                $planillas .= $value->getConsecutivo().",";
            }

            $transport = \Swift_SmtpTransport::newInstance('mail.sociosyamigos.com', 25)
              ->setAuthMode('login')
              ->setUsername('pruebas@sociosyamigos.com')
              ->setPassword('7d7_r47@fqxo')
              ;
    
            // Create the Mailer using your created Transport
            $mailer = \Swift_Mailer::newInstance($transport);
    
            $message = \Swift_Message::newInstance()
                ->setSubject('Plataforma Operaciones - Planillas Por Descargar')
                ->setFrom(array('test@grupo-inc.com' => 'Grupo Inc'))
                ->setTo("manuelgb13@gmail.com,jrengifo@inc-group.co,lferro@inc-group.co,controloperaciones@inc-group.co,
                            logistica1@inc-group.co, logistica2@inc-group.co, logistica3@inc-group.co, logistica4@inc-group.co")
                ->setBody("La siguientes planillas se encuentran generadas y no han sido descargadas: ".$planillas);

            $mailer->send($message);

            $output->writeln('El correo de alerta ha sido enviado correctamente');
        }
    }
}