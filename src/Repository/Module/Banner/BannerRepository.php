<?php

namespace App\Repository\Module\Banner;

use App\Entity\Module\Banner\Banner;
use App\Entity\Module\Banner\Teaser;
use App\Service\Core\CacheService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;
use Symfony\Component\Cache\Exception\CacheException;

/**
 * BannerRepository.
 *
 * @method Banner|null find($id, $lockMode = null, $lockVersion = null)
 * @method Banner|null findOneBy(array $criteria, array $orderBy = null)
 * @method Banner[]    findAll()
 * @method Banner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
class BannerRepository extends ServiceEntityRepository
{
    /**
     * BannerRepository constructor.
     */
    public function __construct(
        private readonly ManagerRegistry $registry,
        private readonly CacheService $cacheService
    ) {
        parent::__construct($this->registry, Banner::class);
    }

    /**
     * Find one online by filter.
     *
     * @throws CacheException|NonUniqueResultException
     */
    public function findOneOnlineByFilter(mixed $filter = null): ?Banner
    {
        if ($filter) {
            $cache = $this->cacheService->adapter(Banner::class, __FUNCTION__);
            $queryBuilder = $this->queryBuilder();
            if (is_numeric($filter)) {
                $queryBuilder->andWhere('p.id = :id')
                    ->setParameter('id', $filter);
            } else {
                $queryBuilder->andWhere('p.slug = :slug')
                    ->setParameter('slug', $filter);
            }
            $queryBuilder = $queryBuilder->getQuery();
            if ($cache instanceof PhpFilesAdapter) {
                $queryBuilder->setResultCache($cache)->enableResultCache();
            }

            return $queryBuilder->getOneOrNullResult();
        }

        return null;
    }

    /**
     * Find online by teaser.
     *
     * @throws CacheException
     */
    public function findOnlineByTeaser(Teaser $teaser)
    {
        $cache = $this->cacheService->adapter(Banner::class, __FUNCTION__);
        $queryBuilder = $this->queryBuilder();
        $categoryIds = [];
        foreach ($teaser->getCategories() as $category) {
            $categoryIds[] = $category->getId();
        }
        if ($categoryIds) {
            $queryBuilder->andWhere('p.category IN (:categoryIds)')
                ->setParameter('categoryIds', $categoryIds);
        }
        $queryBuilder = $queryBuilder->getQuery();
        if ($cache instanceof PhpFilesAdapter) {
            $queryBuilder->setResultCache($cache)->enableResultCache();
        }
        return $queryBuilder->getResult();
    }

    /**
     * Optimized QueryBuilder.
     */
    private function queryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.mediaRelations', 'mr')
            ->leftJoin('p.category', 'c')
            ->leftJoin('mr.media', 'm')
            ->andWhere('p.active = :active')
            ->andWhere('p.publicationStart IS NULL OR p.publicationStart < CURRENT_TIMESTAMP()')
            ->andWhere('p.publicationEnd IS NULL OR p.publicationEnd > CURRENT_TIMESTAMP()')
            ->andWhere('p.publicationStart IS NOT NULL')
            ->setParameter('active', true)
            ->addSelect('mr')
            ->addSelect('c')
            ->addSelect('m');
    }
}
