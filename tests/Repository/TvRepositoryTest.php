<?php

namespace App\Tests\Repository;

use App\Repository\TvRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TvRepositoryTest extends KernelTestCase
{
    public function getRepositoryTv()
    {
        self::bootKernel();
        return static::getContainer()->get(TvRepository::class);
    }

    /**
     * Méthode pour chercher par titre
     */
    public function testFindOneByIdTmdb()
    {
        $tv = $this->getRepositoryTv()->findOneBy(['idTmdb' => 81]);
        $this->assertSame(81, $tv->getIdTmdb());
    }

     /**
     * Méthode pour chercher des titres en foncion du statue
     */
    public function testFindTitleByAnime()
    {
        $query = $this->getRepositoryTv()->findTvByStatue('Statue0');
        $this->assertIsArray($query);
        $this->assertArrayHasKey(0, $query);
        $this->assertIsObject($query[0]);
        $this->assertObjectHasAttribute('title', $query[0]);
    }
}
