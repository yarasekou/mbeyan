<?php

namespace App\Entity;

use App\Repository\ExpertiseRepository;
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
 * @ORM\Entity(repositoryClass=ExpertiseRepository::class)
 * @UniqueEntity(fields={"numeroExpertise"}, message="Ce numero expertise est déjà enregistré")
 * @Vich\Uploadable()
 */
class Expertise
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
    private $numeroExpertise;

    /**
     * @ORM\ManyToOne(targetEntity=TypeAcquisition::class, inversedBy="expertises", cascade={"persist"})
     */
    private $typeAcquisition;

    /**
     * @ORM\ManyToOne(targetEntity=TypeBien::class, inversedBy="expertises", cascade={"persist"})
     */
    private $typeBien;

    /**
     * @ORM\ManyToOne(targetEntity=TypeUsageBien::class, inversedBy="expertises", cascade={"persist"})
     */
    private $typeUsageBien;

    /**
     * @ORM\ManyToOne(targetEntity=TypeDocumentPropriete::class, inversedBy="expertises", cascade={"persist"})
     */
    private $typeDocumentPropriete;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateEvaluation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateNextEvaluation;

    /**
     * @ORM\Column(type="decimal", precision=30, scale=0, nullable=true)
     */
    private $lastEvaluationPrice;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $superficie;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $memo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarque;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $other;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isForStructure;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $infoProprietaire;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEntree;

    /**
     * @ORM\Column(type="decimal", precision=30, scale=0, nullable=true)
     */
    private $montantAcquisition;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateSortieImmobilisation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateFinDation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icon;

    /**
     * @var File|null
     * @Assert\Image(mimeTypesMessage="cet type de fichier n'est pas pris en compte")
     * @Vich\UploadableField(mapping= "bien_icon", fileNameProperty="icon")
     */
    private $bienIcon;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=BienClient::class, inversedBy="expertises", cascade={"persist"})
     */
    private $bienClient;

    /**
     * @ORM\OneToMany(targetEntity=DocumentExpertise::class, mappedBy="expertise", cascade={"persist", "remove"})
     */
    private $documentExpertises;

    /**
     * @ORM\OneToMany(targetEntity=DocumentPdf::class, mappedBy="expertise", cascade={"persist", "remove"})
     */
    private $documentPdfs;

    /**
     * @ORM\OneToMany(targetEntity=DocumentImage::class, mappedBy="expertise", cascade={"persist", "remove"})
     */
    private $DocumentImages;

    /**
     * @ORM\OneToMany(targetEntity=OtherDocument::class, mappedBy="expertise", cascade={"persist", "remove"})
     */
    private $otherDocuments;

    /**
     * @ORM\OneToOne(targetEntity=DossierMbeyan::class, cascade={"persist"})
     */
    private $dossierMbeyan;


    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $fraisAcquisition;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $volumeFoncier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $foncierF;

    /**
     * @ORM\ManyToOne(targetEntity=ClientStructure::class, inversedBy="expertises", cascade={"persist"})
     */
    private $clientStructure;

    /**
     * @ORM\ManyToOne(targetEntity=KohUtilisateur::class, inversedBy="expertises", cascade={"persist"})
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=KohUtilisateur::class)
     */
    private $updatedBy;

    /**
     * @ORM\OneToMany(targetEntity=MemoBien::class, mappedBy="expertise")
     */
    private $memoBiens;

    /**
     * @ORM\OneToMany(targetEntity=RemarqueBien::class, mappedBy="expertise")
     */
    private $remarqueBiens;

    /**
     * @ORM\OneToMany(targetEntity=OtherInfoBien::class, mappedBy="expertise")
     */
    private $otherInfoBiens;

    public function __construct()
    {
        $this->documentExpertises = new ArrayCollection();
        $this->documentPdfs = new ArrayCollection();
        $this->DocumentImages = new ArrayCollection();
        $this->otherDocuments = new ArrayCollection();
        $this->memoBiens = new ArrayCollection();
        $this->remarqueBiens = new ArrayCollection();
        $this->otherInfoBiens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroExpertise(): ?string
    {
        return $this->numeroExpertise;
    }

    public function setNumeroExpertise(string $numeroExpertise): self
    {
        $this->numeroExpertise = $numeroExpertise;

        return $this;
    }

    public function getTypeAcquisition(): ?TypeAcquisition
    {
        return $this->typeAcquisition;
    }

    public function setTypeAcquisition(?TypeAcquisition $typeAcquisition): self
    {
        $this->typeAcquisition = $typeAcquisition;

        return $this;
    }

    public function getTypeBien(): ?TypeBien
    {
        return $this->typeBien;
    }

    public function setTypeBien(?TypeBien $typeBien): self
    {
        $this->typeBien = $typeBien;

        return $this;
    }

    public function getTypeUsageBien(): ?TypeUsageBien
    {
        return $this->typeUsageBien;
    }

    public function setTypeUsageBien(?TypeUsageBien $typeUsageBien): self
    {
        $this->typeUsageBien = $typeUsageBien;

        return $this;
    }

    public function getTypeDocumentPropriete(): ?TypeDocumentPropriete
    {
        return $this->typeDocumentPropriete;
    }

    public function setTypeDocumentPropriete(?TypeDocumentPropriete $typeDocumentPropriete): self
    {
        $this->typeDocumentPropriete = $typeDocumentPropriete;

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

    public function getDateEvaluation(): ?DateTimeInterface
    {
        return $this->dateEvaluation;
    }

    public function setDateEvaluation(DateTimeInterface $dateEvaluation): self
    {
        $this->dateEvaluation = $dateEvaluation;

        return $this;
    }

    public function getDateNextEvaluation(): ?DateTimeInterface
    {
        return $this->dateNextEvaluation;
    }

    public function setDateNextEvaluation(?DateTimeInterface $dateNextEvaluation): self
    {
        $this->dateNextEvaluation = $dateNextEvaluation;

        return $this;
    }

    public function getLastEvaluationPrice(): ?string
    {
        return $this->lastEvaluationPrice;
    }

    public function setLastEvaluationPrice(?string $lastEvaluationPrice): self
    {
        $this->lastEvaluationPrice = $lastEvaluationPrice;

        return $this;
    }

    public function getSuperficie(): ?string
    {
        return $this->superficie;
    }

    public function setSuperficie(?string $superficie): self
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getMemo(): ?string
    {
        return $this->memo;
    }

    public function setMemo(?string $memo): self
    {
        $this->memo = $memo;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }

    public function getOther(): ?string
    {
        return $this->other;
    }

    public function setOther(?string $other): self
    {
        $this->other = $other;

        return $this;
    }

    public function getIsForStructure(): ?bool
    {
        return $this->isForStructure;
    }

    public function setIsForStructure(?bool $isForStructure): self
    {
        $this->isForStructure = $isForStructure;

        return $this;
    }

    public function getInfoProprietaire(): ?string
    {
        return $this->infoProprietaire;
    }

    public function setInfoProprietaire(?string $infoProprietaire): self
    {
        $this->infoProprietaire = $infoProprietaire;

        return $this;
    }

    public function getDateEntree(): ?DateTimeInterface
    {
        return $this->dateEntree;
    }

    public function setDateEntree(?DateTimeInterface $dateEntree): self
    {
        $this->dateEntree = $dateEntree;

        return $this;
    }

    public function getMontantAcquisition(): ?string
    {
        return $this->montantAcquisition;
    }

    public function setMontantAcquisition(?string $montantAcquisition): self
    {
        $this->montantAcquisition = $montantAcquisition;

        return $this;
    }

    public function getDateSortieImmobilisation(): ?DateTimeInterface
    {
        return $this->dateSortieImmobilisation;
    }

    public function setDateSortieImmobilisation(?DateTimeInterface $dateSortieImmobilisation): self
    {
        $this->dateSortieImmobilisation = $dateSortieImmobilisation;

        return $this;
    }

    public function getDateFinDation(): ?DateTimeInterface
    {
        return $this->dateFinDation;
    }

    public function setDateFinDation(?DateTimeInterface $dateFinDation): self
    {
        $this->dateFinDation = $dateFinDation;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
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

    public function getBienClient(): ?BienClient
    {
        return $this->bienClient;
    }

    public function setBienClient(?BienClient $bienClient): self
    {
        $this->bienClient = $bienClient;

        return $this;
    }

    /**
     * @return Collection|DocumentExpertise[]
     */
    public function getDocumentExpertises(): Collection
    {
        return $this->documentExpertises;
    }

    public function addDocumentExpertise(DocumentExpertise $documentExpertise): self
    {
        if (!$this->documentExpertises->contains($documentExpertise)) {
            $this->documentExpertises[] = $documentExpertise;
            $documentExpertise->setExpertise($this);
        }

        return $this;
    }

    public function removeDocumentExpertise(DocumentExpertise $documentExpertise): self
    {
        if ($this->documentExpertises->contains($documentExpertise)) {
            $this->documentExpertises->removeElement($documentExpertise);
            // set the owning side to null (unless already changed)
            if ($documentExpertise->getExpertise() === $this) {
                $documentExpertise->setExpertise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DocumentPdf[]
     */
    public function getDocumentPdfs(): Collection
    {
        return $this->documentPdfs;
    }

    public function addDocumentPdf(DocumentPdf $documentPdf): self
    {
        if (!$this->documentPdfs->contains($documentPdf)) {
            $this->documentPdfs[] = $documentPdf;
            $documentPdf->setExpertise($this);
        }

        return $this;
    }

    public function removeDocumentPdf(DocumentPdf $documentPdf): self
    {
        if ($this->documentPdfs->contains($documentPdf)) {
            $this->documentPdfs->removeElement($documentPdf);
            // set the owning side to null (unless already changed)
            if ($documentPdf->getExpertise() === $this) {
                $documentPdf->setExpertise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DocumentImage[]
     */
    public function getDocumentImages(): Collection
    {
        return $this->DocumentImages;
    }

    public function addDocumentImage(DocumentImage $documentImage): self
    {
        if (!$this->DocumentImages->contains($documentImage)) {
            $this->DocumentImages[] = $documentImage;
            $documentImage->setExpertise($this);
        }

        return $this;
    }

    public function removeDocumentImage(DocumentImage $documentImage): self
    {
        if ($this->DocumentImages->contains($documentImage)) {
            $this->DocumentImages->removeElement($documentImage);
            // set the owning side to null (unless already changed)
            if ($documentImage->getExpertise() === $this) {
                $documentImage->setExpertise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OtherDocument[]
     */
    public function getOtherDocuments(): Collection
    {
        return $this->otherDocuments;
    }

    public function addOtherDocument(OtherDocument $otherDocument): self
    {
        if (!$this->otherDocuments->contains($otherDocument)) {
            $this->otherDocuments[] = $otherDocument;
            $otherDocument->setExpertise($this);
        }

        return $this;
    }

    public function removeOtherDocument(OtherDocument $otherDocument): self
    {
        if ($this->otherDocuments->contains($otherDocument)) {
            $this->otherDocuments->removeElement($otherDocument);
            // set the owning side to null (unless already changed)
            if ($otherDocument->getExpertise() === $this) {
                $otherDocument->setExpertise(null);
            }
        }

        return $this;
    }

    public function getDossierMbeyan(): ?DossierMbeyan
    {
        return $this->dossierMbeyan;
    }

    public function setDossierMbeyan(?DossierMbeyan $dossierMbeyan): self
    {
        $this->dossierMbeyan = $dossierMbeyan;

        return $this;
    }


    /**
     * @return File|null
     */
    public function getBienIcon(): ?File
    {
        return $this->bienIcon;
    }

    /**
     * @param File|null $bienIcon
     * @return Expertise
     * @throws Exception
     */
    public function setBienIcon(?File $bienIcon): Expertise
    {
        $this->bienIcon = $bienIcon;
        if ($this->bienIcon instanceof UploadedFile) {
            $this->updatedAt = new DateTime('now', new DateTimeZone('GMT'));
        }
        return $this;
    }

    public function getFraisAcquisition(): ?string
    {
        return $this->fraisAcquisition;
    }

    public function setFraisAcquisition(?string $fraisAcquisition): self
    {
        $this->fraisAcquisition = $fraisAcquisition;

        return $this;
    }

    public function getVolumeFoncier(): ?string
    {
        return $this->volumeFoncier;
    }

    public function setVolumeFoncier(?string $volumeFoncier): self
    {
        $this->volumeFoncier = $volumeFoncier;

        return $this;
    }

    public function getFoncierF(): ?string
    {
        return $this->foncierF;
    }

    public function setFoncierF(?string $foncierF): self
    {
        $this->foncierF = $foncierF;

        return $this;
    }

    public function getClientStructure(): ?ClientStructure
    {
        return $this->clientStructure;
    }

    public function setClientStructure(?ClientStructure $clientStructure): self
    {
        $this->clientStructure = $clientStructure;

        return $this;
    }

    public function getCreatedBy(): ?KohUtilisateur
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?KohUtilisateur $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getUpdatedBy(): ?KohUtilisateur
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?KohUtilisateur $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * @return Collection|MemoBien[]
     */
    public function getMemoBiens(): Collection
    {
        return $this->memoBiens;
    }

    public function addMemoBien(MemoBien $memoBien): self
    {
        if (!$this->memoBiens->contains($memoBien)) {
            $this->memoBiens[] = $memoBien;
            $memoBien->setExpertise($this);
        }

        return $this;
    }

    public function removeMemoBien(MemoBien $memoBien): self
    {
        if ($this->memoBiens->removeElement($memoBien)) {
            // set the owning side to null (unless already changed)
            if ($memoBien->getExpertise() === $this) {
                $memoBien->setExpertise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RemarqueBien[]
     */
    public function getRemarqueBiens(): Collection
    {
        return $this->remarqueBiens;
    }

    public function addRemarqueBien(RemarqueBien $remarqueBien): self
    {
        if (!$this->remarqueBiens->contains($remarqueBien)) {
            $this->remarqueBiens[] = $remarqueBien;
            $remarqueBien->setExpertise($this);
        }

        return $this;
    }

    public function removeRemarqueBien(RemarqueBien $remarqueBien): self
    {
        if ($this->remarqueBiens->removeElement($remarqueBien)) {
            // set the owning side to null (unless already changed)
            if ($remarqueBien->getExpertise() === $this) {
                $remarqueBien->setExpertise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OtherInfoBien[]
     */
    public function getOtherInfoBiens(): Collection
    {
        return $this->otherInfoBiens;
    }

    public function addOtherInfoBien(OtherInfoBien $otherInfoBien): self
    {
        if (!$this->otherInfoBiens->contains($otherInfoBien)) {
            $this->otherInfoBiens[] = $otherInfoBien;
            $otherInfoBien->setExpertise($this);
        }

        return $this;
    }

    public function removeOtherInfoBien(OtherInfoBien $otherInfoBien): self
    {
        if ($this->otherInfoBiens->removeElement($otherInfoBien)) {
            // set the owning side to null (unless already changed)
            if ($otherInfoBien->getExpertise() === $this) {
                $otherInfoBien->setExpertise(null);
            }
        }

        return $this;
    }
}
