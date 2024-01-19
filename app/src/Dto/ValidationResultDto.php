<?php

namespace App\Dto;

use App\Entity\TestQuestionsAnswer;

readonly final class ValidationResultDto
{
    /**
     * @param TestQuestionsAnswer[] $possibleAnswers
     */
    public function __construct(
        public bool $isCorrect,
        public array $userAnswerNumbers,
        public array $possibleAnswers,
    ) {
    }
}