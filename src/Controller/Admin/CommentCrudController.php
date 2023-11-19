<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Commentaires')
            ->setEntityLabelInSingular('Commenaire')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%')
            ->setPaginatorPageSize(10);
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            DateTimeField::new('created_at')
                ->setLabel('Date de création')
                ->setFormTypeOption('disabled', true),
            TextField::new('lastname')
                ->setLabel('Nom')
                ->setFormTypeOption('disabled', true), 
            TextField::new('name')
                ->setLabel('Prénom')
                ->setFormTypeOption('disabled', true),
            TextField::new('email')
                ->setLabel('Email')
                ->hideOnIndex()
                ->setFormTypeOption('disabled', true),
            IntegerField::new('rating')
                ->setLabel('Note')
                ->setFormTypeOption('disabled', true),
            TextareaField::new('message')
                ->setLabel('Message')
                ->setFormTypeOption('disabled', true),
            BooleanField::new('IsVerified')
                ->setLabel('Validé')
        ];
    }
    
}
