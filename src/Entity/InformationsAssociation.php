<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InformationsAssociationRepository")
 */
class InformationsAssociation
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $Statuts;

    /**
     * @ORM\Column(type="text")
     */
    private $ReglementInterieur;

    /**
     * @ORM\Column(type="text")
     */
    private $CompteRenduAG;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatuts(): ?string
    {
        return $this->Statuts;
    }

    public function setStatuts( string $Statuts ): self
    {
        $this->Statuts = $Statuts;

        return $this;
    }

    public function getReglementInterieur(): ?string
    {
        return $this->ReglementInterieur;
    }

    public function setReglementInterieur( string $ReglementInterieur ): self
    {
        $this->ReglementInterieur = $ReglementInterieur;

        return $this;
    }

    public function getCompteRenduAG(): ?string
    {
        return $this->CompteRenduAG;
    }

    public function setCompteRenduAG( string $CompteRenduAG ): self
    {
        $this->CompteRenduAG = $CompteRenduAG;

        return $this;
    }
}
