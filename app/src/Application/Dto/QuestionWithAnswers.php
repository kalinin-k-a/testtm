<?php

namespace App\Application\Dto;

final readonly class QuestionWithAnswers
{
    /**
     * @param QuestionAnswer[] $answers
     */
    public function __construct(
       public int $questionId,
       public string $questionCaption,
       public array $answers,
    ) {
    }
}