<?php

namespace App\Repository;

use App\Entity\Tv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tv|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tv|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tv[]    findAll()
 * @method Tv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tv::class);
    }

    /**
     * Méthodes pour rechercher des series "a voir"
     *
     * @return Tv[]
     */
    public function findTvByToSee(): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.statue = 1')
            ->orderBy('t.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Méthodes pour rechercher des series "a voir"
     *
     * @return Tv[]
     */
    public function findTvBySeen(): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.statue = 2')
            ->orderBy('t.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
