<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Blague", mappedBy="categories")
     */
    private $blagues;

    public function __construct()
    {
        $this->blagues = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Blague[]
     */
    public function getBlagues(): Collection
    {
        return $this->blagues;
    }

    public function addBlague(Blague $blague): self
    {
        if (!$this->blagues->contains($blague)) {
            $this->blagues[] = $blague;
            $blague->addCategory($this);
        }

        return $this;
    }

    public function removeBlague(Blague $blague): self
    {
        if ($this->blagues->contains($blague)) {
            $this->blagues->removeElement($blague);
            $blague->removeCategory($this);
        }

        return $this;
    }
}
