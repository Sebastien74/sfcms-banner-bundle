<?php

namespace App\Entity\Module\Banner;

use App\Entity\BaseTeaser;
use App\Repository\Module\Banner\TeaserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Teaser.
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
#[ORM\Table(name: 'module_banner_teaser')]
#[ORM\Entity(repositoryClass: TeaserRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Teaser extends BaseTeaser
{
    /**
     * Configurations.
     */
    protected static array $interface = [
        'name' => 'bannerteaser',
        'module' => 'banner',
    ];
}