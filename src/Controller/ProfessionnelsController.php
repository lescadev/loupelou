<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfessionnelsController extends AbstractController
{
    /**
     * @Route("/professionnels", name="professionnels")
     */
    public function index()
    {
        return $this->render('professionnels/professionnels.html.twig', [
            'controller_name' => 'ProfessionnelsController',
        ]);
    }
}
