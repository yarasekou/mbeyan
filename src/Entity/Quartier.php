<?php

namespace App\Entity;

use App\Repository\QuartierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=QuartierRepository::class)
 * @UniqueEntity("name", message="Ce quartier est déjà enregistré")
 */
class Quartier
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
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\ManyToOne(targetEntity=Commune::class, inversedBy="quartiers", cascade={"persist"})
     */
    private $commune;

    /**
     * @ORM\OneToMany(targetEntity=BienClient::class, mappedBy="Quartier", cascade={"persist"})
     */
    private $bienClients;

    public function __construct()
    {
        $this->bienClients = new ArrayCollection();
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

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * @return Collection|BienClient[]
     */
    public function getBienClients(): Collection
    {
        return $this->bienClients;
    }

    public function addBienClient(BienClient $bienClient): self
    {
        if (!$this->bienClients->contains($bienClient)) {
            $this->bienClients[] = $bienClient;
            $bienClient->setQuartier($this);
        }

        return $this;
    }

    public function removeBienClient(BienClient $bienClient): self
    {
        if ($this->bienClients->contains($bienClient)) {
            $this->bienClients->removeElement($bienClient);
            // set the owning side to null (unless already changed)
            if ($bienClient->getQuartier() === $this) {
                $bienClient->setQuartier(null);
            }
        }

        return $this;
    }
}
