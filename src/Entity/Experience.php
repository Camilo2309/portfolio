<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExperienceRepository")
 */
class Experience
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dated;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="experiences")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExperienceList", mappedBy="experience")
     */
    private $experienceLists;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icone;


    public function __construct()
    {
        $this->listing = new ArrayCollection();
        $this->experienceLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDated(): ?string
    {
        return $this->dated;
    }

    public function setDated(string $dated): self
    {
        $this->dated = $dated;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|ExperienceList[]
     */
    public function getExperienceLists(): Collection
    {
        return $this->experienceLists;
    }

    public function addExperienceList(ExperienceList $experienceList): self
    {
        if (!$this->experienceLists->contains($experienceList)) {
            $this->experienceLists[] = $experienceList;
            $experienceList->setExperience($this);
        }

        return $this;
    }

    public function removeExperienceList(ExperienceList $experienceList): self
    {
        if ($this->experienceLists->contains($experienceList)) {
            $this->experienceLists->removeElement($experienceList);
            // set the owning side to null (unless already changed)
            if ($experienceList->getExperience() === $this) {
                $experienceList->setExperience(null);
            }
        }

        return $this;
    }

    public function getIcone(): ?string
    {
        return $this->icone;
    }

    public function setIcone(?string $icone): self
    {
        $this->icone = $icone;

        return $this;
    }

}
