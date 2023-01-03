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

    #[ORM\OneToOne(targetEntity: Permis::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(
        name: 'id_permis',
        referencedColumnName: 'id',
        nullable: true,
    )]
    private ?Permis $permis = null;

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
}
