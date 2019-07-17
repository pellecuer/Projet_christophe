<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
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
    private $code;   


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activity", mappedBy="project", cascade={"persist"})
     */
    private $activities
    ;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tjm", mappedBy="project", cascade={"persist"})
     */
    private $tjms;

    

    public function __construct()
    {
        $this->activities = new ArrayCollection();
        $this->tjms = new ArrayCollection();             
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection|Activities[]
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivities(Activity $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities[] = $activity;
            $activity->setProject($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activities->contains($activity)) {
            $this->activities->removeElement($activity);
            // set the owning side to null (unless already changed)
            if ($activity->getProject() === $this) {
                $activity->setProject(null);
            }
        }

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
            $tjm->setProject($this);
        }

        return $this;
    }

    public function removeTjm(Tjm $tjm): self
    {
        if ($this->tjms->contains($tjm)) {
            $this->tjms->removeElement($tjm);
            // set the owning side to null (unless already changed)
            if ($tjm->getProject() === $this) {
                $tjm->setProject(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
    
}
