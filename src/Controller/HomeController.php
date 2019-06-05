<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Informations;

class HomeController extends AbstractController
{
    
    /**
     * @Route("/", name="index")
     */

    public function index()
    {
            $repo = $this->getDoctrine()->getRepository(Informations::class);
            $Informations = $repo->find(1);

        return $this->render('home.html.twig',[
            'Infos' => $Informations 
        ]);
    }
}
