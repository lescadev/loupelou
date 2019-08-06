<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\PrestataireRepository;
use App\Repository\CategorieRepository;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AjaxController
    extends AbstractController
{

    /**
     * Récupération de l'annuaire
     * @Route("/ajax-annuaire", name="ajax-annuaire")
     *
     * @param UserRepository $userRepository
     * @param Request $request
     *
     * @return Response
     */
    public function ajaxAnnuaire(
        UserRepository $userRepository, PrestataireRepository $prestataireRepository, Request $request
    ) {

        $params = [];

        if( $request->getMethod() == 'POST' ) {
            $body   = $request->getContent();
            $params = json_decode( $body, true );
        }

        $res = $userRepository->findByParams( $params );

        if( $params['status'] == 'prestataire' ) {
            for( $i = 0; $i < count( $res ); $i ++ ) {
                $id                      = $res[ $i ]['id'];
                $presta                  = $prestataireRepository->find( $id );
                $categories              = $presta->getCategories();
                $res[ $i ]['categories'] = $categories->getValues();
            }
        }

        return $this->render( 'pages/annuairePartial.html.twig',
            array( 'response' => $res ) );
    }

    /**
     * Récupération des informations du prestataire pour affichage dans la boîte de dialogue
     * @Route("/ajax-modal", name="ajax-modal")
     *
     * @param UserRepository $userRepository
     * @param CategorieRepository $categorieRepository
     * @param PrestataireRepository $prestataireRepository
     * @param Request $request
     *
     * @return false|string
     */
    public function AjaxModal(
        UserRepository $userRepository, CategorieRepository $categorieRepository,
        PrestataireRepository $prestataireRepository,
        Request $request, SerializerInterface $serialize
    ) {

        if( $request->getMethod() == 'POST' ) {

            $body = $request->getContent();

            $id = json_decode( $body, true );

            $user = $userRepository->find( $id );

            $prestataire = $prestataireRepository->findBy( array( 'user' => $user ) )[0];

            $categories = $prestataire->getCategories()->getValues();

            $data = [
                'nom'           => $prestataire->getDenomination(),
                'categorie'     => $categories,
                'description'   => $user->getDescription(),
                'ville'         => $user->getVille(),
                'rue'           => $user->getAdresse(),
                'code_postal'   => $user->getCodePostal(),
                'date_creation' => $user->getDateCreation(),
                'site_internet' => $prestataire->getSiteInternet(),
            ];

            $json = $serialize->serialize( $data, 'json' );
        } else {
            $json = '';
        }

        return new Response( $json );
    }
}
