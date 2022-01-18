<?php

namespace App\Tests\Entity;

use App\Entity\Movie;
use PHPUnit\Framework\TestCase;

class MovieUnitTest extends TestCase
{
    /**
     * Créé un nouveau Film
     */
    public function getMovie(): Movie
    {
       return (new Movie)->setTitle("Rugal")
                        ->setIdMovieTmdb(192304);
                        
    }

    /**
     * Test la validité du titre
     */
    public function testValidTitle(){
        $this->assertEquals("Rugal", $this->getMovie()->getTitle());
    }

    /**
     * Test la validité de l'id de TMDB
     */
    public function testValidIdMovieTmdb(){
        $this->assertEquals(192304, $this->getMovie()->getIdMovieTmdb());
    }

    /**
     * Test l'invalidité du titre
     */
    public function testInvalidTitle(){
        $this->assertNotEquals(192304, $this->getMovie()->getTitle());
    }

    /**
     * Test l'invalidité de l'id de TMDB
     */
    public function testInvalidIdMovieTmdb(){
        $this->assertNotEquals("Rugal", $this->getMovie()->getIdMovieTmdb());
    }

    /**
     * Test des champs vide
     */
    public function testEmptyTitle(){
        $movie = new Movie();

        $this->assertEmpty($movie->getTitle());
        $this->assertEmpty($movie->getIdMovieTmdb());
    }
}
