<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 150)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $department = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $hireDate = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, AccessRequest>
     */
    #[ORM\OneToMany(targetEntity: AccessRequest::class, mappedBy: 'user')]
    private Collection $accessRequests;

    /**
     * @var Collection<int, UsageLog>
     */
    #[ORM\OneToMany(targetEntity: UsageLog::class, mappedBy: 'user')]
    private Collection $usageLogs;

    /**
     * @var Collection<int, UserToolAccess>
     */
    #[ORM\OneToMany(targetEntity: UserToolAccess::class, mappedBy: 'user')]
    private Collection $userToolAccesses;

    public function __construct()
    {
        $this->accessRequests = new ArrayCollection();
        $this->usageLogs = new ArrayCollection();
        $this->userToolAccesses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(string $department): static
    {
        $this->department = $department;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getHireDate(): ?\DateTime
    {
        return $this->hireDate;
    }

    public function setHireDate(?\DateTime $hireDate): static
    {
        $this->hireDate = $hireDate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, AccessRequest>
     */
    public function getAccessRequests(): Collection
    {
        return $this->accessRequests;
    }

    public function addAccessRequest(AccessRequest $accessRequest): static
    {
        if (!$this->accessRequests->contains($accessRequest)) {
            $this->accessRequests->add($accessRequest);
            $accessRequest->setUser($this);
        }

        return $this;
    }

    public function removeAccessRequest(AccessRequest $accessRequest): static
    {
        if ($this->accessRequests->removeElement($accessRequest)) {
            // set the owning side to null (unless already changed)
            if ($accessRequest->getUser() === $this) {
                $accessRequest->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UsageLog>
     */
    public function getUsageLogs(): Collection
    {
        return $this->usageLogs;
    }

    public function addUsageLog(UsageLog $usageLog): static
    {
        if (!$this->usageLogs->contains($usageLog)) {
            $this->usageLogs->add($usageLog);
            $usageLog->setUser($this);
        }

        return $this;
    }

    public function removeUsageLog(UsageLog $usageLog): static
    {
        if ($this->usageLogs->removeElement($usageLog)) {
            // set the owning side to null (unless already changed)
            if ($usageLog->getUser() === $this) {
                $usageLog->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserToolAccess>
     */
    public function getUserToolAccesses(): Collection
    {
        return $this->userToolAccesses;
    }

    public function addUserToolAccess(UserToolAccess $userToolAccess): static
    {
        if (!$this->userToolAccesses->contains($userToolAccess)) {
            $this->userToolAccesses->add($userToolAccess);
            $userToolAccess->setUser($this);
        }

        return $this;
    }

    public function removeUserToolAccess(UserToolAccess $userToolAccess): static
    {
        if ($this->userToolAccesses->removeElement($userToolAccess)) {
            // set the owning side to null (unless already changed)
            if ($userToolAccess->getUser() === $this) {
                $userToolAccess->setUser(null);
            }
        }

        return $this;
    }
}
