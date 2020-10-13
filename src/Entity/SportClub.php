<?php

namespace App\Entity;

use App\Repository\SportClubRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SportClubRepository::class)
 */
class SportClub
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $discipline;


    // /**
    //  * @ORM\Column(type="string", length=255, nullable=true)
    //  */
    // private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $weblink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $complex;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $adults;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $seniors;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $j16to20;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $j12to15;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $j6to12;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $j3to6;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $j0to3;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $corpo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $handicap;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $district;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=PostalCode::class, inversedBy="sportClubs")
     */
    private $postalCodes;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="sportClubs")
     */
    private $categories;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDiscipline(): ?string
    {
        return $this->discipline;
    }

    public function setDiscipline(string $discipline): self
    {
        $this->discipline = $discipline;

        return $this;
    }

    // public function getCategory(): ?string
    // {
    //     return $this->category;
    // }

    // public function setCategory(?string $category): self
    // {
    //     $this->category = $category;

    //     return $this;
    // }

    public function getWeblink(): ?string
    {
        return $this->weblink;
    }

    public function setWeblink(?string $weblink): self
    {
        $this->weblink = $weblink;

        return $this;
    }

    public function getComplex(): ?string
    {
        return $this->complex;
    }

    public function setComplex(?string $complex): self
    {
        $this->complex = $complex;

        return $this;
    }

    public function getAdults(): ?bool
    {
        return $this->adults;
    }

    public function setAdults(?bool $adults): self
    {
        $this->adults = $adults;

        return $this;
    }

    public function getSeniors(): ?bool
    {
        return $this->seniors;
    }

    public function setSeniors(?bool $seniors): self
    {
        $this->seniors = $seniors;

        return $this;
    }

    public function getJ16to20(): ?bool
    {
        return $this->j16to20;
    }

    public function setJ16to20(?bool $j16to20): self
    {
        $this->j16to20 = $j16to20;

        return $this;
    }

    public function getJ12to15(): ?bool
    {
        return $this->j12to15;
    }

    public function setJ12to15(?bool $j12to15): self
    {
        $this->j12to15 = $j12to15;

        return $this;
    }

    public function getJ6to12(): ?bool
    {
        return $this->j6to12;
    }

    public function setJ6to12(?bool $j6to12): self
    {
        $this->j6to12 = $j6to12;

        return $this;
    }

    public function getJ3to6(): ?bool
    {
        return $this->j3to6;
    }

    public function setJ3to6(?bool $j3to6): self
    {
        $this->j3to6 = $j3to6;

        return $this;
    }
    public function getJ0to3(): ?bool
    {
        return $this->j0to3;
    }

    public function setJ0to3(?bool $j0to3): self
    {
        $this->j0to3 = $j0to3;

        return $this;
    }

    public function getCorpo(): ?bool
    {
        return $this->corpo;
    }

    public function setCorpo(?bool $corpo): self
    {
        $this->corpo = $corpo;

        return $this;
    }

    public function getHandicap(): ?bool
    {
        return $this->handicap;
    }

    public function setHandicap(?bool $handicap): self
    {
        $this->handicap = $handicap;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(?string $district): self
    {
        $this->district = $district;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPostalCodes(): ?PostalCode
    {
        return $this->postalCodes;
    }

    public function setPostalCodes(?PostalCode $postalCodes): self
    {
        $this->postalCodes = $postalCodes;

        return $this;
    }


    public function getCategories(): ?Category
    {
        return $this->categories;
    }

    public function setCategories(?Category $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
