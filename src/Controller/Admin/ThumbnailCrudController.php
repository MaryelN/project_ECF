<?php

namespace App\Controller\Admin;

use App\Entity\Car\Thumbnail;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ThumbnailCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Thumbnail::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Images')
            ->setEntityLabelInSingular('Image')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%')
            ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('imageName')
                ->setLabel('Nom de l\'image'),
            AssociationField::new('car')
                ->setLabel('Nom de la voiture')
                ->setCrudController(CarCrudController::class)
                ->setHelp('Choisissez la voiture'),
            ImageField::new('imageFile')
                ->setLabel('Image')
                ->setBasePath('/uploads/images')
                ->setUploadDir('public/uploads/images') 
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            IntegerField::new('imageSize')
                ->hideOnForm()
                ->hideOnIndex()
                ->setRequired(false),
            DateTimeField::new('updatedAt')
                ->hideOnForm()
                ->hideOnIndex(), 
            DateTimeField::new('createdAt')
                ->hideOnForm()
                ->hideOnIndex(),             
        ];
    }
    

}
