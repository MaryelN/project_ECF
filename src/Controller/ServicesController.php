<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{
    #[Route('/services', name: 'app_services')]
    public function index(ServiceRepository $serviceRepository): Response
    {
        $services = $serviceRepository->findBy([], ['id' => 'ASC']);
        return $this->render('services/index.html.twig', [
            'controller_name' => 'ServicesController',
            'services'=>$services,
            'title'=>'Services'
        ]);
    }
}
