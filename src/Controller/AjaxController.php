<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AjaxController extends AbstractController
{
    /**
     * @Route("/ajax-annuaire", name="ajax-annuaire")
     * @param UserRepository $userRepository
     * @param Request $request
     * @return Response
     */
    public function ajaxAnnuaire(UserRepository $userRepository, Request $request) : Response
    {

        $params = ["search" => 'bio',
            "status" => "comptoir"];

        $res = $userRepository->findByParams($params);

        $response = new Response();
        $response->setContent(json_encode($res, JSON_UNESCAPED_UNICODE));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }
}