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
     * Méthode pour récupérer une collection de Film ou d'un Movie
     * en fonction de l'id du statue.
     */
    public function findTitleByIdStatue(string $tableJoin, string $aliasJoin, int $id): array {
        return $this->createQueryBuilder('s')
                    ->innerJoin('s.'.$tableJoin, $aliasJoin, 'WITH', 's.id = :id')
                    ->setParameter('id', $id)
                    ->getQuery()
                    ->getResult();
    }
}
