<?php

namespace App\Form;

use App\Entity\Candidate;
use App\Entity\Gender;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // add gender here
            ->add('gender', EntityType::class, [
                'class' => Gender::class,
                'attr' => [
                    'id' => "gender",
                    'name' => "gender",
                ]
            ])
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
            ->add('profilePictureFile', FileType::class, [
                'label' => 'Upload Profile Picture',
                'required' => false,
                'attr' => [
                    'type' => 'file',
                    'class' => 'form-control',
                    'name' => 'photo',
                    'id' => 'photo',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'size' => 20000000
                ]
            ])
            // id="photo" size="20000000" accept=".pdf,.jpg,.doc,.docx,.png,.gif" name="photo" type="file"
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
            ->add('passportFile', FileType::class, [
                'label' => 'Upload Passport',
                'required' => false,
                'attr' => [
                    'type' => 'file',
                    'class' => 'form-control',
                    'name' => 'photo',
                    'id' => 'photo',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'size' => 20000000
                ]
            ])
            ->add('cvFile', FileType::class, [
                'label' => 'Upload CV',
                'required' => false,
                'attr' => [
                    'type' => 'file',
                    'class' => 'form-control',
                    'name' => 'photo',
                    'id' => 'photo',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'size' => 20000000
                ]
            ])
            // id="photo" size="20000000" accept=".pdf,.jpg,.doc,.docx,.png,.gif" name="photo" type="file"
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}
