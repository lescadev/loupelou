<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/procurer", name="procurer")
     */
    public function procurer()
    {
        return $this->render('header/procurer.html.twig');
        
    }
    
    /**
     * @Route("/", name="home")
     */

    public function home()
    {
        return $this->render('/home.html.twig');
    }


    /**
     * @Route("/utiliser", name="utiliser")
     */

    public function utiliser()
    {
        return $this->render('header/utiliser.html.twig');
    }


    /**
     * @Route("/rejoindre", name="rejoindre")
     */

    public function rejoindre()
    {
        return $this->render('header/rejoindre.html.twig');
    }


    /**
     * @Route("/contacter", name="contacter")
     */

    public function contacter()
    {
        return $this->render('header/contacter.html.twig');
    }


    /**
     * @Route("/blog", name="blog")
     */

    public function blog()
    {
        return $this->render('header/blog.html.twig');
    }


    /**
     * @Route("/evenements", name="evenements")
     */

    public function evenement()
    {
        return $this->render('header/evenements.html.twig');
    }

    /**
     * @Route("/professionnels/rejoindre", name="professionnels")
     */

    public function professionnels()
    {
        return $this->render('header/professionnels.html.twig');
    }

    /**
     * @Route("/particuliers/rejoindre", name="particuliers")
     */

    public function particuliers()
    {
        return $this->render('header/particuliers.html.twig');
    }
    /**
     * @Route("/cgv", name="cgv")
     */

    public function cgv()
    {
        return $this->render('footer/cgv.html.twig');
    }
    /**
     * @Route("/cgu", name="cgu")
     */

    public function cgu()
    {
        return $this->render('footer/cgu.html.twig');
    }
    /**
     * @Route("/mentionL", name="mentionL")
     */

    public function mentionL()
    {
        return $this->render('footer/mentionL.html.twig');
    }
    /**
     * @Route("/reglement", name="reglement")
     */

    public function reglement()
    {
        return $this->render('footer/reglement.html.twig');
    }
    /**
     * @Route("/rendu", name="rendu")
     */

    public function rendu()
    {
        return $this->render('footer/rendu.html.twig');
    }
    /**
     * @Route("/statut", name="statut")
     */

    public function statut()
    {
        return $this->render('footer/statut.html.twig');
    }
    /**
     * @Route("/login", name="login")
     */

    public function login()
    {
        return $this->render('header/login.html.twig');
    }
}
