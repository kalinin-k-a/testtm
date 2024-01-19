<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\Tests\TestExecutor;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:test',
    description: 'runs test'
)]
class TestExecuteCommand extends Command
{
    public function __construct(
        private readonly TestExecutor $testExecutor,
        //private readonly ResultsPresenter $resultsPresenter,
    ) {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Enter session id to resume or leave it empty to start new test');
        $sessionId = trim(fgets(STDIN));

        if ($sessionId) {
            $session = $this->testExecutor->resume((int)$sessionId);
        } else {
            $session = $this->testExecutor->start();
        }

        $output->writeln('Your session ID is ' . $session->getId() . '. You can use it to resume the test');
        while (!$this->testExecutor->isCompleted($session)) {
            $question = $this->testExecutor->next($session);
            $output->writeln('Question: ' . $question->getCaption());

            $answers = $question->getRandomAnswers();

            foreach ($answers as $i => $answer) {
                $output->writeln("{$i}: {$answer->getCaption()}");
            }
            $output->writeln("Chose at least one answer. Enter numbers, separated by ',' or spase. ");
            $output->writeln("For example 1,2,3 or 1 2 3 ");
            do {
                try {
                    $userAnswer = trim(fgets(STDIN));

                    $this->testExecutor->storeAnswer($session, $question, $answers, $userAnswer);
                    break;
                } catch (\InvalidArgumentException|\OutOfRangeException $e) {
                    $output->writeln($e->getMessage());
                    $output->writeln("Enter another answer");
                }
            } while (true);
            $output->writeln('');
        }

        $output->writeln("Test is completed! Your results are below:");
        $storedAnswers = $this->testExecutor->listResults($session->getId());

        foreach ($storedAnswers as $storedAnswer) {
            $output->writeln("Question: " . $storedAnswer->getQuestion()->getCaption());
            $output->writeln("Shown answers: ");
            foreach ($storedAnswer->getSnapshot()->possibleAnswers as $i => $answerText) {
                $output->writeln("{$i}: {$answerText}");
            }

            $output->writeln("Your answers: " . implode(', ', $storedAnswer->getSnapshot()->userAnswerNumbers));
            $output->writeln("Result: " . (["wrong", "correct"][$storedAnswer->isCorrect()]));
            $output->writeln("");
        }


        return Command::SUCCESS;
    }
}