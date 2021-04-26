<?php

namespace App\Entity;

use App\Repository\MaisonRepository;
use App\Traits\TimestampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MaisonRepository::class)
 */
class Maison extends Logement
{
    use TimestampTrait;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbChambre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $jardin;

    /**
     * @ORM\OneToMany(targetEntity=Photo::class, mappedBy="maison")
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="maison")
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity=Contrat::class, mappedBy="maison")
     */
    private $contrats;

    /**
     * @ORM\ManyToOne(targetEntity=Proprietaire::class, inversedBy="maisons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $proprietaire;


    public function __construct()
    {
        $this->photo = new ArrayCollection();
        $this->commentaire = new ArrayCollection();
        $this->contrats = new ArrayCollection();
    }




    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNbChambre(): ?int
    {
        return $this->nbChambre;
    }

    public function setNbChambre(?int $nbChambre): self
    {
        $this->nbChambre = $nbChambre;

        return $this;
    }

    public function getJardin(): ?string
    {
        return $this->jardin;
    }

    public function setJardin(?string $jardin): self
    {
        $this->jardin = $jardin;

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhoto(): Collection
    {
        return $this->photo;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photo->contains($photo)) {
            $this->photo[] = $photo;
            $photo->setMaison($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photo->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getMaison() === $this) {
                $photo->setMaison(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaire(): Collection
    {
        return $this->commentaire;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire[] = $commentaire;
            $commentaire->setMaison($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaire->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getMaison() === $this) {
                $commentaire->setMaison(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contrat[]
     */
    public function getContrats(): Collection
    {
        return $this->contrats;
    }

    public function addContrat(Contrat $contrat): self
    {
        if (!$this->contrats->contains($contrat)) {
            $this->contrats[] = $contrat;
            $contrat->setMaison($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getMaison() === $this) {
                $contrat->setMaison(null);
            }
        }

        return $this;
    }

    public function getProprietaire(): ?Proprietaire
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?Proprietaire $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

}
