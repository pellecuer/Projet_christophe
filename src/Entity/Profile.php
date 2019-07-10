<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfileRepository")
 */
class Profile
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
    private $codeProfile;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Collaborators", mappedBy="Profile")
     */
    private $Collaborators;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activity", mappedBy="profile")
     */
    private $activities;

    public function __construct()
    {
        $this->Collaborators = new ArrayCollection();
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

    public function getCodeProfile(): ?string
    {
        return $this->codeProfile;
    }

    public function setCodeProfile(string $codeProfile): self
    {
        $this->codeProfile = $codeProfile;

        return $this;
    }

    /**
     * @return Collection|Collaborators[]
     */
    public function getCollaborators(): Collection
    {
        return $this->Collaborators;
    }

    public function addCollaborator(Collaborators $collaborator): self
    {
        if (!$this->Collaborators->contains($collaborator)) {
            $this->Collaborators[] = $collaborator;
            $collaborator->setProfile($this);
        }

        return $this;
    }

    public function removeCollaborator(Collaborators $collaborator): self
    {
        if ($this->Collaborators->contains($collaborator)) {
            $this->Collaborators->removeElement($collaborator);
            // set the owning side to null (unless already changed)
            if ($collaborator->getProfile() === $this) {
                $collaborator->setProfile(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
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
            $activity->setProfile($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activities->contains($activity)) {
            $this->activities->removeElement($activity);
            // set the owning side to null (unless already changed)
            if ($activity->getProfile() === $this) {
                $activity->setProfile(null);
            }
        }

        return $this;
    }
}
