<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    /**
     * @Route("/pages", name="pages")
     */
    public function index()
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

    /**
     * @Route("/utiliser", name="utiliser")
     */

    public function utiliser()
    {
        return $this->render('/utiliser.html.twig');
    }


    /**
     * @Route("/rejoindre", name="rejoindre")
     */

    public function rejoindre()
    {
        return $this->render('/rejoindre.html.twig');
    }


    /**
     * @Route("/contacter", name="contacter")
     */

    public function contacter()
    {
        return $this->render('/contacter.html.twig');
    }


    /**
     * @Route("/blog", name="blog")
     */

    public function blog()
    {
        return $this->render('pages/blog.html.twig');
    }


    /**
     * @Route("/evenements", name="evenements")
     */

    public function evenement()
    {
        return $this->render('pages/evenements.html.twig');
    }

    /**
     * @Route("/cgv", name="cgv")
     */

    public function cgv()
    {
        return $this->render('pages/cgv.html.twig');
    }
    /**
     * @Route("/cgu", name="cgu")
     */

    public function cgu()
    {
        return $this->render('pages/cgu.html.twig');
    }
    /**
     * @Route("/mentions", name="mentions")
     */

    public function mentions()
    {
        return $this->render('pages/mentions.html.twig');
    }
    /**
     * @Route("/reglement", name="reglement")
     */

    public function reglement()
    {
        return $this->render('pages/reglement.html.twig');
    }
    /**
     * @Route("/rendu", name="rendu")
     */

    public function rendu()
    {
        return $this->render('pages/rendu.html.twig');
    }
    /**
     * @Route("/statut", name="statut")
     */

    public function statut()
    {
        return $this->render('/statut.html.twig');
    }
    /**
     * @Route("/logins", name="logins")
     */

    public function logins()
    {
        return $this->render('/logins.html.twig');
    }
    /**
     * @Route("/procurer", name="procurer")
     */
    public function procurer()
    {
        return $this->render('/procurer.html.twig');
        
    }
    /**
     * @Route("/success", name="sucess")
     */
    public function success()
    {
        return $this->render('/success.html.twig');
        
    }
}

