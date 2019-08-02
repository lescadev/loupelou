<?php

namespace App\Controller;

use App\Entity\ArticleBlog;
use App\Entity\Contact;
use App\Entity\Evenements;
use App\Entity\Informations;
use App\Entity\InformationsAssociation;
use App\Entity\InformationsLegales;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use App\Repository\CategorieRepository;
use App\Repository\InformationsRepository;
use ReCaptcha\ReCaptcha;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PagesController
    extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $repo        = $this->getDoctrine()->getRepository( Informations::class );
        $repoEvent   = $this->getDoctrine()->getRepository( Evenements::class );
        $repoArticle = $this->getDoctrine()->getRepository( ArticleBlog::class );

        $informations = $repo->findAll()[0];
        $events       = $repoEvent->findBy( array(), array( 'date' => 'DESC' ), 3 );
        $articles     = $repoArticle->findBy( array(), array( 'id' => 'DESC' ), 3 );

        return $this->render( 'pages/home.html.twig',
            [
                'informations' => $informations,
                'evenements'   => $events,
                'articles'     => $articles,
            ] );
    }

    /**
     * @Route("/procurer", name="procurer")
     */
    public function procurer()
    {
        return $this->render( 'pages/procurer.html.twig',
            [
                'status' => 'comptoir',
            ] );
    }

    /**
     * @Route("/utiliser", name="utiliser")
     */
    public function utiliser(CategorieRepository $categorieRepository)
    {
        $categories = $categorieRepository->findAll();
        return $this->render( 'pages/utiliser.html.twig',
            [
                'status' => 'prestataire',
                'categories' => $categories
            ] );
    }

    /**
     * @Route("/mentions", name="mentions")
     */

    public function mentionsLegales()
    {
        $repo                = $this->getDoctrine()->getRepository( InformationsLegales::class );
        $informationsLegales = $repo->findAll()[0];

        return $this->render( 'pages/mentionsLegales.html.twig',
            [
                'informationsLegales' => $informationsLegales,
            ] );
    }

    /**
     * @Route("/cgv", name="cgv")
     */

    public function cgv()
    {
        $repo                = $this->getDoctrine()->getRepository( InformationsLegales::class );
        $informationsLegales = $repo->findAll()[0];

        return $this->render( 'pages/cgv.html.twig',
            [
                'informationsLegales' => $informationsLegales,
            ] );
    }

    /**
     * @Route("/cgu", name="cgu")
     */

    public function cgu()
    {
        $repo                = $this->getDoctrine()->getRepository( InformationsLegales::class );
        $informationsLegales = $repo->findAll()[0];

        return $this->render( 'pages/cgu.html.twig',
            [
                'informationsLegales' => $informationsLegales,
            ] );
    }

    /**
     * @Route("/statuts", name="statuts")
     */
    public function statuts()
    {
        $repo                    = $this->getDoctrine()->getRepository( InformationsAssociation::class );
        $informationsAssociation = $repo->findAll()[0];

        return $this->render( 'pages/statuts.html.twig',
            [
                'informationsAssociation' => $informationsAssociation,
            ] );
    }

    /**
     * @Route("/reglement-interieur", name="reglementInterieur")
     */
    public function reglementInterieur()
    {
        $repo                    = $this->getDoctrine()->getRepository( InformationsAssociation::class );
        $informationsAssociation = $repo->findAll()[0];

        return $this->render( 'pages/reglementInterieur.html.twig',
            [
                'informationsAssociation' => $informationsAssociation,
            ] );
    }

    /**
     * @Route("/compte-rendu-ag", name="compteRenduAG")
     */
    public function compteRenduAG()
    {
        $repo                    = $this->getDoctrine()->getRepository( InformationsAssociation::class );
        $informationsAssociation = $repo->findAll()[0];

        return $this->render( 'pages/compteRenduAG.html.twig',
            [
                'informationsAssociation' => $informationsAssociation,
            ] );
    }

    /**
     * Page contact
     * @Route("/contact", name="contact")
     */
    public function contact(
        InformationsRepository $informationsRepository, Request $request, ContactNotification $notification
    ) {
        $recaptcha = new ReCaptcha( $this->getParameter( 'google_recaptcha_secret' ) );

        $contact = new Contact();
        $form    = $this->createForm( ContactType::class, $contact );
        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->isValid() ) {
            $resp = $recaptcha->verify( $request->request->get( 'recaptchaToken' ), $request->getClientIp() );
            if( $resp->isSuccess() ) {
                $notification->notify( $contact );
                $this->addFlash( 'success', 'Votre message a bien été envoyé !' );

                return $this->redirectToRoute( 'contact' );
            }
        }

        $infosContact = $informationsRepository->findAll()[0];

        return $this->render( 'pages/contact.html.twig',
            [
                'form'         => $form->createView(),
                'siteKey'      => $this->getParameter( 'google_recaptcha_site_key' ),
                'infosContact' => $infosContact,
            ] );
    }
}
