<?php

namespace App\Entity;

use App\Repository\UsageLogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsageLogRepository::class)]
class UsageLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'usageLogs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'usageLogs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tool $tool = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $sessionDate = null;

    #[ORM\Column]
    private ?int $usageMinutes = null;

    #[ORM\Column]
    private ?int $actionsCount = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTool(): ?Tool
    {
        return $this->tool;
    }

    public function setTool(?Tool $tool): static
    {
        $this->tool = $tool;

        return $this;
    }

    public function getSessionDate(): ?\DateTime
    {
        return $this->sessionDate;
    }

    public function setSessionDate(\DateTime $sessionDate): static
    {
        $this->sessionDate = $sessionDate;

        return $this;
    }

    public function getUsageMinutes(): ?int
    {
        return $this->usageMinutes;
    }

    public function setUsageMinutes(int $usageMinutes): static
    {
        $this->usageMinutes = $usageMinutes;

        return $this;
    }

    public function getActionsCount(): ?int
    {
        return $this->actionsCount;
    }

    public function setActionsCount(int $actionsCount): static
    {
        $this->actionsCount = $actionsCount;

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
}
