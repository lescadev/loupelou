<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticulierRepository")
 */
class Particulier
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsActive()
    {
        return $this->getUser()->getIsActive();
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser( User $user ): self
    {
        $this->user = $user;

        return $this;
    }

    public function setIsActive( bool $isActive )
    {
        return $this->getUser()->setIsActive( $isActive );
    }

    public function getNom(): ?string
    {
        return $this->getUser()->getNom();
    }

    public function setNom( string $nom )
    {
        return $this->getUser()->setNom( $nom );
    }

    public function getPrenom(): ?string
    {
        return $this->getUser()->getPrenom();
    }

    public function setPrenom( string $prenom )
    {
        return $this->getUser()->setPrenom( $prenom );
    }

    public function getEmail(): ?string
    {
        return $this->getUser()->getEmail();
    }

    public function setEmail( string $email )
    {
        return $this->getUser()->setEmail( $email );
    }

    public function getAdresse(): ?string
    {
        return $this->getUser()->getAdresse();
    }

    public function setAdresse( string $adresse )
    {
        return $this->getUser()->setAdresse( $adresse );
    }

    public function getCodePostal(): ?string
    {
        return $this->getUser()->getCodePostal();
    }

    public function setCodePostal( string $codePostal )
    {
        return $this->getUser()->setCodePostal( $codePostal );
    }

    public function getVille()
    {
        return $this->getUser()->getVille();
    }

    public function setVille( string $ville )
    {
        return $this->getUser()->setVille( $ville );
    }

    public function getTelephone(): ?string
    {
        return $this->getUser()->getTelephone();
    }

    public function setTelephone( string $telephone )
    {
        return $this->getUser()->setTelephone( $telephone );
    }
}
