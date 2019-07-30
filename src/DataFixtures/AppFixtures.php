<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\User;
use App\Entity\Particulier;
use App\Entity\Prestataire;
use App\Entity\Comptoir;
use App\Entity\Categorie;
use App\Entity\PrestataireHasCategorie;
use App\Entity\Informations;
use App\Entity\InformationsLegales;
use App\Entity\ArticleBlog;
use App\Entity\Evenements;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures
    extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * AppFixtures constructor
     *
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct( UserPasswordEncoderInterface $userPasswordEncoder )
    {
        $this->encoder = $userPasswordEncoder;
    }

    public function load( ObjectManager $manager )
    {

        // Fixtures de l'entité "admin"
        $admin = new Admin();
        $admin->setPrenom( 'Administrateur' )
              ->setNom( 'Lou Pélou' )
              ->setUsername( "admin" )
              ->setPassword( $this->encoder->encodePassword( $admin, 'admin' ) )
              ->setRoles( [ 'ROLE_ADMIN' ] );
        $manager->persist( $admin );

        // Fixtures de l'entité "Informations"
        $infos = new Informations();
        $infos->setPresentation( "<h2>Présentation</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida et nulla ac lacinia. Nullam ut lorem eget leo faucibus tempus id et purus. Vivamus venenatis feugiat commodo. Donec lobortis ut lectus sit amet iaculis. Nunc fringilla turpis sem, interdum interdum dolor faucibus volutpat. Donec sed ante nisi. Cras bibendum molestie odio placerat dictum. Vestibulum venenatis nulla diam, eget mollis magna mollis sed. Cras eget sollicitudin mi. Aliquam in enim vitae libero varius lobortis ut quis libero. Etiam tincidunt egestas metus, at laoreet ante rutrum id.</p>" )
              ->setSlogan( "Notre monnaie nous appartient<br />Redonnons-lui du sens !" );
        $manager->persist( $infos );

        // Fixtures de l'entité "InformationsLegales"
        $infosL = new InformationsLegales();
        $infosL->setCgv( "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida et nulla ac lacinia. Nullam ut lorem eget leo faucibus tempus id et purus. Vivamus venenatis feugiat commodo. Donec lobortis ut lectus sit amet iaculis. Nunc fringilla turpis sem, interdum interdum dolor faucibus volutpat. Donec sed ante nisi. Cras bibendum molestie odio placerat dictum. Vestibulum venenatis nulla diam, eget mollis magna mollis sed. Cras eget sollicitudin mi. Aliquam in enim vitae libero varius lobortis ut quis libero. Etiam tincidunt egestas metus, at laoreet ante rutrum id.</p>" )
               ->setCgu( "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida et nulla ac lacinia. Nullam ut lorem eget leo faucibus tempus id et purus. Vivamus venenatis feugiat commodo. Donec lobortis ut lectus sit amet iaculis. Nunc fringilla turpis sem, interdum interdum dolor faucibus volutpat. Donec sed ante nisi. Cras bibendum molestie odio placerat dictum. Vestibulum venenatis nulla diam, eget mollis magna mollis sed. Cras eget sollicitudin mi. Aliquam in enim vitae libero varius lobortis ut quis libero. Etiam tincidunt egestas metus, at laoreet ante rutrum id.</p>" )
               ->setMentionsLegales( "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida et nulla ac lacinia. Nullam ut lorem eget leo faucibus tempus id et purus. Vivamus venenatis feugiat commodo. Donec lobortis ut lectus sit amet iaculis. Nunc fringilla turpis sem, interdum interdum dolor faucibus volutpat. Donec sed ante nisi. Cras bibendum molestie odio placerat dictum. Vestibulum venenatis nulla diam, eget mollis magna mollis sed. Cras eget sollicitudin mi. Aliquam in enim vitae libero varius lobortis ut quis libero. Etiam tincidunt egestas metus, at laoreet ante rutrum id.</p>" );
        $manager->persist( $infosL );

        // Fixtures de l'entité "User"
        $user = new User();
        $user->setPrenom( "" )
             ->setNom( "Biocoop Au p’tit épeautre" )
             ->setDateCreation( date_create() )
             ->setVille( "Saint-Junien" )
             ->setAdresse( "La croix Blanche" )
             ->setPassword( $this->encoder->encodePassword( $user, 'test' ) )
             ->setEmail( "BioSaintJu@gmail.com" )
             ->setCodePostal( "87200" )
             ->setLatitude( 45.9016165 )
             ->setLongitude( 0.922393 )
             ->setRoles( [ 'ROLE_COMPTOIR' ] );
        $manager->persist( $user );

        $user2 = new User();
        $user2->setPrenom( "" )
              ->setNom( "Biocoop l’Aubre" )
              ->setDateCreation( date_create() )
              ->setVille( "Limoges" )
              ->setAdresse( "337 rue François Perrin" )
              ->setPassword( $this->encoder->encodePassword( $user2, 'test' ) )
              ->setEmail( "BioLimoges@gmail.com" )
              ->setCodePostal( "87000" )
              ->setLatitude( 45.8230892 )
              ->setLongitude( 1.22248224664746 )
              ->setRoles( [ 'ROLE_COMPTOIR' ] );
        $manager->persist( $user2 );

        $user3 = new User();
        $user3->setPrenom( "" )
              ->setNom( "Callune" )
              ->setDateCreation( date_create() )
              ->setVille( "Eymoutiers" )
              ->setAdresse( "Bussy" )
              ->setPassword( $this->encoder->encodePassword( $user3, 'test' ) )
              ->setEmail( "Callune@gmail.com" )
              ->setCodePostal( "87120" )
              ->setLatitude( 45.724834 )
              ->setLongitude( 1.6817552 )
              ->setRoles( [ 'ROLE_PRESTATAIRE' ] )
              ->setDescription( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac ipsum eleifend, convallis tellus ut, convallis nibh. Integer vitae lobortis quam, in auctor odio. Duis pulvinar sollicitudin leo, ut tincidunt diam hendrerit sit amet. Praesent porta vehicula neque sed fringilla. Integer eu commodo lorem, id egestas ipsum. Praesent lobortis ut turpis a cursus. Aenean suscipit ut nunc at sodales. Duis congue sollicitudin turpis eu volutpat. Nunc sed urna vitae lectus bibendum iaculis. Mauris elementum magna mi. Suspendisse orci felis, vulputate a auctor vel, luctus vitae justo.' );
        $manager->persist( $user3 );

        $user4 = new User();
        $user4->setPrenom( "" )
              ->setNom( "Guarana Café" )
              ->setDateCreation( date_create() )
              ->setVille( "Brive-La-Gaillarde" )
              ->setAdresse( "158 avenue Ribot" )
              ->setPassword( $this->encoder->encodePassword( $user4, 'test' ) )
              ->setEmail( "Guarna@gmail.com" )
              ->setCodePostal( "19100" )
              ->setLatitude( 45.1646424 )
              ->setLongitude( 1.502554 )
              ->setRoles( [ 'ROLE_PRESTATAIRE' ] )
              ->setDescription( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac ipsum eleifend, convallis tellus ut, convallis nibh. Integer vitae lobortis quam, in auctor odio. Duis pulvinar sollicitudin leo, ut tincidunt diam hendrerit sit amet. Praesent porta vehicula neque sed fringilla. Integer eu commodo lorem, id egestas ipsum. Praesent lobortis ut turpis a cursus. Aenean suscipit ut nunc at sodales. Duis congue sollicitudin turpis eu volutpat. Nunc sed urna vitae lectus bibendum iaculis. Mauris elementum magna mi. Suspendisse orci felis, vulputate a auctor vel, luctus vitae justo.' );
        $manager->persist( $user4 );

        $user5 = new User();
        $user5->setPrenom( "Brigitte" )
              ->setNom( "Froidefond" )
              ->setDateCreation( date_create() )
              ->setVille( "LIMOGES" )
              ->setAdresse( "74 rue Santos Dumont" )
              ->setPassword( $this->encoder->encodePassword( $user5, 'test' ) )
              ->setTelephone( '0568452154' )
              ->setEmail( "Gthsfdfga@gmail.com" )
              ->setCodePostal( "87000" )
              ->setLatitude( 45.811710 )
              ->setLongitude( 1.274990 )
              ->setRoles( [ 'ROLE_PRESTATAIRE' ] )
              ->setDescription( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac ipsum eleifend, convallis tellus ut, convallis nibh. Integer vitae lobortis quam, in auctor odio. Duis pulvinar sollicitudin leo, ut tincidunt diam hendrerit sit amet. Praesent porta vehicula neque sed fringilla. Integer eu commodo lorem, id egestas ipsum. Praesent lobortis ut turpis a cursus. Aenean suscipit ut nunc at sodales. Duis congue sollicitudin turpis eu volutpat. Nunc sed urna vitae lectus bibendum iaculis. Mauris elementum magna mi. Suspendisse orci felis, vulputate a auctor vel, luctus vitae justo.' );
        $manager->persist( $user5 );

        $user6 = new User();
        $user6->setPrenom( "Joseph" )
              ->setNom( "Durand" )
              ->setDateCreation( date_create() )
              ->setVille( "Saint-Léonard-de-Noblat" )
              ->setAdresse( "10 rue Saint-Léonard" )
              ->setPassword( $this->encoder->encodePassword( $user6, 'test' ) )
              ->setTelephone( '0102030405' )
              ->setEmail( "joseph@durand.com" )
              ->setCodePostal( "87400" )
              ->setRoles( [ 'ROLE_PARTICULIER' ] );
        $manager->persist( $user6 );

        // Fixtures de l'entité "Comptoir"
        $comptoir = new Comptoir();
        $comptoir->setUser( $user )
                 ->setDenomination( "Biocoop Au p’tit épeautre" )
                 ->setSolde( 1000 );
        $manager->persist( $comptoir );

        $comptoir2 = new Comptoir();
        $comptoir2->setUser( $user2 )
                  ->setDenomination( "Biocoop l’Aubre" )
                  ->setSolde( 1000 );
        $manager->persist( $comptoir2 );

        // Fixtures de l'entité "Prestataire"
        $presta = new Prestataire();
        $presta->setUser( $user3 )
               ->setDenomination( "Callune" )
               ->setSiret( "2" );
        $manager->persist( $presta );

        $presta2 = new Prestataire();
        $presta2->setUser( $user4 )
                ->setDenomination( "Guarana Café" )
                ->setSiret( "2" );
        $manager->persist( $presta2 );

        $presta3 = new Prestataire();
        $presta3->setUser( $user5 )
                ->setDenomination( 'Bridgets Muffins' );
        $manager->persist( $presta3 );

        // Fixtures de l'entité "Particulier"
        $particulier = new Particulier();
        $particulier->setUser( $user6 );
        $manager->persist( $particulier );

        // Fixtures de l'entité "Categorie"
        $categoryList = [
            'Association',
            'Alimentation',
            'Artisanat',
            'Sante',
            'Culture',
            'Education',
            'Hotellerie',
            'Social',
            'Magasin',
            'Restauration',
            'Service',
        ];
        for( $i = 0; $i < count( $categoryList ); $i ++ ) {
            $category[ $i ] = new Categorie();
            $category[ $i ]->setNom( $categoryList[ $i ] );
            $manager->persist( $category[ $i ] );
        }

        $prestaHasCategorie = new PrestataireHasCategorie();
        $prestaHasCategorie->setPrestataire( $presta )
                           ->setCategorie( $category[0] );
        $manager->persist( $prestaHasCategorie );

        $prestaHasCategorie2 = new PrestataireHasCategorie();
        $prestaHasCategorie2->setPrestataire( $presta2 )
                            ->setCategorie( $category[9] );
        $manager->persist( $prestaHasCategorie2 );

        $prestaHasCategorie3 = new PrestataireHasCategorie();
        $prestaHasCategorie3->setPrestataire( $presta3 )
                            ->setCategorie( $category[1] );
        $manager->persist( $prestaHasCategorie3 );

        // Fixtures de l'entité "Blog"
        for( $i = 1; $i <= 10; $i ++ ) {
            $article = new ArticleBlog();
            $article->setTitle( "Titre de l'article n°$i" )
                    ->setContent( "Voici le contenu de l'article n°$i Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum repellat iure laboriosam dolore esse dolor!" )
                    ->setImage( "http://placehold.it/350x200" )
                    ->setImageDescription( "description de l'image $i" )
                    ->setCreatedAt( new \DateTime() );
            $manager->persist( $article );
        };

        // Fixtures de l'entité "Evenements"
        for( $i = 1; $i <= 10; $i ++ ) {
            $event = new Evenements();
            $event->setTitle( "Événement: $i" )
                  ->setDescription( "voici la description de l'événement n°$i" )
                  ->setLogo( "http://placehold.it/250x100" )
                  ->setLogoDescription( "description de l'image $i" )
                  ->setLienEvent( "https://www.google.com" )
                  ->setLieu( "le lieu ce situe ici" )
                  ->setDate( new \Datetime() );
            $manager->persist( $event );
        };

        $manager->flush();
    }
}
