<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(
        mappedBy: 'ville',
        targetEntity: Habitant::class
    )]
    private Collection $habitants;


    /**
     * Ville constructor
     */
    public function __construct()
    {
        $this->habitants = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Habitant>
     */
    public function getHabitants(): Collection
    {
        return $this->habitants;
    }

    public function addHabitant(Habitant $habitant): self
    {
        if (!$this->habitants->contains($habitant)) {
            $this->habitants->add($habitant);
            $habitant->setVille($this);
        }

        return $this;
    }

    public function removeHabitant(Habitant $habitant): self
    {
        if ($this->habitants->removeElement($habitant)) {
            // set the owning side to null (unless already changed)
            if ($habitant->getVille() === $this) {
                $habitant->setVille(null);
            }
        }

        return $this;
    }
}
