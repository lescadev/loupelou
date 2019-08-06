<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{

    public $nom;
    public $prenom;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    /**
     * @ORM\Column(type="float")
     */
    private $montant;
    /**
     * @ORM\Column(type="datetime")
     */
    private $date_transaction;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\comptoir")
     * @ORM\JoinColumn(nullable=false)
     */
    private $comptoir;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser( ?user $user ): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant( float $montant ): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateTransaction(): ?DateTimeInterface
    {
        return $this->date_transaction;
    }

    public function setDateTransaction( DateTimeInterface $date_transaction ): self
    {
        $this->date_transaction = $date_transaction;

        return $this;
    }

    public function getComptoir(): ?comptoir
    {
        return $this->comptoir;
    }

    public function setComptoir( ?comptoir $comptoir ): self
    {
        $this->comptoir = $comptoir;

        return $this;
    }

    public function getNom()
    {
        if( $this->user ) {
            return $this->user->getNom();
        }
    }

    public function getPrenom()
    {
        if( $this->user ) {
            return $this->user->getPrenom();
        }
    }

}
