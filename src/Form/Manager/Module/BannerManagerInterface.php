<?php

namespace App\Form\Manager\Module;

use App\Entity\Core\Website;
use App\Entity\Module\Banner\Banner;

/**
 * BannerManagerInterface.
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
interface BannerManagerInterface
{
    public function prePersist(Banner $banner, Website $website): void;
}