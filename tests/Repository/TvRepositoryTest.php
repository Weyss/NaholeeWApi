<?php

namespace App\Tests\Repository;

use App\Repository\TvRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TvRepositoryTest extends KernelTestCase
{
    public function getRepositoryTv(array $criteria)
    {
        self::bootKernel();
        return static::getContainer()->get(TvRepository::class)->findOneBy($criteria);
    }

    /**
     * Méthode pour chercher par titre
     */
    public function testFindOneByTitle()
    {
        $tv = $this->getRepositoryTv(['title' => 'qui']);
        $this->assertSame('qui', $tv->getTitle());
    }

    /**
     * Methode pour chercher par id
     */
    public function testFindOneByIdTmdb()
    {
        $tv = $this->getRepositoryTv(['idTvTmdb' => '14']);
        $this->assertSame(14, $tv->getIdTvTmdb());
    }

    /**
     * Methode pour chercher par statue
     */
    public function testFindOneByStatue(){
        $tv = $this->getRepositoryTv(['statue' => '41']);
        $this->assertSame(41, $tv->getStatue()->getId());
    }
}
