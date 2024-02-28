<?php

namespace App\Repository\Module\Banner;

use App\Entity\Module\Banner\Teaser;
use App\Service\Core\CacheService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;
use Symfony\Component\Cache\Exception\CacheException;

/**
 * TeaserRepository.
 *
 * @extends ServiceEntityRepository<Teaser>
 *
 * @method Teaser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Teaser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Teaser[]    findAll()
 * @method Teaser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeaserRepository extends ServiceEntityRepository
{
    /**
     * TeaserRepository constructor.
     */
    public function __construct(
        private readonly ManagerRegistry $registry,
        private readonly CacheService $cacheService
    ) {
        parent::__construct($this->registry, Teaser::class);
    }

    /**
     * Find online by filter
     *
     * @throws CacheException|NonUniqueResultException
     */
    public function findOneByFilter(mixed $filter = null): ?Teaser
    {
        if ($filter) {
            $cache = $this->cacheService->adapter(Teaser::class, __FUNCTION__);
            $queryBuilder = $this->createQueryBuilder('t')
                ->leftJoin('t.categories', 'c')
                ->addSelect('c');
            if (is_numeric($filter)) {
                $queryBuilder->andWhere('t.id = :id')
                    ->setParameter('id', $filter);
            } else {
                $queryBuilder->andWhere('t.slug = :slug')
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
}