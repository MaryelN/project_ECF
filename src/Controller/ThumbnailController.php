<?php

namespace App\Controller;

use App\Form\ThumbnailType;
use App\Entity\Car\Thumbnail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ThumbnailController extends AbstractController
{

    #[Route('/thumbnail', name: 'app_thumbnail')]
    public function index(Request $request, EntityManagerInterface $manager,): Response
    {
        $thumbnail = new Thumbnail();

        $form = $this->createForm(ThumbnailType::class, $thumbnail);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();

            $this->addFlash('success', 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('thumbnail/index.html.twig', [
            'controller_name' => 'ThumbnailController',
            'form' => $form->createView(),
        ]);
    }
}
