<?php

namespace App\Controller;

use App\Entity\Comptoir;
use App\Entity\Prestataire;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;

class EasyAdminCustomController extends EasyAdminController {

    /**
     * Delete Prestataire Entity AND associated user if not linked to another comptoir
     * @param $entity
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function removePrestataireEntity($entity)
    {
        $user = $entity->getUser();

        $ComptoirRepository = $this->getDoctrine()->getRepository(Comptoir::class);

        $userIsLinked = $ComptoirRepository->findBy(array("user" => $user));

        if(!$userIsLinked){
            $this->em->remove($user);
        }
        else {
            $user->setRoles(['ROLE_COMPTOIR']);
        }
        $this->em->remove($entity);

        $this->em->flush();
    }

    /**
     * Delete Comptoir Entity AND associated user if not linked to another prestataire
     * @param $entity
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function removeComptoirEntity($entity)
    {
        $user = $entity->getUser();

        $PrestataireRepository = $this->getDoctrine()->getRepository(Prestataire::class);

        $userIsLinked = $PrestataireRepository->findBy(array("user" => $user));

        if(!$userIsLinked){
            $this->em->remove($user);
        }
        else {
            $user->setRoles(['ROLE_PRESTATAIRE']);
        }
        $this->em->remove($entity);

        $this->em->flush();
    }
}
