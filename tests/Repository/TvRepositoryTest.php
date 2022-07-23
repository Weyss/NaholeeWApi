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
    public function testFindOneByIdTmdb()
    {
        $tv = $this->getRepositoryTv(['idTmdb' => 81]);
        $this->assertSame(81, $tv->getIdTmdb());
    }
}
