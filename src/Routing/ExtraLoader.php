<?php

namespace Sfcms\BannerBundle\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * ExtraLoader.
 *
 * (c) Sébastien FOURNIER <fournier.sebastien@outlook.com>
 */
class ExtraLoader extends Loader
{
    private bool $isLoaded = false;

    public function load($resource, string $type = null): ?RouteCollection
    {
        dd('laod');
//        if (true === $this->isLoaded) {
//            throw new \RuntimeException('Do not add the "extra" loader twice');
//        }
//
//        $routes = new RouteCollection();
//
//        $filesystem = new Filesystem();
//        $moduleDirname = $this->projectDir.'/vendor/sfcms';
//        $moduleDirname = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $moduleDirname);
//
//        if ($filesystem->exists($moduleDirname)) {
//            $routes = new RouteCollection();
//            $finder = Finder::create();
//            $finder->in($moduleDirname)->name('routes.yaml');
//            foreach ($finder as $file) {
//                $importedRoutes = $this->import($file->getPathname(), 'yaml');
//                $routes->addCollection($importedRoutes);
//            }
//            $this->isLoaded = true;
//            return $routes;
//        }
//
//        $this->isLoaded = true;

        return null;
    }

    public function supports($resource, string $type = null): bool
    {
        return 'banner_extra_loader' === $type;
    }
}