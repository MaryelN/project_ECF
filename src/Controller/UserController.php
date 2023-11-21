<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/utilisateur', name: 'app_user')]
    public function edit(User $user): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }

        if($this->getUser() == $user){
            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(UserType::class, $user);

        return $this->render('user/edit.html.twig', [
            'controller_name' => 'UserController',
            'form' => $form->createView() 
        ]);
    }
}
