<?php

namespace Sfcms\BannerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Routing\Loader\YamlFileLoader as RoutingYamlFileLoader;
use Symfony\Component\Serializer\Mapping\Loader\XmlFileLoader;

/**
 * BannerExtension.
 *
 * (c) Sébastien FOURNIER <fournier.sebastien@outlook.com>
 */
class BannerExtension extends Extension implements PrependExtensionInterface
{
    private string $extensionName;
    private string $alias;

    /**
     * BannerExtension construct.
     */
    public function __construct(string $extensionName, string $alias)
    {
        $this->extensionName = $extensionName;
        $this->alias = $alias;
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $processor = new Processor();
        $configuration = new Configuration($this->extensionName);
        $config = $processor->processConfiguration($configuration, $configs);

        $configDirname = __DIR__ . '/../../config/';
        $loader = new YamlFileLoader($container, new FileLocator($configDirname));

        $this->addAnnotatedClassesToCompile([
            'Sfcms\\BannerBundle\\Controller\\**',
            'Sfcms\\BannerBundle\\Entity\\**',
            'Sfcms\\BannerBundle\\Form\\**',
            'Sfcms\\BannerBundle\\Repository\\**',
        ]);
        $loader->load('services.yaml');

//        $this->loadRoutes($container, $configDirname);
    }

    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container): void
    {
//        $bundles = $container->getParameter('kernel.bundles');
////        if (!isset($bundles['SfcmsBannerBundle'])) {
//            // disable AcmeGoodbyeBundle in bundles
//            $config = ['acme_something' => 'sdqfdsfsfdsfdsfdsfds'];
//            foreach ($container->getExtensions() as $name => $extension) {
//
//                match ($name) {
//                    // set use_acme_goodbye to false in the config of
//                    // acme_something and acme_other
//                    //
//                    // note that if the user manually configured
//                    // use_acme_goodbye to true in config/services.yaml
//                    // then the setting would in the end be true and not false
//                    'acme_something', 'acme_other' => $container->prependExtensionConfig($name, $config),
//                    default => null
//                };
//            }
////        }
////        dd($container->getExtensions());
//
//        $configs = $container->getExtensionConfig($this->getAlias());

//        foreach (array_reverse($configs) as $config) {
//            // check if entity_manager_name is set in the "acme_hello" configuration
//            if (isset($config['entity_manager_name'])) {
//                // prepend the acme_something settings with the entity_manager_name
//                $container->prependExtensionConfig('acme_something', [
//                    'entity_manager_name' => $config['entity_manager_name'],
//                ]);
//            }
//        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias(): string
    {
        return $this->extensionName;
    }

//    private function loadRoutes(ContainerBuilder $container, string $configDirname)
//    {
//        dd($rootNode);
////
////        $fileRecorder = function ($extension, $path) use (&$serializerLoaders) {
////            $definition = new Definition(\in_array($extension, ['yaml', 'yml']) ? \Symfony\Component\Serializer\Mapping\Loader\YamlFileLoader::class : XmlFileLoader::class, [$path]);
////            $serializerLoaders[] = $definition;
////        };
//
////        $routesLoader = new RoutingYamlFileLoader(new FileLocator($configDirname));
////        $collection = $routesLoader->load('routes/routes.yaml');
////        $container->addResource(new FileResource($configDirname.'routes/routes.yaml'));
////
////        // Here you would somehow add $collection (RouteCollection) to your application's routes
////        // This step is tricky and might need custom handling as Symfony doesn't have a built-in way
////        // to merge RouteCollections from a bundle into the main application automatically.
//    }
}