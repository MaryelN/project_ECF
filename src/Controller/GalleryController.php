<?php

namespace App\Controller;

use App\Entity\Car\Car;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\Car\BrandRepository;
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
        ScheduleRepository $shceduleRepository,
        BrandRepository $brandRepository,
        Request $request): Response
    {        
        $formattedSchedules = $this->getFormattedSchedules($shceduleRepository);

        // Get the page number from the request, ensuring it's a positive non-zero integer
        $page = max(1, (int)$request->query->get('page', 1));

        //on recupere les filtres
        $filters = $request->request->get("brands");
        
        $cars = $carRepository->paginationQuery(6, $filters);

        $totalCars = $carRepository->getTotalCars($filters);
    
        $brands = $brandRepository->findAll();

        // Use the paginator with the corrected page number
        $cars = $paginator->paginate(
            $carRepository->paginationQuery($page, 6, $filters),
            $page,
            6
        );

        if($request->get('ajax')){
            return new Response('ok');
        }

        return $this->render('pages/gallery/index.html.twig', [
            'controller_name' => 'GalleryController',
            'title'=>'Gallerie',
            'cars'=> $cars,
            'brands'=>$brands,
            'formattedSchedules'=>$formattedSchedules
        ]);
    }

    #[Route('/filtre', name:'filter', methods:['POST'])]
    public function filterCars(Request $request, CarRepository $carRepository, BrandRepository $brandRepository): Response
    {
         // Retrieve the raw JSON data from the request body
    $jsonData = $request->getContent();

    // Decode the JSON data
    $data = json_decode($jsonData, true);

    // Check if 'brand' is present in the decoded data
    if (isset($data['brand'])) {
        $brandName = $data['brand'];
    // Trouvez l'entité de la marque correspondant au nom
    $brand = $brandRepository->findOneBy(['name' => $brandName]);
    
    if (!$brand) {
        // Si la marque n'existe pas, vous pouvez renvoyer une réponse JSON vide ou un message d'erreur
        return $this->json(['error' => 'Marque non trouvée pour: ' . $brandName], Response::HTTP_NOT_FOUND);
    }

    // Récupérez les produits filtrés par l'ID de la marque
    $filteredCars = $carRepository->findBy(['brand' => $brand->getId()]);
    
    foreach ($filteredCars as $car) {
        dump($car->getId(), $car->getName()); // Print properties you want to check
    }

    return $this->json(['cars' => $filteredCars]);

    }
    
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
