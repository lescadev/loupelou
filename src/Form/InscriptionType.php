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
                'label' => false
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Mots de passes différents',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => false],
                'second_options' => ['label' => false],
            ])
            ->add('prenom', null, [
                'required'   => true,
                'label' => false
            ])
            ->add('nom', null, [
                'required'   => true,
                'label' => false
            ])
            ->add('telephone', TextType::class, [
                'required'   => false,
                'label' => false,
                'constraints' => new Length(['min' => 10, 'max' => 10]),
                ])
            
            ->add('adresse', null, [
                'required'   => true,
                'label' => false
            ])
            ->add('ville', null, [
                'required'   => true,
                'label' => false
            ])
            ->add('code_postal', null, [
                'required'   => true,
                'label' => false
            ])
        ;
    }
}
