<?php

namespace App\Controller;

use App\Repository\ComptoirRepository;
use App\Repository\PrestataireRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function api(UserRepository $userRepository, ComptoirRepository $comptoirRepository, PrestataireRepository $prestataireRepository) : Response
    {
        $response = new Response();

        $comptoir = $comptoirRepository->findAll();
        $prestataire = $prestataireRepository->findAll();
        $object = (object) [];

        for ($i=0; $i < count($comptoir); $i++) {
            $adresseComptoir= $userRepository->find($comptoir[$i]->getUser());
            $object->comptoir[$i] = [[
                'name' => $adresseComptoir->getNom(),
                'coordonnees' => [
                    'lng' => $adresseComptoir->getLongitude(),
                    'lat' =>$adresseComptoir->getLatitude()
                ]]];
        }

        for ($j=0; $j < count($prestataire); $j++) {
            $adressePresta = $userRepository->find($prestataire[$j]->getUser());
            $object->prestataire[$j] = [[
                'name' => $adressePresta->getNom(),
                'coordonnees' => [
                    'lng' => $adressePresta->getLongitude(),
                    'lat' =>$adressePresta->getLatitude()
                ]]];

        }

        $response->setContent(json_encode($object, JSON_UNESCAPED_UNICODE));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}