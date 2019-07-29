<?php

namespace App\Repository;

use App\Entity\Comptoir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Comptoir|null find( $id, $lockMode = null, $lockVersion = null )
 * @method Comptoir|null findOneBy( array $criteria, array $orderBy = null )
 * @method Comptoir[]    findAll()
 * @method Comptoir[]    findBy( array $criteria, array $orderBy = null, $limit = null, $offset = null )
 */
class ComptoirRepository
    extends ServiceEntityRepository
{

    public function __construct( RegistryInterface $registry )
    {
        parent::__construct( $registry, Comptoir::class );
    }

    // /**
    //  * @return Comptoir[] Returns an array of Comptoir objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Comptoir
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
