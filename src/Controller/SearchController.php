<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    private $connexion;
    private $resultats = 'no search';
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
            $this->resultats = $this->search($recherche);
        }
        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    // établie une connection avec la base de donnée
    public function connect()
    {
        if ($this->connexion === null) {
            $this->connexion = pg_connect(
                "host=127.0.0.1 port=5432 dbname=help user=ngandon"
            );
        }
        return $this->connexion;
    }

    // recherche le mot clé en BDD et renvoie un tableau
    public function search($recherche)
    {
        $connexion = $this->connect();

        $result = pg_query_params($connexion, 'SELECT * FROM post WHERE ts_rank(to_tsvector(title), to_tsquery($1)) > 0.01', [$recherche]);
        $resultats = pg_fetch_all($result);
        return $resultats;
    }

    // affiche le résultat de la recherche
    public function resultat() {

        return $this->render('search/result.html.twig', [
            'resultats' => $this->resultats
        ]);
    }
}