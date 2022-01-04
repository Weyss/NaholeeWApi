<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

// Service servant à faire tout le nécessaire pour faire les appels à l'API
// qu'utilise l'application web

class CallApiService
{
    private $client;

    public function __construct(HttpClientInterface $tmdbClient)
    {
        $this->client = $tmdbClient;
    }
    // Fonction permettant de récuperer les informations sur une serie ou un film
    public function getInfo(string $query)
    {
        $response = $this->client->request(
            'GET',
            'search/tv?query=' . $query . '&language=fr'
        );
        
        return $response->toArray();
    }
}