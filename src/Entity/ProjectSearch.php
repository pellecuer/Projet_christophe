<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ProjectSearch
{
    
    private $id;

    /**
     * @var string|null
     */
    private $date;

    /**
     * @var string|null
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
