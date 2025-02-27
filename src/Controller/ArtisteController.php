<?php

namespace App\Controller;

use App\Entity\Artiste;
use App\Repository\ArtisteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Contrôleur responsable de la gestion des artistes.
 */
class ArtisteController extends AbstractController
{
    /**
     * Liste des artistes.
     * 
     * Cette action permet d'afficher une liste complète des artistes récupérés à partir du repository.
     * 
     * @Route("/artistes", name="artistes", methods={"GET"})
     * 
     * @param ArtisteRepository $repo Le repository qui permet de récupérer la liste des artistes.
     * 
     * @return Response La vue rendue de la liste des artistes.
     */
    public function listeArtistes(ArtisteRepository $repo): Response
    {
        $artistes = $repo->listeArtistesComplete();

        return $this->render('artiste/listeArtistes.html.twig', [
            'lesArtistes' => $artistes
        ]);
    }

    /**
     * Afficher les détails d'un artiste.
     * 
     * Cette action permet d'afficher la fiche détaillée d'un artiste spécifique. L'artiste est passé en paramètre
     * et utilisé pour remplir la vue.
     * 
     * @Route("/artiste/{id}", name="ficheArtiste", methods={"GET"})
     * 
     * @param Artiste $artiste L'artiste dont les détails doivent être affichés.
     * 
     * @return Response La vue rendue de la fiche d'un artiste.
     */
    public function ficheArtiste(Artiste $artiste): Response
    {
        return $this->render('artiste/ficheArtiste.html.twig', [
            'leArtiste' => $artiste
        ]);
    }
}
