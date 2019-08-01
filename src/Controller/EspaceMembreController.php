<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Form\InscriptionType;
use App\Form\DescriptionType;
use App\Form\TransactionType;
use App\Repository\ComptoirRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EspaceMembreController
    extends AbstractController
{

    /**
     * Affichage du profil utilisateur
     * @Route("/profil", name="profil")
     */
    public function profil()
    {
        $user = $this->getUser();

        return $this->render( "/espaceMembre/profil.html.twig",
            [
                'mail'        => $user->getEmail(),
                'prenom'      => $user->getPrenom(),
                'nom'         => $user->getNom(),
                'adresse'     => $user->getAdresse(),
                'ville'       => $user->getVille(),
                'codepostal'  => $user->getCodePostal(),
                'description' => $user->getDescription(),
                "isactive"    => $user->getIsActive(),
            ] );
    }

    /**
     * Modification du mot de passe
     * @Route("/profil/password", name="profil.password")
     */
    public function editPassword(
        Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em
    ) {
        $user = $this->getUser();

        $form = $this->createForm( InscriptionType::class );
        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->get( 'password' )->isValid() ) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get( 'password' )->getData()
                ) );
            $em->persist( $user );
            $em->flush();

            $this->addFlash( 'success', 'Votre mot de passe a été modifié' );

            return $this->redirectToRoute( 'profil' );
        }

        return $this->render( "/espaceMembre/editPassword.html.twig",
            [
                'form'     => $form->createView(),
                'isactive' => $user->getIsActive(),
            ] );
    }

    /**
     * @Route("/profil/email", name="profil.email")
     */
    public function editEmail(
        Request $request, EntityManagerInterface $em
    ) {
        $user = $this->getUser();

        $form = $this->createForm( InscriptionType::class );
        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->get( 'email' )->isValid() ) {
            $user->setEmail( $form->get( 'email' )->getData() );
            $em->persist( $user );
            $em->flush();

            $this->addFlash( 'success', 'Votre adresse e-mail a été modifiée' );

            return $this->redirectToRoute( 'profil' );
        }

        return $this->render( "/espaceMembre/editEmail.html.twig",
            [
                "form"     => $form->createView(),
                "user"     => $user,
                "isactive" => $user->getIsActive(),
            ] );
    }

    /**
     * @Route("/profil/informations", name="profil.informations")
     */
    public function editInformations(
        Request $request, EntityManagerInterface $em
    ) {
        $user = $this->getUser();

        $form = $this->createForm( InscriptionType::class );
        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->get( 'prenom' )->isValid() && $form->get( 'nom' )->isValid()
            && $form->get( 'telephone' )->isValid()
            && $form->get( 'adresse' )->isValid()
            && $form->get( 'ville' )->isValid()
            && $form->get( 'code_postal' )->isValid() ) {

            $user->setPrenom( $form->get( 'prenom' )->getData() );
            $user->setNom( $form->get( 'nom' )->getData() );
            $user->setTelephone( $form->get( 'telephone' )->getData() );
            $user->setAdresse( $form->get( 'adresse' )->getData() );
            $user->setVille( $form->get( 'ville' )->getData() );
            $user->setCodePostal( $form->get( 'code_postal' )->getData() );

            $em->persist( $user );
            $em->flush();

            $this->addFlash( 'success', 'Vos informations ont été modifiées' );

            return $this->redirectToRoute( 'profil' );
        }

        return $this->render( "/espaceMembre/editInformations.html.twig",
            [
                'form'     => $form->createView(),
                'user'     => $user,
                'isactive' => $user->getIsActive(),
            ] );
    }

    /**
     * @Route("/profil/description", name="profil.description")
     */
    public function editDescription( Request $request, EntityManagerInterface $em )
    {
        $user = $this->getUser();

        $form = $this->createForm( DescriptionType::class );
        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->get( 'description' )->isValid() ) {
            $user->setDescription( $form->get( 'description' )->getData() );

            $em->persist( $user );
            $em->flush();

            $this->addFlash( 'success', 'Votre description a été modifiée' );

            return $this->redirectToRoute( 'profil' );
        }

        return $this->render( "/espaceMembre/editDescription.html.twig",
            [
                'form'     => $form->createView(),
                'user'     => $user,
                'isactive' => $user->getIsActive(),
            ] );
    }

    /**
     * Transaction Adhérent > Comptoir
     * @Route("/profil/transaction", name="profil.transaction")
     */
    public function transaction(
        UserRepository $userRepository, ComptoirRepository $comptoirRepository, Request $request, \Swift_Mailer $mailer
    ) {
        $transaction = new Transaction();
        $transaction->setDateTransaction( new \Datetime() );

        $form = $this->createForm( TransactionType::class, $transaction );
        $form->handleRequest( $request );

        $test = $userRepository->findBy( array( "isActive" => true ) );

        $users = [];
        foreach( $test as $user ) {
            array_push( $users, [ $user->getId(), $user->getEmail(), $user->getNom(), $user->getPrenom() ] );
        };

        if( $form->isSubmitted() && $form->isValid() ) {
            $transaction = $form->getData();
            $montant     = $form->getData()->getMontant();

            $user     = $this->getUser();
            $comptoir = $comptoirRepository->findBy( array( "user" => $user ) )[0];

            $target = $request->request->get( 'select' );

            if( ( $comptoir->getSolde() - $montant ) < 0 ) {
                $this->addFlash( 'error', "Transaction refusée, solde insuffisant !" );

                return $this->redirectToRoute( 'profil.transaction' );
            } else if( ( $comptoir->getSolde() - $montant ) <= 50 ) {
                $this->addFlash( 'error', "Transaction refusée, votre solde risque d'être trop bas !" );

                return $this->redirectToRoute( 'profil.transaction' );
            } else {
                $comptoir->setSolde( $comptoir->getSolde() - $montant );
            }
            $adherent       = $userRepository->findBy( array( "id" => $target ) );
            $adherentObject = array_reduce(
                $adherent,
                function( $result, $adherent ) {
                    return $adherent;
                }
            );
            if( empty( $adherent ) ) {
                $this->addFlash( 'error', "Adhérent non reconnu." );

                return $this->redirectToRoute( 'profil.transaction' );
            }
            $transaction->setUser( $adherentObject );
            $transaction->setComptoir( $comptoir );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist( $transaction );
            $entityManager->flush();

            $message = ( new \Swift_Message( 'Transaction' ) )
                ->setFrom( $this->getParameter( 'mail.site' ) )
                ->setTo( $adherentObject->getEmail() )
                ->setBody(
                    $this->renderView(
                        'emails/transaction.html.twig',
                        [
                            'nom'              => $adherentObject->getNom(),
                            'prenom'           => $adherentObject->getPrenom(),
                            'montant'          => $form->get( 'montant' )->getData(),
                            'date_transaction' => $transaction->getDateTransaction()->format( 'd-m-Y' ),
                            'comptoir'         => $comptoir->getDenomination(),
                        ]
                    ),
                    'text/html'
                );

            $mailer->send( $message );

            if( ( $comptoir->getSolde() ) < 60 ) {
                $adminMessage = ( new \Swift_Message( 'Solde bas' ) )
                    ->setFrom( $this->getParameter( 'mail.site' ) )
                    ->setTo( $this->getParameter( 'mail.admin' ) )
                    ->setBody(
                        $this->renderView(
                            'emails/soldeBas.html.twig',
                            [ 'comptoir' => $comptoir->getDenomination() ]
                        ),
                        'text/html'
                    );

                $mailer->send( $adminMessage );
            }

            $this->addFlash( 'success', 'Transaction effectuée !' );

            return $this->redirectToRoute( 'profil.transaction' );
        }

        $user     = $this->getUser();
        $comptoir = $comptoirRepository->findBy( array( "user" => $user ) )[0];

        return $this->render( "espaceMembre/transaction.html.twig",
            [
                'nom'   => $comptoir->getDenomination(),
                'solde' => $comptoir->getSolde(),
                'form'  => $form->createView(),
                'users' => $users,
            ] );
    }
}
