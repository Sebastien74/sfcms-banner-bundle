<?php

declare(strict_types=1);

namespace Sfcms\BannerBundle;

use Sfcms\BannerBundle\DependencyInjection\BannerExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

/**
 * SfcmsBannerBundle.
 *
 * (c) Sébastien FOURNIER <fournier.sebastien@outlook.com>
 */
class SfcmsBannerBundle extends AbstractBundle
{
    private const string EXTENSION_NAME = 'sfcms_banner';

    private const string ALIAS = 'SfcmsBanner';

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new BannerExtension(self::EXTENSION_NAME, self::ALIAS);
    }

    /**
     * {@inheritdoc}
     */
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}