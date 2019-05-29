<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\User;
use App\Entity\Comptoir;
use App\Entity\Informations;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $admin = new Admin();

        $admin->setUsername("admin");
        $admin->setPassword('$argon2i$v=19$m=1024,t=2,p=2$NWtZbUNFQWVNeFF5RngyOQ$6FiZQR/Dfk39XzDI53ge+fAsUC4Kix5ddKFOVG1F55s');
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);
        $manager->flush();


        // Création des fixtures de l'entité "Informations"
        $infos = new Informations();

        $infos->setPresentation("");

        $manager->persist($infos);
        $manager->flush();

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
        $comptoir = new Comptoir();
        $comptoir->setUser($user);
        $comptoir2 = new Comptoir();
        $comptoir2->setUser($user2);
        $manager->persist($user);
        $manager->persist($user2);
        $manager->persist($comptoir);
        $manager->persist($comptoir2);
        $manager->persist($admin);
        $manager->flush();
    }
}
