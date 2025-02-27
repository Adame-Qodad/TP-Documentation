<?php

namespace App\Repository;

use App\Entity\Album;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Repository pour l'entité Album.
 *
 * Cette classe permet de gérer les opérations de persistance (ajout, suppression, etc.) 
 * pour l'entité `Album`. Elle étend `ServiceEntityRepository` de Doctrine, ce qui fournit 
 * des méthodes de base pour interagir avec la base de données.
 *
 * @extends ServiceEntityRepository<Album>
 * 
 * @method Album|null find($id, $lockMode = null, $lockVersion = null) Recherche un album par son ID.
 * @method Album|null findOneBy(array $criteria, array $orderBy = null) Recherche un album avec des critères spécifiques.
 * @method Album[]    findAll() Récupère tous les albums.
 * @method Album[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) Recherche des albums selon des critères spécifiques.
 */
class AlbumRepository extends ServiceEntityRepository
{
    /**
     * Constructeur de la classe AlbumRepository.
     * 
     * @param ManagerRegistry $registry Le registre du gestionnaire d'entités de Doctrine.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Album::class);
    }

    /**
     * Ajoute un album à la base de données.
     *
     * Cette méthode permet de persister un album dans la base de données. Si le paramètre
     * `$flush` est `true`, les modifications seront immédiatement enregistrées.
     * 
     * @param Album $entity L'entité album à ajouter.
     * @param bool $flush Si `true`, les modifications seront immédiatement enregistrées.
     */
    public function add(Album $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Supprime un album de la base de données.
     *
     * Cette méthode permet de supprimer un album de la base de données. Si le paramètre
     * `$flush` est `true`, les modifications seront immédiatement enregistrées.
     * 
     * @param Album $entity L'entité album à supprimer.
     * @param bool $flush Si `true`, les modifications seront immédiatement enregistrées.
     */
    public function remove(Album $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Récupère une liste complète des albums avec leurs styles et artistes associés.
     *
     * Cette méthode crée une requête pour obtenir tous les albums triés par nom, 
     * incluant les informations des styles et des artistes associés. 
     * Elle renvoie une `Query` qui peut être exécutée pour obtenir les résultats.
     *
     * @return Query[] Retourne une requête des albums avec leurs styles et artistes.
     */
    public function listeAlbumsComplete(): ?Query
    {
        return $this->createQueryBuilder('a')
            ->select('a', 's', 'art')
            ->innerJoin('a.styles', 's')  // Jointure avec les styles associés à l'album
            ->innerJoin('a.artiste', 'art')  // Jointure avec l'artiste associé à l'album
            ->orderBy('a.nom', 'ASC')  // Tri par nom d'album
            ->getQuery();
    }

//    public function findOneBySomeField($value): ?Album
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
