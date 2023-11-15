<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\SendMailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function sendMessage(Request $request, EntityManagerInterface $manager, SendMailService $mailer): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
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
            compact('contact')
            );

            $this->addFlash('success', 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('app_home');
        }
        
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'title' => 'Contact',
        ]);
    }

}
