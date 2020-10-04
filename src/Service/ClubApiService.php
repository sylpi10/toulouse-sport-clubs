<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ClubApiService{

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getClub()
    {
        $response = $this->client->request(
            'GET',
            'https://data.toulouse-metropole.fr/api/records/1.0/search/?dataset=annuaire-des-associations-et-clubs-sportifs&q=&rows=1000'
        );

        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders(false)['content-type'][0];
        $content = $response->getContent();
        $content = $response->toArray();
        return $content;
    }
}