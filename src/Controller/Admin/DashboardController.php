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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted as AttributeIsGranted;

class DashboardController extends AbstractDashboardController
{
    
    #[Route('/admin', name: 'admin')]
    #[AttributeIsGranted('ROLE_USER', message: 'Vous n\'avez pas accès à cette page')]

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
        $menuItems[] = MenuItem::linkToRoute('Retour au Site', 'fa fa-home', 'app_home');
        $menuItems[] = MenuItem::section('Site Garage');
        if ($this->isGranted('ROLE_ADMIN')) {
            $menuItems[] = MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
            $menuItems[] = MenuItem::linkToRoute('Registrer', 'fa fa-user', 'app_register');
            $menuItems[] = MenuItem::linkToCrud('Horaires', 'fa fa-clock', Schedule::class);
        }
        $menuItems[] = MenuItem::linkToCrud('Messages', 'fa fa-envelope', Contact::class);
        $menuItems[] = MenuItem::linkToCrud('Commentaires', 'fa fa-comment', Comment::class);
        $menuItems[] = MenuItem::linkToCrud('Services', 'fa fa-wrench', Service::class);
    
        $menuItems[] = MenuItem::section('Voitures d\'Occasion') ;
        $menuItems[] = MenuItem::linkToCrud('Annonces de Voitures', 'fa fa-car', Car::class);
        $menuItems[] = MenuItem::linkToCrud('Marques de Voitures', 'fa fa-car', Brand::class);
        $menuItems[] = MenuItem::linkToCrud('Images de Voitures', 'fa fa-car', Thumbnail::class);
    
        return $menuItems;
    }
}
