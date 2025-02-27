<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Contrôleur responsable de la gestion de la page d'accueil.
 */
class AccueilController extends AbstractController
{
    /**
     * Rendre la vue de la page d'accueil.
     * 
     * Cette action est déclenchée lorsque l'utilisateur visite l'URL racine ("/") du site.
     * Elle rend le modèle `accueil/index.html.twig` pour afficher le contenu de la page d'accueil.
     *
     * @Route("/", name="app_accueil")
     * 
     * @return Response La vue rendue de la page d'accueil sous forme d'un objet Response.
     */
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig');
    }
}
