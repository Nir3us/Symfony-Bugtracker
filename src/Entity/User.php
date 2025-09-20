<?php

/**
 * This file is part of the Symfony Bugtracker project.
 *
 * Entity representing a User in the system.
 *
 * (c)Norbert Białek <mlodszy.bialek@gmail.com>
 */

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 12)]
    private ?string $password = null;

    #[ORM\Column(nullable: true)]
    private ?string $roles = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $createdAt = null;

    /**
     * @var Collection<int, Bug>
     */
    #[ORM\OneToMany(
        targetEntity: Bug::class,
        cascade: ['remove'],
        orphanRemoval: true,
        mappedBy: 'reporter',
        fetch: 'EXTRA_LAZY'
    )]
    private Collection $report;

    public function __construct()
    {
        $this->report = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?string
    {
        return $this->roles;
    }

    public function setRoles(?string $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Bug>
     */
    public function getReport(): Collection
    {
        return $this->report;
    }

    public function addReport(Bug $report): static
    {
        if (!$this->report->contains($report)) {
            $this->report->add($report);
            $report->setReporter($this);
        }

        return $this;
    }

    public function removeReport(Bug $report): static
    {
        if ($this->report->removeElement($report)) {
            // set the owning side to null (unless already changed)
            if ($report->getReporter() === $this) {
                $report->setReporter(null);
            }
        }

        return $this;
    }
}
