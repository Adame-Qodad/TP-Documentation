<?php

namespace App\Controller;

use App\Entity\Label;
use App\Repository\LabelRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Contrôleur responsable de la gestion des labels.
 */
class LabelController extends AbstractController
{
    /**
     * Liste des labels.
     * 
     * Cette action permet d'afficher une liste complète des labels récupérés à partir du repository.
     * 
     * @Route("/labels", name="labels", methods={"GET"})
     * 
     * @param LabelRepository $repo Le repository qui permet de récupérer la liste des labels.
     * 
     * @return Response La vue rendue de la liste des labels.
     */
    public function listeLabels(LabelRepository $repo): Response
    {
        $labels = $repo->findAll();

        return $this->render('label/listeLabel.html.twig', [
            'lesLabels' => $labels
        ]);
    }

    /**
     * Afficher les détails d'un label.
     * 
     * Cette action permet d'afficher la fiche détaillée d'un label spécifique. Le label est passé en paramètre
     * et utilisé pour remplir la vue.
     * 
     * @Route("/label/{id}", name="ficheLabel", methods={"GET"})
     * 
     * @param Label $label Le label dont les détails doivent être affichés.
     * 
     * @return Response La vue rendue de la fiche d'un label.
     */
    public function fichelabel(Label $label): Response
    {
        return $this->render('label/ficheLabel.html.twig', [
            'leLabel' => $label
        ]);
    }
}
