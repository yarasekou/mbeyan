<?php

namespace App\Entity;

use App\Repository\OtherDocumentRepository;
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
 * @ORM\Entity(repositoryClass=OtherDocumentRepository::class)
 * @Vich\Uploadable()
 */
class OtherDocument
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
     * @Assert\File(mimeTypesMessage="Cet type se fichier n'est pas en charge")
     * @Vich\UploadableField(mapping="other_document", fileNameProperty="name")
     */
    private $documentFile;

    /**
     * @ORM\ManyToOne(targetEntity=Expertise::class, inversedBy="otherDocuments", cascade={"persist"})
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

    /**
     * @return File|null
     */
    public function getDocumentFile(): ?File
    {
        return $this->documentFile;
    }

    /**
     * @param File|null $documentFile
     * @return OtherDocument
     * @throws Exception
     */
    public function setDocumentFile(?File $documentFile): OtherDocument
    {
        $this->documentFile = $documentFile;
        if ($this->documentFile instanceof UploadedFile) {
            $this->updatedAt = new DateTime('now', new DateTimeZone('GMT'));
        }

        return $this;
    }
}
