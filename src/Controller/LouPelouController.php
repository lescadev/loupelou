<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LouPelouController extends AbstractController
{
    /**
     * @Route("/header/procurer", name="lou_pelou")
     */
    public function procurer()
    {
        return $this->render('lou_pelou/header/procurer.html.twig');
        
    }
    
    /**
     * @Route("/", name="home")
     */

    public function home()
    {
        return $this->render('lou_pelou/home.html.twig');
    }


    /**
     * @Route("/header/utiliser", name="utiliser")
     */

    public function utiliser()
    {
        return $this->render('lou_pelou/header/utiliser.html.twig');
    }


    /**
     * @Route("/header/rejoindre", name="rejoindre")
     */

    public function rejoindre()
    {
        return $this->render('lou_pelou/header/rejoindre.html.twig');
    }


    /**
     * @Route("/header/contacter", name="contacter")
     */

    public function contacter()
    {
        return $this->render('lou_pelou/header/contacter.html.twig');
    }


    /**
     * @Route("/header/blog", name="blog")
     */

    public function blog()
    {
        return $this->render('lou_pelou/header/blog.html.twig');
    }


    /**
     * @Route("/header/evenement", name="evenement")
     */

    public function evenement()
    {
        return $this->render('lou_pelou/header/evenement.html.twig');
    }

    /**
     * @Route("/header/rejoindre/professionnels", name="professionnels")
     */

    public function professionnels()
    {
        return $this->render('lou_pelou/header/professionnels.html.twig');
    }

    /**
     * @Route("/header/rejoindre/particuliers", name="particuliers")
     */

    public function particuliers()
    {
        return $this->render('lou_pelou/header/particuliers.html.twig');
    }
    /**
     * @Route("/footer/cgv", name="cgv")
     */

    public function cgv()
    {
        return $this->render('lou_pelou/footer/cgv.html.twig');
    }
    /**
     * @Route("/footer/cgu", name="cgu")
     */

    public function cgu()
    {
        return $this->render('lou_pelou/footer/cgu.html.twig');
    }
    /**
     * @Route("/footer/mentionL", name="mentionL")
     */

    public function mentionL()
    {
        return $this->render('lou_pelou/footer/mentionL.html.twig');
    }
    /**
     * @Route("/footer/reglement", name="reglement")
     */

    public function reglement()
    {
        return $this->render('lou_pelou/footer/reglement.html.twig');
    }
    /**
     * @Route("/footer/rendu", name="rendu")
     */

    public function rendu()
    {
        return $this->render('lou_pelou/footer/rendu.html.twig');
    }
    /**
     * @Route("/footer/statut", name="statut")
     */

    public function statut()
    {
        return $this->render('lou_pelou/footer/statut.html.twig');
    }
    /**
     * @Route("/header/login", name="login")
     */

    public function login()
    {
        return $this->render('lou_pelou/header/login.html.twig');
    }
}
