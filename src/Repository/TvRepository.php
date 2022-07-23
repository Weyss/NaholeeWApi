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
     * Méthodes pour rechercher des series en fonction du statue
     * demandé
     * 
     * @param string $statue
     *
     * @return Tv[]
     */
    public function findTvByStatue(string $statue): array
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.statue', 's', 'WITH', 's.id = t.statue')
            ->where('s.statue = :statue')
            ->setParameter('statue', $statue)
            ->orderBy('t.title', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
