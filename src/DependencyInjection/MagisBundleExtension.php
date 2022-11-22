<?php

namespace pjpawel\Magis\MagisBundle\DependencyInjection;

use pjpawel\Magis\ViewDispatcherService;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class MagisBundleExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration($container->get('%kernel.project_dir%'));
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition(ViewDispatcherService::class);
        $definition->replaceArgument(0, $config['default_view_mode']);
        $definition->replaceArgument(1, $config['template_path']);
        $definition->replaceArgument(2, $config['services']);
    }



}