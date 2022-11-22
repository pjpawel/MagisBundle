<?php

namespace pjpawel\Magis\MagisBundle\DependencyInjection;

use pjpawel\Magis\ViewDispatcherService;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class MagisExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $configDir = new FileLocator(__DIR__ . '/../../config');
        $loader = new YamlFileLoader($container, $configDir);
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        //$definition = $container->getDefinition('magis');
        $definition = $container->getDefinition(ViewDispatcherService::class);
        $definition->setArgument(0, $config['default_view_mode']);
        $definition->setArgument(1, $config['template_path']);
        $definition->setArgument(2, $config['services']);
    }



}