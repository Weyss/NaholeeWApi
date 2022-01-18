<?php

namespace App\Tests\Repository;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MovieRepositoryTest extends KernelTestCase
{
    public function getRepositoryFilm(array $criteria)
    {
        self::bootKernel();
        return static::getContainer()->get(MovieRepository::class)->findOneBy($criteria);
    }

    /**
     * Méthode pour chercher par titre
     */
    public function testFindOneByTitle()
    {
        $movie = $this->getRepositoryFilm(['title' => 'qui']);
        $this->assertSame('qui', $movie->getTitle());
    }

    /**
     * Methode pour chercher par id
     */
    public function testFindOneByIdTmdb()
    {
        $movie = $this->getRepositoryFilm(['idMovieTmdb' => '245']);
        $this->assertSame(245, $movie->getIdMovieTmdb());
    }

    /**
     * Methode pour chercher par statue
     */
    public function testFindOneByStatue(){
        $film = $this->getRepositoryFilm(['statue' => '37']);
        $this->assertSame(37, $film->getStatue()->getId());
    }
}
