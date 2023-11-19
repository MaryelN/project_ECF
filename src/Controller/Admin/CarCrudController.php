<?php

namespace App\Controller\Admin;

use App\Entity\Car\Car;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Car::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Voitures')
            ->setEntityLabelInSingular('Voiture')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%')
            ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('name')
                ->setLabel('Nom'),
            IntegerField::new('car_year')
                ->setLabel('Année'),
            IntegerField::new('km')
                ->setLabel('Kilométrage'),
            IntegerField::new('price')
                ->setLabel('Prix'),
            AssociationField::new('transmission')
                ->setLabel('Transmission')
                ->setCrudController(TransmissionCrudController::class)
                ->setHelp('Choisissez la transmission de la voiture'),
            AssociationField::new('fuel')
                ->setLabel('Carburant')
                ->setCrudController(FieldCrudController::class)
                ->setHelp('Choisissez le carburant de la voiture'),
            AssociationField::new('brand')
                ->setLabel('Marque')
                ->setHelp('Choisissez la marque de la voiture')
                ->setCrudController(BrandCrudController::class),
        
            TextEditorField::new('description')
                ->setLabel('Description'),
        ];
    }   
}