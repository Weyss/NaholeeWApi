<?php

namespace App\Repository;

use App\Entity\Statue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Statue|null find($id, $lockMode = null, $lockVersion = null)
 * @method Statue|null findOneBy(array $criteria, array $orderBy = null)
 * @method Statue[]    findAll()
 * @method Statue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Statue::class);
    }

    /**
     * Méthode pour rechercher des titres "vu" en fonction de la catégorie
    *
    * @param string $value
    * @return array
    */
    public function findTitleBySeen($value): array
    {
        return $this->createQueryBuilder('s')
                    ->select('s', 'f', 't')
                    ->innerJoin('s.film', 'f')
                    ->innerJoin('s.tv', 't')
                    ->andWhere('f.country LIKE :category', 't.country LIKE :category')
                    ->setParameter('category', '%'. $value .'%')
                    ->getQuery()
                    ->getResult();               
    }

    /**
     * Méthode pour rechercher des titres "a voir" en fonction de la catégorie
    *
    * @param string $value
    * @return array
    */
    public function findTitleByToSee($value): array
    {
        return $this->createQueryBuilder('s')
                    ->select('s', 'f', 't')
                    ->innerJoin('s.film', 'f')
                    ->innerJoin('s.tv', 't')
                    ->andWhere('f.country LIKE :category', 't.country LIKE :category')
                    ->setParameter('category', '%'. $value .'%')
                    ->getQuery()
                    ->getResult();                
    }
}

