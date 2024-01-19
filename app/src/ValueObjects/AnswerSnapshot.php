<?php

namespace App\ValueObjects;

use App\Entity\TestQuestionsAnswer;

readonly final class AnswerSnapshot
{
    public function __construct(
        public array $possibleAnswers,
        public array $userAnswerNumbers,
    ) {
    }

    /**
     * @param TestQuestionsAnswer[] $possibleAnswers
     */
    public static function fromAnswersEntitiesAndUserAnswer(array $possibleAnswers, array $userAnswerNumbers): self
    {
        $possibleAnswersCaptions = array_map(fn (TestQuestionsAnswer $answer) => $answer->getCaption(), $possibleAnswers);

        return new self($possibleAnswersCaptions, $userAnswerNumbers);
    }
}