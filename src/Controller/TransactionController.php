<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ComptoirRepository;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Entity\Comptoir;
use App\Entity\Transaction;
use App\Form\TransactionType;

class TransactionController extends AbstractController
{
/**
     * @Route("/transaction", name="transaction")
     */
	public function transaction(UserRepository $userRepository, ComptoirRepository $comptoirRepository, Request $request, \Swift_Mailer $mailer)
	{
		$transaction = new Transaction();
		$transaction->setDateTransaction(new \Datetime());

        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transaction = $form->getData();
            $nom = $form->getData()->nom;
            $prenom = $form->getData()->prenom;
            $montant = $form->getData()->getMontant();

            $user = $this->getUser();
            $comptoir = $comptoirRepository->findBy(array("user"=> $user))[0];
            if(($comptoir->getSolde() - $montant) <0)
            {
            	$this->addFlash('error', "Transaction refusée, solde insuffisant! ");
            	return $this->redirectToRoute('transaction');

            }
            else if(($comptoir->getSolde() - $montant) <=50)
            {
            	$this->addFlash('error', "Transaction refusée, votre solde risque d'être trop bas! ");
            	return $this->redirectToRoute('transaction');

            }
            else 
            {
            	$comptoir->setSolde($comptoir->getSolde() - $montant);
            }
            $adherent = $userRepository->findBy(array("nom"=> $nom, "prenom"=> $prenom));
             $adherentObject = array_reduce(
                        $adherent,
                        function ($result, $adherent) {
                            return $adherent;
                        }
                    );
            if(empty($adherent)){
        	$this->addFlash('error', "Adhérent non reconnu.");
        	return $this->redirectToRoute('transaction');
        }
            $transaction->setUser($adherent[0]);
            $transaction->setComptoir($comptoir);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($transaction);
            $entityManager->flush();

            $message = (new \Swift_Message('Transaction'))
            ->setFrom($this->getParameter('mail.site'))
            ->setTo( $adherentObject->getEmail())
            ->setBody(
                $this-> renderView(
                    'emails/transaction.html.twig',
                    ['nom' =>  $form->get('nom')->getData(), 'prenom' =>  $form->get('prenom')->getData(), 'montant' => $form->get('montant')->getData(), 'date_transaction' => $transaction->getDateTransaction()->format('d-m-Y'), 'comptoir' => $comptoir->getDenomination()]
                ),
                'text/html'
            );

            $mailer->send($message);

            if(($comptoir->getSolde())<60)
    		{
    		$adminMessage = (new \Swift_Message('Solde bas'))
            ->setFrom($this->getParameter('mail.site'))
            ->setTo($this->getParameter('mail.admin'))
            ->setBody(
                $this-> renderView(
                    'emails/soldeBas.html.twig',
                    ['comptoir' => $comptoir->getDenomination()]
                ),
                'text/html'
            );

            $mailer->send($adminMessage);
    		}

            $this->addFlash('success', 'Transaction effectuée !');
            return $this->redirectToRoute('transaction');

        }

        $user = $this->getUser();
        $comptoir = $comptoirRepository->findBy(array("user"=> $user))[0];


		return $this->render("transaction/transaction.html.twig", [
            'controller_name' => 'TransactionController',
            'nom' => $comptoir->getDenomination(),
            'solde' => $comptoir->getSolde(),
            'form' => $form->createView()
        ]);
	}
}