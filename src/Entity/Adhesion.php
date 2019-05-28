<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdhesionRepository")
 */
class Adhesion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $debut_adhesion;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fin_adhesion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="adhesions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebutAdhesion(): ?\DateTimeInterface
    {
        return $this->debut_adhesion;
    }

    public function setDebutAdhesion(\DateTimeInterface $debut_adhesion): self
    {
        $this->debut_adhesion = $debut_adhesion;

        return $this;
    }

    public function getFinAdhesion(): ?\DateTimeInterface
    {
        return $this->fin_adhesion;
    }

    public function setFinAdhesion(?\DateTimeInterface $fin_adhesion): self
    {
        $this->fin_adhesion = $fin_adhesion;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
