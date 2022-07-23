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
    public function testFind()
    {
        $query = $this->getRepositoryStatue()->find(['id' => 1]);
        $this->assertSame('Statue0', $query->getStatue());
    }
}
