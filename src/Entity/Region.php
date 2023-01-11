<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=RegionRepository::class)
 * @UniqueEntity("name", message="Cette région est déjà enregistrée")
 */
class Region
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
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\OneToMany(targetEntity=Cercle::class, mappedBy="region", cascade={"persist"})
     */
    private $cercles;

    public function __construct()
    {
        $this->cercles = new ArrayCollection();
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

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection|Cercle[]
     */
    public function getCercles(): Collection
    {
        return $this->cercles;
    }

    public function addCercle(Cercle $cercle): self
    {
        if (!$this->cercles->contains($cercle)) {
            $this->cercles[] = $cercle;
            $cercle->setRegion($this);
        }

        return $this;
    }

    public function removeCercle(Cercle $cercle): self
    {
        if ($this->cercles->contains($cercle)) {
            $this->cercles->removeElement($cercle);
            // set the owning side to null (unless already changed)
            if ($cercle->getRegion() === $this) {
                $cercle->setRegion(null);
            }
        }

        return $this;
    }
}
