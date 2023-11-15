<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\AddCarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddCarsController extends AbstractController
{
    #[Route('/voiture/creation', name: 'app_cars')]
    public function newCar(EntityManagerInterface $manager, Request $request): Response
    {
        $car = new Car();

        $form = $this->createForm(AddCarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();

            $manager->persist($car);
            $manager->flush();

            $this->addFlash('success', 'La voiture a été ajoutée');
            return $this->redirectToRoute('app_gallery_index');
        }
        return $this->render('pages/cars/index.html.twig', [
            'controller_name' => 'CarsController',
            'title' => 'Créer une voiture',
            'form' => $form->createView(),
        ]);
        
    }
}
