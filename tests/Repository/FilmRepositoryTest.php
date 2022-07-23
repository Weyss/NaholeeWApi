<?php

namespace App\Tests\Repository;

use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FilmRepositoryTest extends KernelTestCase
{

    public function getRepositoryFilm()
    {
        self::bootKernel();
        return static::getContainer()->get(FilmRepository::class);
    }

   /**
     * Méthode pour chercher par id 
     */
    public function testFindOneByIdTmdb()
    {
        $tv = $this->getRepositoryFilm()->findOneBy(['idTmdb' => 1]);
        $this->assertSame(1, $tv->getIdTmdb());
    }

    /**
     * Méthode pour chercher des titres en foncion du statue
     */
    public function testFindTitleByAnime()
    {
        $query = $this->getRepositoryFilm()->findFilmByStatue('Statue0');
        $this->assertIsArray($query);
        $this->assertArrayHasKey(0, $query);
        $this->assertIsObject($query[0]);
        $this->assertObjectHasAttribute('title', $query[0]);
    }
}
