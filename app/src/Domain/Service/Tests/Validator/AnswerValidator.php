<?php

declare(strict_types=1);

namespace App\Domain\Service\Tests\Validator;

use App\Domain\Dto\ValidationResultDto;
use App\Domain\Entity\TestQuestionsAnswer;

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