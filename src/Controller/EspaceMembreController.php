<?php

namespace App\Controller;

use App\Form\InscriptionType;
use App\Form\DescriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

class EspaceMembreController
    extends AbstractController
{

    /**
     * @Route("/profil", name="profil")
     */
    public function profil()
    {
        $user = $this->getUser();

        return $this->render( "/espaceMembre/profil.html.twig",
            [
                'mail'        => $user->getEmail(),
                'prenom'      => $user->getPrenom(),
                'nom'         => $user->getNom(),
                'adresse'     => $user->getAdresse(),
                'ville'       => $user->getVille(),
                'codepostal'  => $user->getCodePostal(),
                'description' => $user->getDescription(),
                "isactive"    => $user->getIsActive(),
            ] );
    }

    /**
     * @Route("/profil/modifmdp", name="modifmdp")
     */
    public function modifmdp(
        Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em
    ) {

        $user = $this->getUser();

        $form = $this->createForm( InscriptionType::class );
        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->get( 'password' )->isValid() ) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get( 'password' )->getData()
                ) );
            $em->persist( $user );
            $em->flush();
        }

        return $this->render( "/espaceMembre/modifMdp.html.twig",
            [
                'form'     => $form->createView(),
                'isactive' => $user->getIsActive(),
            ] );
    }

    /**
     * @Route("/profil/modifemail", name="modifemail")
     */
    public function modifemail(
        Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em
    ) {
        $user = $this->getUser();
        $user = $this->getUser();

        $form = $this->createForm( InscriptionType::class );
        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->get( 'email' )->isValid() ) {

            $user->setEmail( $form->get( 'email' )->getData() );

            $em->persist( $user );
            $em->flush();
        }

        return $this->render( "/espaceMembre/modifEmail.html.twig",
            [
                "form"     => $form->createView(),
                "mail"     => $user->getEmail(),
                "isactive" => $user->getIsActive(),
            ] );
    }

    /**
     * @Route("/profil/modifinfo", name="modifinfo")
     */
    public function modifinfo(
        Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em
    ) {
        $user = $this->getUser();

        $form = $this->createForm( InscriptionType::class );
        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->get( 'prenom' )->isValid() && $form->get( 'nom' )->isValid()
            && $form->get( 'telephone' )->isValid()
            && $form->get( 'adresse' )->isValid()
            && $form->get( 'ville' )->isValid()
            && $form->get( 'code_postal' )->isValid() ) {

            $user->setEmail( $user->getEmail() );
            $user->setPrenom( $form->get( 'prenom' )->getData() );
            $user->setNom( $form->get( 'nom' )->getData() );
            $user->setTelephone( $form->get( 'telephone' )->getData() );
            $user->setAdresse( $form->get( 'adresse' )->getData() );
            $user->setVille( $form->get( 'ville' )->getData() );
            $user->setCodePostal( $form->get( 'code_postal' )->getData() );
            $em->persist( $user );
            $em->flush();
        }

        return $this->render( "/espaceMembre/modifInfo.html.twig",
            [
                'form'     => $form->createView(),
                'user'     => $user,
                'isactive' => $user->getIsActive(),
            ] );
    }

    /**
     * @Route("/profil/modifdescription", name="modifdescription")
     */
    public function modifdescription( Request $request, EntityManagerInterface $em )
    {
        $user = $this->getUser();

        $form = $this->createForm( DescriptionType::class );
        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->get( 'description' )->isValid() ) {

            $user->setDescription( $form->get( 'description' )->getData() );
            $em->persist( $user );
            $em->flush();
        }

        return $this->render( "/espaceMembre/modifDescription.html.twig",
            [
                'form' => $form->createView(),
                'user' => $user,
                'isactive' => $user->getIsActive()
            ] );
    }
}