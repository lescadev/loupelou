<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class DescriptionType
    extends AbstractType
{

    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder
            ->add( 'description',
                CKEditorType::class,
                [
                    'required' => true,
                    'label'       => false
                ] );
    }
}