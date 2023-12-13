<?php

namespace App\Controller;

use App\Entity\Car\Car;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\Car\CarRepository;
use App\Repository\ScheduleRepository;
use App\Service\ScheduleFormatterService;
use App\Service\SendMailService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gallerie', name: 'app_gallery_')]
class GalleryController extends AbstractController
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

    #[Route('/', name:'index')]
    public function index(
        CarRepository $carRepository, 
        PaginatorInterface $paginator, 
        ScheduleRepository $repository,
        Request $request): Response
    {        
        $formattedSchedules = $this->getFormattedSchedules($repository);

        $cars = $paginator->paginate(
            $carRepository->findAll(),
            $request->query->getInt('page', 1),
            6 
        );

        return $this->render('pages/gallery/index.html.twig', [
            'controller_name' => 'GalleryController',
            'title'=>'Gallerie',
            'cars'=> $cars,
            'formattedSchedules'=>$formattedSchedules
        ]);
    }
    
    #[Route('/{id}', name:'details')]
    public function details(Car $car, ScheduleRepository $repository): Response
    {                
        $formattedSchedules = $this->getFormattedSchedules($repository);

        return $this->render('pages/gallery/details.html.twig', [
            'controller_name' => 'GalleryController',
            'title'=>'Details',
            'car'=>$car,
            'formattedSchedules'=>$formattedSchedules 
        ]);
    }

    #[Route('/{id}/contacter', name:'contact')]
    public function sendMessage(
        Request $request, 
        EntityManagerInterface $manager, 
        SendMailService $mailer, 
        Car $car, 
        ScheduleRepository $repository
        ): Response
    {
        $formattedSchedules = $this->getFormattedSchedules($repository);
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->get('subject')->setData($car->getName());
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();

            $mailer->send(
            $contact->getEmail(),
            'admin@garage.com',
            $contact->getSubject(),
            $template = 'contact',
            compact('contact', 'car')
            );

            $this->addFlash('success', 'Votre message a bien été envoyé !');

            return $this->redirectToRoute('app_gallery_index');
        }
        
        return $this->render('pages/gallery/contact.html.twig', [
            'form' => $form->createView(),
            'title' => 'Contactez-nous',
            'car' => $car,
            'formattedSchedules'=>$formattedSchedules
        ]);
    }
}
