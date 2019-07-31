<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ArticleBlog;
use App\Entity\Evenements;
use App\Entity\InformationsAssociation;

class PagesController
    extends AbstractController
{

    /**
     * @Route("/pages", name="pages")
     */
    public function index()
    {
        return $this->render( 'pages/index.html.twig',
            [
                'controller_name' => 'PagesController',
            ] );
    }

    /**
     * @Route("/utiliser", name="utiliser")
     */
    public function utiliser()
    {
        return $this->render( 'map/utiliser.html.twig',
            [
                'status' => 'prestataire',
            ] );
    }

    /**
     * @Route("/rejoindre", name="rejoindre")
     */
    public function rejoindre()
    {
        return $this->render( '/rejoindre.html.twig' );
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function blog()
    {
        $repo = $this->getDoctrine()->getRepository( ArticleBlog::class );

        $articles = $repo->findAll();

        return $this->render( 'pages/blog.html.twig',
            [
                'articles' => $articles,
            ] );
    }

    /**
     * @Route("/blog/{id}", name="blogArticle")
     */
    public function blogArticle( $id )
    {
        $repo = $this->getDoctrine()->getRepository( ArticleBlog::class );

        $article = $repo->find( $id );

        return $this->render( 'pages/blogArticle.html.twig',
            [
                "article" => $article,
            ] );
    }

    /**
     * @Route("/evenements", name="evenements")
     */
    public function evenement()
    {
        $repo = $this->getDoctrine()->getRepository( Evenements::class );

        $events = $repo->findAll();

        return $this->render( 'pages/evenements.html.twig',
            [
                "events" => $events,
            ] );
    }

    /**
     * @Route("/statuts", name="statuts")
     */
    public function statuts()
    {
        $repo      = $this->getDoctrine()->getRepository( InformationsAssociation::class );
        $infosAsso = $repo->findAll()[0];

        return $this->render( 'statuts.html.twig',
            [
                'infosAsso' => $infosAsso,
            ] );
    }

    /**
     * @Route("/reglement-interieur", name="reglementInterieur")
     */
    public function reglementInterieur()
    {
        $repo      = $this->getDoctrine()->getRepository( InformationsAssociation::class );
        $infosAsso = $repo->findAll()[0];

        return $this->render( 'reglementInterieur.html.twig',
            [
                'infosAsso' => $infosAsso,
            ] );
    }

    /**
     * @Route("/compte-rendu-ag", name="compteRenduAG")
     */
    public function CompteRenduAG()
    {
        $repo      = $this->getDoctrine()->getRepository( InformationsAssociation::class );
        $infosAsso = $repo->findAll()[0];

        return $this->render( 'compteRenduAG.html.twig',
            [
                'infosAsso' => $infosAsso,
            ] );
    }

    /**
     * @Route("/procurer", name="procurer")
     */
    public function procurer()
    {
        return $this->render( 'map/procurer.html.twig',
            [
                'status' => 'comptoir',
            ] );
    }

    /**
     * @Route("/success", name="sucess")
     */
    public function success()
    {
        return $this->render( '/success.html.twig' );
    }
}
