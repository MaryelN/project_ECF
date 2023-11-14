<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/accueil', name: 'app_home')]
    public function index(CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository->findBy(['rating'=> 5],[ 'id' => 'DESC'], 3);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'comments' => $comments,
            'title' => 'Garage V. Parrot'
        ]);
    }
    
}
