<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\InformationsLegales;

class MentionsLegalesController
    extends AbstractController
{

    /**
     * @Route("/cgv", name="cgv")
     */

    public function cgv()
    {
        $repo     = $this->getDoctrine()->getRepository( InformationsLegales::class );
        $Mentions = $repo->findAll()[0];

        return $this->render( 'mentionslegales/cgv.html.twig',
            [
                'Mentions' => $Mentions,
            ] );
    }

    /**
     * @Route("/cgu", name="cgu")
     */

    public function cgu()
    {
        $repo     = $this->getDoctrine()->getRepository( InformationsLegales::class );
        $Mentions = $repo->findAll()[0];

        return $this->render( 'mentionslegales/cgu.html.twig',
            [
                'Mentions' => $Mentions,
            ] );
    }

    /**
     * @Route("/mentions", name="mentions")
     */

    public function mentions()
    {
        $repo     = $this->getDoctrine()->getRepository( InformationsLegales::class );
        $Mentions = $repo->findAll()[0];

        return $this->render( 'mentionslegales/mentions.html.twig',
            [
                'Mentions' => $Mentions,
            ] );
    }
}
