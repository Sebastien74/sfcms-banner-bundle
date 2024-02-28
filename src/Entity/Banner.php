<?php

namespace Sfcms\BannerBundle\Entity;

use App\Repository\Module\Banner\BannerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BannerRepository::class)]
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
