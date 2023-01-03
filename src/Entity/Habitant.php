<?php

namespace App\Entity;

use App\Repository\HabitantRepository;
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
}
