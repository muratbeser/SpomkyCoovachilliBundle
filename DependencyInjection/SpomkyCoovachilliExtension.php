<?php

namespace Spomky\CoovachilliBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SpomkyCoovachilliExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor     = new Processor();
        $configuration = new Configuration($container->get('kernel.debug'));

        $config = $processor->processConfiguration($configuration, $configs);

        $container->setParameter('spomky_coovachilli.uam.secret', $config['uam']['secret']);
        $container->setParameter('spomky_coovachilli.uam.method', $config['uam']['method']);
        $container->setParameter('spomky_coovachilli.uam.uri.logon', $config['uam']['uri']['logon']);
        $container->setParameter('spomky_coovachilli.uam.uri.logoff', $config['uam']['uri']['logoff']);
        $container->setParameter('spomky_coovachilli.uam.uri.status', $config['uam']['uri']['status']);
    }

    public function getAlias()
    {
        return 'spomky_coovachilli';
    }
}
