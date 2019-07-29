<?php

namespace App\Repository;

use App\Entity\PrestataireHasCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PrestataireHasCategorie|null find( $id, $lockMode = null, $lockVersion = null )
 * @method PrestataireHasCategorie|null findOneBy( array $criteria, array $orderBy = null )
 * @method PrestataireHasCategorie[]    findAll()
 * @method PrestataireHasCategorie[]    findBy( array $criteria, array $orderBy = null, $limit = null, $offset = null )
 */
class PrestataireHasCategorieRepository
    extends ServiceEntityRepository
{

    public function __construct( RegistryInterface $registry )
    {
        parent::__construct( $registry, PrestataireHasCategorie::class );
    }

    // /**
    //  * @return PrestataireHasCategorie[] Returns an array of PrestataireHasCategorie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrestataireHasCategorie
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
