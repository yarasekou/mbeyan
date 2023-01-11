<?php

namespace App\Entity;

use App\Repository\KohUtilisateurRepository;
use DateTime;
use DateTimeZone;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Serializable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=KohUtilisateurRepository::class)
 * @UniqueEntity("email", message="Cet émail existe dejà")
 * @UniqueEntity("telephone", message="Ce numero de téléphone existe dejà")
 * @Vich\Uploadable()
 */
class KohUtilisateur implements UserInterface, Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Email(message="Entrez une adresse email valide")
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActived;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdmin;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $username;

    private $nomUtilisateur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isKohUser;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomStructure;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $confirmationToken;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isConfirmed;

    /**
     * @ORM\ManyToMany(targetEntity=Authority::class, inversedBy="kohUtilisateurs", cascade={"persist"})
     */
    private $authorities;

    /**
     * @ORM\ManyToOne(targetEntity=TypeCompte::class, inversedBy="kohUtilisateurs", cascade={"persist"})
     */
    private $typeCompte;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $token_validity;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @var File|null
     * @Assert\Image(mimeTypesMessage="cet type de fichier n'est pas pris en compte", mimeTypes={"image/jpeg", "image/gif", "image/png"})
     * @Vich\UploadableField(mapping= "user_image", fileNameProperty="image_profile")
     */
    private $userProfile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_profile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=Structure::class, inversedBy="kohUtilisateurs", cascade={"persist"})
     */
    private $structure;

    /**
     * @ORM\OneToMany(targetEntity=BienClient::class, mappedBy="kohUtilisateur", cascade={"persist"})
     */
    private $bienClients;

    /**
     * @ORM\OneToMany(targetEntity=SysAdminOperation::class, mappedBy="kohUtilisateur", orphanRemoval=true)
     */
    private $sysAdminOperations;

    /**
     * @ORM\OneToMany(targetEntity=Expertise::class, mappedBy="createdBy", cascade={"persist"})
     */
    private $expertises;

    /**
     * @ORM\OneToMany(targetEntity=MemoBien::class, mappedBy="createdBy")
     */
    private $memoBiens;

    /**
     * @ORM\OneToMany(targetEntity=RemarqueBien::class, mappedBy="createdBy")
     */
    private $remarqueBiens;

    /**
     * @ORM\OneToMany(targetEntity=OtherInfoBien::class, mappedBy="createdBy")
     */
    private $otherInfoBiens;

    public function __construct()
    {
        $this->authorities = new ArrayCollection();
        $this->bienClients = new ArrayCollection();
        $this->sysAdminOperations = new ArrayCollection();
        $this->expertises = new ArrayCollection();
        $this->memoBiens = new ArrayCollection();
        $this->remarqueBiens = new ArrayCollection();
        $this->otherInfoBiens = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return KohUtilisateur
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return KohUtilisateur
     */
    public function setEmail($email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return KohUtilisateur
     */
    public function setPassword($password): KohUtilisateur
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     * @return KohUtilisateur
     */
    public function setFirstName($firstName): KohUtilisateur
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     * @return KohUtilisateur
     */
    public function setLastName($lastName): KohUtilisateur
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     * @return KohUtilisateur
     */
    public function setTelephone($telephone): KohUtilisateur
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     * @return KohUtilisateur
     */
    public function setAdresse($adresse): KohUtilisateur
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsActived()
    {
        return $this->isActived;
    }

    /**
     * @param mixed $isActived
     * @return KohUtilisateur
     */
    public function setIsActived($isActived): KohUtilisateur
    {
        $this->isActived = $isActived;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param mixed $isAdmin
     * @return KohUtilisateur
     */
    public function setIsAdmin($isAdmin): KohUtilisateur
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return KohUtilisateur
     */
    public function setUsername($username): KohUtilisateur
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsKohUser()
    {
        return $this->isKohUser;
    }

    /**
     * @param mixed $isKohUser
     * @return KohUtilisateur
     */
    public function setIsKohUser($isKohUser): KohUtilisateur
    {
        $this->isKohUser = $isKohUser;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomStructure()
    {
        return $this->nomStructure;
    }

    /**
     * @param mixed $nomStructure
     * @return KohUtilisateur
     */
    public function setNomStructure($nomStructure): KohUtilisateur
    {
        $this->nomStructure = $nomStructure;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return KohUtilisateur
     */
    public function setStatus($status): KohUtilisateur
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * @param mixed $confirmationToken
     * @return KohUtilisateur
     */
    public function setConfirmationToken($confirmationToken): KohUtilisateur
    {
        $this->confirmationToken = $confirmationToken;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsConfirmed()
    {
        return $this->isConfirmed;
    }

    /**
     * @param mixed $isConfirmed
     * @return KohUtilisateur
     */
    public function setIsConfirmed($isConfirmed): KohUtilisateur
    {
        $this->isConfirmed = $isConfirmed;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getAuthorities(): Collection
    {
        return $this->authorities;
    }

    /**
     * @param ArrayCollection $authorities
     * @return KohUtilisateur
     */
    public function setAuthorities(ArrayCollection $authorities): KohUtilisateur
    {
        $this->authorities = $authorities;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeCompte()
    {
        return $this->typeCompte;
    }

    /**
     * @param mixed $typeCompte
     * @return KohUtilisateur
     */
    public function setTypeCompte($typeCompte): KohUtilisateur
    {
        $this->typeCompte = $typeCompte;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTokenValidity()
    {
        return $this->token_validity;
    }

    /**
     * @param mixed $token_validity
     * @return KohUtilisateur
     */
    public function setTokenValidity($token_validity): KohUtilisateur
    {
        $this->token_validity = $token_validity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     * @return KohUtilisateur
     */
    public function setCreatedAt($created_at): KohUtilisateur
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageProfile()
    {
        return $this->image_profile;
    }

    /**
     * @param mixed $image_profile
     * @return KohUtilisateur
     */
    public function setImageProfile($image_profile): KohUtilisateur
    {
        $this->image_profile = $image_profile;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     * @return KohUtilisateur
     */
    public function setUpdatedAt($updated_at): KohUtilisateur
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * @return string
     */
    public function serialize(): string
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->authorities,
            $this->isKohUser,
            $this->isActived,
            $this->isAdmin
        ));
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized): void
    {
        [
            $this->id,
            $this->username,
            $this->password,
            $this->authorities,
            $this->isKohUser,
            $this->isActived,
            $this->isAdmin
        ] = unserialize($serialized, ['allowed_classes' => false]);
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = array();

        foreach ($this->getAuthorities() as $role) {
            $roles[] = strtoupper("ROLE_" . $role->getName());
        }
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    /**
     * @return string|null
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @return mixed
     */
    public function eraseCredentials()
    {
        return null;
    }

    /**
     * @return File|null
     * @Ignore
     */
    public function getUserProfile(): ?File
    {
        return $this->userProfile;
    }

    /**
     * @param File|null $user_profile
     * @return KohUtilisateur
     * @throws Exception
     */
    public function setUserProfile(?File $user_profile): KohUtilisateur
    {
        $this->userProfile = $user_profile;
        if ($this->userProfile instanceof UploadedFile) {
            $this->updated_at = new DateTime('now', new DateTimeZone('GMT'));
        }
        return $this;
    }

    public function addAuthority(Authority $authority): self
    {
        if (!$this->authorities->contains($authority)) {
            $this->authorities[] = $authority;
        }

        return $this;
    }

    public function removeAuthority(Authority $authority): self
    {
        if ($this->authorities->contains($authority)) {
            $this->authorities->removeElement($authority);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomUtilisateur()
    {
        return $this->nomUtilisateur = $this->username;
    }

    /**
     * @param mixed $nomUtilisateur
     * @return KohUtilisateur
     */
    public function setNomUtilisateur($nomUtilisateur): KohUtilisateur
    {
        $this->nomUtilisateur = $nomUtilisateur;
        $this->username = $nomUtilisateur;
        return $this;
    }

    public function getStructure(): ?Structure
    {
        return $this->structure;
    }

    public function setStructure(?Structure $structure): self
    {
        $this->structure = $structure;

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
            $bienClient->setKohUtilisateur($this);
        }

        return $this;
    }

    public function removeBienClient(BienClient $bienClient): self
    {
        if ($this->bienClients->contains($bienClient)) {
            $this->bienClients->removeElement($bienClient);
            // set the owning side to null (unless already changed)
            if ($bienClient->getKohUtilisateur() === $this) {
                $bienClient->setKohUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function hasRoleSuperAdmin(): bool
    {
        $roles = $this->authorities;

        foreach ($roles as $role) {
            if (strcmp($role->getName(), 'SUPER_ADMIN') === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasRoleSuperAdminAndIsAdmin(): bool
    {
        return $this->hasRoleSuperAdmin() and $this->isAdmin;
    }

    /**
     * @return bool
     */
    public function hasRoleAdmin(): bool
    {
        $roles = $this->authorities;
        foreach ($roles as $role) {
            if (strcmp($role->getName(), 'ADMIN') === 0) {
                return true;
            }
        }

        return false;
    }

    public function hasRoleAdminAndIsAdmin(): bool
    {
        return $this->hasRoleAdmin() and $this->isAdmin;
    }

    /**
     * @return bool
     */
    public function hasValideSuperAdminCompte(): bool
    {
        return $this->hasRoleSuperAdmin() && $this->isKohUser && $this->isConfirmed && $this->isActived;
    }

    /**
     * @return bool
     */
    public function hasValideAdminCompte(): bool
    {
        return $this->hasRoleAdmin() && !$this->isKohUser && $this->isConfirmed && $this->isActived;
    }

    /**
     * @return Collection|SysAdminOperation[]
     */
    public function getSysAdminOperations(): Collection
    {
        return $this->sysAdminOperations;
    }

    public function addSysAdminOperation(SysAdminOperation $sysAdminOperation): self
    {
        if (!$this->sysAdminOperations->contains($sysAdminOperation)) {
            $this->sysAdminOperations[] = $sysAdminOperation;
            $sysAdminOperation->setKohUtilisateur($this);
        }

        return $this;
    }

    public function removeSysAdminOperation(SysAdminOperation $sysAdminOperation): self
    {
        if ($this->sysAdminOperations->removeElement($sysAdminOperation)) {
            // set the owning side to null (unless already changed)
            if ($sysAdminOperation->getKohUtilisateur() === $this) {
                $sysAdminOperation->setKohUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Expertise[]
     */
    public function getExpertises(): Collection
    {
        return $this->expertises;
    }

    public function addExpertise(Expertise $expertise): self
    {
        if (!$this->expertises->contains($expertise)) {
            $this->expertises[] = $expertise;
            $expertise->setCreatedBy($this);
        }

        return $this;
    }

    public function removeExpertise(Expertise $expertise): self
    {
        if ($this->expertises->removeElement($expertise)) {
            // set the owning side to null (unless already changed)
            if ($expertise->getCreatedBy() === $this) {
                $expertise->setCreatedBy(null);
            }
        }

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
            $memoBien->setCreatedBy($this);
        }

        return $this;
    }

    public function removeMemoBien(MemoBien $memoBien): self
    {
        if ($this->memoBiens->removeElement($memoBien)) {
            // set the owning side to null (unless already changed)
            if ($memoBien->getCreatedBy() === $this) {
                $memoBien->setCreatedBy(null);
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
            $remarqueBien->setCreatedBy($this);
        }

        return $this;
    }

    public function removeRemarqueBien(RemarqueBien $remarqueBien): self
    {
        if ($this->remarqueBiens->removeElement($remarqueBien)) {
            // set the owning side to null (unless already changed)
            if ($remarqueBien->getCreatedBy() === $this) {
                $remarqueBien->setCreatedBy(null);
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
            $otherInfoBien->setCreatedBy($this);
        }

        return $this;
    }

    public function removeOtherInfoBien(OtherInfoBien $otherInfoBien): self
    {
        if ($this->otherInfoBiens->removeElement($otherInfoBien)) {
            // set the owning side to null (unless already changed)
            if ($otherInfoBien->getCreatedBy() === $this) {
                $otherInfoBien->setCreatedBy(null);
            }
        }

        return $this;
    }
}
