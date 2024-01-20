<?php

declare(strict_types=1);

namespace App\Domain\Service\Tests;

use App\Domain\Dto\ValidationResultDto;
use App\Domain\Entity\TestsQuestion;
use App\Domain\Entity\TestsSession;
use App\Domain\Entity\TestsSessionAnswer;
use App\Domain\Repository\TestsSessionAnswerRepositoryInterface;
use App\Domain\ValueObjects\AnswerSnapshot;

class TestQuestionAnswerSaver
{
    public function __construct(
        private readonly TestsSessionAnswerRepositoryInterface  $sessionAnswerRepository
    ) {

    }

    /**
     * @param int[] $userAnswerNumbers
     */
    public function save(
        TestsSession $session,
        TestsQuestion $question,
        array $shownAnswers,
        array $userAnswerNumbers,
        ValidationResultDto $validationResult
    ): TestsSessionAnswer  {
        if ($this->sessionAnswerRepository->existsBySessionAndQuestion($session->getId(), $question->getId())) {
            throw new \LogicException('Attempt to reanswer a question');
        }

        if ($session->getTest()->getId() !== $question->getTest()->getId()) {
            throw new \LogicException('This question is from another test');
        }

        return TestsSessionAnswer::createFromUserAnswer(
            question: $question,
            session: $session,
            snapshot: AnswerSnapshot::fromAnswersEntitiesAndUserAnswer($shownAnswers, $userAnswerNumbers),
            isCorrect: $validationResult->isCorrect
        );
    }
}