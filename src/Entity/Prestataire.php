<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

// use Symfony\Component\Validator\Constraints\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrestataireRepository")
 */
class Prestataire
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $site_internet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $denomination;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Categorie", inversedBy="prestataires")
     * @ORM\JoinTable(name="prestataire_categorie",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="categorie", referencedColumnName="id")
     *   })
     */
    private $categories;

    public function __construct()
    {
        // $this->category = new Collection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function setCategories( Categorie $categories )
    {
        $this->categories = $categories;

        return $this;
    }

    public function getSiteInternet(): ?string
    {
        return $this->site_internet;
    }

    public function setSiteInternet( ?string $site_internet ): self
    {
        $this->site_internet = $site_internet;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret( string $siret ): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getDenomination(): ?string
    {
        return $this->denomination;
    }

    public function setDenomination( string $denomination ): self
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getNom()
    {
        return $this->getUser()->getNom();
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

    public function setNom( string $nom )
    {
        return $this->getUser()->setNom( $nom );
    }

    public function getPrenom()
    {
        return $this->getUser()->getPrenom();
    }

    public function setPrenom( string $prenom )
    {
        return $this->getUser()->setPrenom( $prenom );
    }

    public function getIsActive()
    {
        return $this->getUser()->getIsActive();
    }

    public function setIsActive( bool $isActive )
    {
        return $this->getUser()->setIsActive( $isActive );
    }

    public function getTelephone()
    {
        return $this->getUser()->getTelephone();
    }

    public function setTelephone( string $telephone )
    {
        return $this->getUser()->setTelephone( $telephone );
    }

    public function getEmail()
    {
        return $this->getUser()->getEmail();
    }

    public function setEmail( string $email )
    {
        return $this->getUser()->setEmail( $email );
    }

    public function getAdresse()
    {
        return $this->getUser()->getAdresse();
    }

    public function setAdresse( string $adresse )
    {
        return $this->getUser()->setAdresse( $adresse );
    }

    public function getVille()
    {
        return $this->getUser()->getVille();
    }

    public function setVille( string $ville )
    {
        return $this->getUser()->setVille( $ville );
    }

    public function getDescription()
    {
        return $this->getUser()->getDescription();
    }

    public function setDescription( $description )
    {
        return $this->getUser()->setDescription( $description );
    }

    public function getCodePostal()
    {
        return $this->getUser()->getCodePostal();
    }

    public function setCodePostal( string $codePostal )
    {
        return $this->getUser()->setCodePostal( $codePostal );
    }

    public function addCategory( Categorie $category ): self
    {
        if( ! $this->categories->contains( $category ) ) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory( Categorie $category ): self
    {
        if( $this->categories->contains( $category ) ) {
            $this->categories->removeElement( $category );
        }

        return $this;
    }

}
