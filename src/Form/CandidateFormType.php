<?php

namespace App\Form;

use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class CandidateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // add gender here
            ->add('firstname', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'class' => 'form-control',
                    'name' => 'first_name',
                    'id' => 'first_name',
                    'value' => '',
                    'required' => true
                ]
            ])
            ->add('lastname', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'class' => 'form-control',
                    'name' => 'last_name',
                    'id' => 'last_name',
                    'value' => '',
                    'required' => true
                ]
            ])
            ->add('currentlocation', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'name' => 'current_location',
                    'id' => 'current_location',
                    'value' => '',
                    'required' => true
                ]
            ])
            ->add('adress', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'name' => 'address',
                    'id' => 'address',
                    'value' => '',
                ]
            ])
            ->add('profilePictureFile', VichFileType::class, [
                'label' => 'Upload Profile Picture',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
            ])
            ->add('country', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'name' => 'country',
                    'id' => 'country',
                    'value' => '',
                ]
            ])
            ->add('nationality', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'name' => 'nationality',
                    'id' => 'nationality',
                    'value' => '',
                ]
            ])
            ->add('birthdate', DateType::class,  [
                'attr' => [
                    'class' => 'datepicker',
                    'type' => 'text',
                    'name' => 'birth_date',
                    'id' => 'birth_date',
                    'value' => '',
                ]
            ])
            ->add('birthplace', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'name' => 'birth_place',
                    'id' => 'birth_place',
                    'value' => '',
                ]
            ])
            ->add('passportFile', VichFileType::class, [
                'label' => 'Upload Passport',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
            ])
            ->add('cvFile', VichFileType::class, [
                'label' => 'Upload CV',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}
