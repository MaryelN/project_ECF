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
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
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
            ->setEntityLabelInPlural('Thumbnails')
            ->setEntityLabelInSingular('Thumbnail')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%')
            ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        $mappingParams = $this->getParameter('vich_uploader.mappings'); 

        $carsImagePath = $mappingParams['thumbnail']['uri_prefix'];
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            // TextField::new('imageName')
            //     ->setLabel('Nom de l\'image'),
            AssociationField::new('car')
                ->setLabel('Nom de la voiture')
                ->setCrudController(CarCrudController::class)
                ->setHelp('Choisissez la voiture'),
            TextareaField::new('imageFile')
                ->setFormType(VichImageType::class),
            ImageField::new('imageName')
                ->setBasePath($carsImagePath)
                ->hideOnForm(),
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
