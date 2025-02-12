<?php

namespace App\Controller\Admin;

use App\Entity\Job;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;


class JobCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Job::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom du job'),
            TextEditorField::new('description', 'Description'),
            DateTimeField::new('created_at', 'Date de création')->setFormat('dd/MM/yyyy HH:mm')->hideOnForm(),
            DateTimeField::new('updated_at', 'Date de mise à jour')->setFormat('dd/MM/yyyy HH:mm')->hideOnForm(),
            DateTimeField::new('deleted_at', 'Supprimé le')->setFormat('dd/MM/yyyy HH:mm')->onlyOnDetail(),
            AssociationField::new('category', 'Catégorie')
            ->setCrudController(JobCategoryCrudController::class)
                ->autocomplete(),
            AssociationField::new('recruiter', 'Recruteur')
                ->setDisabled() // Empêche la modification
                ->hideOnForm(), // Masque dans le formulaire (car déjà défini)
            AssociationField::new('contract', 'Contrat')
                ->setCrudController(ContractCrudController::class)
                ->autocomplete(),

        ];
    }
}
