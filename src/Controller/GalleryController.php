<?php

namespace App\Controller;

use App\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalleryController extends AbstractController
{
    #[Route('/gallerie', name: 'app_gallery')]
    public function gallery(): Response
    {
        return $this->render('gallery/index.html.twig');
    }
    #[Route('/gallerie/{id}', name: 'app_gallery_details')]
    public function details(Car $car): Response
    {
        dd($car);
        Return $this->render('gallery/details.html.twig', [
            'controller_name' => 'Gallerie Details Controller',
            'title' => 'Details',
        ]);
    }
}
