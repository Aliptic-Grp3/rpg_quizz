<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NiveauRepository")
 */
class Niveau
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Questions", mappedBy="idNiveau", orphanRemoval=true)
     */
    private $idQuestion;

    public function __construct()
    {
        $this->idQuestion = new ArrayCollection();
    }

    public function getId(): ?int
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
     * @return Collection|Questions[]
     */
    public function getIdQuestion(): Collection
    {
        return $this->idQuestion;
    }

    public function addIdQuestion(Questions $idQuestion): self
    {
        if (!$this->idQuestion->contains($idQuestion)) {
            $this->idQuestion[] = $idQuestion;
            $idQuestion->setIdNiveau($this);
        }

        return $this;
    }

    public function removeIdQuestion(Questions $idQuestion): self
    {
        if ($this->idQuestion->contains($idQuestion)) {
            $this->idQuestion->removeElement($idQuestion);
            // set the owning side to null (unless already changed)
            if ($idQuestion->getIdNiveau() === $this) {
                $idQuestion->setIdNiveau(null);
            }
        }

        return $this;
    }

	public function __toString(){
		return $this->libelle;
	}
}
