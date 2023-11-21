<?php

namespace App\Entity\Car;

use App\Entity\Images;
use Cocur\Slugify\Slugify;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\Car\CarRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use symfony\component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Car
{
    use CreatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank()]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length:255, nullable: true)]
    #[Assert\NotBlank()]
    private ?string $slug = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\NotBlank()]
    private ?int $car_year = null;

    #[ORM\Column(type: Types::INTEGER)]
    #[Assert\NotBlank()]
    private ?int $km = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Assert\NotBlank()]
    private ?string $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank()]
    private ?Transmission $transmission = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank()]
    private ?Fuel $fuel = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank()]
    private ?Brand $brand = null;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: Thumbnail::class, cascade: ['persist', 'remove'])]
    private Collection $thumbnails;
    
    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $updatedAt = null;
    
    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->thumbnails = new ArrayCollection();
    }

    #[ORM\PrePersist]
    public function prePersist()
    {
        $this->slug = (new Slugify())->slugify($this->name);
    }
    
    #[ORM\PreUpdate]
    public function preUpdate()
    {
        $this->updatedAt = new \DateTimeImmutable();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCarYear(): ?int
    {
        return $this->car_year;
    }

    public function setCarYear(int $car_year): static
    {
        $this->car_year = $car_year;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(int $km): static
    {
        $this->km = $km;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTransmission(): ?transmission
    {
        return $this->transmission;
    }

    public function setTransmission(?transmission $transmission): static
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getFuel(): ?fuel
    {
        return $this->fuel;
    }

    public function setFuel(?fuel $fuel): static
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getBrand(): ?brand
    {
        return $this->brand;
    }

    public function setBrand(?brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function addThumbnail(Thumbnail $thumbnail): static
    {
        if (!$this->thumbnails->contains($thumbnail)) {
            $this->thumbnails->add($thumbnail);
            $thumbnail->setCar($this);
        }
    
        return $this;
    }
    
    public function removeThumbnail(Thumbnail $thumbnail): static
    {
        if ($this->thumbnails->removeElement($thumbnail)) {
            // set the owning side to null (unless already changed)
            if ($thumbnail->getCar() === $this) {
                $thumbnail->setCar(null);
            }
        }
    
        return $this;
    }
}