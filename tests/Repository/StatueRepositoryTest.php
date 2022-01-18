<?php

namespace App\Tests\Repository;

use App\Repository\StatueRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class StatueRepositoryTest extends KernelTestCase
{
    public function getRepositoryStatue()
    {
        self::bootKernel();
        return static::getContainer()->get(StatueRepository::class);
    }

    /**
     * Méthode pour chercher par statue
     */
    public function testFindOneByStatue()
    {
        $query = $this->getRepositoryStatue()->findOneBy(['statue' => 'Statue0']);
        $this->assertSame('Statue0', $query->getStatue());
    }

   /**
     * Méthode pour chercher un titre
     * en fonction de l'id du statue
     */
    public function testTitleFilm()
    {
        $query = $this->getRepositoryStatue()->findTitleByIdStatue('film', 'f', 38);
        $film = $query[0]->getFilm();
        foreach($film as $data)
            $this->assertSame('enim', $data->getTitle());
    }

    /**
     * Méthode pour chercher un titre
     * en fonction de l'id du statue
     */
    public function testTitleMovie()
    {
        $query = $this->getRepositoryStatue()->findTitleByIdStatue('movie', 'm', 38);
        $movie = $query[0]->getMovie();
        foreach($movie as $data)
            $this->assertSame('est', $data->getTitle());
    }
}