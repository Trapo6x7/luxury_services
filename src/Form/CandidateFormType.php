<?php

namespace App\Form;

use App\Entity\Candidate;
use App\Entity\Experience;
use App\Entity\Gender;
use App\Entity\JobCategory;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CandidateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // add gender here
            ->add('gender', EntityType::class, [
                'class' => Gender::class,
                'choice_label' => 'name',  
                'choice_value' => 'id', 
                'expanded' => false, 
                'multiple' => false, 
                'attr' => [
                    'id' => "gender",
                    'name' => "gender",
                    'required' => false
                ],
                'placeholder' => 'Choose a gender please...',
            ])
            ->add('firstname', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'class' => 'form-control',
                    'name' => 'first_name',
                    'id' => 'first_name',
                    'value' => '',
                    'required' => false
                ]
            ])
            ->add('lastname', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'class' => 'form-control',
                    'name' => 'last_name',
                    'id' => 'last_name',
                    'value' => '',
                    'required' => false
                ]
            ])
            ->add('currentlocation', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'name' => 'current_location',
                    'id' => 'current_location',
                    'value' => '',
                    'required' => false
                ]
            ])
            ->add('adress', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'name' => 'address',
                    'id' => 'address',
                    'value' => '',
                    'required' => false
                ]
            ])
            ->add('profilePicture_path', FileType::class, [
                'label' => 'Upload Profile Picture',

                'attr' => [
                    'type' => 'file',
                    'class' => 'form-control',
                    'name' => 'photo',
                    'id' => 'photo',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'required' => false,
                    'size' => 20000000,
                    'mapped' => false
                ]
            ])
            ->add('country', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'name' => 'country',
                    'id' => 'country',
                    'value' => '',
                    'required' => false
                ]
            ])
            ->add('nationality', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'name' => 'nationality',
                    'id' => 'nationality',
                    'required' => false,
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
                    'required' => false
                ]
            ])
            ->add('birthplace', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'name' => 'birth_place',
                    'id' => 'birth_place',
                    'value' => '',
                    'required' => false
                ]
            ])
            ->add('passport_path', FileType::class, [
                'label' => 'Upload Passport',

                'attr' => [
                    'type' => 'file',
                    'class' => 'form-control',
                    'name' => 'passport',
                    'id' => 'passport',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'required' => false,
                    'size' => 20000000,
                    'mapped' => false
                ]
            ])
            ->add('cv_path', FileType::class, [
                'label' => 'Upload CV',

                'attr' => [
                    'type' => 'file',
                    'class' => 'form-control',
                    'name' => 'cv',
                    'id' => 'cv',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'required' => false,
                    'size' => 20000000,
                    'mapped' => false
                ]
            ])
            ->add('experience', EntityType::class, [
                'class' => Experience::class,
                'choice_label' => 'experience',  // Assure-toi que Gender a bien une propriété "name"
                'choice_value' => 'id',  // Associe chaque option à son ID
                'expanded' => false, // Assure que c'est bien un <select> et pas des radios
                'multiple' => false, // Ne pas afficher comme une liste multiple
                'attr' => [
                    'id' => "experience",
                    'name' => "experience",
                    'required' => false
                ],
                'placeholder' => 'Choose an experience please...',
            ])
            ->add('job_category', EntityType::class, [
                'class' => JobCategory::class,
                'choice_label' => 'category',
                'choice_value' => 'id',
                'expanded' => false,
                'multiple' => false,
                'attr' => [
                    'id' => "job_sector",
                    'name' => "job_sector[]",
                    'required' => false
                ],
                'placeholder' => 'Choose a category please...'
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
