<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Contact;
use App\Form\ContactCarType;
use App\Repository\CarRepository;
use App\Service\SendMailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gallerie', name: 'app_gallery_')]
class GalleryController extends AbstractController
{
    #[Route('/', name:'index')]
    public function index(CarRepository $carRepository): Response
    {        
        $cars = $carRepository->findBy([], ['id' => 'DESC']);                               
        return $this->render('gallery/index.html.twig', [
            'controller_name' => 'GalleryController',
            'title'=>'Gallerie',
            'cars'=> $cars 
        ]);
    }
    
    #[Route('/{id}', name:'details')]
    public function details(Car $car): Response
    {                                   
        return $this->render('gallery/details.html.twig', [
            'controller_name' => 'GalleryController',
            'title'=>'Details',
            'car'=>$car 
        ]);
    }

    #[Route('/{id}/contacter', name:'contact')]
    public function sendMessage(Request $request, EntityManagerInterface $manager, SendMailService $mailer, Car $car): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactCarType::class, $contact, [
            'subject' => $car->getName()
        ]);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();

            $carName = $car->getName();
            // $contact->setSubject($carName);

            $manager->persist($contact);
            $manager->flush();

            $mailer->send(
            $contact->getEmail(),
            'admin@garage.com',
            $contact->getSubject(),
            $template = 'contactCar',
            compact('contact', 'car')
            );

            $this->addFlash('success', 'Votre message a bien été envoyé !');

            return $this->redirectToRoute('app_gallery_index');
        }
        
        return $this->render('gallery/contact.html.twig', [
            'form' => $form->createView(),
            'title' => 'Contactez-nous',
            'car' => $car
        ]);
    }
}
