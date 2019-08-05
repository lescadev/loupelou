<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\User;
use App\Entity\Comptoir;
use App\Entity\Categorie;
use App\Entity\Particulier;
use App\Entity\Prestataire;
use App\Entity\Informations;
use App\Entity\InformationsLegales;
use App\Entity\InformationsAssociation;
use App\Entity\ArticleBlog;
use App\Entity\Evenements;
use Datetime;
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
        $infos->setSlogan( "Notre monnaie nous appartient<br />Redonnons-lui du sens !" )
              ->setTitrePresentation( "Association Le Chemin Limousin" )
              ->setPresentation( "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut varius odio at lacus varius dapibus. Sed consequat nisi et vehicula suscipit. In hac habitasse platea dictumst. Donec accumsan laoreet mollis. Vestibulum laoreet mi elit, sit amet lacinia orci mollis sed. Donec mattis ligula justo, vel <strong>dictum</strong> tortor pretium eu. Nunc dictum sodales convallis. Donec mi risus, dictum at commodo sit amet, ultricies id dui. Duis vitae placerat odio, vitae aliquam nisl. Mauris euismod lectus sed ante vestibulum, ut venenatis dolor dictum.</p><p>Duis vitae ex justo. Nunc gravida nunc velit, at fermentum magna condimentum eget. Vestibulum vel nibh ac est hendrerit semper at vitae neque. <strong>Fusce</strong> posuere, libero eu malesuada sagittis, nulla elit pharetra erat, a lobortis velit diam at sem. Pellentesque tincidunt lorem auctor, aliquam quam in, bibendum nisl. Mauris mollis, lorem vel maximus placerat, ex dolor bibendum nisi, suscipit luctus arcu elit ac augue. Cras eu vulputate mauris, rutrum dictum est. Praesent tempus lectus ac ex pharetra mattis. Sed sollicitudin tellus in lectus ultrices, quis porta risus maximus. Duis facilisis malesuada augue quis sodales. Praesent ante ligula, pretium ultrices sagittis nec, lacinia nec odio. Duis at felis nunc.</p><p>Nunc vulputate mauris magna, quis molestie leo tristique et. Integer quis facilisis tortor, vitae tincidunt dui. Nam odio nulla, elementum sed cursus ut, auctor quis nunc. Donec eu porttitor sapien. Duis sed nibh dapibus, pharetra massa ac, mollis nibh. Curabitur elementum ante at orci vehicula blandit. Ut neque eros, fermentum id dignissim sit amet, rhoncus et urna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis dapibus tempor lectus rutrum congue. Sed <strong>faucibus</strong>, nunc ac tincidunt eleifend, tellus magna semper ligula, et lacinia dolor sem ut tellus. Suspendisse potenti. Nam pellentesque justo eget mi aliquet lobortis. Donec ligula ipsum, tristique sed nulla malesuada, pulvinar facilisis massa. Praesent luctus tempus tellus ac vehicula.</p>" )
              ->setAdresse( 'La Chapelle' )
              ->setCodePostal( '87380' )
              ->setVille( 'Château-Chervix' )
              ->setEmail( '01monnaielocalelimousine@gmail.com' )
              ->setFacebook( 'http://www.facebook.com/lechemindupelou/' );
        $manager->persist( $infos );

        // Fixtures de l'entité "InformationsLegales"
        $infosL = new InformationsLegales();
        $infosL->setCgv( "<p>(CGV) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida et nulla ac lacinia. Nullam ut lorem eget leo faucibus tempus id et purus. Vivamus venenatis feugiat commodo. Donec lobortis ut lectus sit amet iaculis. Nunc fringilla turpis sem, interdum interdum dolor faucibus volutpat. Donec sed ante nisi. Cras bibendum molestie odio placerat dictum. Vestibulum venenatis nulla diam, eget mollis magna mollis sed. Cras eget sollicitudin mi. Aliquam in enim vitae libero varius lobortis ut quis libero. Etiam tincidunt egestas metus, at laoreet ante rutrum id.</p>" )
               ->setCgu( "<p>(CGU) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida et nulla ac lacinia. Nullam ut lorem eget leo faucibus tempus id et purus. Vivamus venenatis feugiat commodo. Donec lobortis ut lectus sit amet iaculis. Nunc fringilla turpis sem, interdum interdum dolor faucibus volutpat. Donec sed ante nisi. Cras bibendum molestie odio placerat dictum. Vestibulum venenatis nulla diam, eget mollis magna mollis sed. Cras eget sollicitudin mi. Aliquam in enim vitae libero varius lobortis ut quis libero. Etiam tincidunt egestas metus, at laoreet ante rutrum id.</p>" )
               ->setMentionsLegales( "<p>(ML) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida et nulla ac lacinia. Nullam ut lorem eget leo faucibus tempus id et purus. Vivamus venenatis feugiat commodo. Donec lobortis ut lectus sit amet iaculis. Nunc fringilla turpis sem, interdum interdum dolor faucibus volutpat. Donec sed ante nisi. Cras bibendum molestie odio placerat dictum. Vestibulum venenatis nulla diam, eget mollis magna mollis sed. Cras eget sollicitudin mi. Aliquam in enim vitae libero varius lobortis ut quis libero. Etiam tincidunt egestas metus, at laoreet ante rutrum id.</p>" );
        $manager->persist( $infosL );

        // Fixtures de l'entité "InformationsAssociation"
        $infosA = new InformationsAssociation();
        $infosA->setStatuts( "<p>(ST) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida et nulla ac lacinia. Nullam ut lorem eget leo faucibus tempus id et purus. Vivamus venenatis feugiat commodo. Donec lobortis ut lectus sit amet iaculis. Nunc fringilla turpis sem, interdum interdum dolor faucibus volutpat. Donec sed ante nisi. Cras bibendum molestie odio placerat dictum. Vestibulum venenatis nulla diam, eget mollis magna mollis sed. Cras eget sollicitudin mi. Aliquam in enim vitae libero varius lobortis ut quis libero. Etiam tincidunt egestas metus, at laoreet ante rutrum id.</p>" )
               ->setReglementInterieur( "<p>(RI) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida et nulla ac lacinia. Nullam ut lorem eget leo faucibus tempus id et purus. Vivamus venenatis feugiat commodo. Donec lobortis ut lectus sit amet iaculis. Nunc fringilla turpis sem, interdum interdum dolor faucibus volutpat. Donec sed ante nisi. Cras bibendum molestie odio placerat dictum. Vestibulum venenatis nulla diam, eget mollis magna mollis sed. Cras eget sollicitudin mi. Aliquam in enim vitae libero varius lobortis ut quis libero. Etiam tincidunt egestas metus, at laoreet ante rutrum id.</p>" )
               ->setCompteRenduAG( "<p>(AG) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida et nulla ac lacinia. Nullam ut lorem eget leo faucibus tempus id et purus. Vivamus venenatis feugiat commodo. Donec lobortis ut lectus sit amet iaculis. Nunc fringilla turpis sem, interdum interdum dolor faucibus volutpat. Donec sed ante nisi. Cras bibendum molestie odio placerat dictum. Vestibulum venenatis nulla diam, eget mollis magna mollis sed. Cras eget sollicitudin mi. Aliquam in enim vitae libero varius lobortis ut quis libero. Etiam tincidunt egestas metus, at laoreet ante rutrum id.</p>" );
        $manager->persist( $infosA );

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

        $presta->addCategory( $category[1] );
        $presta->addCategory( $category[0] );

        $presta2->addCategory( $category[5] );
        $presta2->addCategory( $category[8] );
        $presta2->addCategory( $category[3] );

        $presta3->addCategory( $category[6] );
        $presta3->addCategory( $category[5] );

        $manager->persist( $user );
        $manager->persist( $user2 );
        $manager->persist( $user5 );
        $manager->persist( $presta3 );
        $manager->persist( $comptoir );
        $manager->persist( $comptoir2 );
        $manager->persist( $presta );
        $manager->persist( $presta2 );

        // Blog fixtures

        // Fixtures de l'entité "Blog"
        for( $i = 1; $i <= 10; $i ++ ) {
            $article = new ArticleBlog();
            $article->setTitle( "Titre de l'article n°$i" )
                    ->setContent( "Voici le contenu de l'article n°$i Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum repellat iure laboriosam dolore esse dolor!" )
                    ->setImage( "http://placehold.it/350x200" )
                    ->setImageDescription( "description de l'image $i" )
                    ->setCreatedAt( new DateTime() );
            $manager->persist( $article );
        };

        // Fixtures de l'entité "Evenements"
        for( $i = 1; $i <= 10; $i ++ ) {
            $event = new Evenements();
            $event->setTitle( "Événement: $i" )
                  ->setDescription( "voici la description de l'événement n°$i" )
                  ->setImage( "http://placehold.it/350x200" )
                  ->setImageDescription( "description de l'image $i" )
                  ->setLienEvent( "https://www.google.com" )
                  ->setLieu( "le lieu ce situe ici" )
                  ->setDate( new Datetime() );
            $manager->persist( $event );
        };

        $manager->flush();
    }
}
