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
 * @method User|null find( $id, $lockMode = null, $lockVersion = null )
 * @method User|null findOneBy( array $criteria, array $orderBy = null )
 * @method User[]    findAll()
 * @method User[]    findBy( array $criteria, array $orderBy = null, $limit = null, $offset = null )
 */
class UserRepository
    extends ServiceEntityRepository
{

    private $em;

    public function __construct( RegistryInterface $registry, EntityManagerInterface $em )
    {
        parent::__construct( $registry, User::class );
        $this->em = $em;
    }

    public function findByParams( array $params )
    {

        $query = $this->createQueryBuilder( 'user' )
                      ->andWhere( 'user.isActive = true' );

        if( ! empty( $params['status'] ) ) {
            if( $params['status'] === 'prestataire' ) {

                $query->innerJoin( prestataire::class, 'prestataire' )
                      ->andWhere( 'user.id = prestataire.user' )
                      ->select( 'user', 'prestataire.denomination' );

                if( ! empty( $params['search'] ) ) {
                    $query->andWhere( "prestataire.denomination LIKE :search OR user.description LIKE :search OR user.ville LIKE :search" )
                          ->setParameter( 'search', '%' . $params['search'] . '%' );
                }

                if( ! empty( $params['filter'] and $params['filter'] !== 'Tous les services' ) ) {
                    $query->innerJoin( Categorie::class, 'categorie' )
                          ->innerJoin( 'categorie.prestataires', 'prestaHasCategorie' )
                          ->andWhere( 'categorie.nom = :filter' )
                          ->setParameter( 'filter', $params['filter'] )
                          ->andWhere( 'prestataire.id = prestaHasCategorie' )
                          ->andWhere( 'user.id = prestataire.user' );
                } else {
                    $query->innerJoin( Categorie::class, 'categorie' )
                          ->innerJoin( 'categorie.prestataires', 'prestaHasCategorie' )
                          ->andWhere( 'prestataire.id = prestaHasCategorie' )
                          ->andWhere( 'user.id = prestataire.user' );
                }
                $query->select( 'user' )->distinct();
                $query->addSelect( 'user.id as userId',
                    'user.longitude',
                    'prestataire.id',
                    'user.latitude',
                    'prestataire.denomination',
                    'categorie.nom',
                    'prestataire.site_internet' );
            } elseif( $params['status'] === 'comptoir' ) {

                $query->innerJoin( comptoir::class, 'comptoir' )
                      ->andWhere( 'user.id = comptoir.user' )
                      ->select( 'user' )->distinct()
                      ->addSelect( 'user.id as userId',
                          'user.longitude',
                          'user.latitude',
                          'comptoir.denomination',
                          'comptoir.site_internet' );

                if( ! empty( $params['search'] ) ) {
                    $query->andWhere( "comptoir.denomination LIKE :search OR user.description LIKE :search OR user.ville LIKE :search" )
                          ->setParameter( 'search', '%' . $params['search'] . '%' );
                }
            }

            if( ! empty( $params['longitude'] )
                and ! empty( $params['latitude'] ) ) {
                $query->addSelect(
                    '( 6371 * acos(cos(radians(' . $params['latitude'] . '))' .
                    '* cos( radians( user.latitude ) )' .
                    '* cos( radians( user.longitude )' .
                    '- radians(' . $params['longitude'] . ') )' .
                    '+ sin( radians(' . $params['latitude'] . ') )' .
                    '* sin( radians( user.latitude ) ) ) ) as distance'
                )
                      ->orderBy( "distance", 'ASC' );
            }

            if( ! empty( $params['distance'] ) ) {
                $query->andHaving( 'distance < :radius' )
                      ->setParameter( 'radius', $params['distance'] );
            }
        }

        $res = $query->getQuery()->getResult();

        return $res;
    }

    public function loadUserByEmail( $email )
    {
        return $this->createQueryBuilder( 'u' )
                    ->where( 'u.email = :email' )
                    ->setParameter( 'email', $email )
                    ->getQuery()
                    ->getOneOrNullResult();
    }

    public function loadUserByToken( $token )
    {
        return $this->createQueryBuilder( 'u' )
                    ->where( 'u.token = :token' )
                    ->setParameter( 'token', $token )
                    ->getQuery()
                    ->getOneOrNullResult();
    }

}
