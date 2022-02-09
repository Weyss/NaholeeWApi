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

    /**
     * Méthode pour récupérer les informations
     * d'une serie
     *
     * @param string $query
     * @return array
     */
    public function getInfoTv(string $query):array
    {
        $response = $this->client->request(
            'GET',
            'search/tv?query=' . $query . '&language=fr'
        );
        
        return $response->toArray();
    }

    /**
     * Méthode pour récupérer les détails
     * d'une serie
     *
     * @param int $id
     * @return array
     */
    public function getDetailInfoTv(int $id):array
    {
        $response = $this->client->request(
            'GET',
            'tv/'. $id .'?language=fr'
        );
        
        return $response->toArray();
    }

    /**
     * Méthode pour récupérer les informations
     * d'un film
     *
     * @param string $query
     * @return array
     */
    public function getInfoFilm(string $query):array
    {
        $response = $this->client->request(
            'GET',
            'search/movie?query=' . $query . '&language=fr'
        );
        
        return $response->toArray();
    }

    /**
     * Méthode pour récupérer les détails
     * d'un film
     *
     * @param integer $id
     * @return array
     */
    public function getDetailInfoFilm(int $id):array
    {
        $response = $this->client->request(
            'GET',
            'movie/'. $id .'?language=fr'
        );
        
        return $response->toArray();
    }
}