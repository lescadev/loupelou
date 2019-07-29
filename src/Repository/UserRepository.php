<?php

namespace App\Repository;

use App\Entity\Categorie;
use App\Entity\User;
use App\Entity\Prestataire;
use App\Entity\Comptoir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    private $em;

    public function __construct(RegistryInterface $registry, EntityManagerInterface $em)
    {
        parent::__construct($registry, User::class);
        $this->em =$em;
    }

    public function findByParams(array $params){
        $query= $this->em->createNativeQuery('SELECT nom FROM categorie WHERE id = 1');

        // $query = $this->createQueryBuilder('user');

        // if(!empty($params['status'])){
        //     if($params['status'] === 'prestataire') {

        //         $query->innerJoin(prestataire::class, 'prestataire')
        //             ->andWhere('user.id = prestataire.user')
        //             ->select('user', 'prestataire.denomination');

        //         if(!empty($params['search']))
        //             $query->andWhere("prestataire.denomination LIKE :search OR user.description LIKE :search")
        //                 ->setParameter('search', '%' . $params['search']. '%');

        //         if(!empty($params['filter'] and $params['filter'] !== 'Tous les services'))
        //             $query->join(Categorie::class, 'c')
        //                   ->where("c.nom = '{$params['filter']}'");
        //                   var_dump($query->getSQL()); exit;
        //         // else
        //         //     $query->innerJoin(Categorie::class, 'categorie')
        //         //         ->andWhere('prestaHasCategorie.categorie = categorie.id')
        //         //         ->andWhere('prestataire.id = prestaHasCategorie.prestataire')
        //         //         ->andWhere('user.id = prestataire.user');

        //         $query->select('user', 'prestataire.denomination', 'c.nom');
        //     }

        //     elseif ($params['status'] === 'comptoir') {

        //         $query->innerJoin(comptoir::class, 'comptoir')
        //             ->andWhere('user.id = comptoir.user')
        //             ->select('user', 'comptoir.denomination');

        //         if(!empty($params['search']))
        //             $query->andWhere("comptoir.denomination LIKE :search OR user.description LIKE :search")
        //                 ->setParameter('search',  '%' . $params['search']. '%');
        //     }

        //     if(!empty($params['distance']) and !empty($params['longitude']) and !empty($params['latitude'])){
        //         $query->addSelect(
        //             '( 6371 * acos(cos(radians(' . $params['latitude'] . '))' .
        //             '* cos( radians( user.latitude ) )' .
        //             '* cos( radians( user.longitude )' .
        //             '- radians(' . $params['longitude'] . ') )' .
        //             '+ sin( radians(' . $params['latitude'] . ') )' .
        //             '* sin( radians( user.latitude ) ) ) ) as distance'
        //         )
        //             ->andHaving('distance < :radius')
        //             ->setParameter('radius', $params['distance']);
        //     }
        // }

        // $res = $query->getQuery()->getArrayResult();
        $res= $query->getResult();
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
