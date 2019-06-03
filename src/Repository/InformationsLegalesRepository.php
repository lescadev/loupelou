<?php

namespace App\Repository;

use App\Entity\InformationsLegales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InformationsLegales|null find($id, $lockMode = null, $lockVersion = null)
 * @method InformationsLegales|null findOneBy(array $criteria, array $orderBy = null)
 * @method InformationsLegales[]    findAll()
 * @method InformationsLegales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformationsLegalesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InformationsLegales::class);
    }

    // /**
    //  * @return InformationsLegales[] Returns an array of InformationsLegales objects
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
    public function findOneBySomeField($value): ?InformationsLegales
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
