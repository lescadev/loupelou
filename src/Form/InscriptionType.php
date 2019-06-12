<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'required'   => true,
                'label' => "Email  *"
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Mots de passes différents',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe  *'],
                'second_options' => ['label' => 'Répéter votre mot de passe  *'],
            ])
            ->add('prenom', null, [
                'required'   => true,
                'label' => "Prenom  *"
            ])
            ->add('nom', null, [
                'required'   => true,
                'label' => "Nom  *"
            ])
            ->add('telephone', TextType::class, [
                'required'   => false,
                'label' => "Téléphone",
                'constraints' => new Length(['min' => 10, 'max' => 10]),
                ])
            
            ->add('adresse', null, [
                'required'   => true,
                'label' => "Adresse  *"
            ])
            ->add('ville', null, [
                'required'   => true,
                'label' => "Ville  *"
            ])
            ->add('code_postal', null, [
                'required'   => true,
                'label' => "Code Postal  *"
            ])
        ;
    }
}
