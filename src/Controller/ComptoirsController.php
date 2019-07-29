<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ComptoirsController
    extends AbstractController
{

    /**
     * @Route("/comptoirs", name="comptoirs")
     */
    public function index()
    {

        return $this->render( 'comptoirs/comptoirs.html.twig',
            [
                'controller_name' => 'ComptoirsController',
            ] );
    }
}
