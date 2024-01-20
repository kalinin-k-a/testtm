<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Inrastructure\Repository\TestQuestionsAnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestQuestionsAnswerRepository::class)]
#[ORM\Table(name: 'tests_questions_answers')]
class TestQuestionsAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 512)]
    private string $caption;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private TestsQuestion $question;

    #[ORM\Column]
    private ?bool $isCorrect = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): static
    {
        $this->caption = $caption;

        return $this;
    }

    public function getQuestionId(): ?TestsQuestion
    {
        return $this->question;
    }

    public function setQuestionId(?TestsQuestion $question): static
    {
        $this->question = $question;

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
}
