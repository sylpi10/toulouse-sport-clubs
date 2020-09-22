<?php

namespace App\Entity;

class Club{
    
    private $id;

    private $name;

    private $sport;

    private $code;

    private $webAddress;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId()
    {
        # code...
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName(string $name): self
    {
        $this->name = $this->client->request(
            'GET',
            'https://data.toulouse-metropole.fr/api/records/1.0/search/?dataset=annuaire-des-associations-et-clubs-sportifs&q=asso_nom%' .$name.'&rows=1000'
        );

        return $this;
    }

}