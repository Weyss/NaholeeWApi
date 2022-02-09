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
     * Test de la recherche d'une serie
     * 
     * @return void
     */
    public function testSearchTv(): void
    {
        $client = $this->getClient('GET', '/search');
        $client->submitForm('Recherche', [
            'form[query]' => 'Rugal'
        ]);
        
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    /**
     * Test de la recherche d'un film
     *
     * @return void
     */
    public function testSearchFilm(): void
    {
        $client = $this->getClient('GET', '/search');

        $client->submitForm('Recherche', [
            'form[query]' => 'Man of Steel'
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    /** 
     * Test de la page de recherche des détails par rapport 
     * à l'id
     * (L'id vient de la BDD de l'api utiliser)
     * 
     * @return void
     */
    public function testDetailTvPage():void
    {
        $this->getClient('GET', '/detail-tv/97766');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    
    /**
     * test de la page de recherche des détails par rapport
     * à l'id
     * (L'id vient de la BDD de l'api utiliser)
     *
     * @return void
     */
    public function testDetailFilmPage(): void
    {
        $this->getClient('GET', '/detail-film/49521');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    /**
     * Test requête AJAX pour les séries
     * (L'id de la série et du statue viennent de la BDD
     * local test)
     * 
     * @return void
     */
    public function testManagementTv(){
        $client = static::createClient();
        $client->xmlHttpRequest('POST', '/management/383', [
            'tv' => ['statue' => 40]
        ]);
        
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    /**
     * Test requête AJAX pour un film
     * (L'id du film et du statue viennent de la BDD
     * local test)
     * 
     * @return void
     */
    public function testManagementFilm(){
        $client = static::createClient();
        $client->xmlHttpRequest('POST', '/management/230', [
            'film' => ['statue' => 40]
        ]);
        
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
