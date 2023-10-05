<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    #[Route('/contact', name: 'page_contact')]
    public function contact(): Response
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'PagesController',
            'title' => 'Contact',
        ]);
    }

    #[Route('/gallery', name: 'page_gallery')]
    public function gallery(): Response
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'PagesController',
            'title' => 'Gallery',
        ]);
    }
}
