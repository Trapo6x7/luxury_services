<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class UserCrudController extends AbstractCrudController
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('email', 'Email'),
            TextField::new('password', 'Password')
                ->onlyOnForms()
                ->setRequired(false), 
            ChoiceField::new('roles', 'Roles')
                ->setChoices([
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                    'Recruteur' => 'ROLE_RECRUITER',
                    'Candidat' => 'ROLE_CANDIDATE',
                ])
                ->allowMultipleChoices()
                ->renderExpanded(),
            BooleanField::new('isVerified', 'Vérifié'),
        ];
    }
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof User && $entityInstance->getPassword()) {
            $hashedPassword = $this->passwordHasher->hashPassword($entityInstance, $entityInstance->getPassword());
            $entityInstance->setPassword($hashedPassword);
        }

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof User && $entityInstance->getPassword()) {
            $hashedPassword = $this->passwordHasher->hashPassword($entityInstance, $entityInstance->getPassword());
            $entityInstance->setPassword($hashedPassword);
        }

        parent::updateEntity($entityManager, $entityInstance);
    }
}
