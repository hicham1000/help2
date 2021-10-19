<?php

namespace App\Controller;

use App\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    private $connexion;

    /**
     * @Route("/search", name="search")
     */
    public function index(Request $request, RequestStack $requestStack): Response
    {
        // $user = $this->getUser();
        $recherche = $requestStack->getMainRequest()->query->get('q');
        // Voir la doc de requestStack /!\

        $form = $this->createForm(SearchType::class);
        $form->handleRequest($requestStack->getMainRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $this->search($recherche);
        }

        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),

        ]);
    }



    public function connect()
    {
        if ($this->connexion === null) {
            $this->connexion = pg_connect(
                "host=127.0.0.1 port=5432 dbname=help user=ngandon"
            );
        }
        return $this->connexion;
    }


    public function search($recherche)
    {
        // dump('coucou');

        $connexion = $this->connect();

        // $sql = SELECT title, ts_rank(to_tsvector(title), to_tsquery('PSQL')) FROM post WHERE ts_rank(to_tsvector(title), to_tsquery('PSQL')) > 0.01;
        
        $result = pg_query_params($connexion, 'SELECT title, content FROM post WHERE ts_rank(to_tsvector(title), to_tsquery($1)) > 0.01', [$recherche]);
        $tests = pg_fetch_all($result);

        dump($tests);


        // return $this->render('search/result.html.twig', [
        //     "tests" => $tests,
        // ]);
    }
}