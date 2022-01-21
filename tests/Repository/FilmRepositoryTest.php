<?php

namespace App\Tests\Repository;

use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FilmRepositoryTest extends KernelTestCase
{

    public function getRepositoryFilm(array $criteria)
    {
        self::bootKernel();
        return static::getContainer()->get(FilmRepository::class)->findOneBy($criteria);
    }

    /**
     * Méthode pour chercher par titre
     */
    public function testFindOneByTitle()
    {
        $film = $this->getRepositoryFilm(['title' => 'facilis']);
        $this->assertSame('facilis', $film->getTitle());
    }

    /**
     * Methode pour chercher par id
     */
    public function testFindOneByIdTmdb()
    {
        $film = $this->getRepositoryFilm(['idFilmTmdb' => '21']);
        $this->assertSame(21, $film->getIdFilmTmdb());
    }

    /**
     * Methode pour chercher par statue
     */
    public function testFindOneByStatue(){
        $film = $this->getRepositoryFilm(['statue' => '41']);
        $this->assertSame(41, $film->getStatue()->getId());
    }
}
