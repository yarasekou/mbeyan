<?php

namespace App\Entity;

use App\Repository\TypeCompteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TypeCompteRepository::class)
 * @UniqueEntity("name", message="Ce type de compte existe déjà")
 */
class TypeCompte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasManyUser;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isStructure;

    /**
     * @ORM\OneToMany(targetEntity=KohUtilisateur::class, mappedBy="typeCompte", cascade={"persist"})
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

    public function getHasManyUser(): ?bool
    {
        return $this->hasManyUser;
    }

    public function setHasManyUser(bool $hasManyUser): self
    {
        $this->hasManyUser = $hasManyUser;

        return $this;
    }

    public function getIsStructure(): ?bool
    {
        return $this->isStructure;
    }

    public function setIsStructure(bool $isStructure): self
    {
        $this->isStructure = $isStructure;

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
            $kohUtilisateur->setTypeCompte($this);
        }

        return $this;
    }

    public function removeKohUtilisateur(KohUtilisateur $kohUtilisateur): self
    {
        if ($this->kohUtilisateurs->contains($kohUtilisateur)) {
            $this->kohUtilisateurs->removeElement($kohUtilisateur);
            // set the owning side to null (unless already changed)
            if ($kohUtilisateur->getTypeCompte() === $this) {
                $kohUtilisateur->setTypeCompte(null);
            }
        }

        return $this;
    }
}
