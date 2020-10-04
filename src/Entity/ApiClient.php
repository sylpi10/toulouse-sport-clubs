<?php

namespace App\Entity;

use Symfony\Contracts\HttpClient\HttpClientInterface;


class ApiClient{

    private $client;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->client = $httpClient;
    }

     public function getClubs()  
     {
         $rep = $this->client->request('GET', 'https://data.toulouse-metropole.fr/api/records/1.0/search/?dataset=annuaire-des-associations-et-clubs-sportifs&q=&rows=1000');
         $clubs = $rep->toArray();
         return $clubs;
     }
}