<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/accueil', name: 'app_home')]
    public function index(): Response
    {
        
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'title' => 'Garage V. Parrot'
        ]);
    }
    
}
