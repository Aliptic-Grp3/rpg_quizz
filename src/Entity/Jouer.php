<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JouerRepository")
 */
class Jouer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Persona", mappedBy="idJouer")
     */
    private $idPersona;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Thematique", mappedBy="idJouer")
     */
    private $idThematique;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $aGagner;

    public function __construct()
    {
        $this->idPersona = new ArrayCollection();
        $this->idThematique = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Persona[]
     */
    public function getIdPersona(): Collection
    {
        return $this->idPersona;
    }

    public function addIdPersona(Persona $idPersona): self
    {
        if (!$this->idPersona->contains($idPersona)) {
            $this->idPersona[] = $idPersona;
            $idPersona->setIdJouer($this);
        }

        return $this;
    }

    public function removeIdPersona(Persona $idPersona): self
    {
        if ($this->idPersona->contains($idPersona)) {
            $this->idPersona->removeElement($idPersona);
            // set the owning side to null (unless already changed)
            if ($idPersona->getIdJouer() === $this) {
                $idPersona->setIdJouer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Thematique[]
     */
    public function getIdThematique(): Collection
    {
        return $this->idThematique;
    }

    public function addIdThematique(Thematique $idThematique): self
    {
        if (!$this->idThematique->contains($idThematique)) {
            $this->idThematique[] = $idThematique;
            $idThematique->setIdJouer($this);
        }

        return $this;
    }

    public function removeIdThematique(Thematique $idThematique): self
    {
        if ($this->idThematique->contains($idThematique)) {
            $this->idThematique->removeElement($idThematique);
            // set the owning side to null (unless already changed)
            if ($idThematique->getIdJouer() === $this) {
                $idThematique->setIdJouer(null);
            }
        }

        return $this;
    }

    public function getAGagner(): ?bool
    {
        return $this->aGagner;
    }

    public function setAGagner(?bool $aGagner): self
    {
        $this->aGagner = $aGagner;

        return $this;
    }
}
