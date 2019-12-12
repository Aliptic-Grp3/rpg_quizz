<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionsRepository")
 */
class Questions
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Thematique", inversedBy="idQuestion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idThematique;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Niveau", inversedBy="idQuestion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idNiveau;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reponse", mappedBy="idQuestion", orphanRemoval=true)
     */
    private $idReponse;

    public function __construct()
    {
        $this->idReponse = new ArrayCollection();
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

    public function getIdThematique(): ?Thematique
    {
        return $this->idThematique;
    }

    public function setIdThematique(?Thematique $idThematique): self
    {
        $this->idThematique = $idThematique;

        return $this;
    }

    public function getIdNiveau(): ?Niveau
    {
        return $this->idNiveau;
    }

    public function setIdNiveau(?Niveau $idNiveau): self
    {
        $this->idNiveau = $idNiveau;

        return $this;
    }

    /**
     * @return Collection|Reponse[]
     */
    public function getIdReponse(): Collection
    {
        return $this->idReponse;
    }

    public function addIdReponse(Reponse $idReponse): self
    {
        if (!$this->idReponse->contains($idReponse)) {
            $this->idReponse[] = $idReponse;
            $idReponse->setIdQuestion($this);
        }

        return $this;
    }

    public function removeIdReponse(Reponse $idReponse): self
    {
        if ($this->idReponse->contains($idReponse)) {
            $this->idReponse->removeElement($idReponse);
            // set the owning side to null (unless already changed)
            if ($idReponse->getIdQuestion() === $this) {
                $idReponse->setIdQuestion(null);
            }
        }

        return $this;
    }
}
