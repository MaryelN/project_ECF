<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarsController extends AbstractController
{
    #[Route('/gallerie/creation', name: 'new', methods: ['GET', 'POST'])]
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
            'title' => 'Créer une nouvelle annonce',
            'form' => $form->createView(),
        ]);
        
    }

    #[Route('gallerie/{id}/edition', name: 'edit', methods: ['GET', 'POST'])]
    public function editCar(Car $car,EntityManagerInterface $manager, Request $request): Response
    {
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();

            $manager->persist($car);
            $manager->flush();

            $this->addFlash('success', 'La voiture a été Modifiée');
            return $this->redirectToRoute('app_gallery_index');
        }
        return $this->render('pages/gallery/new.html.twig', [
            'controller_name' => 'CarsController',
            'title' => 'Modifier une annonce',
            'form' => $form->createView(),
        ]);
    }  

    #[Route('/voiture/{id}/supression', name: 'delete', methods: ['GET', 'POST'])]
    public function deleteCar(Car $car, EntityManagerInterface $manager): Response
    {
        
        $manager->remove($car);
        $manager->flush();

        $this->addFlash('success', 'La voiture a été supprimée');
        return $this->redirectToRoute('app_gallery_index');
    }
}

