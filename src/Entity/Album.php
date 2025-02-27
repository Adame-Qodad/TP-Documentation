<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entité représentant un album musical.
 *
 * @ORM\Entity(repositoryClass=AlbumRepository::class)
 */
class Album
{
    /**
     * L'identifiant unique de l'album.
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * 
     * @var int|null
     */
    private $id;

    /**
     * Le nom de l'album.
     *
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $nom;

    /**
     * L'année de sortie de l'album.
     *
     * @ORM\Column(type="integer")
     * 
     * @var int
     */
    private $date;

    /**
     * L'image de couverture de l'album.
     *
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $image;

    /**
     * L'artiste qui a créé l'album.
     *
     * @ORM\ManyToOne(targetEntity=Artiste::class, inversedBy="albums")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @var Artiste
     */
    private $artiste;

    /**
     * Les morceaux qui font partie de cet album.
     *
     * @ORM\OneToMany(targetEntity=Morceau::class, mappedBy="album")
     * 
     * @var Collection<int, Morceau>
     */
    private $morceaux;

    /**
     * Les styles musicaux associés à cet album.
     *
     * @ORM\ManyToMany(targetEntity=Style::class, mappedBy="albums")
     * 
     * @var Collection<int, Style>
     */
    private $styles;

    /**
     * Le label de l'album.
     *
     * @ORM\ManyToOne(targetEntity=Label::class, inversedBy="albums")
     * 
     * @var Label|null
     */
    private $label;

    /**
     * Constructeur pour initialiser les collections.
     */
    public function __construct()
    {
        $this->morceaux = new ArrayCollection();
        $this->styles = new ArrayCollection();
    }

    /**
     * Récupère l'identifiant de l'album.
     *
     * @return int|null L'identifiant de l'album.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Récupère le nom de l'album.
     *
     * @return string|null Le nom de l'album.
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * Modifie le nom de l'album.
     *
     * @param string $nom Le nouveau nom de l'album.
     * @return self
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Récupère l'année de sortie de l'album.
     *
     * @return int|null L'année de sortie de l'album.
     */
    public function getDate(): ?int
    {
        return $this->date;
    }

    /**
     * Modifie l'année de sortie de l'album.
     *
     * @param int $date La nouvelle année de sortie.
     * @return self
     */
    public function setDate(int $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Récupère l'image de couverture de l'album.
     *
     * @return string|null L'image de couverture de l'album.
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Modifie l'image de couverture de l'album.
     *
     * @param string $image La nouvelle image de couverture.
     * @return self
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Récupère l'artiste associé à l'album.
     *
     * @return Artiste|null L'artiste de l'album.
     */
    public function getArtiste(): ?Artiste
    {
        return $this->artiste;
    }

    /**
     * Modifie l'artiste associé à l'album.
     *
     * @param Artiste|null $artiste L'artiste à associer à l'album.
     * @return self
     */
    public function setArtiste(?Artiste $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }

    /**
     * Récupère les morceaux associés à l'album.
     *
     * @return Collection<int, Morceau> Les morceaux de l'album.
     */
    public function getMorceaux(): Collection
    {
        return $this->morceaux;
    }

    /**
     * Ajoute un morceau à l'album.
     *
     * @param Morceau $morceaux Le morceau à ajouter.
     * @return self
     */
    public function addMorceaux(Morceau $morceaux): self
    {
        if (!$this->morceaux->contains($morceaux)) {
            $this->morceaux[] = $morceaux;
            $morceaux->setAlbum($this);
        }

        return $this;
    }

    /**
     * Supprime un morceau de l'album.
     *
     * @param Morceau $morceaux Le morceau à supprimer.
     * @return self
     */
    public function removeMorceaux(Morceau $morceaux): self
    {
        if ($this->morceaux->removeElement($morceaux)) {
            if ($morceaux->getAlbum() === $this) {
                $morceaux->setAlbum(null);
            }
        }

        return $this;
    }

    /**
     * Récupère les styles associés à l'album.
     *
     * @return Collection<int, Style> Les styles de l'album.
     */
    public function getStyles(): Collection
    {
        return $this->styles;
    }

    /**
     * Ajoute un style à l'album.
     *
     * @param Style $style Le style à ajouter.
     * @return self
     */
    public function addStyle(Style $style): self
    {
        if (!$this->styles->contains($style)) {
            $this->styles[] = $style;
            $style->addAlbum($this);
        }

        return $this;
    }

    /**
     * Supprime un style de l'album.
     *
     * @param Style $style Le style à supprimer.
     * @return self
     */
    public function removeStyle(Style $style): self
    {
        if ($this->styles->removeElement($style)) {
            $style->removeAlbum($this);
        }

        return $this;
    }

    /**
     * Récupère le label associé à l'album.
     *
     * @return Label|null Le label de l'album.
     */
    public function getLabel(): ?Label
    {
        return $this->label;
    }

    /**
     * Modifie le label associé à l'album.
     *
     * @param Label|null $label Le label à associer.
     * @return self
     */
    public function setLabel(?Label $label): self
    {
        $this->label = $label;

        return $this;
    }
}
