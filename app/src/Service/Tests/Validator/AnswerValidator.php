<?php

declare(strict_types=1);

namespace App\Service\Tests\Validator;

use App\Dto\ValidationResultDto;
use App\Entity\TestQuestionsAnswer;

interface AnswerValidator
{
    /**
     * @param TestQuestionsAnswer[] $possibleAnswers
     * @param int[] $userAnswersNumbers
     *
     * @throws \InvalidArgumentException
     * @throws \OutOfRangeException
     */
    public function validate(array $possibleAnswers, array $userAnswersNumbers): ValidationResultDto;
}