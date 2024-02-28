<?php

namespace App\Entity\Module\Banner;

use App\Entity\BaseEntity;
use App\Entity\Core\Website;
use App\Repository\Module\Banner\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Category
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
#[ORM\Table(name: 'module_banner_category')]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Category extends BaseEntity
{
    /**
     * Configurations
     */
    protected static string $masterField = 'website';
    protected static array $interface = [
        'name' => 'bannercategory',
        'resize' => true
    ];

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $maxWidth = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $maxHeight = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $tabletMaxWidth = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $tabletMaxHeight = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $mobileMaxWidth = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $mobileMaxHeight = null;

    #[ORM\OneToMany(mappedBy: "category", targetEntity: Banner::class, cascade: ["persist"], orphanRemoval: true)]
    private ArrayCollection|PersistentCollection $banners;

    #[ORM\ManyToOne(targetEntity: Website::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Website $website = null;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->banners = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getMaxWidth(): ?int
    {
        return $this->maxWidth;
    }

    /**
     * @param int|null $maxWidth
     */
    public function setMaxWidth(?int $maxWidth): void
    {
        $this->maxWidth = $maxWidth;
    }

    /**
     * @return int|null
     */
    public function getMaxHeight(): ?int
    {
        return $this->maxHeight;
    }

    /**
     * @param int|null $maxHeight
     */
    public function setMaxHeight(?int $maxHeight): void
    {
        $this->maxHeight = $maxHeight;
    }

    /**
     * @return int|null
     */
    public function getTabletMaxWidth(): ?int
    {
        return $this->tabletMaxWidth;
    }

    /**
     * @param int|null $tabletMaxWidth
     */
    public function setTabletMaxWidth(?int $tabletMaxWidth): void
    {
        $this->tabletMaxWidth = $tabletMaxWidth;
    }

    /**
     * @return int|null
     */
    public function getTabletMaxHeight(): ?int
    {
        return $this->tabletMaxHeight;
    }

    /**
     * @param int|null $tabletMaxHeight
     */
    public function setTabletMaxHeight(?int $tabletMaxHeight): void
    {
        $this->tabletMaxHeight = $tabletMaxHeight;
    }

    /**
     * @return int|null
     */
    public function getMobileMaxWidth(): ?int
    {
        return $this->mobileMaxWidth;
    }

    /**
     * @param int|null $mobileMaxWidth
     */
    public function setMobileMaxWidth(?int $mobileMaxWidth): void
    {
        $this->mobileMaxWidth = $mobileMaxWidth;
    }

    /**
     * @return int|null
     */
    public function getMobileMaxHeight(): ?int
    {
        return $this->mobileMaxHeight;
    }

    /**
     * @param int|null $mobileMaxHeight
     */
    public function setMobileMaxHeight(?int $mobileMaxHeight): void
    {
        $this->mobileMaxHeight = $mobileMaxHeight;
    }

    /**
     * @return ArrayCollection|PersistentCollection
     */
    public function getBanners(): ArrayCollection|PersistentCollection
    {
        return $this->banners;
    }

    /**
     * @param ArrayCollection|PersistentCollection $banners
     */
    public function setBanners(ArrayCollection|PersistentCollection $banners): void
    {
        $this->banners = $banners;
    }

    public function getWebsite(): ?Website
    {
        return $this->website;
    }

    public function setWebsite(?Website $website): self
    {
        $this->website = $website;

        return $this;
    }
}