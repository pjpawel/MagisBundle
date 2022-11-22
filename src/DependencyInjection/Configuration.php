<?php

namespace pjpawel\Magis\MagisBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    private string $projectDir;

    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('magis');

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('default_view_mode')->defaultValue('direct')->isRequired()->end()
            ->end()
        ;
        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('template_path')->defaultValue($this->projectDir . '/templates')->isRequired()->end()
            ->end()
        ;
        $treeBuilder->getRootNode()
            ->fixXmlConfig('service')
            ->children()
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