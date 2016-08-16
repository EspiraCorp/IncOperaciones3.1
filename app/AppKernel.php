<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            //new AppBundle\AppBundle(),
            new Incentives\OperacionesBundle\IncentivesOperacionesBundle(),
            new Incentives\BaseBundle\IncentivesBaseBundle(),
            new Incentives\CatalogoBundle\IncentivesCatalogoBundle(),
            new Incentives\RedencionesBundle\IncentivesRedencionesBundle(),
            new Incentives\InventarioBundle\IncentivesInventarioBundle(),
            new Incentives\ServiciosBundle\IncentivesServiciosBundle(),
            new Incentives\GarantiasBundle\IncentivesGarantiasBundle(),
            new Incentives\FacturacionBundle\IncentivesFacturacionBundle(),
            new Incentives\OrdenesBundle\IncentivesOrdenesBundle(),
            new Incentives\SolicitudesBundle\IncentivesSolicitudesBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
