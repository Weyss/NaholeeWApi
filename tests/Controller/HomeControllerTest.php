<?php

namespace App\Tests\Controller;

use App\Service\CallApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    /**
     * Test de la page d'acceuil
     */
    public function testHomePage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    /**
     * Test de la page de recherche
     */
    public function testSearchPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/search');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    /**
     * Test de la recherche
     */
    public function testSearch(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/search');
        $form = $crawler->selectButton('Recherche')->form([
            'form[query]' => 'Rugal'
        ]);
        
        $client->submit($form);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    /**
     * Test de la page de recherche des détails par rapport 
     * à l'id
     */
    public function testDetailTv():void
    {
        $client = static::createClient();
        $client->request('GET', '/detail-tv/{id}', ['id' => 97766]);
        
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
