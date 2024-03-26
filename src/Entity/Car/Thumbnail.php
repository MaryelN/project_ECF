<?php

namespace App\Entity\Car;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\Car\ThumbnailRepository;
use App\Entity\Trait\CreatedAtTrait;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ThumbnailRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class Thumbnail
{
    use CreatedAtTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: "thumbnail", fileNameProperty: "imageName", size: "imageSize")]
    private ?File $imageFile = null;

    #[ORM\Column(type:'string', length: 255, nullable: true)]
    private ?string $imageName = null;
    
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $updatedAt = null;
    
    #[ORM\ManyToOne(inversedBy: 'thumbnail', targetEntity: Car::class)]
    private ?Car $car = null;
    
    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
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
        
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        
        if (null !== $imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }
    
    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;
        
        return $this;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }
    
    public function setImageSize(?int $imageSize): self
    {
        $this->imageSize = $imageSize;
        
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
    
    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        
        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): self
    {
        $this->car = $car;

        return $this;
    }

}