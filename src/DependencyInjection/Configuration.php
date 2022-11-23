<?php

namespace pjpawel\Magis\MagisBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Paweł Podgórski <pawel.jan.podgorski@gmail.com>
 */
class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('magis');
        $treeBuilder->getRootNode()
            ->fixXmlConfig('service')
            ->children()
                ->scalarNode('template_path')->defaultValue('%kernel.project_dir%/templates')->isRequired()->end()
                ->scalarNode('default_view_mode')->defaultValue('direct')->isRequired()->end()
                ->arrayNode('services')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('alias')->end()
                            ->scalarNode('service_class')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

}