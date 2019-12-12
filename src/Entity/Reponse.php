<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReponseRepository")
 */
class Reponse
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
     * @ORM\Column(type="boolean")
     */
    private $estCorrect;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Questions", inversedBy="idReponse")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idQuestion;

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

    public function getEstCorrect(): ?bool
    {
        return $this->estCorrect;
    }

    public function setEstCorrect(bool $estCorrect): self
    {
        $this->estCorrect = $estCorrect;

        return $this;
    }

    public function getIdQuestion(): ?Questions
    {
        return $this->idQuestion;
    }

    public function setIdQuestion(?Questions $idQuestion): self
    {
        $this->idQuestion = $idQuestion;

        return $this;
    }

	public function __toString(){
		return $this->libelle;
	}
}
