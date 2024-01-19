<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TestsQuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestsQuestionRepository::class)]
#[ORM\Table(name: 'tests_questions')]
class TestsQuestion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 512)]
    private ?string $caption = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Test $test = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: TestQuestionsAnswer::class, orphanRemoval: true)]
    private Collection $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

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

    public function getTest(): ?Test
    {
        return $this->test;
    }

    /**
     * @return TestQuestionsAnswer[]
     */
    public function getRandomAnswers(): array
    {
        $answers = $this->answers->toArray();
        shuffle($answers);

        return $answers;
    }

    public function addAnswer(TestQuestionsAnswer $answer): static
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setQuestionId($this);
        }

        return $this;
    }

    public function removeAnswer(TestQuestionsAnswer $answer): static
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestionId() === $this) {
                $answer->setQuestionId(null);
            }
        }

        return $this;
    }
}
