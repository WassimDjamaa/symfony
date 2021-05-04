<?php

namespace App\Entity;

use App\Repository\ResultRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResultRepository::class)
 */
class Result
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
    private $adress_ip;

    /**
     * @ORM\ManyToOne(targetEntity=Questions::class, inversedBy="id_users")
     */
    private $id_questions;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="results")
     */
    private $id_users;

    /**
     * @ORM\ManyToOne(targetEntity=Answers::class, inversedBy="results")
     * @ORM\JoinColumn(nullable=false)
     */
    private $answer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getAdressIp(): ?string
    {
        return $this->adress_ip;
    }

    public function setAdressIp(?string $adress_ip): self
    {
        $this->adress_ip = $adress_ip;

        return $this;
    }

    public function getIdQuestions(): ?Questions
    {
        return $this->id_questions;
    }

    public function setIdQuestions(?Questions $id_questions): self
    {
        $this->id_questions = $id_questions;

        return $this;
    }

    public function getIdUsers(): ?User
    {
        return $this->id_users;
    }

    public function setIdUsers(?User $id_users): self
    {
        $this->id_users = $id_users;

        return $this;
    }

    public function getAnswer(): ?Answers
    {
        return $this->answer;
    }

    public function setAnswer(?Answers $answer): self
    {
        $this->answer = $answer;

        return $this;
    }
}
