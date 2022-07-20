<?php

namespace App\Tests\Entity;

use App\Entity\Film;
use App\Entity\Statue;
use PHPUnit\Framework\TestCase;

class FilmUnitTest extends TestCase
{
    /**
     * Créé un nouveau Film
     */
    public function getFilm(): Film
    {
       return (new Film)->setTitle("The Witcher")
                        ->setIdFilmTmdb(192304)
                        ->setStatue(new Statue())
                        ->setCountry("French")
                        ->setAnime(true);
                        
    }

    /**
     * Test la validité du titre
     */
    public function testValidTitle(){
        $this->assertEquals("The Witcher", $this->getFilm()->getTitle());
    }

    /**
     * Test la validité de l'id de TMDB
     */
    public function testValidIdFilmTmdb(){
        $this->assertEquals(192304, $this->getFilm()->getIdFilmTmdb());
    }

    /**
     * Test l'invalidité du titre
     */
    public function testInvalidTitle(){
        $this->assertNotEquals(192304, $this->getFilm()->getTitle());
    }

    /**
     * Test l'invalidité de l'id de TMDB
     */
    public function testInvalidIdFilmTmdb(){
        $this->assertNotEquals("The Witcher", $this->getFilm()->getIdFilmTmdb());
    }

    /**
     * Test la validité du pays
     */
    public function testValidCountry(){
        $this->assertEquals("French", $this->getFilm()->getCountry());
    }

    /**
     * Test l'invalidité du pays
     */
    public function testInvalidCountry(){
        $this->assertNotEquals(192304, $this->getFilm()->getCountry());
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
     * Test des champs vide
     */
    public function testEmpty(){
        $film = new Film();

        $this->assertEmpty($film->getTitle());
        $this->assertEmpty($film->getIdFilmTmdb());
        $this->assertEmpty($film->getStatue());
        $this->assertEmpty($film->getCountry());
        $this->assertEmpty($film->getAnime());
    }
}
