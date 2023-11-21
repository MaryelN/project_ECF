<?php

namespace App\Controller;

use App\Repository\ScheduleRepository;
use App\Service\ScheduleFormatterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private $scheduleFormatterService;

    public function __construct(ScheduleFormatterService $scheduleFormatterService)
    {
        $this->scheduleFormatterService = $scheduleFormatterService;
    }

    private function getFormattedSchedules(ScheduleRepository $repository): array
    {
        return $this->scheduleFormatterService->getFormattedSchedules($repository);
    }

    #[Route(path: '/connexion', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, ScheduleRepository $repository,): Response
    {
        $formattedSchedules = $this->getFormattedSchedules($repository);

        if ($this->getUser()) {
            return $this->redirectToRoute('admin');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('pages/security/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error,
            'formattedSchedules'=>$formattedSchedules
        ]);
    }

    #[Route(path: '/deconnexion', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
