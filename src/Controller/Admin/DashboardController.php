<?php

namespace App\Controller\Admin;

use App\Entity\Car\Brand;
use App\Entity\Car\Car;
use App\Entity\Car\Thumbnail;
use App\Entity\Contact;
use App\Entity\Schedule;
use App\Entity\Service;
use App\Entity\User;
use App\Entity\Comment;;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Garage V. Parrot - Admin')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Accueil', 'fa fa-home'),

            MenuItem::section('Utilisateurs'),
            MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class),

            MenuItem::section('Site Garage'),
            MenuItem::linkToCrud('Horaires', 'fa fa-clock', Schedule::class),
            MenuItem::linkToCrud('Messages', 'fa fa-envelope', Contact::class),
            MenuItem::linkToCrud('Commentaires', 'fa fa-comment', Comment::class),
            MenuItem::linkToCrud('Services', 'fa fa-wrench', Service::class),
            MenuItem::section('Voitures d\'Occasion'),
            MenuItem::linkToCrud('Annonces de Voitures', 'fa fa-car', Car::class),
            MenuItem::linkToCrud('Marques de Voitures', 'fa fa-check', Brand::class),
            MenuItem::linkToCrud('Images des Voitures', 'fa fa-photo', Thumbnail::class),
        ];
    }
}
