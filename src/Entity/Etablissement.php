<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'etablissement', targetEntity: HabitantEtablissement::class)]
    private Collection $habitantEtablissements;

    public function __construct()
    {
        $this->habitantEtablissements = new ArrayCollection();
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
     * @return Collection<int, HabitantEtablissement>
     */
    public function getHabitantEtablissements(): Collection
    {
        return $this->habitantEtablissements;
    }

    public function addHabitantEtablissement(HabitantEtablissement $habitantEtablissement): self
    {
        if (!$this->habitantEtablissements->contains($habitantEtablissement)) {
            $this->habitantEtablissements->add($habitantEtablissement);
            $habitantEtablissement->setEtablissement($this);
        }

        return $this;
    }

    public function removeHabitantEtablissement(HabitantEtablissement $habitantEtablissement): self
    {
        if ($this->habitantEtablissements->removeElement($habitantEtablissement)) {
            // set the owning side to null (unless already changed)
            if ($habitantEtablissement->getEtablissement() === $this) {
                $habitantEtablissement->setEtablissement(null);
            }
        }

        return $this;
    }
}
