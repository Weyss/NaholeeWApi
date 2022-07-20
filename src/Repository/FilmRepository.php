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
     * Méthodes pour rechercher des film "vu"
     *
     * @return Film[]
     */
    public function findFilmByToSee(): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.statue = 1')
            ->orderBy('f.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Méthodes pour rechercher des films "a voir"
     *
     * @return Film[]
     */
    public function findFilmBySeen(): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.statue = 2')
            ->orderBy('f.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
