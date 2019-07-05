<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TjmRepository")
 */
class Tjm
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="Tjm")
     */
    private $project;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pole", inversedBy="Tjm")
     */
    private $pole;   
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getPole(): ?Pole
    {
        return $this->pole;
    }

    public function setPole(?Pole $pole): self
    {
        $this->pole = $pole;

        return $this;
    }
    
}
