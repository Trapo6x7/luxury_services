<?php

namespace App\Controller\Admin;

use App\Entity\Recruiter;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\SecurityBundle\Security;

class RecruiterCrudController extends AbstractCrudController
{   private UserPasswordHasherInterface $passwordHasher;
    private Security $security;

    public function __construct(UserPasswordHasherInterface $passwordHasher, Security $security)
    {
        $this->passwordHasher = $passwordHasher;
        $this->security = $security;
    }

    public static function getEntityFqcn(): string
    {
        return Recruiter::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
           TextField::new('name'),
            TextField::new('activity'),
            TextField::new('company'),
            TextField::new('post'),
            TextField::new('phone'),
            TextField::new('mail'),
            TextField::new('password')->onlyOnForms()->setRequired(false),
            AssociationField::new('user')->hideOnForm(), // Cacher le champ 'user' sur le formulaire
        ];
    }
    
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Associer l'utilisateur connecté à l'entité
        if ($entityInstance instanceof Recruiter) {
            $user = $this->security->getUser();
            $entityInstance->setUser($user);
        }

        // Hasher le mot de passe si nécessaire (code que tu as déjà)
        if ($entityInstance instanceof User && $entityInstance->getPassword()) {
            $hashedPassword = $this->passwordHasher->hashPassword($entityInstance, $entityInstance->getPassword());
            $entityInstance->setPassword($hashedPassword);
        }

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Associer l'utilisateur connecté à l'entité lors de la mise à jour
        if ($entityInstance instanceof Recruiter) {
            $user = $this->security->getUser();
            $entityInstance->setUser($user);
        }

        // Hasher le mot de passe si nécessaire (code que tu as déjà)
        if ($entityInstance instanceof User && $entityInstance->getPassword()) {
            $hashedPassword = $this->passwordHasher->hashPassword($entityInstance, $entityInstance->getPassword());
            $entityInstance->setPassword($hashedPassword);
        }

        parent::updateEntity($entityManager, $entityInstance);
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityPermission('ROLE_RECRUITER'); // Restriction d'accès au CRUD
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW, Action::DELETE); // Désactive la création, modification et suppression
    }
}
