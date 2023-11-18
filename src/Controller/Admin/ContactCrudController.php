<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Messages')
            ->setEntityLabelInSingular('Message')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%')
            ->setPaginatorPageSize(10);
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->setFormTypeOption('disabled', true),
            DateTimeField::new('createdAt')
                ->setLabel('Date de création')
                ->setFormTypeOption('disabled', true),
            TextField::new('lastname')
                ->setLabel('Nom'),
            TextField::new('name')
                ->setLabel('Prénom'),
            TextField::new('email')
                ->setLabel('Email'),
            TextField::new('Subject')
                ->setLabel('Sujet'),
            TextareaField::new('Message')
                ->setLabel('Message')
                ->hideOnDetail()
    
        ];
    }
    
}
