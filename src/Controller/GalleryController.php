<?php

namespace App\Controller;

use App\Entity\Car;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gallerie', name: 'app_gallery_')]
class GalleryController extends AbstractController
{
    #[Route('/', name:'index')]
    public function index(CarRepository $carRepository): Response
    {        
        $cars = $carRepository->findBy([], ['id' => 'DESC']);                               
        return $this->render('gallery/index.html.twig', [
            'controller_name' => 'GalleryController',
            'title'=>'Gallerie',
            'cars'=> $cars 
        ]);
    }
    
    #[Route('/{id}', name:'details')]
    public function details(Car $car): Response
    {                                   
        return $this->render('gallery/details.html.twig', [
            'controller_name' => 'GalleryController',
            'title'=>'Details',
            'car'=>$car 
        ]);
    }

}
