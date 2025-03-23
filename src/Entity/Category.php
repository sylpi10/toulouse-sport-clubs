<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"category")]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'categories', targetEntity: SportClub::class, orphanRemoval: true)]
    private Collection $sportClubs;

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

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getSportClubs(): Collection
    {
        return $this->sportClubs;
    }

    public function addSportClub(SportClub $sportClub): self
    {
        if (!$this->sportClubs->contains($sportClub)) {
            $this->sportClubs[] = $sportClub;
            $sportClub->setCategories($this);
        }

        return $this;
    }

    public function removeSportClub(SportClub $sportClub): self
    {
        if ($this->sportClubs->contains($sportClub)) {
            $this->sportClubs->removeElement($sportClub);
            // set the owning side to null (unless already changed)
            if ($sportClub->getCategories() === $this) {
                $sportClub->setCategories(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
