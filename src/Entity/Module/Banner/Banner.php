<?php

namespace App\Entity\Module\Banner;

use App\Repository\Module\Banner\BannerRepository;
use App\Repository\Module\Catalog\CatalogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Catalog.
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
#[ORM\Table(name: 'module_banner')]
#[ORM\Entity(repositoryClass: BannerRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Banner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
