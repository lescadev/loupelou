<?php

namespace App\Controller;

use App\Entity\Comptoir;
use App\Entity\Particulier;
use App\Entity\Prestataire;
use App\Entity\User;
use App\Form\CategorieType;
use App\Form\InscriptionProType;
use App\Form\InscriptionType;
use App\Form\ResetPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use ReCaptcha\ReCaptcha;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserController
    extends AbstractController
{

    /**
     * Inscription Adhérent
     * @Route("/particulier/inscription", name="user.inscriptionParticulier")
     */
    public function inscriptionParticulier(
        Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer
    ) {
        $recaptcha = new ReCaptcha( $this->getParameter( 'google_recaptcha_secret' ) );

        $user = new User();
        $user->setDateCreation( date_create() );
        $user->setRoles( [ "ROLE_PARTICULIER" ] );
        $user->setIsActive( false );

        $particulier = new Particulier();
        $particulier->setUser( $user );

        $form = $this->createForm( InscriptionType::class, $user );
        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->isValid() ) {

            $resp = $recaptcha->verify( $request->request->get( 'recaptchaToken' ), $request->getClientIp() );
            if( $resp->isSuccess() ) {

                $form->getData();
                $user = $form->getData();
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get( 'password' )->getData()
                    )
                );

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist( $user );
                $entityManager->persist( $particulier );
                $entityManager->flush();

                $message = ( new \Swift_Message( 'Inscription sur le site Lou Pélou' ) )
                    ->setFrom( $this->getParameter( 'mail.site' ) )
                    ->setTo( $form->get( 'email' )->getData() )
                    ->setBody(
                        $this->renderView(
                            'emails/inscription.html.twig',
                            [
                                'nom'    => $form->get( 'nom' )->getData(),
                                'prenom' => $form->get( 'prenom' )->getData(),
                                'email'  => $form->get( 'email' )->getData(),
                                'type'   => 'particulier',
                            ]
                        ),
                        'text/html'
                    );

                $mailer->send( $message );

                $adminMessage = ( new \Swift_Message( 'Inscription sur le site Lou Pélou' ) )
                    ->setFrom( $this->getParameter( 'mail.site' ) )
                    ->setTo( $this->getParameter( 'mail.admin' ) )
                    ->setBody(
                        $this->renderView(
                            'emails/adminInscription.html.twig',
                            [
                                'nom'    => $form->get( 'nom' )->getData(),
                                'prenom' => $form->get( 'prenom' )->getData(),
                                'email'  => $form->get( 'email' )->getData(),
                                'type'   => 'particulier',
                            ]
                        ),
                        'text/html'
                    );

                $mailer->send( $adminMessage );

                $this->addFlash( 'success',
                    'Votre inscription est effective et va être prise en compte prochainement' );

                return $this->redirectToRoute( 'user.inscriptionSuccess' );
            }
        }

        return $this->render( 'user/inscriptionParticulier.html.twig',
            [
                'form'    => $form->createView(),
                'siteKey' => $this->getParameter( 'google_recaptcha_site_key' ),
            ] );
    }

    /**
     * Inscription Prestataire & Comptoir
     * @Route("/professionnel/inscription", name="user.inscriptionProfessionnel")
     */
    public function inscriptionProfessionnel(
        Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer
    ) {
        $recaptcha = new ReCaptcha( $this->getParameter( 'google_recaptcha_secret' ) );

        $user = new User();
        $user->setDateCreation( date_create() );
        $user->setIsActive( false );

        $form = $this->createForm( InscriptionType::class, $user );
        $form->handleRequest( $request );

        $formPro = $this->createForm( InscriptionProType::class );
        $formPro->handleRequest( $request );

        $formCategorie = $this->createForm( CategorieType::class );
        $formCategorie->handleRequest( $request );

        if( $form->isSubmitted() && $form->isValid() ) {

            $resp = $recaptcha->verify( $request->request->get( 'recaptchaToken' ), $request->getClientIp() );
            if( $resp->isSuccess() ) {

                $form->getData();
                $user = $form->getData();
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get( 'password' )->getData()
                    )
                );
                $data = $formPro->getData();

                $entityManager = $this->getDoctrine()->getManager();

                //Conversion de l'adresse en coordonnées GPS pour la map
                $client = new Client();

                $address   = $form->get( 'adresse' )->getData();
                $ville     = $form->get( 'ville' )->getData();
                $address_f = $address . " " . $ville;
                $prepAddr  = str_replace( ' ', '+', $address_f );

                try {
                    $res = $client->request( 'GET', 'https://api-adresse.data.gouv.fr/search/?q=' . $prepAddr );

                    $json   = $res->getBody();
                    $json_d = json_decode( $json );

                    $lon = $json_d->features[0]->geometry->coordinates[0];
                    $lat = $json_d->features[0]->geometry->coordinates[1];
                } catch( \Exception $exception ) {
                    $lat = null;
                    $lon = null;
                }

                $user->setLongitude( $lon );
                $user->setLatitude( $lat );

                if( ! empty( $data['compt'] ) ) {
                    $comptoir = new Comptoir;
                    $comptoir->setUser( $user );
                    $user->setRoles( [ "ROLE_COMPTOIR" ] );

                    if( ! empty( $data['siret'] ) ) {
                        $comptoir->setSiret( $data["siret"] );
                    }
                    if( ! empty( $data['site_internet'] ) ) {
                        $comptoir->setSiteInternet( $data["site_internet"] );
                    }

                    $comptoir->setDenomination( $data["denomination"] );

                    $entityManager->persist( $comptoir );
                }

                if( ! empty( $data['presta'] ) ) {
                    $prestataire = new Prestataire;
                    $prestataire->setUser( $user );
                    $categorie = $formCategorie->getData();
                    $user->setRoles( [ "ROLE_PRESTATAIRE" ] );

                    if( ! empty( $data['siret'] ) ) {
                        $prestataire->setSiret( $data["siret"] );
                    }
                    if( ! empty( $data['site_internet'] ) ) {
                        $prestataire->setSiteInternet( $data["site_internet"] );
                    }

                    $prestataire->setDenomination( $data["denomination"] );

                    $categorieObject = array_reduce(
                        $categorie,
                        function( $result, $categorie ) {
                            return $categorie;
                        }
                    );

                    $prestataire->addCategory( $categorieObject );

                    $entityManager->persist( $prestataire );
                }

                if( ! empty( $data['compt'] ) && ! empty( $data['presta'] ) ) {
                    $user->setRoles( [ "ROLE_PRESTATAIRE", "ROLE_COMPTOIR" ] );
                    $userType = 'comptoir & prestataire';
                } else if( ! empty( $data['compt'] ) ) {
                    $userType = 'comptoir';
                } else if( ! empty( $data['presta'] ) ) {
                    $userType = 'prestataire';
                }

                if( ! empty( $data['compt'] ) | ! empty( $data['presta'] ) ) {
                    $entityManager->flush();

                    $message = ( new \Swift_Message( 'Inscription sur le site Lou Pélou' ) )
                        ->setFrom( $this->getParameter( 'mail.site' ) )
                        ->setTo( $form->get( 'email' )->getData() )
                        ->setBody(
                            $this->renderView(
                                'emails/inscription.html.twig',
                                [
                                    'nom'    => $form->get( 'nom' )->getData(),
                                    'prenom' => $form->get( 'prenom' )->getData(),
                                    'email'  => $form->get( 'email' )->getData(),
                                    'type'   => $userType,
                                ]
                            ),
                            'text/html'
                        );

                    $mailer->send( $message );

                    $adminMessage = ( new \Swift_Message( 'Inscription sur le site Lou Pélou' ) )
                        ->setFrom( $this->getParameter( 'mail.site' ) )
                        ->setTo( $this->getParameter( 'mail.admin' ) )
                        ->setBody(
                            $this->renderView(
                                'emails/adminInscription.html.twig',
                                [
                                    'nom'    => $form->get( 'nom' )->getData(),
                                    'prenom' => $form->get( 'prenom' )->getData(),
                                    'email'  => $form->get( 'email' )->getData(),
                                    'type'   => $userType,
                                ]
                            ),
                            'text/html'
                        );

                    $mailer->send( $adminMessage );

                    $this->addFlash( 'success',
                        'Votre inscription est effective et va être prise en compte prochainement.' );

                    return $this->redirectToRoute( 'user.inscriptionSuccess' );
                }
            }
        }

        return $this->render( 'user/inscriptionProfessionnel.html.twig',
            [
                'form'          => $form->createView(),
                'formPro'       => $formPro->createView(),
                'formCategorie' => $formCategorie->createView(),
                'siteKey'       => $this->getParameter( 'google_recaptcha_site_key' ),
            ] );
    }

    /**
     * @Route("/confirmation-inscription", name="user.inscriptionSuccess")
     */
    public function success()
    {
        return $this->render( 'user/success.html.twig' );
    }

    /**
     * @Route("/login", name="login")
     */
    public function login( AuthenticationUtils $authenticationUtils )
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render( 'user/login.html.twig',
            [
                'last_username' => $lastUsername,
                'error'         => $error,
            ] );
    }

    /**
     * @Route("/forgot", name="forgot")
     */
    public function forgot( Request $request, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator )
    {

        $form = $this->createFormBuilder()
                     ->add( 'email',
                         EmailType::class,
                         [
                             'label'       => false,
                             'constraints' => [
                                 new Email(),
                                 new NotBlank(),
                             ],
                         ] )
                     ->getForm();
        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->isValid() ) {

            $em = $this->getDoctrine()->getManager();

            $user = $em->getRepository( User::class )->loadUserByEmail( $form->getData()['email'] );

            // aucun email associé à ce compte.
            if( ! $user ) {
                $this->addFlash( 'warning', "Cet email n'existe pas." );

                return $this->redirectToRoute( "forgot" );
            }

            // création du token
            $user->setToken( $tokenGenerator->generateToken() );
            // enregistrement de la date de création du token
            $user->setPasswordRequestedAt( new \Datetime() );
            $em->flush();

            $message = ( new \Swift_Message( 'Lou Pélou - Réinitialisation de votre mot de passe' ) )
                ->setFrom( $this->getParameter( 'mail.site' ) )
                ->setTo( $user->getEmail() )
                ->setBody( $this->renderView( "emails/resettingpassword.html.twig",
                    [
                        'user' => $user,
                    ] ),
                    'text/html' );
            $mailer->send( $message );
            $this->addFlash( 'success',
                "Un mail va vous être envoyé afin que vous puissiez renouveler votre mot de passe. Le lien que vous recevrez sera valide 24h." );

            return $this->redirectToRoute( "forgot" );
        }

        return $this->render( '/user/forgotpassword.html.twig',
            [
                'form' => $form->createView(),
            ] );
    }

    /**
     * @Route("/reinitialiser/{id}/{token}", name="resettingPassword")
     */
    public function resetting(
        User $user, $token, $id, Request $request, UserPasswordEncoderInterface $passwordEncoder,
        EntityManagerInterface $em
    ) {

        if( $user->getToken() === null || $token !== $user->getToken()
            || ! $this->isRequestInTime( $user->getPasswordRequestedAt() ) ) {
            $this->addFlash( 'danger', "Ce lien n'est plus valide" );

            return $this->redirectToRoute( "index" );
        }

        $form = $this->createForm( ResetPasswordType::class );
        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->isValid() ) {
            $user = $em->getRepository( User::class )->loadUserByToken( $token );
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->getData()->getPassword()
                )
            );

            // réinitialisation du token à null pour qu'il ne soit plus réutilisable
            $user->setToken( null );
            $user->setPasswordRequestedAt( null );

            $em->persist( $user );
            $em->flush();

            $this->addFlash( 'success', "Votre mot de passe a été réinitialisé." );

            return $this->redirectToRoute( "login" );
        }

        return $this->render( '/user/resetpassword.html.twig',
            [
                'form' => $form->createView(),
            ] );
    }

    private function isRequestInTime( \Datetime $passwordRequestedAt = null )
    {
        if( $passwordRequestedAt === null ) {
            return false;
        }

        $now      = new \DateTime();
        $interval = $now->getTimestamp() - $passwordRequestedAt->getTimestamp();

        $daySeconds = 3600 * 24;
        $response   = $interval > $daySeconds ? false : $reponse = true;

        return $response;
    }
}
