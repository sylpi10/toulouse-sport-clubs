<?php

namespace App\Entity;

use App\Repository\PostalCodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostalCodeRepository::class)
 */
class PostalCode
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $number;

    /**
     * @ORM\OneToMany(targetEntity=SportClub::class, mappedBy="postalCodes")
     */
    private $sportClubs;

    public function __construct()
    {
        $this->sportClubs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return Collection|SportClub[]
     */
    public function getSportClubs(): ?Collection
    {
        return $this->sportClubs;
    }

    public function addSportClub(SportClub $sportClub): self
    {
        if (!$this->sportClubs->contains($sportClub)) {
            $this->sportClubs[] = $sportClub;
            $sportClub->setPostalCodes($this);
        }

        return $this;
    }

    public function removeSportClub(SportClub $sportClub): self
    {
        if ($this->sportClubs->contains($sportClub)) {
            $this->sportClubs->removeElement($sportClub);
            // set the owning side to null (unless already changed)
            if ($sportClub->getPostalCodes() === $this) {
                $sportClub->setPostalCodes(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->number;
    }
}
