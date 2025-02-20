<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ParticipationRepository::class)]
class Participation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Positive(message: "Le montant du don doit être positif.")]
    private ?float $amount = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $participantDate = null;

    #[ORM\ManyToOne(targetEntity: Project::class,inversedBy: 'participations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $project = null;

    #[ORM\ManyToOne(targetEntity: Person::class,inversedBy: 'participations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Person $donator = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getParticipantDate(): ?\DateTimeInterface
    {
        return $this->participantDate;
    }

    public function setParticipantDate(\DateTimeInterface $participantDate): static
    {
        $this->participantDate = $participantDate;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): static
    {
        $this->project = $project;

        return $this;
    }

    public function getDonator(): ?Person
    {
        return $this->donator;
    }

    public function setDonator(?Person $donator): static
    {
        $this->donator = $donator;

        return $this;
    }
}
