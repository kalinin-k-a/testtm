<?php

declare(strict_types=1);

namespace App\Domain\Service\Tests;

use App\Domain\Entity\TestQuestionsAnswer;
use App\Domain\Entity\TestsQuestion;
use App\Domain\Entity\TestsSession;
use App\Domain\Entity\TestsSessionAnswer;
use App\Domain\Repository\TestsSessionAnswerRepositoryInterface;
use App\Domain\Repository\TestsSessionRepositoryInterface;
use App\Domain\Service\Exceptions\SessionNotFoundException;
use App\Domain\Service\Exceptions\TestNotFoundException;
use App\Domain\Service\Tests\AnswerParser\AnswerParser;
use App\Domain\Service\Tests\Validator\AnswerValidator;
use App\Domain\ValueObjects\AnswerSnapshot;
use Doctrine\ORM\EntityManagerInterface;

class TestQuestionSelector
{
    public function getUnanswerred(TestsSession $session): ?TestsQuestion
    {
        $allQuestions = $session->getTest()?->getQuestions() ?? [];

        $answersIndexed = [];
        foreach ($session->getAnswers() as $answer) {
            $answersIndexed[$answer->getQuestion()->getId()] = $answer;
        }

        $allQuestionsArray = $allQuestions->toArray();
        shuffle($allQuestionsArray);
        foreach($allQuestionsArray as $question) {
            if (!isset($answersIndexed[$question->getId()])) {
                return $question;
            }
        }

        return null;
    }
}