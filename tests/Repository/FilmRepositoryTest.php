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
        $film = $this->getRepositoryFilm(['title' => 'enim']);
        $this->assertSame('enim', $film->getTitle());
    }

    /**
     * Methode pour chercher par id
     */
    public function testFindOneByIdTmdb()
    {
        $film = $this->getRepositoryFilm(['idFilmTmdb' => '329']);
        $this->assertSame(329, $film->getIdFilmTmdb());
    }

    /**
     * Methode pour chercher par statue
     */
    public function testFindOneByStatue(){
        $film = $this->getRepositoryFilm(['statue' => '38']);
        $this->assertSame(38, $film->getStatue()->getId());
    }
}
