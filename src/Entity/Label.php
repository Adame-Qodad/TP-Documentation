<?php

namespace App\Entity;

use App\Repository\LabelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entité représentant un label musical.
 *
 * @ORM\Entity(repositoryClass=LabelRepository::class)
 */
class Label
{
    /**
     * L'identifiant unique du label.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @var int|null
     */
    private $id;

    /**
     * Le nom du label.
     *
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $nom;

    /**
     * La description du label.
     *
     * @ORM\Column(type="text", nullable=true)
     * 
     * @var string|null
     */
    private $description;

    /**
     * L'année de création du label.
     *
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @var int|null
     */
    private $annee;

    /**
     * Le type de label (exemple : "indépendant", "majeur").
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @var string|null
     */
    private $type;

    /**
     * Le logo du label.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @var string|null
     */
    private $logo;

    /**
     * Les albums associés à ce label.
     *
     * @ORM\OneToMany(targetEntity=Album::class, mappedBy="label")
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
     * Récupère l'identifiant du label.
     *
     * @return int|null L'identifiant du label.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Modifie l'identifiant du label.
     *
     * @param string $id L'identifiant du label.
     * @return self
     */
    public function setID(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Récupère le nom du label.
     *
     * @return string|null Le nom du label.
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * Modifie le nom du label.
     *
     * @param string $nom Le nouveau nom du label.
     * @return self
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Récupère la description du label.
     *
     * @return string|null La description du label.
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Modifie la description du label.
     *
     * @param string|null $description La nouvelle description du label.
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Récupère l'année de création du label.
     *
     * @return int|null L'année de création du label.
     */
    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    /**
     * Modifie l'année de création du label.
     *
     * @param int|null $annee La nouvelle année de création du label.
     * @return self
     */
    public function setAnnee(?int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Récupère le type du label (exemple : "indépendant", "majeur").
     *
     * @return string|null Le type du label.
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Modifie le type du label.
     *
     * @param string|null $type Le nouveau type du label.
     * @return self
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Récupère le logo du label.
     *
     * @return string|null Le logo du label.
     */
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * Modifie le logo du label.
     *
     * @param string|null $logo Le nouveau logo du label.
     * @return self
     */
    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Récupère les albums associés à ce label.
     *
     * @return Collection<int, Album> Les albums associés au label.
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    /**
     * Ajoute un album au label.
     *
     * @param Album $album L'album à ajouter.
     * @return self
     */
    public function addAlbum(Album $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums[] = $album;
            $album->setLabel($this);
        }

        return $this;
    }

    /**
     * Supprime un album du label.
     *
     * @param Album $album L'album à supprimer.
     * @return self
     */
    public function removeAlbum(Album $album): self
    {
        if ($this->albums->removeElement($album)) {
            if ($album->getLabel() === $this) {
                $album->setLabel(null);
            }
        }

        return $this;
    }
}
