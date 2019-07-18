<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Prestataire;
use App\Entity\Comptoir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findByParams(array $params){

        $query = $this->createQueryBuilder('user');

        if(!empty($params['search']))
            $query->andWhere("user.nom LIKE :search")
                ->setParameter('search',  $params['search']. '%');

        //TODO: Create "categorie" field in user model
        if(!empty($params['filter']))
            $query->andWhere("user.categorie = :filter")
                ->setParameter('filter', $params['filter']);

        if(!empty($params['status'])){
            if($params['status'] === 'prestataire')
                $query->join(prestataire::class, 'prestataire')
                    ->andWhere('user.id = prestataire.user');
            elseif ($params['status'] === 'comptoir')
                $query->join(comptoir::class, 'comptoir')
                    ->andWhere('user.id = comptoir.user');
        }

        $res = $query->getQuery()->getArrayResult();

        return $res;
    }



    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
