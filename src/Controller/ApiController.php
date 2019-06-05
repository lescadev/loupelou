<?php

namespace App\Controller;

use App\Repository\ComptoirRepository;
use App\Repository\PrestataireRepository;
use App\Repository\UserRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;

class ApiController extends AbstractController
{
    /**
     * @Rest\Route("/api")
     * @Method("GET")
     * @QueryParam(name="statut")
     */
    public function api(UserRepository $userRepository, ComptoirRepository $comptoirRepository, PrestataireRepository $prestataireRepository, ParamFetcher $paramFetcher) : Response
    {
        $response = new Response();
        $object = (object) [];

        $statut = $paramFetcher->get('statut');

        if($statut == "comptoir") {
            $comptoir = $comptoirRepository->findAll();
            for ($i=0; $i < count($comptoir); $i++) {
                $adresseComptoir= $userRepository->find($comptoir[$i]->getUser());
                $object->comptoir[$i] = [[
                    'name' => $comptoir[$i]->getDenomination(),
                    'coordonnees' => [
                        'lng' => $adresseComptoir->getLongitude(),
                        'lat' =>$adresseComptoir->getLatitude()
                    ]]];
            }
        }
        if($statut == "prestataire") {
            $prestataire = $prestataireRepository->findAll();
            for ($j=0; $j < count($prestataire); $j++) {
                $adressePresta = $userRepository->find($prestataire[$j]->getUser());
                $object->prestataire[$j] = [[
                    'name' => $prestataire[$j]->getDenomination(),
                    'coordonnees' => [
                        'lng' => $adressePresta->getLongitude(),
                        'lat' =>$adressePresta->getLatitude()
                    ]]];

            }
        }
        $response->setContent(json_encode($object, JSON_UNESCAPED_UNICODE));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}