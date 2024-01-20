<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObjects\AnswerSnapshot;
use App\Inrastructure\Repository\TestsSessionAnswerRepository;
use App\Inrastructure\Types\AnswerSnapshotType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestsSessionAnswerRepository::class)]
#[ORM\Table(name: 'tests_sessions_answers')]
class TestsSessionAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne()]
    private ?TestsQuestion $question = null;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne()]
    private ?TestsSession $session = null;

    #[ORM\Column]
    private ?bool $isCorrect = null;

    #[ORM\Column(type: AnswerSnapshotType::NAME)]
    private ?AnswerSnapshot $snapshot = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?TestsQuestion
    {
        return $this->question;
    }

    public function setQuestion(TestsQuestion $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function setSession(TestsSession $session): static
    {
        $this->session = $session;

        return $this;
    }

    public function isCorrect(): ?bool
    {
        return $this->isCorrect;
    }

    public function setIsCorrect(bool $isCorrect): static
    {
        $this->isCorrect = $isCorrect;

        return $this;
    }

    public function getSnapshot(): ?AnswerSnapshot
    {
        return $this->snapshot;
    }

    public function setSnapshot(AnswerSnapshot $snapshot): static
    {
        $this->snapshot = $snapshot;

        return $this;
    }

    public function getSession(): TestsSession
    {
        return $this->session;
    }

    public static function createFromUserAnswer(
        TestsQuestion $question,
        TestsSession $session,
        AnswerSnapshot $snapshot,
        bool $isCorrect
    ): self {
        return (new self())
            ->setIsCorrect($isCorrect)
            ->setSnapshot($snapshot)
            ->setQuestion($question)
            ->setSession($session);
    }
}
