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
use GuzzleHttp\Client;
use ReCaptcha\ReCaptcha;
use App\Form\CategorieType;
use App\Entity\PrestataireHasCategorie;

class ProfessionnelsController extends AbstractController
{
    /**
     * @Route("/professionnel/inscription", name="inscription_pro")
     */
    public function inscriptionPro(Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer)
    {
        $recaptcha = new ReCaptcha($this->getParameter('google_recaptcha_secret'));

        $user = new User();
        $user -> setDateCreation(date_create());
        $user -> setIsActive(false);

        $form = $this->createForm(InscriptionType::class, $user);
        $form -> handleRequest($request);

        $formPro = $this->createForm(InscriptionProType::class);
        $formPro->handleRequest($request);

        $formCategorie = $this->createForm(CategorieType::class);
        $formCategorie->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $resp = $recaptcha->verify($request->request->get('recaptchaToken'), $request->getClientIp());
            if ($resp->isSuccess()) {

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

                //Conversion de l'adresse en coordonnées GPS pour la map
                $client = new Client();

                $address = $form->get('adresse')->getData();
                $ville = $form->get('ville')->getData();
                $address_f = $address . " " . $ville;
                $prepAddr = str_replace(' ','+',$address_f);

                try {
                    $res = $client->request('GET', 'https://api-adresse.data.gouv.fr/search/?q='.$prepAddr);

                    $json = $res->getBody();
                    $json_d = json_decode($json);

                    $lon = $json_d->features[0]->geometry->coordinates[0];
                    $lat = $json_d->features[0]->geometry->coordinates[1];

                } catch (\Exception $exception) {
                    $lat = null;
                    $lon = null;
                }

                $user->setLongitude($lon);
                $user->setLatitude($lat);

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
                    $categorie = $formCategorie->getData();
                    $user -> setRoles(["ROLE_PRESTATAIRE"]);

                    if(!empty($data['siret'])){ 
                        $prestataire ->setSiret($data["siret"]);
                    }
                    if(!empty($data['site_internet'])){
                        $prestataire ->setSiteInternet($data["site_internet"]);
                    }

                    $prestataire ->setDenomination($data["denomination"]);
                    
                    $entityManager->persist($prestataire);

                    $prestatairehascategorie = new PrestataireHasCategorie;
                    $prestatairehascategorie->setPrestataire($prestataire);
       
                    $categorieObject = array_reduce(
                        $categorie,
                        function ($result, $categorie) {
                            return $categorie;
                        }
                    );

                    $prestatairehascategorie->setCategorie($categorieObject);
                    $entityManager->persist($prestatairehascategorie);
                }


                if(!empty($data['compt']) && !empty($data['presta'])){
                    $user -> setRoles(["ROLE_PRESTA&COMPT"]);
                }

                if(!empty($data['compt']) | !empty($data['presta'])) {
                    $entityManager->flush();

                    $message = (new \Swift_Message('Inscription loupelou'))
                    ->setFrom($this->getParameter('mail.site'))
                    ->setTo( $form->get('email')->getData())
                    ->setBody(
                    $this-> renderView(
                        'emails/inscription.html.twig',
                        ['nom' =>  $form->get('nom')->getData(), 'prenom' =>  $form->get('prenom')->getData(), 'email' => $form->get('email')->getData()]
                    ),
                    'text/html'
                );

                $mailer->send($message);

                $adminMessage = (new \Swift_Message('Inscription loupelou'))
                    ->setFrom($this->getParameter('mail.site'))
                    ->setTo($this->getParameter('mail.admin'))
                    ->setBody(
                    $this-> renderView(
                        'emails/adminInscription.html.twig',
                        ['nom' =>  $form->get('nom')->getData(), 'prenom' =>  $form->get('prenom')->getData(), 'email' => $form->get('email')->getData()]
                    ),
                    'text/html'
                );

                $mailer->send($adminMessage);

                    $this->addFlash('success', 'Votre inscription est effective et va être prise en compte prochainement.');
                    return $this->redirectToRoute('sucess');
                    
                }
            }
        }
        return $this->render('professionnels/professionnels.html.twig', [
            'form' => $form->createView(),
            'formPro' => $formPro->createView(),
            'formCategorie' => $formCategorie->createView(),
            'siteKey' => $this->getParameter('google_recaptcha_site_key'),
        ]);
    }
}
