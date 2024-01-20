<?php

namespace App\Application\UseCases;


use App\Domain\Entity\TestsSession;
use App\Domain\Repository\TestQuestionAnswerRepositoryInterface;
use App\Domain\Repository\TestQuestionRepositoryInterface;
use App\Domain\Service\Tests\AnswerParser\AnswerParser;
use App\Domain\Service\Tests\TestQuestionAnswerSaver;
use App\Domain\Service\Tests\Validator\AnswerValidator;
use Doctrine\ORM\EntityManagerInterface;

class StoreUserAnswerUseCase
{
    public function __construct(
        private readonly TestQuestionRepositoryInterface $questionsRepsitory,
        private readonly TestQuestionAnswerRepositoryInterface $answersRepsitory,
        private readonly AnswerParser $answerParser,
        private readonly AnswerValidator $answerValidator,
        private readonly TestQuestionAnswerSaver $saver,
        private readonly EntityManagerInterface $em,
    ) {

    }

    /**
     * @param int[] $orderedAnswersIds
     *
     */
    public function execute(
        TestsSession $session,
        int $questionId,
        array $orderedAnswersIds,
        string $userAnswerString
    ): void  {
        $answerredNumbers = $this->answerParser->parse($userAnswerString);

        $shownAnswers = $this->answersRepsitory->findOrderedByIds(...$orderedAnswersIds);
        $validationResult = $this->answerValidator->validate($shownAnswers, $answerredNumbers);

        $sessionAnswer = $this->saver->save(
            session: $session,
            question: $this->questionsRepsitory->find($questionId),
            shownAnswers: $shownAnswers,
            userAnswerNumbers: $answerredNumbers,
            validationResult: $validationResult
        );

        $this->em->persist($sessionAnswer);
        $this->em->flush();
    }
}