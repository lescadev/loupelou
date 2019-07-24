<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\PrestataireRepository;
use App\Repository\CategorieRepository;
use App\Repository\PrestataireHasCategorieRepository;
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

        return $this->render('map/annuairePartial.html.twig',
            array('response' => $res));
    }


    /**
     * @Route("/ajax-modal", name="ajax-modal")
     * @param UserRepository $userRepository
     * @param CategorieRepository $categorieRepository
     * @param PrestataireRepository $prestataireRepository
     * @param PrestataireHasCategorieRepository $prestataireHasCategorieRepository
     * @param Request $request
     * @return false|string
     */
    public function AjaxModal(UserRepository $userRepository, CategorieRepository $categorieRepository,
                              PrestataireRepository $prestataireRepository, PrestataireHasCategorieRepository $prestataireHasCategorieRepository,
                              Request $request)
    {

        if($request->getMethod() == 'POST') {

            $body = $request->getContent();

            $id = json_decode($body, true);

            $user = $userRepository->find($id);

            $prestataire = $prestataireRepository->findBy(array('user' => $user))[0];

            $prestataireHasCategorie = $prestataireHasCategorieRepository->findBy(array('prestataire' => $prestataire))[0];

            $data = [
                'nom' => $prestataire->getDenomination(),
                'categorie' => $prestataireHasCategorie->getCategorie()->getNom(),
                'description' => $user->getDescription(),
                'ville' => $user->getVille(),
                'rue' => $user->getAdresse(),
                'code_postal' => $user->getCodePostal(),
                'date_creation' => $user->getDateCreation(),
                'site_internet' => $prestataire->getSiteInternet(),
            ];

            $json = json_encode($data);

        }
        else {
            $json = '';
        }

        return new Response($json);
    }
}
