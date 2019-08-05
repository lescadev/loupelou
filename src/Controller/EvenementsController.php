<?php

namespace App\Controller;

use App\Entity\Evenements;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EvenementsController
    extends AbstractController
{

    /**
     * Liste des évènements
     * @Route("/evenements", name="evenements")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository( Evenements::class );

        $events = $repo->findAll();

        return $this->render( 'evenements/index.html.twig',
            [
                "events" => $events,
            ] );
    }
}
