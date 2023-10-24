<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait MessageTrait
{
  #[ORM\Column(length: 255)]
  private ?string $message = null;

  public function getMessage(): ?string
  {
      return $this->message;
  }

  public function setMessage(string $message): static
  {
      $this->message = $message;

      return $this;
  }
    }