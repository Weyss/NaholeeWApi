<?php

namespace App\Tests\Entity;

use App\Entity\Tv;
use App\Entity\Statue;
use PHPUnit\Framework\TestCase;

class TvUnitTest extends TestCase
{
    /**
     * Créé un nouveau Film
     */
    public function getTv(): Tv
    {
       return (new Tv)->setTitle("Rugal")
                        ->setIdTvTmdb(192304)
                        ->setStatue(new Statue())
                        ->setCountry("French");
                        
    }

    /**
     * Test la validité du titre
     */
    public function testValidTitle(){
        $this->assertEquals("Rugal", $this->getTv()->getTitle());
    }

    /**
     * Test la validité de l'id de TMDB
     */
    public function testValidIdTvTmdb(){
        $this->assertEquals(192304, $this->getTv()->getIdTvTmdb());
    }

    /**
     * Test l'invalidité du titre
     */
    public function testInvalidTitle(){
        $this->assertNotEquals(192304, $this->getTv()->getTitle());
    }

    /**
     * Test l'invalidité de l'id de TMDB
     */
    public function testInvalidIdTvTmdb(){
        $this->assertNotEquals("Rugal", $this->getTv()->getIdTvTmdb());
    }

    /**
     * Test la validité du pays
     */
    public function testValidCountry(){
        $this->assertEquals("French", $this->getTv()->getCountry());
    }

    /**
     * Test l'invalidité du pays
     */
    public function testInvalidCountry(){
        $this->assertNotEquals(192304, $this->getTv()->getCountry());
    }

    /**
     * Test des champs vide
     */
    public function testEmptyTitle(){
        $tv = new Tv();

        $this->assertEmpty($tv->getTitle());
        $this->assertEmpty($tv->getIdTvTmdb());
        $this->assertEmpty($tv->getStatue());
        $this->assertEmpty($tv->getCountry());
    }
}
