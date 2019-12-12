<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ThematiqueRepository")
 */
class Thematique
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
     * @ORM\OneToMany(targetEntity="App\Entity\Questions", mappedBy="idThematique", orphanRemoval=true)
     */
    private $idQuestion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Jouer", inversedBy="idThematique")
     */
    private $idJouer;

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
            $idQuestion->setIdThematique($this);
        }

        return $this;
    }

    public function removeIdQuestion(Questions $idQuestion): self
    {
        if ($this->idQuestion->contains($idQuestion)) {
            $this->idQuestion->removeElement($idQuestion);
            // set the owning side to null (unless already changed)
            if ($idQuestion->getIdThematique() === $this) {
                $idQuestion->setIdThematique(null);
            }
        }

        return $this;
    }

    public function getIdJouer(): ?Jouer
    {
        return $this->idJouer;
    }

    public function setIdJouer(?Jouer $idJouer): self
    {
        $this->idJouer = $idJouer;

        return $this;
    }

	public function __toString(){
		return $this->libelle.' ///////// ' .$this->id;
	}
}
