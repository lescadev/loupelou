<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DescriptionType
    extends AbstractType
{

    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder
            ->add( 'description',
                TextareaType::class,
                [
                    'required' => true,
                ] );
    }
}
