<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use ReCaptcha\ReCaptcha;

class ContactController extends AbstractController
{
    /**
     * @Route("/contacter", name="contacter")
     */
    public function index(Request $request, ContactNotification $notification)
    {
        $recaptcha = new ReCaptcha($this->getParameter('google_recaptcha_secret'));

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $resp = $recaptcha->verify($request->request->get('recaptchaToken'), $request->getClientIp());
            if ($resp->isSuccess()) {
                $notification->notify($contact);
                $this->addFlash('success', 'Votre message a bien été envoyé !');
                return $this->redirectToRoute('contacter');
            }
        }
        
        return $this->render('contact/contacter.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form -> createView(),
            'siteKey' => $this->getParameter('google_recaptcha_site_key'),
        ]);
    }
}
