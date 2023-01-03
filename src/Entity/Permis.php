<?php

namespace App\Entity;

use App\Repository\PermisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PermisRepository::class)]
class Permis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prefecture = null;

    #[ORM\OneToOne(
        targetEntity: Habitant::class,
        mappedBy: 'permis',
        cascade: ['persist', 'remove'],
    )]
    private ?Habitant $habitant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrefecture(): ?string
    {
        return $this->prefecture;
    }

    public function setPrefecture(string $prefecture): self
    {
        $this->prefecture = $prefecture;

        return $this;
    }

    public function getHabitant(): ?Habitant
    {
        return $this->habitant;
    }

    public function setHabitant(?Habitant $habitant): self
    {
        // unset the owning side of the relation if necessary
        if ($habitant === null && $this->habitant !== null) {
            $this->habitant->setPermis(null);
        }

        // set the owning side of the relation if necessary
        if ($habitant !== null && $habitant->getPermis() !== $this) {
            $habitant->setPermis($this);
        }

        $this->habitant = $habitant;

        return $this;
    }
}
