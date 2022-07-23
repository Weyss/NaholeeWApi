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
     * Méthode de requête pour récupérer les informations en fonction:
     *  - statue (ex: Vu, Avoir)
     *  - du pays (ex: JP, KR,...)
     * 
     * @param string $statue
     * @param string $country
     */
    public function findTitleByStatue(string $statue,  $country)
    {                
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
                SELECT * FROM statue s
                INNER JOIN (SELECT f.statue_id, f.title, f.country, f.id_tmdb, f.media FROM film f
                            UNION
                            SELECT t.statue_id, t.title, t.country, t.id_tmdb, t.media FROM tv t) 
                            AS results ON s.id = results.statue_id
                WHERE s.statue = :statue
                AND results.country LIKE :country
                ';

        return $conn->prepare($sql)
                    ->executeQuery(['statue' => $statue, 'country' => $country])
                    ->fetchAllAssociative();
    }

    public function findAnimeByStatue(string $statue)
    {                
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
                SELECT * FROM statue s
                INNER JOIN (SELECT f.statue_id, f.title, f.anime, f.id_tmdb, f.media FROM film f
                            UNION
                            SELECT t.statue_id, t.title, t.anime, t.id_tmdb, t.media FROM tv t) 
                            AS results ON s.id = results.statue_id
                WHERE s.statue = :statue
                AND results.anime = 1
                ';

        return $conn->prepare($sql)
                    ->executeQuery(['statue' => $statue])
                    ->fetchAllAssociative();
    }
}

