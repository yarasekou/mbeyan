<?php

namespace App\Entity;

use App\Repository\SysAdminOperationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SysAdminOperationRepository::class)
 */
class SysAdminOperation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=KohUtilisateur::class, inversedBy="sysAdminOperations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $kohUtilisateur;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userAffected;

    /**
     * @ORM\Column(type="datetime")
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

    public function getKohUtilisateur(): ?KohUtilisateur
    {
        return $this->kohUtilisateur;
    }

    public function setKohUtilisateur(?KohUtilisateur $kohUtilisateur): self
    {
        $this->kohUtilisateur = $kohUtilisateur;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUserAffected(): ?string
    {
        return $this->userAffected;
    }

    public function setUserAffected(?string $userAffected): self
    {
        $this->userAffected = $userAffected;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
