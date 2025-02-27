<?php

namespace App\Entity;

use App\Repository\ArtisteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entité représentant un artiste musical.
 *
 * @ORM\Entity(repositoryClass=ArtisteRepository::class)
 */
class Artiste
{
    /**
     * L'identifiant unique de l'artiste.
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * 
     * @var int|null
     */
    private $id;

    /**
     * Le nom de l'artiste.
     *
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $nom;

    /**
     * La description de l'artiste.
     *
     * @ORM\Column(type="text")
     * 
     * @var string
     */
    private $description;

    /**
     * Le site web de l'artiste.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @var string|null
     */
    private $site;

    /**
     * L'image représentant l'artiste.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @var string|null
     */
    private $image;

    /**
     * Le type d'artiste (exemple : "solo", "groupe").
     *
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $type;

    /**
     * Les albums créés par l'artiste.
     *
     * @ORM\OneToMany(targetEntity=Album::class, mappedBy="artiste")
     * 
     * @var Collection<int, Album>
     */
    private $albums;

    /**
     * Constructeur pour initialiser la collection des albums.
     */
    public function __construct()
    {
        $this->albums = new ArrayCollection();
    }

    /**
     * Récupère l'identifiant de l'artiste.
     *
     * @return int|null L'identifiant de l'artiste.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Récupère le nom de l'artiste.
     *
     * @return string|null Le nom de l'artiste.
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * Modifie le nom de l'artiste.
     *
     * @param string $nom Le nouveau nom de l'artiste.
     * @return self
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Récupère la description de l'artiste.
     *
     * @return string|null La description de l'artiste.
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Modifie la description de l'artiste.
     *
     * @param string $description La nouvelle description de l'artiste.
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Récupère le site web de l'artiste.
     *
     * @return string|null Le site web de l'artiste.
     */
    public function getSite(): ?string
    {
        return $this->site;
    }

    /**
     * Modifie le site web de l'artiste.
     *
     * @param string|null $site Le nouveau site web de l'artiste.
     * @return self
     */
    public function setSite(?string $site): self
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Récupère l'image représentant l'artiste.
     *
     * @return string|null L'image représentant l'artiste.
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Modifie l'image représentant l'artiste.
     *
     * @param string|null $image La nouvelle image de l'artiste.
     * @return self
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Récupère le type d'artiste (exemple : "solo", "groupe").
     *
     * @return string|null Le type d'artiste.
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Modifie le type d'artiste.
     *
     * @param string $type Le nouveau type d'artiste.
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Récupère les albums créés par l'artiste.
     *
     * @return Collection<int, Album> Les albums de l'artiste.
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    /**
     * Ajoute un album à l'artiste.
     *
     * @param Album $album L'album à ajouter.
     * @return self
     */
    public function addAlbum(Album $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums[] = $album;
            $album->setArtiste($this);
        }

        return $this;
    }

    /**
     * Supprime un album de l'artiste.
     *
     * @param Album $album L'album à supprimer.
     * @return self
     */
    public function removeAlbum(Album $album): self
    {
        if ($this->albums->removeElement($album)) {
            if ($album->getArtiste() === $this) {
                $album->setArtiste(null);
            }
        }

        return $this;
    }
}
