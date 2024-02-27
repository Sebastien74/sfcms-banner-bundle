<?php

namespace Sfcms\BannerBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Finder\Finder;

/*
 * BannerExtension.
 *
 * (c) Sébastien FOURNIER <fournier.sebastien@outlook.com>
 */
class BannerExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configDirname = __DIR__ . '/../../config/';
        $loader = new YamlFileLoader($container, new FileLocator($configDirname));
        $loader->load('services.yaml');
        $loader->load('routes/routes.yaml');
    }
}