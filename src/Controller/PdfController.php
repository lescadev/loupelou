<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Repository\CategorieRepository;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController
    extends AbstractController
{

    /**
     * @Route("/formulaire_adhesion", name="pdf.adhesion")
     */
    public function pdfAdhesion()
    {
        $pdfOptions = new Options();
        $pdfOptions->set( 'defaultFont', 'Arial' );
        $dompdf = new Dompdf( $pdfOptions );

        $html = $this->renderView( 'pdf/adhesionPdf.html.twig' );

        $dompdf->loadHtml( $html );
        $dompdf->setPaper( 'A4', 'portrait' );
        $dompdf->render();

        $dompdf->stream( "adhesion-lou-pelou.pdf",
            [
                "Attachment" => true,
            ] );
    }

    /**
     * @Route("profil/imprimer", name="profil.pdf")
     */
    public function pdfAdherent()
    {
        $pdfOptions = new Options();
        $pdfOptions->set( 'defaultFont', 'Arial' );
        $dompdf = new Dompdf( $pdfOptions );

        $user = $this->getUser();

        $html = $this->renderView( 'pdf/profilPdf.html.twig',
            [
                'user' => $user,

            ] );

        $dompdf->loadHtml( $html );
        $dompdf->setPaper( 'A4', 'portrait' );
        $dompdf->render();

        $dompdf->stream( "adherent.pdf",
            [
                "Attachment" => true,
            ] );
    }

    /**
     * @Route("/annuaire_comptoirs", name="pdf.comptoirs")
     */
    public function pdfComptoirs( UserRepository $userRepository )
    {

        $pdfOptions = new Options();
        $pdfOptions->set( 'defaultFont', 'Arial' );

        $dompdf = new Dompdf( $pdfOptions );

        $resComptoir =
            $userRepository->findByParams( array( 'status' => 'comptoir', 'filter' => 'Tous les services' ) );

        $html = $this->renderView( 'pdf/pdfComptoirs.html.twig',
            [
                'comptoir' => $resComptoir,
            ] );

        $dompdf->loadHtml( $html );

        $dompdf->render();

        $dompdf->stream( "annuaire-comptoirs.pdf",
            [
                "Attachment" => true,
            ] );
    }

    /**
     * @Route("/annuaire_prestataires", name="pdf.prestataires")
     */
    public function pdfPrestataires( CategorieRepository $categorieRepo )
    {

        $pdfOptions = new Options();
        $pdfOptions->set( 'defaultFont', 'Arial' );

        $dompdf = new Dompdf( $pdfOptions );

        $categories = $categorieRepo->findAll();

        $prestaCate = array();

        foreach( $categories as $categorie ) {
            $nom                = $categorie->getNom();
            $prestataireCate    = $categorie->getPrestataires()->getValues();
            $prestaCate[ $nom ] = $prestataireCate;
        }

        $html = $this->renderView( 'pdf/pdfPrestataires.html.twig',
            [
                'prestaCate' => $prestaCate,
            ] );

        $dompdf->loadHtml( $html );

        $dompdf->render();

        $dompdf->stream( "annuaire-prestataires.pdf",
            [
                "Attachment" => true,
            ] );
    }
}
