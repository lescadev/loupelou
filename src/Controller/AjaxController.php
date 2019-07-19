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
    public function ajaxAnnuaire(UserRepository $userRepository, Request $request)
    {

        $params = [];

        if ($request->getMethod() == 'POST') {
            $body = $request->getContent();
            $params = json_decode($body, true);
        }

        $res = $userRepository->findByParams($params);

        if(!empty($params['display']))
            if($params['display'] === 'list') {
                //var_dump($res);
                return $this->render("annuairePartial.html.twig",
                    array('response' => $res));
            }
            elseif ($params['display'] === 'map') {
                $response = new Response();
                $response->setContent(json_encode($res, JSON_UNESCAPED_UNICODE));
                $response->headers->set('Content-Type', 'application/json');
                return $response;
            }


    }
}