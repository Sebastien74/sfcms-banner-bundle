<?php

namespace Sfcms\BannerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration.
 *
 * (c) Sébastien FOURNIER <fournier.sebastien@outlook.com>
 */
class Configuration implements ConfigurationInterface
{
    private string $extensionName;

    /**
     * Configuration construct.
     */
    public function __construct(string $extensionName)
    {
        $this->extensionName = $extensionName;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder($this->extensionName);
        $rootNode = $treeBuilder->getRootNode();
//        $rootNode->children()
//            ->arrayNode('serializer');

        return $treeBuilder;
    }
}