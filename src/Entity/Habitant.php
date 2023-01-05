<?php

namespace App\Entity;

use App\Repository\HabitantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HabitantRepository::class)]
class Habitant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToOne(
        targetEntity: Permis::class,
        inversedBy: 'habitant',
        cascade: ['persist', 'remove'],
    )]
    #[ORM\JoinColumn(
        name: 'id_permis',
        referencedColumnName: 'id',
        nullable: true,
    )]
    private ?Permis $permis = null;

    #[ORM\ManyToOne(
        targetEntity: Ville::class,       // non nécessaire
        inversedBy: 'habitants',
    )]
    #[ORM\JoinColumn(
        name: 'id_ville',                 // nécessaire car Symfony choisirait 'ville_id'
        referencedColumnName: 'id',       // non nécessaire
        nullable: true,                   // non nécessaire
    )]
    private ?Ville $ville = null;

    #[ORM\ManyToMany(targetEntity: Nationalite::class, inversedBy: 'habitants')]
    #[ORM\JoinTable(name: 'asso_habitants_nationalites')]
    #[ORM\JoinColumn(name: 'id_habitant', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'id_nationalite', referencedColumnName: 'id')]
    private Collection $nationalites;

    public function __construct()
    {
        $this->nationalites = new ArrayCollection();
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

    public function getPermis(): ?Permis
    {
        return $this->permis;
    }

    public function setPermis(?Permis $permis): self
    {
        $this->permis = $permis;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Nationalite>
     */
    public function getNationalites(): Collection
    {
        return $this->nationalites;
    }

    public function addNationalite(Nationalite $nationalite): self
    {
        if (!$this->nationalites->contains($nationalite)) {
            $this->nationalites->add($nationalite);
        }

        return $this;
    }

    public function removeNationalite(Nationalite $nationalite): self
    {
        $this->nationalites->removeElement($nationalite);

        return $this;
    }
}
