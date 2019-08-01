<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController
    extends AbstractController
{

    /**
     * Connexion administration
     * @Route("/login_admin", name="app_login")
     *
     * @param AuthenticationUtils $authenticationUtils
     *
     * @return Response
     */
    public function login( AuthenticationUtils $authenticationUtils ): Response
    {
        // Get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // Last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render( 'admin/login.html.twig',
            [
                'last_username' => $lastUsername,
                'error'         => $error,
            ] );
    }
}
