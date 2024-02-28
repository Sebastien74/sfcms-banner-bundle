<?php

namespace App\Entity\Module\Banner;

use App\Entity\BaseTeaser;
use App\Repository\Module\Banner\TeaserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Validator\Constraints as Assert;

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

    #[ORM\ManyToMany(targetEntity: Category::class)]
    #[ORM\OrderBy(['adminName' => 'ASC'])]
    #[Assert\Valid]
    private ArrayCollection|PersistentCollection $categories;

    /**
     * Teaser constructor.
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }
}