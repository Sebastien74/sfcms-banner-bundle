<?php

declare(strict_types=1);

namespace SFCms\Bundle\BannerBundle;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

/*
 * BannerBundle.
 *
 * (c) Sébastien FOURNIER <fournier.sebastien@outlook.com>
 */
class SFCmsBannerBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}