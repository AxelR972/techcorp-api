<?php

namespace App\Entity;

use App\Repository\ToolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ToolRepository::class)]
class Tool
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tools')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $text = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $vendor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $websiteUrl = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $monthlyCost = null;

    #[ORM\Column]
    private ?int $activeUsersCount = null;

    #[ORM\Column(length: 255)]
    private ?string $ownerDepartment = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, AccessRequest>
     */
    #[ORM\OneToMany(targetEntity: AccessRequest::class, mappedBy: 'tool')]
    private Collection $accessRequests;

    /**
     * @var Collection<int, UsageLog>
     */
    #[ORM\OneToMany(targetEntity: UsageLog::class, mappedBy: 'tool')]
    private Collection $usageLogs;

    /**
     * @var Collection<int, UserToolAccess>
     */
    #[ORM\OneToMany(targetEntity: UserToolAccess::class, mappedBy: 'tool')]
    private Collection $userToolAccesses;

    /**
     * @var Collection<int, CostTracking>
     */
    #[ORM\OneToMany(targetEntity: CostTracking::class, mappedBy: 'tool')]
    private Collection $costTrackings;

    public function __construct()
    {
        $this->accessRequests = new ArrayCollection();
        $this->usageLogs = new ArrayCollection();
        $this->userToolAccesses = new ArrayCollection();
        $this->costTrackings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getVendor(): ?string
    {
        return $this->vendor;
    }

    public function setVendor(?string $vendor): static
    {
        $this->vendor = $vendor;

        return $this;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->websiteUrl;
    }

    public function setWebsiteUrl(?string $websiteUrl): static
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    public function getMonthlyCost(): ?string
    {
        return $this->monthlyCost;
    }

    public function setMonthlyCost(string $monthlyCost): static
    {
        $this->monthlyCost = $monthlyCost;

        return $this;
    }

    public function getActiveUsersCount(): ?int
    {
        return $this->activeUsersCount;
    }

    public function setActiveUsersCount(int $activeUsersCount): static
    {
        $this->activeUsersCount = $activeUsersCount;

        return $this;
    }

    public function getOwnerDepartment(): ?string
    {
        return $this->ownerDepartment;
    }

    public function setOwnerDepartment(string $ownerDepartment): static
    {
        $this->ownerDepartment = $ownerDepartment;

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
            $accessRequest->setTool($this);
        }

        return $this;
    }

    public function removeAccessRequest(AccessRequest $accessRequest): static
    {
        if ($this->accessRequests->removeElement($accessRequest)) {
            // set the owning side to null (unless already changed)
            if ($accessRequest->getTool() === $this) {
                $accessRequest->setTool(null);
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
            $usageLog->setTool($this);
        }

        return $this;
    }

    public function removeUsageLog(UsageLog $usageLog): static
    {
        if ($this->usageLogs->removeElement($usageLog)) {
            // set the owning side to null (unless already changed)
            if ($usageLog->getTool() === $this) {
                $usageLog->setTool(null);
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
            $userToolAccess->setTool($this);
        }

        return $this;
    }

    public function removeUserToolAccess(UserToolAccess $userToolAccess): static
    {
        if ($this->userToolAccesses->removeElement($userToolAccess)) {
            // set the owning side to null (unless already changed)
            if ($userToolAccess->getTool() === $this) {
                $userToolAccess->setTool(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CostTracking>
     */
    public function getCostTrackings(): Collection
    {
        return $this->costTrackings;
    }

    public function addCostTracking(CostTracking $costTracking): static
    {
        if (!$this->costTrackings->contains($costTracking)) {
            $this->costTrackings->add($costTracking);
            $costTracking->setTool($this);
        }

        return $this;
    }

    public function removeCostTracking(CostTracking $costTracking): static
    {
        if ($this->costTrackings->removeElement($costTracking)) {
            // set the owning side to null (unless already changed)
            if ($costTracking->getTool() === $this) {
                $costTracking->setTool(null);
            }
        }

        return $this;
    }
}
