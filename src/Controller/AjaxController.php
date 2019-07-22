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

        return $this->render('annuairePartial.html.twig',
            array('response' => $res));
    }
}