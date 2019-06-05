<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Comptoir;
use App\Entity\Prestataire;
use App\Form\InscriptionType;
use App\Form\InscriptionProType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfessionnelsController extends AbstractController
{
    /**
     * @Route("/professionnel/inscription", name="inscription_pro")
     */
    public function inscriptionPro(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $user -> setDateCreation(date_create());

        $form = $this->createForm(InscriptionType::class, $user);
        $form -> handleRequest($request);

        $formPro = $this->createForm(InscriptionProType::class);
        $formPro->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $user = $form->getData();
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $data = $formPro->getData();

            $entityManager = $this->getDoctrine()->getManager();

            if(!empty($data['compt'])) {
                $comptoir = new Comptoir;
                $comptoir->setUser($user);
                $user -> setRoles(["ROLE_COMPTOIR"]);

                if(!empty($data['siret'])){
                    $comptoir ->setSiret($data["siret"]);
                }
                if(!empty($data['site_internet'])){
                    $comptoir ->setSiteInternet($data["site_internet"]);
                }

                $comptoir ->setDenomination($data["denomination"]);

                $entityManager->persist($comptoir);
            }

            if(!empty($data['presta'])) {
                $prestataire = new Prestataire;
                $prestataire->setUser($user);
                $user -> setRoles(["ROLE_PRESTATAIRE"]);

                if(!empty($data['siret'])){ 
                    $prestataire ->setSiret($data["siret"]);
                }
                if(!empty($data['site_internet'])){
                    $prestataire ->setSiteInternet($data["site_internet"]);
                }

                $prestataire ->setDenomination($data["denomination"]);
                
                $entityManager->persist($prestataire);
            }


            if(!empty($data['compt']) && !empty($data['presta'])){
                $user -> setRoles(["ROLE_PRESTA&COMPT"]);
            }

            if(!empty($data['compt']) | !empty($data['presta'])) {
                $entityManager->flush();

                $this->addFlash('success', 'Inscription réussi!');
                return $this->redirectToRoute('sucess');
                
            }
        }


        return $this->render('professionnels/professionnels.html.twig', [
            'form' => $form->createView(),
            'formPro' => $formPro->createView(),
        ]);
    }
}