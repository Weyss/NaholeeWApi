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
    * @return Film[] Returns an array of Film objects
    */
    public function findFilmByToSee()
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.statue = 1')
            ->orderBy('f.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return Film[] Returns an array of Film objects
    */
    public function findFilmBySeen()
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.statue = 2')
            ->orderBy('f.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findTitleSeen($value): array 
    {
        return $this->createQueryBuilder('f')
                    ->innerJoin('f.statue', 's', 'WITH', 's.statue = :statue')
                    ->andWhere('f.country LIKE :category')
                    ->setParameter('statue', 'Vu')
                    ->setParameter('category', '%'. $value .'%')
                    ->getQuery()
                    ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Film
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
