<?php

namespace App\Controller;

use App\Repository\ScheduleRepository;
use App\Repository\ServiceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{
    #[Route('/services', name: 'app_services')]
    public function index(
        ServiceRepository $serviceRepository, 
        PaginatorInterface $paginator,
        ScheduleRepository $schedulerepository,
        Request $request
        ): Response
    {
        $schedules = $schedulerepository->findBy([], ['id' => 'ASC']);
        $data = $serviceRepository->findBy([], ['id' => 'ASC']);
        $services = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/services/index.html.twig', [
            'controller_name' => 'ServicesController',
            'services'=>$services,
            'schedules'=>$schedules,
            'title'=>'Services'
        ]);
    }
}
