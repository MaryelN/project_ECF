<?php

namespace App\Controller\Admin;

use App\Entity\Schedule;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class ScheduleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Schedule::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm()
            ->hideOnIndex(),
            TextField::new('day_name')
            ->setLabel('Jour'),
            TimeField::new('opening_am')
            ->setLabel('Ouverture AM'),
            TimeField::new('closing_am')
            ->setLabel('Fermeture AM'),
            TimeField::new('opening_pm')
            ->setLabel('Ouverture PM'),
            TimeField::new('closing_pm')
            ->setLabel('Fermeture PM'),
        ];
    }
    
}
