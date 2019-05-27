<?php

namespace App\DataFixtures;

use App\Entity\Admin;
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


        //Création des fixtures de l'entité "Informations"
        $infos = new Informations();

        $infos->setPresentation("");

        $manager->persist($infos);
        $manager->flush();
    }
}
