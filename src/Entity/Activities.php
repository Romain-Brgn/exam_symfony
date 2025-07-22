<?php

namespace App\Entity;

use App\Repository\ActivitiesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivitiesRepository::class)]
class Activities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_url = null;

    #[ORM\Column]
    private ?bool $outside = null;

    #[ORM\Column]
    private ?bool $home_based = null;

    #[ORM\Column]
    private ?\DateTime $start_time = null;

    #[ORM\Column]
    private ?\DateTime $end_time = null;

    #[ORM\Column]
    private ?float $fullcost = null;

    #[ORM\Column]
    private ?float $discounted_price = null;

    #[ORM\Column]
    private ?int $availability_fullcost = null;

    #[ORM\Column(nullable: true)]
    private ?int $availability_discounted_price = null;

    #[ORM\Column]
    private ?int $remaining_availability_fullcost = null;

    #[ORM\Column(nullable: true)]
    private ?int $remaining_availability_discounted_price = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $recurrence = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $specific_note = null;



    #[ORM\ManyToOne(inversedBy: 'activities')]
    private ?theme $theme = null;

    #[ORM\ManyToOne(inversedBy: 'Activities')]
    private ?ProfessorUser $professorUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(?string $image_url): static
    {
        $this->image_url = $image_url;

        return $this;
    }

    public function isOutside(): ?bool
    {
        return $this->outside;
    }

    public function setOutside(bool $outside): static
    {
        $this->outside = $outside;

        return $this;
    }

    public function isHomeBased(): ?bool
    {
        return $this->home_based;
    }

    public function setHomeBased(bool $home_based): static
    {
        $this->home_based = $home_based;

        return $this;
    }

    public function getStartTime(): ?\DateTime
    {
        return $this->start_time;
    }

    public function setStartTime(\DateTime $start_time): static
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndTime(): ?\DateTime
    {
        return $this->end_time;
    }

    public function setEndTime(\DateTime $end_time): static
    {
        $this->end_time = $end_time;

        return $this;
    }

    public function getFullcost(): ?float
    {
        return $this->fullcost;
    }

    public function setFullcost(float $fullcost): static
    {
        $this->fullcost = $fullcost;

        return $this;
    }

    public function getDiscountedPrice(): ?float
    {
        return $this->discounted_price;
    }

    public function setDiscountedPrice(?float $discounted_price): static
    {
        $this->discounted_price = $discounted_price;

        return $this;
    }

    public function getAvailabilityFullcost(): ?int
    {
        return $this->availability_fullcost;
    }

    public function setAvailabilityFullcost(int $availability_fullcost): static
    {
        $this->availability_fullcost = $availability_fullcost;

        return $this;
    }

    public function getAvailabilityDiscountedPrice(): ?int
    {
        return $this->availability_discounted_price;
    }

    public function setAvailabilityDiscountedPrice(?int $availability_discounted_price): static
    {
        $this->availability_discounted_price = $availability_discounted_price;

        return $this;
    }

    public function getRemainingAvailabilityFullcost(): ?int
    {
        return $this->remaining_availability_fullcost;
    }

    public function setRemainingAvailabilityFullcost(int $remaining_availability_fullcost): static
    {
        $this->remaining_availability_fullcost = $remaining_availability_fullcost;

        return $this;
    }

    public function getRemainingAvailabilityDiscountedPrice(): ?int
    {
        return $this->remaining_availability_discounted_price;
    }

    public function setRemainingAvailabilityDiscountedPrice(?int $remaining_availability_discounted_price): static
    {
        $this->remaining_availability_discounted_price = $remaining_availability_discounted_price;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getRecurrence(): ?string
    {
        return $this->recurrence;
    }

    public function setRecurrence(?string $recurrence): static
    {
        $this->recurrence = $recurrence;

        return $this;
    }

    public function getSpecificNote(): ?string
    {
        return $this->specific_note;
    }

    public function setSpecificNote(?string $specific_note): static
    {
        $this->specific_note = $specific_note;

        return $this;
    }



    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): static
    {
        $this->theme = $theme;

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
