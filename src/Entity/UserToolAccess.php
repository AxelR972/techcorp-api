<?php

namespace App\Entity;

use App\Repository\UserToolAccessRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserToolAccessRepository::class)]
class UserToolAccess
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userToolAccesses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'userToolAccesses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tool $tool = null;

    #[ORM\ManyToOne(inversedBy: 'userToolAccesses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $grantedBy = null;

    #[ORM\ManyToOne(inversedBy: 'userToolAccesses')]
    private ?User $revokedBy = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $grantedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $revokedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

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

    public function getGrantedBy(): ?User
    {
        return $this->grantedBy;
    }

    public function setGrantedBy(?User $grantedBy): static
    {
        $this->grantedBy = $grantedBy;

        return $this;
    }

    public function getRevokedBy(): ?User
    {
        return $this->revokedBy;
    }

    public function setRevokedBy(?User $revokedBy): static
    {
        $this->revokedBy = $revokedBy;

        return $this;
    }

    public function getGrantedAt(): ?\DateTimeImmutable
    {
        return $this->grantedAt;
    }

    public function setGrantedAt(\DateTimeImmutable $grantedAt): static
    {
        $this->grantedAt = $grantedAt;

        return $this;
    }

    public function getRevokedAt(): ?\DateTimeImmutable
    {
        return $this->revokedAt;
    }

    public function setRevokedAt(?\DateTimeImmutable $revokedAt): static
    {
        $this->revokedAt = $revokedAt;

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
}
