<?php

namespace App\Entity;

use App\Repository\DisciplineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DisciplineRepository::class)
 */
class Discipline
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=SportClub::class, mappedBy="discipline")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|SportClub[]
     */
    public function getSportClubs(): Collection
    {
        return $this->sportClubs;
    }

    public function addSportClub(SportClub $sportClub): self
    {
        if (!$this->sportClubs->contains($sportClub)) {
            $this->sportClubs[] = $sportClub;
            $sportClub->setDiscipline($this);
        }

        return $this;
    }

    public function removeSportClub(SportClub $sportClub): self
    {
        if ($this->sportClubs->contains($sportClub)) {
            $this->sportClubs->removeElement($sportClub);
            // set the owning side to null (unless already changed)
            if ($sportClub->getDiscipline() === $this) {
                $sportClub->setDiscipline('');
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
