<?php

namespace App\Controller;

use App\Repository\ScheduleRepository;
use App\Repository\ServiceRepository;
use App\Service\ScheduleFormatterService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{
    private $scheduleFormatterService;

    public function __construct(ScheduleFormatterService $scheduleFormatterService)
    {
        $this->scheduleFormatterService = $scheduleFormatterService;
    }

    #[Route('/services', name: 'app_services')]
    public function index(
        ServiceRepository $serviceRepository, 
        PaginatorInterface $paginator,
        ScheduleRepository $schedulerepository,
        Request $request
        ): Response
    {
        $formattedSchedules = $this->scheduleFormatterService->getFormattedSchedules();
        
        $data = $serviceRepository->findBy([], ['id' => 'ASC']);
        
        $services = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/services/index.html.twig', [
            'formattedSchedules' => $formattedSchedules,
            'controller_name' => 'ServicesController',
            'services'=>$services,
            'title'=>'Services'
        ]);
    }
}
