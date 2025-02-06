<?php

namespace App\Form;

use Doctrine\DBAL\Types\BooleanType;
use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname', TextType::class, [
            'label' => 'First Name',
            'required' => true,
        ])
        ->add('lastname', TextType::class, [
            'label' => 'Last Name',
            'required' => true,
        ])
        ->add('adress', TextType::class, [
            'label' => 'Address',
            'required' => false,
        ])
        ->add('country', TextType::class, [
            'label' => 'Country',
            'required' => false,
        ])
        ->add('nationality', TextType::class, [
            'label' => 'Nationality',
            'required' => false,
        ])
        ->add('passport', BooleanType::class, [
            'label' => 'Has Passport?',
            'required' => false,
        ])
        ->add('location', TextType::class, [
            'label' => 'Location',
            'required' => false,
        ])
        ->add('date_of_birth', TextType::class, [
            'label' => 'Date of Birth',
            'required' => false,
        ])
        ->add('place_of_birth', TextType::class, [
            'label' => 'Place of Birth',
            'required' => false,
        ])
        ->add('availability', BooleanType::class, [
            'label' => 'Available?',
            'required' => false,
        ])
        ->add('description', TextareaType::class, [
            'label' => 'Description',
            'required' => false,
        ])
        ->add('created_at', DateType::class, [
            'label' => 'Created At',
            'widget' => 'single_text',
            'required' => false,
        ])
        ->add('uploaded_at', DateType::class, [
            'label' => 'Uploaded At',
            'widget' => 'single_text',
            'required' => false,
        ])
        ->add('deleted_at', DateType::class, [
            'label' => 'Deleted At',
            'widget' => 'single_text',
            'required' => false,
        ])
        ->add('id_file', IntegerType::class, [
            'label' => 'File ID',
            'required' => false,
        ])
        ->add('experience', ChoiceType::class, [
            'label' => 'Experience (years)',
            'required' => false,
        ])
        ->add('category', ChoiceType::class, [
            'label' => 'Category ID',
            'required' => false,
        ])
        ->add('note', TextareaType::class, [
            'label' => 'Note',
            'required' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
