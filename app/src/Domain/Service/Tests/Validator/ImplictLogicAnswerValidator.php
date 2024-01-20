<?php

declare(strict_types=1);

namespace App\Domain\Service\Tests\Validator;

use App\Domain\Dto\ValidationResultDto;

class ImplictLogicAnswerValidator implements AnswerValidator
{
    public function validate(array $possibleAnswers, array $userAnswersNumbers): ValidationResultDto
    {
        if (count($userAnswersNumbers) < 1) {
            throw new \InvalidArgumentException("Empty answer");
        }

        $result = true;
        foreach ($userAnswersNumbers as $answerNumber) {
            if (!isset($possibleAnswers[$answerNumber])) {
                throw new \OutOfRangeException("Answer {$answerNumber} does not exist");
            }

            if (!$possibleAnswers[$answerNumber]->isCorrect()) {
                $result = false;
                break;
            }
        }

        return new ValidationResultDto($result, $userAnswersNumbers, $possibleAnswers);
    }
}