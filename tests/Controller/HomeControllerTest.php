<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{

    /**
     * Méthode pour simuler le client
     *
     * @param string $method
     * @param string $route
     * @return KernelBrowser
     */
    public function getClient(string $method, string $route, $parameters = []): KernelBrowser
    {
        $client = static::createClient();
        $client->request($method, $route, $parameters);

        return $client;
    }

    /**
     * Test de la page d'acceuil
     * 
     * @return void
     */
    public function testHomePage(): void
    {
        $this->getClient('GET', '/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    
    /**
     * Test de la page de recherche
     * 
     * @return void
     */
    public function testSearchPage(): void
    {
        $this->getClient('GET', '/search');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    /**
     * Test de la recherche
     * 
     * @return void
     */
    public function testSearch(): void
    {
        $client = $this->getClient('GET', '/search');
        $client->submitForm('Recherche', [
            'form[query]' => 'Rugal'
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    /** 
     * Test de la page de recherche des détails par rapport 
     * à l'id
     * 
     * @return void
     */
    public function testDetailTvPage():void
    {
        $this->getClient('GET', '/detail-tv/97766');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    
    /**
     * Test de la soumission
     *
     * @return void
     */
    public function testManagementTvSubmit(){
        $client = static::createClient();
        $client->xmlHttpRequest('POST', '/management-tv/97766', [
            'tv' => ['statue' => 1]
        ]);
        
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
