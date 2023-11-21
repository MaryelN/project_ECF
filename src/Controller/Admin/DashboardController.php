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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN', message: 'Vous n\'avez pas accès à cette page')]
    #[IsGranted('ROLE_USER', message: 'Vous n\'avez pas accès à cette page')]

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
        $menuItems = [
            MenuItem::linkToDashboard('Accueil', 'fa fa-home'),
        ];
    
        if ($this->isGranted('ROLE_ADMIN')) {
            $menuItems[] = MenuItem::section('Utilisateurs');
            $menuItems[] = MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
        }
    
        $menuItems[] = MenuItem::section('Site Garage');
        if ($this->isGranted('ROLE_ADMIN')) {
            $menuItems[] = MenuItem::linkToCrud('Horaires', 'fa fa-clock', Schedule::class);
        }
        $menuItems[] = MenuItem::linkToCrud('Messages', 'fa fa-envelope', Contact::class);
        $menuItems[] = MenuItem::linkToCrud('Commentaires', 'fa fa-comment', Comment::class);
        $menuItems[] = MenuItem::linkToCrud('Services', 'fa fa-wrench', Service::class);
    
        $menuItems[] = MenuItem::section('Voitures d\'Occasion');
        $menuItems[] = MenuItem::linkToCrud('Annonces de Voitures', 'fa fa-car', Car::class);
    
        return $menuItems;
    }
}
