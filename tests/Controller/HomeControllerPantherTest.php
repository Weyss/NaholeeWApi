<?php

namespace App\Tests\Controller;

use Facebook\WebDriver\WebDriverBy;
use Symfony\Component\Panther\PantherTestCase;

class HomeControllerPantherTest extends PantherTestCase
{
    /**
     * Test pour informer que la serie est suivie
     *
     * @return void
     */
    public function testManagementTvIdExist(): void
    {
        $client = static::createPantherClient(['browser' => static::FIREFOX]);
        $client->request('GET', '/detail-tv/97766');

        $this->assertSelectorTextContains('.alert', 'Cette serie est dans votre liste');
    }

    /**
     * Test pour informer que la serie n'est pas suivie
     *
     * @return void
     */
    public function testManagementTvIdNotExist(): void
    {
        $client = static::createPantherClient(['browser' => static::FIREFOX]);
        $client->request('GET', '/detail-tv/137520');

        $this->assertSelectorTextContains('.alert', 'Cette serie n\'est pas ajouter à votre liste');
    }

    /**
     * Test pour confirmer l'ajout d'une serie
     *
     * @return void
     */
    public function testManagementTvSubmittedFormForAdd(){
        $client = static::createPantherClient(['browser' => static::FIREFOX]);
        $client->request('GET', '/detail-tv/137520');
        $client->getWebDriver()->findElement(WebDriverBy::id('tv_statue_1'))->click();
        $client->waitForElementToContain('#js-info', 'Ajouter');
        
        $this->assertSelectorTextContains('#js-info', 'Ajouter');
    }

    /**
     * Test pour confirmer une édition
     *
     * @return void
     */
    public function testManagementTvSubmittedFormForEdit(){
        $client = static::createPantherClient(['browser' => static::FIREFOX]);
        $client->request('GET', '/detail-tv/97766');
        $client->getWebDriver()->findElement(WebDriverBy::id('tv_statue_1'))->click();
        $client->waitForElementToContain('#js-info', 'Modifier');
        
        $this->assertSelectorTextContains('#js-info', 'Modifier');
    }
}
