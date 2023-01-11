<?php

namespace App\Entity;

use App\Repository\StructureRepository;
use DateTime;
use DateTimeInterface;
use DateTimeZone;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=StructureRepository::class)
 * @Vich\Uploadable()
 * @UniqueEntity(fields={"name"}, message="Cette structure existe dejà")
 */
class Structure
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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logoStructure;

    /**
     * @var File|null
     * @Assert\Image(mimeTypesMessage="cet type de fichier n'est pas pris en compte", mimeTypes={"image/jpeg", "image/gif", "image/png"})
     * @Vich\UploadableField(mapping= "structure_image", fileNameProperty="logoStructure")
     */
    private $structure_profile;

    /**
     * @ORM\OneToMany(targetEntity=KohUtilisateur::class, mappedBy="structure", cascade={"persist","remove"})
     */
    private $kohUtilisateurs;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity=ClientStructure::class, mappedBy="structure", cascade={"persist"})
     */
    private $clientStructures;

    public function __construct()
    {
        $this->kohUtilisateurs = new ArrayCollection();
        $this->clientStructures = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getLogoStructure(): ?string
    {
        return $this->logoStructure;
    }

    public function setLogoStructure(?string $logoStructure): self
    {
        $this->logoStructure = $logoStructure;

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
            $kohUtilisateur->setStructure($this);
        }

        return $this;
    }

    public function removeKohUtilisateur(KohUtilisateur $kohUtilisateur): self
    {
        if ($this->kohUtilisateurs->contains($kohUtilisateur)) {
            $this->kohUtilisateurs->removeElement($kohUtilisateur);
            // set the owning side to null (unless already changed)
            if ($kohUtilisateur->getStructure() === $this) {
                $kohUtilisateur->setStructure(null);
            }
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getStructureProfile(): ?File
    {
        return $this->structure_profile;
    }

    /**
     * @param File|null $structure_profile
     * @return Structure
     * @throws Exception
     */
    public function setStructureProfile(?File $structure_profile): Structure
    {
        $this->structure_profile = $structure_profile;
        if ($this->structure_profile instanceof UploadedFile) {
            $this->updated_at = new DateTime('now', new DateTimeZone('GMT'));
        }
        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection|ClientStructure[]
     */
    public function getClientStructures(): Collection
    {
        return $this->clientStructures;
    }

    public function addClientStructure(ClientStructure $clientStructure): self
    {
        if (!$this->clientStructures->contains($clientStructure)) {
            $this->clientStructures[] = $clientStructure;
            $clientStructure->setStructure($this);
        }

        return $this;
    }

    public function removeClientStructure(ClientStructure $clientStructure): self
    {
        if ($this->clientStructures->contains($clientStructure)) {
            $this->clientStructures->removeElement($clientStructure);
            // set the owning side to null (unless already changed)
            if ($clientStructure->getStructure() === $this) {
                $clientStructure->setStructure(null);
            }
        }

        return $this;
    }
}
