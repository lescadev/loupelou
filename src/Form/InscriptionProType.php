<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class InscriptionProType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('site_internet')
            ->add('siret')
            ->add('compt', CheckboxType::class, [
                'label'    => 'Comptoir',
                'required' => false,
                ]
            )
            ->add('presta', CheckboxType::class, [
                'label'    => 'Prestataire',
                'required' => false,
                ]
            )
        ;
    }
}