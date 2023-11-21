<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScheduleRepository::class)]
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $day_name = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $opening_am = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $closing_am = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $opening_pm = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $closing_pm = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayName(): ?string
    {
        return $this->day_name;
    }

    public function setDayName(string $day_name): static
    {
        $this->day_name = $day_name;

        return $this;
    }

    public function getOpeningAm(): ?\DateTimeInterface
    {
        return $this->opening_am;
    }

    public function setOpeningAm(?\DateTimeInterface $opening_am): static
    {
        $this->opening_am = $opening_am;

        return $this;
    }

    public function getClosingAm(): ?\DateTimeInterface
    {
        return $this->closing_am;
    }

    public function setClosingAm(?\DateTimeInterface $closing_am): static
    {
        $this->closing_am = $closing_am;

        return $this;
    }

    public function getOpeningPm(): ?\DateTimeInterface
    {
        return $this->opening_pm;
    }

    public function setOpeningPm(?\DateTimeInterface $opening_pm): static
    {
        $this->opening_pm = $opening_pm;

        return $this;
    }

    public function getClosingPm(): ?\DateTimeInterface
    {
        return $this->closing_pm;
    }

    public function setClosingPm(?\DateTimeInterface $closing_pm): static
    {
        $this->closing_pm = $closing_pm;

        return $this;
    }
}
