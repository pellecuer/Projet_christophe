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

    public function __construct()
    {
        $this->Collaborators = new ArrayCollection();
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
}
