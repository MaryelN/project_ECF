<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Form\BrandType;
use App\Repository\BrandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrandController extends AbstractController
{
    #[Route('marques', name: 'app_brand')]    
    public function index(BrandRepository $repository): Response
    {
        $brands = $repository->findBy([], ['id' => 'ASC']);
        return $this->render('brand/index.html.twig', [
            'controller_name' => 'MarqueController',
            'brands'=>$brands,
            'title'=>'Modifier une marque'
        ]);
    }

    #[Route('marques/creation', name: 'app_new_brand', methods: ['GET', 'POST'])]
    public function newBrand(EntityManagerInterface $manager, Request $request): Response
    { 
        $brand = new Brand();

        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brand = $form->getData();

            $manager->persist($brand);
            $manager->flush();

            $this->addFlash('success', 'La marque a été ajoutée');
            return $this->redirectToRoute('app_brand');
        }
        return $this->render('pages/gallery/new.html.twig', [
            'title' => 'Créer une voiture',
            'form' => $form->createView(),
        ]);
        
    }

    #[Route('marques/edition/{id}', name:'modify')]
    public function editBrand(Brand $brand, EntityManagerInterface $manager, Request $request): Response
    {
        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brand = $form->getData();

            $manager->persist($brand);
            $manager->flush();

            $this->addFlash('success', 'La marque a été Modifiée');
        }
        return $this->render('brand/edit.html.twig', [
            'title' => 'Modifier une marque',
            'form' => $form->createView(),
        ]);
    }  
#[Route('marques/supression/{id}', name:'delete',methods: ['GET'])]
    public function deleteBrand(Brand $brand, EntityManagerInterface $manager): Response
    {
        if (!$brand) {
            throw $this->createNotFoundException('La marque n\'a pas été trouvée'.$brand->getId());
        }

        $manager->remove($brand);
        $manager->flush();

        $this->addFlash('success', 'La voiture a été supprimée');
        return $this->render('brand/edit.html.twig',[
            'title' => 'Modifier une marque',
        ]);
    }
}