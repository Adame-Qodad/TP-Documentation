<?php

namespace App\Entity;

use App\Repository\MorceauRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entité représentant un morceau musical.
 *
 * @ORM\Entity(repositoryClass=MorceauRepository::class)
 */
class Morceau
{
    /**
     * L'identifiant unique du morceau.
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * 
     * @var int|null
     */
    private $id;

    /**
     * Le titre du morceau.
     *
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $titre;

    /**
     * La durée du morceau, exprimée en format texte (par exemple "3:45").
     *
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $duree;

    /**
     * L'album auquel ce morceau appartient.
     *
     * @ORM\ManyToOne(targetEntity=Album::class, inversedBy="morceaux")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @var Album|null
     */
    private $album;

    /**
     * Le numéro de piste du morceau sur l'album.
     *
     * @ORM\Column(type="integer")
     * 
     * @var int
     */
    private $piste;

    /**
     * Récupère l'identifiant du morceau.
     *
     * @return int|null L'identifiant du morceau.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Récupère le titre du morceau.
     *
     * @return string|null Le titre du morceau.
     */
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    /**
     * Modifie le titre du morceau.
     *
     * @param string $titre Le nouveau titre du morceau.
     * @return self
     */
    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Modifie l'identifiant du morceau.
     *
     * @param string $id L'identifiant du morceau.
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Récupère la durée du morceau.
     *
     * @return string|null La durée du morceau.
     */
    public function getDuree(): ?string
    {
        return $this->duree;
    }

    /**
     * Modifie la durée du morceau.
     *
     * @param string $duree La nouvelle durée du morceau.
     * @return self
     */
    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Récupère l'album auquel ce morceau appartient.
     *
     * @return Album|null L'album associé au morceau.
     */
    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    /**
     * Modifie l'album auquel ce morceau appartient.
     *
     * @param Album|null $album L'album auquel associer le morceau.
     * @return self
     */
    public function setAlbum(?Album $album): self
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Récupère le numéro de piste du morceau.
     *
     * @return int Le numéro de piste du morceau.
     */
    public function getPiste(): ?int
    {
        return $this->piste;
    }

    /**
     * Modifie le numéro de piste du morceau.
     *
     * @param int $piste Le nouveau numéro de piste.
     * @return self
     */
    public function setPiste(int $piste): self
    {
        $this->piste = $piste;

        return $this;
    }
}
