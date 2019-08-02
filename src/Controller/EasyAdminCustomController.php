<?php

namespace App\Controller;

use App\Entity\Comptoir;
use App\Entity\Prestataire;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use EasyCorp\Bundle\EasyAdminBundle\Configuration\ConfigManager;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminControllerTrait;
use EasyCorp\Bundle\EasyAdminBundle\Form\Filter\FilterRegistry;
use EasyCorp\Bundle\EasyAdminBundle\Search\Autocomplete;
use EasyCorp\Bundle\EasyAdminBundle\Search\Paginator;
use EasyCorp\Bundle\EasyAdminBundle\Search\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;


class EasyAdminCustomController extends AbstractController {

    use AdminControllerTrait;

    /** @var EntityManager|null The Doctrine entity manager for the current entity */
    protected $em;

    public static function getSubscribedServices(): array
    {
        return parent::getSubscribedServices() + [
                'easyadmin.autocomplete' => Autocomplete::class,
                'easyadmin.config.manager' => ConfigManager::class,
                'easyadmin.paginator' => Paginator::class,
                'easyadmin.query_builder' => QueryBuilder::class,
                'easyadmin.property_accessor' => PropertyAccessorInterface::class,
                'easyadmin.filter.registry' => FilterRegistry::class,
                'event_dispatcher' => EventDispatcherInterface::class,
            ];
    }

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
