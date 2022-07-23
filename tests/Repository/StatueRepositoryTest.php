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

    /**
     * Méthode pour chercher des titres en foncion:
     *  - statue (Vu, A voir)
     *  - pays (Kr, JP, ..)
     */
    public function testFindTitleByStatue()
    {
        $query = $this->getRepositoryStatue()->findTitleByStatue('Statue1', 'jp');
        $this->assertIsArray($query);
        $this->assertContains('reiciendis', $query[0]);
    }

    /**
     * Méthode pour chercher des titres en foncion:
     *  - statue (Vu, A voir)
     *  - si c'est un animé (Kr, JP, ..)
     */
    public function testFindTitleByAnime()
    {
        $query = $this->getRepositoryStatue()->findAnimeByStatue('Statue1');
        $this->assertIsArray($query);
        $this->assertContains('reiciendis', $query[0]);
    }
}
