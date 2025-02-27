<?php

namespace App\Repository;

use App\Entity\Artiste;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Repository pour l'entité Artiste.
 *
 * Cette classe permet de gérer les opérations de persistance (ajout, suppression, etc.) 
 * pour l'entité `Artiste`. Elle étend `ServiceEntityRepository` de Doctrine, ce qui fournit 
 * des méthodes de base pour interagir avec la base de données.
 *
 * @extends ServiceEntityRepository<Artiste>
 * 
 * @method Artiste|null find($id, $lockMode = null, $lockVersion = null) Recherche un artiste par son ID.
 * @method Artiste|null findOneBy(array $criteria, array $orderBy = null) Recherche un artiste avec des critères spécifiques.
 * @method Artiste[]    findAll() Récupère tous les artistes.
 * @method Artiste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) Recherche des artistes selon des critères spécifiques.
 */
class ArtisteRepository extends ServiceEntityRepository
{
    /**
     * Constructeur de la classe ArtisteRepository.
     * 
     * @param ManagerRegistry $registry Le registre du gestionnaire d'entités de Doctrine.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artiste::class);
    }

    /**
     * Ajoute un artiste à la base de données.
     *
     * Cette méthode permet de persister un artiste dans la base de données. Si le paramètre
     * `$flush` est `true`, les modifications seront immédiatement enregistrées.
     * 
     * @param Artiste $entity L'entité artiste à ajouter.
     * @param bool $flush Si `true`, les modifications seront immédiatement enregistrées.
     */
    public function add(Artiste $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Supprime un artiste de la base de données.
     *
     * Cette méthode permet de supprimer un artiste de la base de données. Si le paramètre
     * `$flush` est `true`, les modifications seront immédiatement enregistrées.
     * 
     * @param Artiste $entity L'entité artiste à supprimer.
     * @param bool $flush Si `true`, les modifications seront immédiatement enregistrées.
     */
    public function remove(Artiste $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Récupère une liste complète des artistes avec leurs albums associés.
     *
     * Cette méthode crée une requête pour obtenir tous les artistes triés par nom, 
     * incluant les informations des albums associés. 
     * Elle renvoie un tableau d'objets `Artiste`.
     *
     * @return Artiste[] Retourne un tableau d'artistes avec leurs albums associés.
     */
    public function listeArtistesComplete()
    {
        return $this->createQueryBuilder('art')
            ->select('art', 'a')  // Sélectionne l'artiste et ses albums
            ->innerJoin('art.albums', 'a')  // Jointure avec les albums associés à l'artiste
            ->orderBy('a.nom', 'ASC')  // Tri des albums par nom
            ->getQuery()
            ->getResult();  // Exécution de la requête et récupération des résultats
    }

    /**
     * Récupère une liste paginée des artistes avec leurs albums associés.
     *
     * Cette méthode crée une requête pour obtenir tous les artistes avec leurs albums associés.
     * Elle renvoie une `Query` qui peut être exécutée pour obtenir les résultats, utile pour la pagination.
     *
     * @return Query Retourne une requête paginée pour récupérer les artistes et leurs albums.
     */
    public function listeArtistesCompletePaginee(): Query
    {
        return $this->createQueryBuilder('art')
            ->select('art', 'a')  // Sélectionne l'artiste et ses albums
            ->innerJoin('art.albums', 'a')  // Jointure avec les albums associés à l'artiste
            ->orderBy('art.nom', 'ASC')  // Tri des artistes par nom
            ->getQuery();  // Retourne la requête sans l'exécuter pour permettre la pagination
    }

//    public function findOneBySomeField($value): ?Artiste
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
