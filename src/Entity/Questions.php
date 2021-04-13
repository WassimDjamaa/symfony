<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionsRepository::class)
 */
class Questions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_multiple;

    /**
     * @ORM\OneToMany(targetEntity=Answers::class, mappedBy="id_question")
     */
    private $answers;

    /**
     * @ORM\OneToMany(targetEntity=Result::class, mappedBy="id_questions")
     */
    private $id_users;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->id_users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getIsMultiple(): ?bool
    {
        return $this->is_multiple;
    }

    public function setIsMultiple(?bool $is_multiple): self
    {
        $this->is_multiple = $is_multiple;

        return $this;
    }

    /**
     * @return Collection|Answers[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answers $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setIdQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answers $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getIdQuestion() === $this) {
                $answer->setIdQuestion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Result[]
     */
    public function getIdUsers(): Collection
    {
        return $this->id_users;
    }

    public function addIdUser(Result $idUser): self
    {
        if (!$this->id_users->contains($idUser)) {
            $this->id_users[] = $idUser;
            $idUser->setIdQuestions($this);
        }

        return $this;
    }

    public function removeIdUser(Result $idUser): self
    {
        if ($this->id_users->removeElement($idUser)) {
            // set the owning side to null (unless already changed)
            if ($idUser->getIdQuestions() === $this) {
                $idUser->setIdQuestions(null);
            }
        }

        return $this;
    }
}
