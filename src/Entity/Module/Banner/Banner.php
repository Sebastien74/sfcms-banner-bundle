<?php

namespace App\Entity\Module\Banner;

use App\Entity\BaseEntity;
use App\Entity\Core\Website;
use App\Entity\Media\MediaRelation;
use App\Entity\Translation\i18n;
use App\Repository\Module\Banner\BannerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Banner.
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
#[ORM\Table(name: 'module_banner')]
#[ORM\Entity(repositoryClass: BannerRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'mediaRelations',
        joinColumns: [new ORM\JoinColumn(name: 'banner_id', referencedColumnName: 'id', onDelete: 'cascade')],
        inverseJoinColumns: [new ORM\InverseJoinColumn(name: 'relation_id', referencedColumnName: 'id', unique: true, onDelete: 'cascade')],
        joinTable: new ORM\JoinTable(name: 'module_banner_media_relations'),
        fetch: 'EXTRA_LAZY'
    ),
    new ORM\AssociationOverride(
        name: 'i18ns',
        joinColumns: [new ORM\JoinColumn(name: 'banner_id', referencedColumnName: 'id', onDelete: 'cascade')],
        inverseJoinColumns: [new ORM\InverseJoinColumn(name: 'i18n_id', referencedColumnName: 'id', unique: true, onDelete: 'cascade')],
        joinTable: new ORM\JoinTable(name: 'module_banner_i18ns'),
        fetch: 'EXTRA_LAZY'
    ),
])]
class Banner extends BaseEntity
{
    /**
     * Configurations.
     */
    protected static array $interface = [
        'name' => 'banner',
        'removeMedia' => false,
    ];

    #[ORM\Column(type: 'integer', nullable: true)]
    private int $viewCount = 0;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int $clickCount = 0;

    #[ORM\Column(type: 'boolean')]
    private ?bool $active = false;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $publicationStart = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $publicationEnd = null;

    #[ORM\ManyToOne(targetEntity: Size::class)]
    #[ORM\JoinColumn(name: 'size_id', referencedColumnName: 'id', nullable: true, onDelete: 'SET NULL')]
    private ?Size $size = null;

    #[ORM\ManyToOne(targetEntity: Website::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Website $website = null;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: i18n::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\OrderBy(['locale' => 'ASC'])]
    #[Assert\Valid]
    private ArrayCollection|PersistentCollection $i18ns;

    #[ORM\ManyToMany(targetEntity: MediaRelation::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\OrderBy(['position' => 'ASC', 'locale' => 'ASC'])]
    #[Assert\Valid]
    private ArrayCollection|PersistentCollection $mediaRelations;

    /**
     * Banner constructor.
     */
    public function __construct()
    {
        $this->i18ns = new ArrayCollection();
        $this->mediaRelations = new ArrayCollection();
    }

    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    public function setViewCount(int $viewCount): void
    {
        $this->viewCount = $viewCount;
    }

    public function getClickCount(): int
    {
        return $this->clickCount;
    }

    public function setClickCount(int $clickCount): void
    {
        $this->clickCount = $clickCount;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): void
    {
        $this->active = $active;
    }

    public function getPublicationStart(): ?\DateTimeInterface
    {
        return $this->publicationStart;
    }

    public function setPublicationStart(?\DateTimeInterface $publicationStart): void
    {
        $this->publicationStart = $publicationStart;
    }

    public function getPublicationEnd(): ?\DateTimeInterface
    {
        return $this->publicationEnd;
    }

    public function setPublicationEnd(?\DateTimeInterface $publicationEnd): void
    {
        $this->publicationEnd = $publicationEnd;
    }

    public function getSize(): ?Size
    {
        return $this->size;
    }

    public function setSize(?Size $size): void
    {
        $this->size = $size;
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, i18n>
     */
    public function getI18ns(): Collection
    {
        return $this->i18ns;
    }

    public function addI18n(i18n $i18n): self
    {
        if (!$this->i18ns->contains($i18n)) {
            $this->i18ns->add($i18n);
        }

        return $this;
    }

    public function removeI18n(i18n $i18n): self
    {
        $this->i18ns->removeElement($i18n);

        return $this;
    }

    /**
     * @return Collection<int, MediaRelation>
     */
    public function getMediaRelations(): Collection
    {
        return $this->mediaRelations;
    }

    public function addMediaRelation(MediaRelation $mediaRelation): self
    {
        if (!$this->mediaRelations->contains($mediaRelation)) {
            $this->mediaRelations->add($mediaRelation);
        }

        return $this;
    }

    public function removeMediaRelation(MediaRelation $mediaRelation): self
    {
        $this->mediaRelations->removeElement($mediaRelation);

        return $this;
    }
}
