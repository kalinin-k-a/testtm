<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Inrastructure\Repository\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestRepository::class)]
#[ORM\Table(name: 'tests')]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 512)]
    private string $caption;

    #[ORM\Column(length: 4096)]
    private string $description;

    #[ORM\OneToMany(mappedBy: 'test', targetEntity: TestsQuestion::class, orphanRemoval: true)]
    private Collection $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, TestsQuestion>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }
}
