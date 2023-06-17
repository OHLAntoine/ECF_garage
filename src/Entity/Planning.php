<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: PlanningRepository::class)]
#[UniqueEntity('dayOfTheWeek', message: "Ce jour de la semaine est déjà rentré")]
class Planning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $dayOfTheWeek = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $morningStart = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $morningEnd = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $afternoonStart = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $afternoonEnd = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayOfTheWeek(): ?string
    {
        return $this->dayOfTheWeek;
    }

    public function setDayOfTheWeek(string $dayOfTheWeek): static
    {
        $this->dayOfTheWeek = $dayOfTheWeek;

        return $this;
    }

    public function getMorningStart(): ?\DateTimeInterface
    {
        return $this->morningStart;
    }

    public function setMorningStart(?\DateTimeInterface $morningStart): static
    {
        $this->morningStart = $morningStart;

        return $this;
    }

    public function getMorningEnd(): ?\DateTimeInterface
    {
        return $this->morningEnd;
    }

    public function setMorningEnd(?\DateTimeInterface $morningEnd): static
    {
        $this->morningEnd = $morningEnd;

        return $this;
    }

    public function getAfternoonStart(): ?\DateTimeInterface
    {
        return $this->afternoonStart;
    }

    public function setAfternoonStart(?\DateTimeInterface $afternoonStart): static
    {
        $this->afternoonStart = $afternoonStart;

        return $this;
    }

    public function getAfternoonEnd(): ?\DateTimeInterface
    {
        return $this->afternoonEnd;
    }

    public function setAfternoonEnd(?\DateTimeInterface $afternoonEnd): static
    {
        $this->afternoonEnd = $afternoonEnd;

        return $this;
    }
}
