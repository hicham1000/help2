<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function index(): Response
    {

        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();

        return $this->render('post/index.html.twig', [
            "posts" => $posts,
        ]);
    }
      /**
     * @Route("/post/add", name="post_add")
     */
    public function add(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('post/_form.html.twig', [
            'controller_name' => 'PostController',
            'form' => $form->createView()
        ]);
    }
  /**
     * @Route("/post/modify", name="post_modify")
     */

    public function modify(): Response
    {
        return $this->render('post/modify.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }
    
}