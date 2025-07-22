<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvaluationRepository::class)]
class Evaluation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\Column]
    private ?int $nb_star_on_5 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $review = null;

    #[ORM\ManyToOne(inversedBy: 'Evaluations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProfessorUser $professorUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNbStarOn5(): ?int
    {
        return $this->nb_star_on_5;
    }

    public function setNbStarOn5(int $nb_star_on_5): static
    {
        $this->nb_star_on_5 = $nb_star_on_5;

        return $this;
    }

    public function getReview(): ?string
    {
        return $this->review;
    }

    public function setReview(?string $review): static
    {
        $this->review = $review;

        return $this;
    }

    public function getProfessorUser(): ?ProfessorUser
    {
        return $this->professorUser;
    }

    public function setProfessorUser(?ProfessorUser $professorUser): static
    {
        $this->professorUser = $professorUser;

        return $this;
    }
}
