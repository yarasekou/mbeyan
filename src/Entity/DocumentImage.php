<?php

namespace App\Entity;

use App\Repository\DocumentImageRepository;
use DateTime;
use DateTimeInterface;
use DateTimeZone;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=DocumentImageRepository::class)
 * @Vich\Uploadable()
 */
class DocumentImage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var File|null
     * @Assert\Image(mimeTypesMessage="cet type de fichier n'est pas pris en compte")
     * @Vich\UploadableField(mapping= "bien_document_image", fileNameProperty="name")
     */
    private $document_image;

    /**
     * @ORM\ManyToOne(targetEntity=Expertise::class, inversedBy="DocumentImages", cascade={"persist"})
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
    public function getDocumentImage(): ?File
    {
        return $this->document_image;
    }

    /**
     * @param File|null $document_image
     * @return DocumentImage
     * @throws Exception
     */
    public function setDocumentImage(?File $document_image): DocumentImage
    {
        $this->document_image = $document_image;
        if ($this->document_image instanceof UploadedFile) {
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
