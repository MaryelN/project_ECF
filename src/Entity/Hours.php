<?php

namespace App\Entity;

use App\Repository\HoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoursRepository::class)]
class Hours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $day_name = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hour_am_1 = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hour_am_2 = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hour_pm_1 = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hour_pm_2 = null;

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

    public function getHourAm1(): ?\DateTimeInterface
    {
        return $this->hour_am_1;
    }

    public function setHourAm1(\DateTimeInterface $hour_am_1): static
    {
        $this->hour_am_1 = $hour_am_1;

        return $this;
    }

    public function getHourAm2(): ?\DateTimeInterface
    {
        return $this->hour_am_2;
    }

    public function setHourAm2(\DateTimeInterface $hour_am_2): static
    {
        $this->hour_am_2 = $hour_am_2;

        return $this;
    }

    public function getHourPm1(): ?\DateTimeInterface
    {
        return $this->hour_pm_1;
    }

    public function setHourPm1(\DateTimeInterface $hour_pm_1): static
    {
        $this->hour_pm_1 = $hour_pm_1;

        return $this;
    }

    public function getHourPm2(): ?\DateTimeInterface
    {
        return $this->hour_pm_2;
    }

    public function setHourPm2(\DateTimeInterface $hour_pm_2): static
    {
        $this->hour_pm_2 = $hour_pm_2;

        return $this;
    }
}
