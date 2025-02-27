<?php

namespace App\Controller;

use App\Entity\Album;
use App\Repository\AlbumRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Contrôleur responsable de la gestion des albums.
 */
class AlbumController extends AbstractController
{
    /**
     * Liste des albums avec pagination.
     * 
     * Cette action permet d'afficher une liste d'albums paginée. Elle utilise le service de pagination pour diviser la liste des albums en pages.
     * Le nombre d'albums affichés par page est limité à 9.
     * 
     * @Route("/albums", name="albums", methods={"GET"})
     * 
     * @param AlbumRepository $repo Le repository qui permet de récupérer la liste complète des albums.
     * @param PaginatorInterface $paginator Le service de pagination utilisé pour paginer les résultats.
     * @param Request $request La requête HTTP contenant les informations de la page demandée.
     * 
     * @return Response La vue rendue de la liste des albums avec pagination.
     */
    public function listeAlbums(AlbumRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $albums = $paginator->paginate(
            $repo->listeAlbumsComplete(), /* requête, PAS le résultat */
            $request->query->getInt('page', 1), /* numéro de page */
            9 /* nombre d'éléments par page */
        );

        return $this->render('album/listeAlbums.html.twig', [
            'lesAlbums' => $albums
        ]);
    }

    /**
     * Afficher les détails d'un album.
     * 
     * Cette action permet d'afficher la fiche détaillée d'un album. Elle prend l'album en paramètre et le passe à la vue pour affichage.
     * 
     * @Route("/album/{id}", name="ficheAlbum", methods={"GET"})
     * 
     * @param Album $album L'album dont les détails doivent être affichés.
     * 
     * @return Response La vue rendue de la fiche d'un album.
     */
    public function ficheAlbum(Album $album): Response
    {
        return $this->render('album/ficheAlbum.html.twig', [
            'leAlbum' => $album
        ]);
    }
}
