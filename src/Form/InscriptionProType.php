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
            ->add('denomination', null, [
                'required'   => true,
                'label' => "Nom de l'enseigne  *"
            ])
            ->add('site_internet', null, [
                'required'   => false,
                'label' => "Site Internet"
            ])
            ->add('siret', null, [
                'required'   => false,
                'label' => "Siret"
            ])
            ->add('compt', CheckboxType::class, [
                'label'    => 'Comptoir',
                'required' => false,
            ])
            ->add('presta', CheckboxType::class, [
                'label'    => 'Prestataire',
                'required' => false,
            ])
        ;
    }
}
