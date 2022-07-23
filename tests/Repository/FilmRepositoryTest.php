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
     * Méthode pour chercher par id 
     */
    public function testFindOneByIdTmdb()
    {
        $tv = $this->getRepositoryFilm(['idTmdb' => 1]);
        $this->assertSame(1, $tv->getIdTmdb());
    }

}
