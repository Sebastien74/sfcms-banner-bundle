<?php

declare(strict_types=1);

namespace Sfcms\BannerBundle;

use Sfcms\BannerBundle\DependencyInjection\BannerExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/*
 * BannerBundle.
 *
 * (c) Sébastien FOURNIER <fournier.sebastien@outlook.com>
 */
class BannerBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new BannerExtension();
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}