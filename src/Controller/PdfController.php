<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController extends AbstractController
{
    /**
     * @Route("/pdf_comptoir", name="pdf_comptoir")
     */
    public function pdfComptoir(UserRepository $userRepository)
    {

    $pdfOptions = new Options();
    $pdfOptions->set('defaultFont', 'Arial');

    $dompdf = new Dompdf($pdfOptions);

    $resComptoir = $userRepository->findByParams(array('status' => 'comptoir', 'filter' => 'Tous les services'));

    $html = $this->renderView('pdf/constructorComptoir.html.twig', [
        'comptoir' => $resComptoir
    ]);

    $dompdf->loadHtml($html);

    $dompdf->render();

    $dompdf->stream("annuaire_comptoir.pdf", [
        "Attachment" => true
    ]);

    }

        /**
         * @Route("/pdf_prestataire", name="pdf_prestataire")
         */
        public function pdfPresta(UserRepository $userRepository)
        {

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);

        $resPresta = $userRepository->findByParams(array('status' => 'prestataire', 'filter' => 'Tous les services'));

        $html = $this->renderView('pdf/constructorPrestataire.html.twig', [
            'presta' => $resPresta
        ]);

        $dompdf->loadHtml($html);

        $dompdf->render();

        $dompdf->stream("annuaire_prestataire.pdf", [
            "Attachment" => true
        ]);

        }
}
