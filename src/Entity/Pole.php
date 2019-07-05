<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PoleRepository")
 */
class Pole
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codePole;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tjm", mappedBy="pole")
     */
    private $tjm;

    

    public function __construct()
    {
        $this->tjm = new ArrayCollection();       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCodePole(): ?string
    {
        return $this->codePole;
    }

    public function setCodePole(string $codePole): self
    {
        $this->codePole = $codePole;

        return $this;
    }

    /**
     * @return Collection|Tjm[]
     */
    public function getTjm(): Collection
    {
        return $this->tjm;
    }

    public function addTjm(Tjm $tjm): self
    {
        if (!$this->tjm->contains($tjm)) {
            $this->tjm[] = $tjm;
            $tjm->setPole($this);
        }

        return $this;
    }

    public function removeTjm(Tjm $tjm): self
    {
        if ($this->tjm->contains($tjm)) {
            $this->tjm->removeElement($tjm);
            // set the owning side to null (unless already changed)
            if ($tjm->getPole() === $this) {
                $tjm->setPole(null);
            }
        }

        return $this;
    }    
}
