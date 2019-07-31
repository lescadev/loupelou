<?php

namespace App\Repository;

use App\Entity\InformationsAssociation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InformationsAssociation|null find($id, $lockMode = null, $lockVersion = null)
 * @method InformationsAssociation|null findOneBy(array $criteria, array $orderBy = null)
 * @method InformationsAssociation[]    findAll()
 * @method InformationsAssociation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformationsAssociationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InformationsAssociation::class);
    }

    // /**
    //  * @return InformationsAssociation[] Returns an array of InformationsAssociation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InformationsAssociation
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
