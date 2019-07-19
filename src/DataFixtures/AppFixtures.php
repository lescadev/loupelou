<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Prestataire;
use App\Entity\User;
use App\Entity\Comptoir;
use App\Entity\Informations;
use App\Entity\InformationsLegales;
use App\Entity\Evenements;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        // Création des fixtures de l'entité "admin"

        $admin = new Admin();

        $admin->setUsername("admin");
        $admin->setPassword('$argon2i$v=19$m=1024,t=2,p=2$NWtZbUNFQWVNeFF5RngyOQ$6FiZQR/Dfk39XzDI53ge+fAsUC4Kix5ddKFOVG1F55s');
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);


        // Création des fixtures de l'entité "Informations"

        $infos = new Informations();
        $infos->setPresentation("Presentation")
            ->setSlogan("Coucou");           
        $manager->persist($infos);

        //fixtures de l'entité "InformationsLegales"

        $infosL = new InformationsLegales();
        $infosL->setCgv("zefzefzefz")
            ->setCgu("zefzefzefz")
            ->setMentionsLegales("zfzfzfzfzefzefzgegze");
        $manager->persist($infosL);

        //fixtures de l'entité "User"

        $user = new User();
        $user->setPrenom("")
            ->setNom("Biocoop Au p’tit épeautre")
            ->setDateCreation(date_create())
            ->setVille("Saint-Junien")
            ->setAdresse("La croix Blanche")
            ->setPassword("test")
            ->setEmail("BioSaintJu@gmail.com")
            ->setCodePostal("87200")
            ->setLatitude(45.9016165)
            ->setLongitude(0.922393)
            ->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $user2 = new User();
        $user2->setPrenom("")
            ->setNom("Biocoop l’Aubre")
            ->setDateCreation(date_create())
            ->setVille("Limoges")
            ->setAdresse("337 rue François Perrin")
            ->setPassword("test")
            ->setEmail("BioLimoges@gmail.com")
            ->setCodePostal("87000")
            ->setLatitude(45.8230892)
            ->setLongitude(1.22248224664746)
            ->setRoles(['ROLE_USER']);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setPrenom("")
            ->setNom("Callune")
            ->setDateCreation(date_create())
            ->setVille("Eymoutiers")
            ->setAdresse("Bussy")
            ->setPassword("test")
            ->setEmail("Callune@gmail.com")
            ->setCodePostal("87120")
            ->setLatitude(45.724834)
            ->setLongitude(1.6817552)
            ->setRoles(['ROLE_USER']);

        $user4 = new User();
        $user4->setPrenom("")
            ->setNom("Guarana Café")
            ->setDateCreation(date_create())
            ->setVille("Brive-La-Gaillarde")
            ->setAdresse("158 avenue Ribot")
            ->setPassword("test")
            ->setEmail("Guarna@gmail.com")
            ->setCodePostal("19100")
            ->setLatitude(45.1646424)
            ->setLongitude(1.502554)
            ->setRoles(['ROLE_USER']);
        
        //fixtures de l'entité "Comptoir"

        $comptoir = new Comptoir();
        $comptoir->setUser($user);
        $comptoir->setDenomination("Biocoop Au p’tit épeautre");
        $comptoir2 = new Comptoir();
        $comptoir2->setUser($user2);
        $comptoir2->setDenomination("Biocoop l’Aubre");
        $presta = new Prestataire();
        $presta->setSiret("2");
        $presta->setUser($user3);
        $presta->setDenomination("Callune");
        $presta2 = new Prestataire();
        $presta2->setSiret("2");
        $presta2->setUser($user4);
        $presta2->setDenomination("Guarana Café");
        $manager->persist($user);
        $manager->persist($user2);
        $manager->persist($comptoir);
        $manager->persist($comptoir2);
        $manager->persist($presta);
        $manager->persist($presta2);
       
        for($i = 1; $i <= 10; $i++){
            $event = new Evenements();
            $event->setTitle("Événement: $i")
                  ->setDescription("voici la description de l'événement n°$i")
                  ->setLogo("http://placehold.it/250x100")
                  ->setLogoDescription("description de l'image $i")
                  ->setLienEvent("https://www.google.com")
                  ->setLieu("le lieu ce situe ici")
                  ->setDate(new \Datetime());
            
            $manager->persist($event);
        };
        
        $manager->flush();
    }
}
