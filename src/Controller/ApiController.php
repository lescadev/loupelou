<?php

namespace App\Controller;

use App\Repository\ComptoirRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function api(UserRepository $userRepository, ComptoirRepository $comptoirRepository) : Response
    {
        $response = new Response();

        $comptoir = $comptoirRepository->findAll();
        $object = (object) [];

        for ($i=0; $i < count($comptoir); $i++) {
            $adresse= $userRepository->find($comptoir[$i]->getUser());
            $object->comptoir[$i] = [[
                'name' => $adresse->getNom(),
                'coordonnees' => [
                    'lng' => $adresse->getLongitude(),
                    'lat' =>$adresse->getLatitude()
                ]]];
        }


        $response->setContent(json_encode($object, JSON_UNESCAPED_UNICODE));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}