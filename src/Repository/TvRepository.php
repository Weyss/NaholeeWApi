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
    * @return Tv[] Returns an array of TV objects
    */
    public function findTvByToSee()
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.statue = 1')
            ->orderBy('t.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return Tv[] Returns an array of Tv objects
    */
    public function findTvBySeen()
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.statue = 2')
            ->orderBy('t.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Tv[] Returns an array of Tv objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tv
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
