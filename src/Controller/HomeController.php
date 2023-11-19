<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ScheduleRepository;

class HomeController extends AbstractController
{

    #[Route('/accueil', name: 'app_home')]
    public function index(CommentRepository $commentRepository, ScheduleRepository $repository): Response
    {
        $schedules = $repository->findBy([], ['id' => 'ASC']);
        $comments = $commentRepository->findBy(['rating'=> 5],[ 'id' => 'DESC'], 3);

        // Format DateTimeInterface to string for each schedule
        $formattedSchedules = array_map(function ($schedule) {
            return [
                'dayName' => $schedule->getDayName(),
                'openingAm' => $schedule->getOpeningAm()->format('H:i'),
                'closingAm' => $schedule->getClosingAm()->format('H:i'),
                'openingPm' => $schedule->getOpeningPm()->format('H:i'),
                'closingPm' => $schedule->getClosingPm()->format('H:i'),
            ];
        }, $schedules);

        return $this->render('pages/home/index.html.twig', [
            'formattedSchedules' => $formattedSchedules,
            'controller_name' => 'HomeController',
            'comments' => $comments,
            'schedules'=>$schedules,
            'title' => 'Garage V. Parrot'
        ]);
    }
}