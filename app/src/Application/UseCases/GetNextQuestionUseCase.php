<?php

namespace App\Application\UseCases;


use App\Application\Dto\QuestionAnswer;
use App\Application\Dto\QuestionWithAnswers;
use App\Domain\Entity\TestsQuestion;
use App\Domain\Entity\TestsSession;
use App\Domain\Service\Tests\TestQuestionSelector;
use Doctrine\ORM\EntityManagerInterface;

class GetNextQuestionUseCase
{
    public function __construct(
        private readonly TestQuestionSelector $questionSelector,
        private readonly EntityManagerInterface $em,
    ) {

    }

    public function execute(TestsSession $session): ?QuestionWithAnswers
    {
        $this->em->refresh($session);
        $question = $this->questionSelector->getUnanswerred($session);
        if (null == $question) {
            return null;
        }

        return new QuestionWithAnswers(
            $question->getId(),
            $question->getCaption(),
            $this->getRandomAnswers($question)
        );
    }

    /**
     * @return QuestionAnswer[]
     */
    private function getRandomAnswers(TestsQuestion $question): array
    {
        $answersEntities = $question->getAnswers()->toArray();
        $answers = [];
        foreach ($answersEntities as $answer) {
            $answers[] = new QuestionAnswer($answer->getId(), $answer->getCaption());
        }
        shuffle($answers);

        return $answers;
    }
}