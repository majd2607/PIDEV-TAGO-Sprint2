<?php

namespace App\Entity;

use App\Repository\MaintenancesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaintenancesRepository::class)]
class Maintenances
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typePanne = null;


    #[ORM\Column(length: 255)]
    private ?string $statu = null;

    #[ORM\ManyToOne(inversedBy: 'maintenances')]
    private ?Vehicules $idVehicule = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypePanne(): ?string
    {
        return $this->typePanne;
    }

    public function setTypePanne(string $typePanne): self
    {
        $this->typePanne = $typePanne;

        return $this;
    }


    public function getStatu(): ?string
    {
        return $this->statu;
    }

    public function setStatu(string $statu): self
    {
        $this->statu = $statu;

        return $this;
    }

    public function getIdVehicule(): ?vehicules
    {
        return $this->idVehicule;
    }

    public function setIdVehicule(?vehicules $idVehicule): self
    {
        $this->idVehicule = $idVehicule;

        return $this;
    }
}
