<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Inrastructure\Repository\TestsSessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestsSessionRepository::class)]
#[ORM\Table(name: 'tests_sessions')]
class TestsSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne()]
    private Test $test;

    #[ORM\Column()]
    private bool $isCompleted;

    #[ORM\OneToMany(mappedBy: 'session', targetEntity: TestsSessionAnswer::class)]
    private Collection $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }

    public function getTest(): ?Test
    {
        return $this->test;
    }

    public function setTest(Test $test): self
    {
        $this->test = $test;

        return $this;
    }

    public function setCompleted(bool $yes): self
    {
        $this->isCompleted = $yes;

        return $this;
    }

    public static function createFromTest(Test $test): self
    {
        return (new self())->setTest($test)->setCompleted(false);
    }

    /**
     * @return Collection<int, TestsSessionAnswer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

}
