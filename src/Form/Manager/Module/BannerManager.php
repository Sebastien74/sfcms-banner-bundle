<?php

namespace App\Form\Manager\Module;

use App\Entity\Core\Website;
use App\Entity\Media\Media;
use App\Entity\Media\MediaRelation;
use App\Entity\Module\Banner\Banner;
use App\Entity\Module\Form\Form;
use App\Entity\Translation\i18n;
use Doctrine\ORM\EntityManagerInterface;

/**
 * BannerManager.
 *
 * Manage admin Banner form
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
class BannerManager implements BannerManagerInterface
{
    private const array FORMATS = ['desktop', 'mobile'];
    private ?Website $website = null;

    /**
     * FormManager constructor.
     */
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    /**
     * @prePersist
     *
     * @throws \Exception
     */
    public function prePersist(Banner $banner, Website $website): void
    {
        $this->website = $website;

        if ($banner->getMediaRelations()->isEmpty()) {
            $configuration = $website->getConfiguration();
            foreach (self::FORMATS as $key => $format) {
                $locale = $configuration->getLocale();
                $media = new Media();
                $this->setProperties($media, $locale);
                $i18n = new i18n();
                $this->setProperties($i18n, $locale);
                $mediaRelation = new MediaRelation();
                $this->setProperties($mediaRelation, $locale);
                $mediaRelation->setMedia($media);
                $mediaRelation->setI18n($i18n);
                $mediaRelation->setPosition($key + 1);
                $mediaRelation->setCategory('banner-'.$format);
                $banner->addMediaRelation($mediaRelation);
            }
        }

        $this->entityManager->persist($banner);
    }

    private function setProperties(mixed $entity, string $locale): void
    {
        if (method_exists($entity, 'setWebsite')) {
            $entity->setWebsite($this->website);
        }

        if (method_exists($entity, 'setLocale')) {
            $entity->setLocale($locale);
        }

        if (method_exists($entity, 'setCreatedAt')) {
            $entity->setCreatedAt(new \DateTime('now'));
        }
    }
}
