<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ScheduleRepository;
use App\Service\ScheduleFormatterService;

class HomeController extends AbstractController
{

    private $scheduleFormatterService;

    public function __construct(ScheduleFormatterService $scheduleFormatterService)
    {
        $this->scheduleFormatterService = $scheduleFormatterService;
    }

    #[Route('/accueil', name: 'app_home')]
    public function index(CommentRepository $commentRepository): Response
    {
        
        $comments = $commentRepository->findBy(['rating'=> 5],[ 'id' => 'DESC'], 3);

        $formattedSchedules = $this->scheduleFormatterService->getFormattedSchedules();

        return $this->render('pages/home/index.html.twig', [
            'formattedSchedules' => $formattedSchedules,
            'controller_name' => 'HomeController',
            'comments' => $comments,
            'title' => 'Garage V. Parrot'
        ]);
    }
}