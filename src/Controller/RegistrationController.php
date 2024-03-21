<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\UserAuthenticator;
use App\Service\JWTService;
use App\Service\ScheduleFormatterService;
use App\Service\SendMailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    private $scheduleFormatterService;

    public function __construct(ScheduleFormatterService $scheduleFormatterService)
    {
        $this->scheduleFormatterService = $scheduleFormatterService;
    }

    #[Route('/inscription', name: 'app_register')]
    #[IsGranted('ROLE_ADMIN', message: 'Vous êtes déjà inscrit')]
    public function register(
        Request $request, 
        UserPasswordHasherInterface $userPasswordHasher, 
        UserAuthenticatorInterface $userAuthenticator, 
        UserAuthenticator $authenticator, 
        EntityManagerInterface $entityManager, 
        SendMailService $mailer, 
        JWTService $jwt
        ): Response
    {
        $formattedSchedules = $this->scheduleFormatterService->getFormattedSchedules();

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            
            if ($this->getUser()) {
                return $this->redirectToRoute('app_home');
            }

            $header = [
                'alg' => 'HS256', 
                'typ' => 'JWT'
            ];

            $payload =[
                'user_id' => $user->getId()
            ];

            $token = $jwt->generate($header, $payload, $this->getParameter('app.jwtsecret'));

            $mailer->send(
                'no-reply@garage.net',
                $user->getEmail(),
                'Activation de votre compte sur Garage.V.Parrot',
                'register',
                compact('user', 'token')

            );

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('pages/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'formattedSchedules' => $formattedSchedules,

        ]);
    }

    #[Route('/verif/{token}', name: 'app_verify')]
    public function checkSignature($token, JWTService $jwt, UserRepository $userRepository, EntityManagerInterface $em): Response
    {
        if ($jwt->isValid($token) && !$jwt->isExpired($token) && $jwt->checkSignature($token, $this->getParameter('app.jwtsecret'))){
            $payload = $jwt->getPayload($token);
            $user = $userRepository->find($payload['user_id']);
            if ($user && !$user->getIsVerified()){
                $user->setIsVerified(true);
                $em->flush($user);
                
                $this->addFlash('succes','Votre compte a bien été verifié');
                return $this->redirectToRoute('admin');
            }
        } 
        $this->addFlash('danger','Le token est invalide ou a expiré');
        return $this->redirectToRoute('app_login');
    }

    #[Route('/renvoiverif', name: 'app_resend')]
    #[IsGranted('ROLE_USER', message: 'Vous devez être connecté pour accéder à cette page')]
    public function resendVerif(JWTService $jwt, SendMailService $mailer, UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        
        if (!$user){
            $this->addFlash('danger','Vous devez être connecté pour accéder à cette page');
            return $this->redirectToRoute('app_login');
        }

        if ($user->getIsVerified()){
            $this->addFlash('warning','Votre compte est déjà vérifié');
            return $this->redirectToRoute('admin');
        }

        $header = [
            'alg' => 'HS256', 
            'typ' => 'JWT'
        ];

        $payload =[
            'user_id' => $user->getId()
        ];

        $token = $jwt->generate($header, $payload, $this->getParameter('app.jwtsecret'));

        $mailer->send(
            'no-reply@garage.net',
            $user->getEmail(),
            'Activation de votre compte sur Garage.V.Parrot',
            'register',
            compact('user', 'token')

        );
        $this->addFlash('succes','Un nouveau mail de vérification vous a été envoyé');
        return $this->redirectToRoute('app_home');
    }
}