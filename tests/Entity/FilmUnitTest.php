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
                        ->setStatue(new Statue());
                        
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
     * Test des champs vide
     */
    public function testEmpty(){
        $film = new Film();

        $this->assertEmpty($film->getTitle());
        $this->assertEmpty($film->getIdFilmTmdb());
        $this->assertEmpty($film->getStatue());
    }
}
