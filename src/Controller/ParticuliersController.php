<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Particulier;
use App\Form\InscriptionType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ParticuliersController extends AbstractController
{
    /**
     * @Route("/particulier/inscription", name="inscription_particulier")
     */
    public function inscription(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $user -> setDateCreation(date_create());
        $user -> setRoles(["ROLE_PARTICULIER"]);

        $particulier = new Particulier();
        $particulier ->setUser($user);

        $form = $this->createForm(InscriptionType::class, $user);
        $form -> handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $user = $form->getData();

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->persist($particulier);
            $entityManager->flush();
            
            $this->addFlash('success', 'Inscription réussie !');
            return $this->redirectToRoute('sucess');
        }


        return $this->render('particuliers/particuliers.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
