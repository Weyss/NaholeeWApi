<?php

namespace App\Repository;

use App\Entity\Film;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Film|null find($id, $lockMode = null, $lockVersion = null)
 * @method Film|null findOneBy(array $criteria, array $orderBy = null)
 * @method Film[]    findAll()
 * @method Film[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
    }

    /**
     * Méthodes pour rechercher des film en fonction du statue 
     * demandé
     *
     * @param string $statue
     * 
     * @return Film[]
     */
    public function findFilmByStatue(string $statue): array
    {
        return $this->createQueryBuilder('f')
            ->innerJoin('f.statue', 's', 'WITH', 's.id = f.statue')
            ->where('s.statue = :statue')
            ->setParameter('statue', $statue)
            ->orderBy('f.title', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }
}
