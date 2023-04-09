<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamations
 *
 * @ORM\Table(name="reclamations", indexes={@ORM\Index(name="fk_reclamations_users", columns={"idClient"}), @ORM\Index(name="fk_reclamations_vehicules", columns={"idVehicule"})})
 * @ORM\Entity
 */
class Reclamations
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="Vehicules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idVehicule", referencedColumnName="id")
     * })
     */
    private ?Vehicules $idvehicule = null;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    //  private $date = 'CURRENT_TIMESTAMP';
    private ?\DateTimeInterface $date = null;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean", nullable=false)
     */
    private $archive = '0';

    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="Utilisateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idClient", referencedColumnName="id")
     * })
     */
    private ?Utilisateurs $idclient = null;


    public function getId(): ?int
    {
        return $this->id;
    }





    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isArchive(): ?bool
    {
        return $this->archive;
    }

    public function setArchive(bool $archive): self
    {
        $this->archive = $archive;

        return $this;
    }

    public function getIdclient(): ?Utilisateurs
    {
        return $this->idclient;
    }

    public function setIdclient(?Utilisateurs $idclient): self
    {
        $this->idclient = $idclient;

        return $this;
    }

    public function getIdvehicule(): ?Vehicules
    {
        return $this->idvehicule;
    }

    public function setIdvehicule(?Vehicules $idvehicules): self
    {
        $this->idvehicule = $idvehicules;

        return $this;
    }
}
