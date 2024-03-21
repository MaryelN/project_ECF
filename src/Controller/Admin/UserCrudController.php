<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Employés')
            ->setEntityLabelInSingular('Employé')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%');
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            TextField::new('lastname')
            ->setLabel('Nom'),
            TextField::new('name')
            ->setLabel('Prénom'),
            TextField::new('email'),
            TextField::new('password')
            ->hideOnForm()
            ->hideOnIndex(),
            ArrayField::new('roles')
            ->hideOnIndex(),
            DateTimeField::new('createdAt')
            ->setFormTypeOption('disabled', true)
        ];
    }
}   

