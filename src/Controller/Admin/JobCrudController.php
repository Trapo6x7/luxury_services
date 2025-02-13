<?php

namespace App\Controller\Admin;

use App\Entity\Job;
use App\Entity\Recruiter;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Bundle\SecurityBundle\Security;

class JobCrudController extends AbstractCrudController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getEntityFqcn(): string
    {
        return Job::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom du job'),
            TextareaField::new('description', 'Description'),
            DateTimeField::new('created_at', 'Date de création')->setFormat('dd/MM/yyyy HH:mm')->hideOnForm(),
            DateTimeField::new('updated_at', 'Date de mise à jour')->setFormat('dd/MM/yyyy HH:mm')->hideOnForm(),
            DateTimeField::new('deleted_at', 'Supprimé le')->setFormat('dd/MM/yyyy HH:mm')->onlyOnDetail(),
            AssociationField::new('jobCategory', 'Catégorie')
                ->setCrudController(JobCategoryCrudController::class)
                ->autocomplete(),
            AssociationField::new('contract', 'Contrat')
                ->setCrudController(ContractCrudController::class)
                ->autocomplete(),

        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Associer l'utilisateur connecté à l'entité
        if ($entityInstance instanceof Job) {
            $user = $this->security->getUser();
            /** @var User $user */
            $userId = $entityManager->getRepository(User::class)->findOneBy(['email' => $user->getEmail()])->getId();
            $recruiter = $entityManager->getRepository(Recruiter::class)->findOneBy(['user' => $userId]);
            $entityInstance->setRecruiter($recruiter);
        }


        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Associer l'utilisateur connecté à l'entité lors de la mise à jour
        if ($entityInstance instanceof Job) {
            $user = $this->security->getUser();
            /** @var User $user */
            $userId = $entityManager->getRepository(User::class)->findOneBy(['email' => $user->getEmail()])->getId();
            $recruiter = $entityManager->getRepository(Recruiter::class)->findOneBy(['user' => $userId]);
            $entityInstance->setRecruiter($recruiter);
        }


        parent::updateEntity($entityManager, $entityInstance);
    }
    
}
