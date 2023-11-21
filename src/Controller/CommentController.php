<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Service\ScheduleFormatterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    private $scheduleFormatterService;

    public function __construct(ScheduleFormatterService $scheduleFormatterService)
    {
        $this->scheduleFormatterService = $scheduleFormatterService;
    }

    #[Route('/commentaires', name: 'app_comment')]
    public function sendComment(Request $request, EntityManagerInterface $manager): Response
    {
        $formattedSchedules = $this->scheduleFormatterService->getFormattedSchedules();

        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $comment = $form->getData();

            $manager->persist($comment);
            $manager->flush();

            $this->addFlash('success', 'Merci pour votre commentaire');
            return $this->redirectToRoute('app_home');
        }
        
        return $this->render('pages/comment/index.html.twig', [
            'formattedSchedules' => $formattedSchedules,
            'form' => $form->createView(),
            'title' => 'Commentaires',
        ]);
    }
}
