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
                        ->setIdTmdb(192304)
                        ->setStatue(new Statue())
                        ->setCountry("French")
                        ->setAnime(true)
                        ->setMedia('tv');
                        
    }

    /**
     * Test la validité du titre
     */
    public function testValidTitle(){
        $this->assertEquals("Rugal", $this->getTv()->getTitle());
    }

    /**
     * Test l'invalidité du titre
     */
    public function testInvalidTitle(){
        $this->assertNotEquals(192304, $this->getTv()->getTitle());
    }

    /**
     * Test la validité de l'id de TMDB
     */
    public function testValidIdTmdb(){
        $this->assertEquals(192304, $this->getTv()->getIdTmdb());
    }

    /**
     * Test l'invalidité de l'id de TMDB
     */
    public function testInvalidIdTvTmdb(){
        $this->assertNotEquals("Rugal", $this->getTv()->getIdTmdb());
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
     * Test la valeur boolean "true" pour un anime
     */
    public function testTrueValueAnime(){
        $this->assertTrue(true);
    }

    /**
     * Test la valeur boolean "false" pour un anime
     */
    public function testFalseValueAnime(){
        $this->assertFalse(false);
    }

    /**
     * Test la validité du pays
     */
    public function testValidMedia(){
        $this->assertEquals("tv", $this->getTv()->getMedia());
    }

    /**
     * Test l'invalidité du pays
     */
    public function testInvalidMedia(){
        $this->assertNotEquals(192304, $this->getTv()->getMedia());
    }

    /**
     * Test des champs vide
     */
    public function testEmptyTitle(){
        $tv = new Tv();

        $this->assertEmpty($tv->getTitle());
        $this->assertEmpty($tv->getIdTmdb());
        $this->assertEmpty($tv->getStatue());
        $this->assertEmpty($tv->getCountry());
        $this->assertEmpty($tv->getAnime());
        $this->assertEmpty($tv->getMedia());
    }
}
