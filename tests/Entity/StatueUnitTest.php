<?php

namespace App\Tests\Entity;

use App\Entity\Statue;
use PHPUnit\Framework\TestCase;

class StatueUnitTest extends TestCase
{
    /**
     * Créé un nouveau Statue
     */
    public function getEntity(): Statue
    {
       return (new Statue())->setStatue("A voir");            
    }

    /**
     * Test la validité du statue
     */
    public function testValidStatue(){
        $this->assertEquals("A voir", $this->getEntity()->getStatue());
    }

    /**
     * Test l'invalidité du statue
     */
    public function testInvalidStatue(){
        $this->assertNotEquals(192304, $this->getEntity()->getStatue());
    }

    /**
     * Test des champs vides
     */
    public function testEmpty(){
        $film = new Statue();
        $this->assertEmpty($film->getStatue());
    }
}
