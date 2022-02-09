<?php

namespace App\Tests\Controller;

use Facebook\WebDriver\WebDriverBy;
use Symfony\Component\Panther\PantherTestCase;

class HomeControllerPantherTest extends PantherTestCase
{

    // Série de tests lié l'entité "Serie"
    /**
     * Test pour informer que la serie n'est pas suivie
     *
     * @return void
     */
    public function testTvIdNotExist(): void
    {
        $client = static::createPantherClient(['browser' => static::FIREFOX]);
        $client->request('GET', '/detail-tv/137520');

        $this->assertSelectorTextContains('.alert', 'Cette serie n\'est pas ajouter à votre liste');
    }

    /**
     * Test pour informer que la serie est suivie
     *
     * @return void
     */
    public function testTvIdExist(): void
    {
        $client = static::createPantherClient(['browser' => static::FIREFOX]);
        $client->request('GET', '/detail-tv/97766');

        $this->assertSelectorTextContains('.alert', 'Cette serie est dans votre liste');
    }

    /**
     * Test pour confirmer l'ajout d'une serie
     *
     * @return void
     */
    public function testTvSubmittedFormToAdd(){
        $client = static::createPantherClient(['browser' => static::FIREFOX]);
        $client->request('GET', '/detail-tv/137520');
        $client->getWebDriver()->findElement(WebDriverBy::id('tv_statue_2'))->click();
        $client->waitForElementToContain('#js-info', 'Ajouter');
        
        $this->assertSelectorTextContains('h2', 'Bulgasal');
    }

    /**
     * Test pour confirmer une édition
     * 
     * @depends testTvSubmittedFormToAdd
     * @return void
     */
    public function testTvSubmittedFormToEdit(){
        $client = static::createPantherClient(['browser' => static::FIREFOX]);
        $client->request('GET', '/detail-tv/137520');
        $client->getWebDriver()->findElement(WebDriverBy::id('tv_statue_1'))->click();
        $client->waitForElementToContain('#js-info', 'Modifier');
        
        $this->assertSelectorTextContains('h2', 'Bulgasal');
    }

    // Série de tests pour lié à l'entité "Film"
    /**
     * Test pour informer que le film est suivi
     * 
     * @return void
     */
    public function testFilmIdNotExist(): void
    {
        $client = static::createPantherClient(['browser' => static::FIREFOX]);
        $client->request('GET', '/detail-film/297802');

        $this->assertSelectorTextContains('.alert', 'Cette serie n\'est pas ajouter à votre liste');
    }

    /**
     * Test pour informer que le film n'est pas suivi
     *
     * @return void
     */
    public function testFilmIdExist(): void
    {
        $client = static::createPantherClient(['browser' => static::FIREFOX]);
        $client->request('GET', '/detail-film/49521');

        $this->assertSelectorTextContains('.alert', 'Cette serie est dans votre liste');
    }

    /**
     * Test pour confimer l'ajout d'un film
     *
     * @return void
     */
    public function testFilmSubmittedFormToAdd(){
        $client = static::createPantherClient(['browser' => static::FIREFOX]);
        $client->request('GET', '/detail-film/297802');
        $client->getWebDriver()->findElement(WebDriverBy::id('film_statue_1'))->click();
        $client->waitForElementToContain('#js-info', 'Ajouter');
        
        $this->assertSelectorTextContains('h2', 'Aquaman');
    }

    /**
     * Test pour confimer l'edition d'un film
     * 
     * @depends testFilmSubmittedFormToAdd
     * @return void
     */
    public function testFilmSubmittedFormToEdit(){
        $client = static::createPantherClient(['browser' => static::FIREFOX]);
        $client->request('GET', '/detail-film/297802');
        $client->getWebDriver()->findElement(WebDriverBy::id('film_statue_2'))->click();
        $client->waitForElementToContain('#js-info', 'Modifier');
        
        $this->assertSelectorTextContains('h2', 'Aquaman');
    }
}
