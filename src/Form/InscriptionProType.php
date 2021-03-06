<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class InscriptionProType
    extends AbstractType
{

    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder
            ->add( 'denomination',
                null,
                [
                    'required' => true,
                    'label'    => false,
                ] )
            ->add( 'site_internet',
                null,
                [
                    'required' => false,
                    'label'    => false,
                ] )
            ->add( 'siret',
                null,
                [
                    'required' => false,
                    'label'    => false,
                ] )
            ->add( 'compt',
                CheckboxType::class,
                [
                    'label'    => 'Comptoir',
                    'required' => false,
                ] )
            ->add( 'presta',
                CheckboxType::class,
                [
                    'label'    => 'Prestataire',
                    'required' => false,
                ] );
    }
}
