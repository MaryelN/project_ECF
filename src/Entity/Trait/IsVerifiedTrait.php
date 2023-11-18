<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait IsVerifiedTrait
{
  #[ORM\Column(type: 'boolean')]
  private $is_verified = false;

  public function getIsVerified(): ?bool
  {
      return $this->is_verified;
  }

  public function setIsVerified(?bool $is_verified): self
  {
      $this->is_verified = $is_verified;

      return $this;
  }
}