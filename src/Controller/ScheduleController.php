<?php

namespace App\Controller;

use App\Repository\ScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScheduleController extends AbstractController
{
    #[Route('/schedule', name: 'app_schedule')]
    public function index(ScheduleRepository $repository, ): Response
    {
        $schedules = $repository->findBy([], ['id' => 'ASC']);

        return $this->render('_partials/_footer.html.twig', [
            'controller_name' => 'scheduleController',
            'schedules'=>$schedules,
            'title'=>'schedule'
        ]);
    }
}