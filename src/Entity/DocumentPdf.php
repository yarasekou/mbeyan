<?php

namespace App\Entity;

use App\Repository\DocumentPdfRepository;
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
 * @ORM\Entity(repositoryClass=DocumentPdfRepository::class)
 * @Vich\Uploadable()
 */
class DocumentPdf
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
     * @Assert\File(mimeTypesMessage="cet type de fichier n'est pas pris en compte")
     * @Vich\UploadableField(mapping= "bien_document_pdf", fileNameProperty="name")
     */
    private $document_pdf;

    /**
     * @ORM\ManyToOne(targetEntity=Expertise::class, inversedBy="documentPdfs", cascade={"persist"})
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
    public function getDocumentPdf(): ?File
    {
        return $this->document_pdf;
    }

    /**
     * @param File|null $document_pdf
     * @return DocumentPdf
     * @throws Exception
     */
    public function setDocumentPdf(?File $document_pdf): DocumentPdf
    {
        $this->document_pdf = $document_pdf;
        if ($this->document_pdf instanceof UploadedFile) {
            $this->setUpdatedAt(new DateTime('now', new DateTimeZone('GMT')));
        }
        return $this;
    }
}
