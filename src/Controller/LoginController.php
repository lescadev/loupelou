<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Form\ResetPasswordType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoginController
    extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login( AuthenticationUtils $authenticationUtils )
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render( 'login.html.twig',
            [
                'last_username' => $lastUsername,
                'error'         => $error,
            ] );
    }

    /**
     * @Route("/forgot", name="forgot")
     */
    public function forgot(Request $request, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator){
        
        $form = $this->createFormBuilder()
        ->add('email', EmailType::class, [
            'label' => false,
            'constraints' => [
                new Email(),
                new NotBlank()
            ]
        ])
        ->getForm();
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository(User::class)->loadUserByEmail($form->getData()['email']);

        // aucun email associé à ce compte.
        if (!$user) {
            $this->addFlash( 'warning', "Cet email n'existe pas." );
            return $this->redirectToRoute("forgot");
        } 

        // création du token
        $user->setToken($tokenGenerator->generateToken());
        // enregistrement de la date de création du token
        $user->setPasswordRequestedAt(new \Datetime());
        $em->flush();

        $message = ( new \Swift_Message( 'Objet : Réinitialisation mots de passe'  ))
            ->setFrom( $this->getParameter( 'mail.site' )  )
            ->setTo( $user->getEmail() )
            ->setBody( $this->renderView( "emails/resettingpassword.html.twig",
                [
                    'user' => $user,
                ] ),
                'text/html' );
        $mailer->send( $message );
        $this->addFlash('success', "Un mail va vous être envoyé afin que vous puissiez renouveller votre mot de passe. Le lien que vous recevrez sera valide 24h.");
        return $this->redirectToRoute("forgot");
    }

    return $this->render('forgotpassword.html.twig', [
        'form' => $form->createView()
    ]);

    }

    private function isRequestInTime(\Datetime $passwordRequestedAt = null)
    {
        if ($passwordRequestedAt === null)
        {
            return false;        
        }
        
        $now = new \DateTime();
        $interval = $now->getTimestamp() - $passwordRequestedAt->getTimestamp();

        $daySeconds = 3600 * 24;
        $response = $interval > $daySeconds ? false : $reponse = true;
        return $response;
    }

    /**
     * @Route("/reinitialiser/{id}/{token}", name="resettingPassword")
     */
    public function resetting(User $user, $token, $id, Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        
        if ($user->getToken() === null || $token !== $user->getToken() || !$this->isRequestInTime($user->getPasswordRequestedAt()))
        {
            throw new AccessDeniedHttpException();
        }

        
        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid())
        {   
            $user = $em->getRepository(User::class)->loadUserByToken($token);
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->getData()->getPassword()
                )
            );

            // réinitialisation du token à null pour qu'il ne soit plus réutilisable
            $user->setToken(null);
            $user->setPasswordRequestedAt(null);
        
            $em->persist($user);
            $em->flush();


            return $this->redirectToRoute("login");

        }
        else if ($form->isSubmitted() && !$form->isValid()){
            exit('KO');
        }
        return $this->render('resetpassword.html.twig', [
            'form' => $form->createView()
        ]);
        
    }
}
