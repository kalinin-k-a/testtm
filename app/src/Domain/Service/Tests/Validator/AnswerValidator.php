<?php

declare(strict_types=1);

namespace App\Domain\Service\Tests\Validator;

use App\Domain\Dto\ValidationResultDto;

interface AnswerValidator
{
    /**
     * @param IsCorrect[] $possibleAnswers
     * @param int[] $userAnswersNumbers
     *
     * @throws \InvalidArgumentException
     * @throws \OutOfRangeException
     */
    public function validate(array $possibleAnswers, array $userAnswersNumbers): ValidationResultDto;
}