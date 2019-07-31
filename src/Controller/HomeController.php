<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Informations;
use App\Entity\ArticleBlog;
use App\Entity\Evenements;

class HomeController
    extends AbstractController
{

    /**
     * @Route("/", name="index")
     */

    public function index()
    {
        $repo         = $this->getDoctrine()->getRepository( Informations::class );
        $repoEvent         = $this->getDoctrine()->getRepository( Evenements::class );
        $repoArticle         = $this->getDoctrine()->getRepository( ArticleBlog::class );

        $Informations = $repo->findAll()[0];
        $events = $repoEvent->findBy(array(), array('date' => 'DESC'),3);
        $articles = $repoArticle->findBy(array(), array('id' => 'DESC'),3);


        return $this->render( 'home.html.twig',
            [
                'Infos' => $Informations,
                'events' => $events,
                'articles' => $articles,
            ] );
    }
}
