<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarsController extends AbstractController
{
    #[Route('/voiture/creation', name: 'app_new_car')]
    public function newCar(EntityManagerInterface $manager, Request $request): Response
    {
        $car = new Car();

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();

            $manager->persist($car);
            $manager->flush();

            $this->addFlash('success', 'La voiture a été ajoutée');
            return $this->redirectToRoute('app_gallery_index');
        }
        return $this->render('pages/gallery/new.html.twig', [
            'controller_name' => 'CarsController',
            'title' => 'Créer une voiture',
            'form' => $form->createView(),
        ]);
        
    }

    #[Route('/voiture/edition', name: 'app_edit_car')]
    public function editCar(EntityManagerInterface $manager, Request $request): Response
    {
        $car = new Car();

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();

            $manager->persist($car);
            $manager->flush();

            $this->addFlash('success', 'La voiture a été ajoutée');
            return $this->redirectToRoute('app_gallery_index');
        }
        return $this->render('pages/gallery/new.html.twig', [
            'controller_name' => 'CarsController',
            'title' => 'Créer une voiture',
            'form' => $form->createView(),
        ]);
    }  
}

