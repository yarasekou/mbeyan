<?php

namespace App\Entity;

use App\Repository\DocumentExpertiseRepository;
use DateTime;
use DateTimeInterface;
use DateTimeZone;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=DocumentExpertiseRepository::class)
 * @UniqueEntity(fields={"name"}, message="Ce document est déjà enregistré")
 * @Vich\Uploadable()
 */
class DocumentExpertise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var File|null
     * @Assert\File(mimeTypesMessage="cet type de fichier n'est pas pris en compte")
     * @Vich\UploadableField(mapping= "bien_document_expertise", fileNameProperty="name")
     */
    private $document_expertise;

    /**
     * @ORM\ManyToOne(targetEntity=Expertise::class, inversedBy="documentExpertises", cascade={"persist"})
     */
    private $expertise;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getExpertise(): ?Expertise
    {
        return $this->expertise;
    }

    public function setExpertise(?Expertise $expertise): self
    {
        $this->expertise = $expertise;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getDocumentExpertise(): ?File
    {
        return $this->document_expertise;
    }

    /**
     * @param File|null $document_expertise
     * @return DocumentExpertise
     * @throws Exception
     */
    public function setDocumentExpertise(?File $document_expertise): DocumentExpertise
    {
        $this->document_expertise = $document_expertise;
        if ($this->document_expertise instanceof UploadedFile) {
            $this->updatedAt = new DateTime('now', new DateTimeZone('GMT'));
        }
        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
