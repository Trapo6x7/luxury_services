<?php

namespace App\Form;

use App\Entity\Candidate;
use App\Entity\Experience;
use App\Entity\Gender;
use App\Entity\JobCategory;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CandidateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // add gender here
            ->add('gender', EntityType::class, [
                'class' => Gender::class,
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => false,
                'attr' => [
                    'id' => "gender",
                    'name' => "gender",
                ],
                'placeholder' => 'Choose a gender please...',
                'required' => false
            ])
            ->add('firstname', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'class' => 'form-control',
                    'id' => 'first_name',
                ],
                'required' => false
            ])
            ->add('lastname', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'class' => 'form-control',
                    'id' => 'last_name',
                ],
                'required' => false
            ])
            ->add('currentlocation', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'id' => 'current_location',
                ],
                'required' => false
            ])
            ->add('adress', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'id' => 'address',
                ],
                'required' => false
            ])
            ->add('profilePictureFile', FileType::class, [
                'label' => 'Upload Profile Picture',
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'photo',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'size' => 20000000,
                    
                ],
                'required' => false,
                'mapped' => false,
            ])
            ->add('country', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'id' => 'country',
                ],
                'required' => false
            ])
            ->add('nationality', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'id' => 'nationality',
                ],
                'required' => false,
            ])
            ->add('birthdate', BirthdayType::class, [
                'required' => false,
                'label' => 'Birthdate',
                'attr' => [
                    'class' => 'datepicker',
                    'id' => 'birth_date',
                ],
                'label_attr' => [
                    'class' => 'active',
                ],
                'format' => 'yyyy-MM-dd',
            ])

            ->add('birthplace', TextType::class,  [
                'attr' => [
                    'type' => 'text',
                    'id' => 'birth_place',
                ],
                'required' => false
            ])
            ->add('passportFile', FileType::class, [
                'label' => 'Upload Passport',
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'passport',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'size' => 20000000,
                ],
                'mapped' => false,
                'required' => false,
            ])
            ->add('cvFile', FileType::class, [
                'label' => 'Upload CV',
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'cv',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'size' => 20000000,
                ],
                'mapped' => false,
                'required' => false,
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
                ],
                'placeholder' => 'Choose an experience please...',
                'required' => false
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Short description for your profile, as well as more personnal informations (e.g. your hobbies/interests ). You can also paste any link you want.',
                'attr' => [
                    'id' => 'description',
                    'class' => 'materialize-textarea',
                    'cols' => 50,
                    'rows' => 10,
                ],
            ])
            ->add('job_category', EntityType::class, [
                'class' => JobCategory::class,
                'choice_label' => 'category',
                'expanded' => false,
                'multiple' => false,
                'attr' => [
                    'id' => "job_sector",
                    'name' => "job_sector[]",
                ],
                'placeholder' => 'Choose a category please...',
                'required' => false
            ])
            ->add('email', EmailType::class, [
                'required' => false,
                'mapped' => false,
                'label' => 'Email',
                'attr' => [
                    'id' => 'email',
                    'class' => 'form-control',
                ],
            ])
            ->add('newPassword', RepeatedType::class, [
                'mapped' => false,
                'required' => false,
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'New Password',
                    'attr' => [
                        'class' => 'form-control',
                        'id' => 'password',
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirm New Password',
                    'attr' => [
                        'class' => 'form-control',
                        'id' => 'password_repeat',
                    ],
                ],
                'invalid_message' => 'The password fields must match.',
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, $this->setUpdatedAt(...))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
    private function setUpdatedAt(FormEvent $event): void
    {
        $candidate = $event->getData();

        $candidate->setUpdatedAt(new \DateTimeImmutable());
    }
}
