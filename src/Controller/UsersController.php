<?php

namespace App\Controller;

use App\Form\AppuserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    
    /**
    * @Route("/users", name="users/users")
    */
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AppuserType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this ->getDoctrine()->getManager();
            $em -> persist($user);
            $em -> flush(); 
            $this->addFlash('message', 'Profile mis à jour');
            
            return $this->redirectToRoute('users/users');
        }
        return $this->renderForm('users/users.html.twig', [
            'form' => $form,
            'user' => $user
        ]);
    }
}