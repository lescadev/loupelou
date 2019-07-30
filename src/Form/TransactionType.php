<?php

namespace App\Form;

use App\Entity\Transaction;
use App\Entity\Comptoir;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

           ->add('nom', TextType::class, [
                'required'   => true,
                'label' => false
            ])

           ->add('prenom', TextType::class, [
                'required'   => true,
                'label' => false
            ])

            ->add('montant', MoneyType::class, [
                'required'   => true,
                'label' => false,
                'currency' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Transaction::class,
        ]);
    }
}
