<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Particulier;
use App\Form\InscriptionType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use FOS\RestBundle\View\View;
use ReCaptcha\ReCaptcha;

class ParticuliersController
    extends AbstractController
{

    /**
     * @Route("/particulier/inscription", name="inscription_particulier")
     */
    public function inscription( Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer
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

                $message = ( new \Swift_Message( 'Inscription loupelou' ) )
                    ->setFrom( $this->getParameter( 'mail.site' ) )
                    ->setTo( $form->get( 'email' )->getData() )
                    ->setBody(
                        $this->renderView(
                            'emails/inscription.html.twig',
                            [
                                'nom'    => $form->get( 'nom' )->getData(),
                                'prenom' => $form->get( 'prenom' )->getData(),
                                'email'  => $form->get( 'email' )->getData(),
                            ]
                        ),
                        'text/html'
                    );

                $mailer->send( $message );

                $adminMessage = ( new \Swift_Message( 'Inscription loupelou' ) )
                    ->setFrom( $this->getParameter( 'mail.site' ) )
                    ->setTo( $this->getParameter( 'mail.admin' ) )
                    ->setBody(
                        $this->renderView(
                            'emails/adminInscription.html.twig',
                            [
                                'nom'    => $form->get( 'nom' )->getData(),
                                'prenom' => $form->get( 'prenom' )->getData(),
                                'email'  => $form->get( 'email' )->getData(),
                            ]
                        ),
                        'text/html'
                    );

                $mailer->send( $adminMessage );

                $this->addFlash( 'success',
                    'Votre inscription est effective et va être prise en compte prochainement' );

                return $this->redirectToRoute( 'sucess' );
            }
        }

        return $this->render( 'particuliers/particuliers.html.twig',
            [
                'form'    => $form->createView(),
                'siteKey' => $this->getParameter( 'google_recaptcha_site_key' ),
            ] );
    }
}