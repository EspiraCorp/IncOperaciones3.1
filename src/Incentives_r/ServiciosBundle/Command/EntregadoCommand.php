<?php
namespace Incentives\ServiciosBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
 
class EntregadoCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('incentives:entregado')
            ->setDescription('Descripción de lo que hace el comando');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
 	$em = $this->getContainer()->get('doctrine')->getManager();

	$qb = $em->createQueryBuilder();            
	$qb->select('r');
	$qb->from('IncentivesRedencionesBundle:Redenciones','r');
	$str_filtro = "r.redencionestado = 5 AND r.fechaEntrega IS NOT NULL";
	$qb->where($str_filtro);
	        
	$redenciones = $qb->getQuery()->getResult();

	$estado = $em->getRepository('IncentivesRedencionesBundle:Redencionesestado')->find('6');
		
        foreach($redenciones as $key => $value){
	     
	     	$value->setRedencionestado($estado);
		$em->persist($value);
            	$em->flush();
	     
	     	//Almacenar Historico
		$redencionH = $this->getContainer()->get('incentives_redenciones');
	    	$redencionH->insertar($value);
	}

        $output->writeln('Actualizado');
        
    }
}
