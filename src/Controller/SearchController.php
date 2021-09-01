<?php

namespace App\Controller;

use App\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index(Request $request): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(SearchType::class);
        // $form->add('send', SubmitType::class);
        $form->handleRequest($request);

        dump($form->getData());

        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
