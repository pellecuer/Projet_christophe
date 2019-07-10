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
     * @ORM\OneToMany(targetEntity="App\Entity\Tjm", mappedBy="pole", cascade={"persist"})
     */
    private $tjms;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activity", mappedBy="pole")
     */
    private $activities;

    public function __construct()
    {
        $this->tjms = new ArrayCollection();
        $this->activities = new ArrayCollection();
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
    public function getTjms(): Collection
    {
        return $this->tjms;
    }

    public function addTjm(Tjm $tjm): self
    {
        if (!$this->tjms->contains($tjm)) {
            $this->tjms[] = $tjm;
            $tjm->setPole($this);
        }

        return $this;
    }

    public function removeTjm(Tjm $tjm): self
    {
        if ($this->tjms->contains($tjm)) {
            $this->tjms->removeElement($tjm);
            // set the owning side to null (unless already changed)
            if ($tjm->getPole() === $this) {
                $tjm->setPole(null);
            }
        }

        return $this;
    }

    public function __toString(){        
        return $this->name;        
    }

    /**
     * @return Collection|Activity[]
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities[] = $activity;
            $activity->setPole($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activities->contains($activity)) {
            $this->activities->removeElement($activity);
            // set the owning side to null (unless already changed)
            if ($activity->getPole() === $this) {
                $activity->setPole(null);
            }
        }

        return $this;
    }
    
}
