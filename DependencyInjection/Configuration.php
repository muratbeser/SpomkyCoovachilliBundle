<?php

namespace Spomky\CoovachilliBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('spomky_coovachilli');

        $this->addUamSection($rootNode);

        return $treeBuilder;
    }

    private function addUamSection(ArrayNodeDefinition $node)
    {
        $supportedMethods = array('pap', 'chap');

        $node
            ->children()
                ->arrayNode('uam')
                    ->children()
                        ->arrayNode('uri')
                            ->children()
                                ->scalarNode('logon')->isRequired()->isRequired()->cannotBeEmpty()->defaultValue('/logon')->end()
                                ->scalarNode('logoff')->isRequired()->isRequired()->cannotBeEmpty()->defaultValue('/status')->end()
                                ->scalarNode('status')->isRequired()->isRequired()->cannotBeEmpty()->defaultValue('/logoff')->end()
                            ->end()
                        ->end()
                        ->scalarNode('secret')->end()
                        ->scalarNode('method')
                            ->validate()
                                ->ifNotInArray($supportedMethods)
                                ->thenInvalid('The method %s is not supported. Please choose one of ' . json_encode($supportedMethods))
                            ->end()
                            ->cannotBeOverwritten()
                            ->isRequired()
                            ->cannotBeEmpty()
                    ->end()
                ->end()
            ->end();
    }
}
