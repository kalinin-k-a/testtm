<?php

namespace App\Application\UseCases;


use App\Application\Dto\QuestionWithAnswers;
use App\Domain\Entity\TestQuestionsAnswer;
use App\Domain\Entity\TestsQuestion;
use App\Domain\Entity\TestsSession;
use App\Domain\Entity\TestsSessionAnswer;
use App\Domain\Repository\TestsSessionAnswerRepositoryInterface;
use App\Domain\Service\Tests\AnswerParser\AnswerParser;
use App\Domain\Service\Tests\TestQuestionSelector;
use App\Domain\Service\Tests\Validator\AnswerValidator;
use Doctrine\ORM\EntityManagerInterface;

readonly class ListResultsUseCase
{
    public function __construct(
        private TestsSessionAnswerRepositoryInterface $sessionAnswerRepository,
    ) {
    }

    /**
     * @param int $sessionId
     *
     * @return TestsSessionAnswer[]
     */
    public function listResults(int $sessionId): array
    {
        return $this->sessionAnswerRepository->findBySession($sessionId);
    }
}