<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InformationsLegalesRepository")
 */
class InformationsLegales
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
    private $cgu;

    /**
     * @ORM\Column(type="text")
     */
    private $cgv;

    /**
     * @ORM\Column(type="text")
     */
    private $mentionsLegales;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCgu(): ?string
    {
        return $this->cgu;
    }

    public function setCgu(string $cgu): self
    {
        $this->cgu = $cgu;

        return $this;
    }

    public function getCgv(): ?string
    {
        return $this->cgv;
    }

    public function setCgv(string $cgv): self
    {
        $this->cgv = $cgv;

        return $this;
    }

    public function getMentionsLegales(): ?string
    {
        return $this->mentionsLegales;
    }

    public function setMentionsLegales(string $mentionsLegales): self
    {
        $this->mentionsLegales = $mentionsLegales;

        return $this;
    }
}
