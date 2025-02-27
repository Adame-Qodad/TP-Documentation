<?php

namespace App\Entity;

use App\Repository\StyleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entité représentant un style musical.
 *
 * @ORM\Entity(repositoryClass=StyleRepository::class)
 */
class Style
{
    /**
     * L'identifiant unique du style.
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * 
     * @var int|null
     */
    private $id;

    /**
     * Le nom du style musical.
     *
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $nom;

    /**
     * La couleur associée au style, si applicable.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @var string|null
     */
    private $couleur;

    /**
     * Les albums associés à ce style.
     *
     * @ORM\ManyToMany(targetEntity=Album::class, inversedBy="styles")
     * 
     * @var Collection<int, Album>
     */
    private $albums;

    public function __construct()
    {
        $this->albums = new ArrayCollection();
    }

    /**
     * Récupère l'identifiant du style.
     *
     * @return int|null L'identifiant du style.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Modifie l'identifiant du style.
     *
     * @param string $id L'identifiant du style.
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Récupère le nom du style.
     *
     * @return string Le nom du style.
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * Modifie le nom du style.
     *
     * @param string $nom Le nouveau nom du style.
     * @return self
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Récupère la couleur associée au style.
     *
     * @return string|null La couleur du style, ou null si non spécifiée.
     */
    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    /**
     * Modifie la couleur associée au style.
     *
     * @param string|null $couleur La nouvelle couleur du style.
     * @return self
     */
    public function setCouleur(?string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Récupère la collection des albums associés à ce style.
     *
     * @return Collection<int, Album> La collection d'albums.
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    /**
     * Ajoute un album à la collection des albums associés à ce style.
     *
     * @param Album $album L'album à ajouter.
     * @return self
     */
    public function addAlbum(Album $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums[] = $album;
        }

        return $this;
    }

    /**
     * Retire un album de la collection des albums associés à ce style.
     *
     * @param Album $album L'album à retirer.
     * @return self
     */
    public function removeAlbum(Album $album): self
    {
        $this->albums->removeElement($album);

        return $this;
    }
}
