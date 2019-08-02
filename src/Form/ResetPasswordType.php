<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ResetPasswordType extends AbstractType
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder
            ->add('password',
            RepeatedType::class,
            [
                'type'            => PasswordType::class,
                'invalid_message' => 'Mots de passe différents',
                'options'         => [ 'attr' => [ 'class' => 'password-field' , 'placeholder' => 'Entrez votre mots de passe'] ],
                'required'        => true,
                'first_options'   => [ 'label' => false ],
                'second_options'  => [ 'label' => false ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}