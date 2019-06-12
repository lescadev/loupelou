<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;

class ContactController extends AbstractController
{
    /**
     * @Route("/contacter", name="contacter")
     */
    public function index(Request $request, ContactNotification $notification)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact);
            $this->addFlash('success', 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('contacter');
        }
        
        return $this->render('contact/contacter.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form -> createView()
        ]);
    }
}
