<?php

namespace App\Entity;

use App\Repository\AuthorityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuthorityRepository::class)
 */
class Authority
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isRoleKoh;

    /**
     * @ORM\ManyToMany(targetEntity=KohUtilisateur::class, mappedBy="roles", cascade={"persist"})
     */
    private $kohUtilisateurs;

    public function __construct()
    {
        $this->kohUtilisateurs = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsRoleKoh(): ?bool
    {
        return $this->isRoleKoh;
    }

    public function setIsRoleKoh(bool $isRoleKoh): self
    {
        $this->isRoleKoh = $isRoleKoh;

        return $this;
    }

    /**
     * @return Collection|KohUtilisateur[]
     */
    public function getKohUtilisateurs(): Collection
    {
        return $this->kohUtilisateurs;
    }

    public function addKohUtilisateur(KohUtilisateur $kohUtilisateur): self
    {
        if (!$this->kohUtilisateurs->contains($kohUtilisateur)) {
            $this->kohUtilisateurs[] = $kohUtilisateur;
            $kohUtilisateur->addAuthority($this);
        }

        return $this;
    }

    public function removeKohUtilisateur(KohUtilisateur $kohUtilisateur): self
    {
        if ($this->kohUtilisateurs->contains($kohUtilisateur)) {
            $this->kohUtilisateurs->removeElement($kohUtilisateur);
            $kohUtilisateur->removeAuthority($this);
        }

        return $this;
    }
}
