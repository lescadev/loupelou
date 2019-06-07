<?php
namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

class EspaceMembreController extends AbstractController {


    /**
     * @Route("/profil", name="profil")
     */
    public function profil()
    {
        $user = $this->getUser();

        return $this->render("/espaceMembre/profil.html.twig", [
        'mail' => $user->getEmail(),
        'prenom' => $user->getPrenom(),
        'nom' => $user->getNom(),
        'adresse' => $user->getAdresse(),
        'ville' => $user->getVille(),
        'codepostal' => $user->getCodePostal()]);
    }
    /**
     * @Route("/profil/modifmdp", name="modifmdp")
     */
    public function modifmdp(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        return $this->render("/espaceMembre/modifMdp.html.twig", [
        ]);
    }
    /**
     * @Route("/profil/modifemail", name="modifemail")
     */
    public function modifemail(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        return $this->render("/espaceMembre/modifEmail.html.twig", [
            "mail" => $user->getEmail()
        ]);
    }
    /**
     * @Route("/profil/modifinfo", name="modifinfo")
     */
    public function modifinfo(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        return $this->render("/espaceMembre/modifInfo.html.twig", [
        ]);
    }
}