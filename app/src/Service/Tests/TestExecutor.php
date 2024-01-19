<?php

declare(strict_types=1);

namespace App\Service\Tests;

use App\Entity\TestQuestionsAnswer;
use App\Entity\TestsQuestion;
use App\Entity\TestsSession;
use App\Entity\TestsSessionAnswer;
use App\Repository\TestRepository;
use App\Repository\TestsSessionAnswerRepository;
use App\Repository\TestsSessionRepository;
use App\Service\Exceptions\SessionNotFoundException;
use App\Service\Exceptions\TestNotFoundException;
use App\Service\Tests\AnswerParser\AnswerParser;
use App\Service\Tests\Validator\AnswerValidator;
use App\ValueObjects\AnswerSnapshot;
use Doctrine\ORM\EntityManagerInterface;

class TestExecutor
{
    private const DEFAULT_TEST_ID = 1;

    public function __construct(
        // todo - make dependency on interfaces
        private readonly TestsSessionAnswerRepository $sessionAnswerRepository,
        private readonly TestsSessionRepository $testSessionsRepository,
        private readonly TestRepository $testsRepository,
        private readonly EntityManagerInterface $em,
        private readonly AnswerParser $answerParser,
        private readonly AnswerValidator $answerValidator,
    ) {
    }

    public function start(int $testId = self::DEFAULT_TEST_ID): TestsSession
    {
        $test = $this->testsRepository->find($testId);
        if ($test === null) {
            throw new TestNotFoundException();
        }

        $session = TestsSession::createFromTest($test);
        $this->em->persist($session);
        $this->em->flush();

        return $session;
    }

    public function resume(int $sessionId): TestsSession
    {
        $session = $this->testSessionsRepository->find($sessionId);
        if ($session === null) {
            throw new SessionNotFoundException();
        }

        return $session;
    }

    /**
     * @param TestQuestionsAnswer[] $shownAnswers
     *
     * @return void
     */
    public function storeAnswer(
        TestsSession $session,
        TestsQuestion $question,
        array $shownAnswers,
        string $userAnswerString
    ): void  {
        if ($this->sessionAnswerRepository->existsBySessionAndQuestion($session->getId(), $question->getId())) {
           throw new \LogicException('Attempt to reanswer a question');
        }

        $answerredNumbers = $this->answerParser->parse($userAnswerString);
        $validationResult = $this->answerValidator->validate($shownAnswers, $answerredNumbers);

        $sessionAnswer = TestsSessionAnswer::createFromUserAnswer(
            question: $question,
            session: $session,
            snapshot: AnswerSnapshot::fromAnswersEntitiesAndUserAnswer($shownAnswers, $answerredNumbers),
            isCorrect: $validationResult->isCorrect
        );
        $this->em->persist($sessionAnswer);
        $this->em->flush();
    }

    /**
     * @return TestsSessionAnswer[]
     */
    public function listResults(int $sessionId): array
    {
        return $this->sessionAnswerRepository->findBySession($sessionId);
    }

    public function isCompleted(TestsSession $session): bool
    {
        return count($this->getUnanswerredQuestions($session)) === 0;
    }

    public function next(TestsSession $session): TestsQuestion
    {
        $unAnswerredQuetions = $this->getUnanswerredQuestions($session);

        if (count($unAnswerredQuetions) === 0) {
            throw new \LogicException('There is no next question');
        }

        return $unAnswerredQuetions[array_rand($unAnswerredQuetions)];
    }

    private function getUnanswerredQuestions(TestsSession $session): array
    {
        $this->em->refresh($session);
        $allQuestions = $session->getTest()?->getQuestions();

        $answersIndexed = [];
        foreach ($session->getAnswers() as $answer) {
            $answersIndexed[$answer->getQuestion()->getId()] = $answer;
        }

        $unAnswerredQuetions = [];
        foreach($allQuestions as $question) {
            if (!isset($answersIndexed[$question->getId()])) {
                $unAnswerredQuetions[] = $question;
            }
        }

        return $unAnswerredQuetions;
    }
}