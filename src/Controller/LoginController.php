<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
    public function forgot(Request $request){
        if ($request->isMethod('POST')) {
            return $this->render( 'resetpassword.html.twig',
                [

                ] );
        }

        return $this->render( 'forgotpassword.html.twig',
            [

            ] );
    }
}
