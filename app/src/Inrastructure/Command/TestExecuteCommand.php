<?php

declare(strict_types=1);

namespace App\Inrastructure\Command;

use App\Application\Dto\QuestionAnswer;
use App\Application\UseCases\GetNextQuestionUseCase;
use App\Application\UseCases\InitTestSessionUseCase;
use App\Application\UseCases\ListResultsUseCase;
use App\Application\UseCases\StoreUserAnswerUseCase;
use App\Inrastructure\Presenter\ListResultPresenter;
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
        private readonly InitTestSessionUseCase $testInitiator,
        private readonly GetNextQuestionUseCase $nextQuestionGetter,
        private readonly StoreUserAnswerUseCase $saver,
        private readonly ListResultsUseCase $listUseCase,
        private readonly ListResultPresenter $listResultPreenter,
    ) {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $session = $this->testInitiator->execute();

        $output->writeln('<info>Your session ID is ' . $session->getId() . '. You can use it to resume the test</info>');
        $output->writeln("<comment>For each question chose at least one answer. Enter numbers, separated by ',' or spase. </comment>");
        $output->writeln("For example 1,2,3 or 1 2 3 ");

        while ($question = $this->nextQuestionGetter->execute($session)) {
            $output->writeln('<question>Question</question>: ' . $question->questionCaption);

            foreach ($question->answers as $i => $answer) {
                $output->writeln("{$i}: {$answer->caption}");
            }

            do {
                try {
                    $userAnswer = trim(fgets(STDIN));
                    $this->saver->execute(
                        $session,
                        $question->questionId,
                        array_map(fn (QuestionAnswer $qa) => $qa->id, $question->answers),
                        $userAnswer
                    );
                    break;
                } catch (\InvalidArgumentException|\OutOfRangeException $e) {
                    $output->writeln('<error>' . $e->getMessage() . '</error>>');
                    $output->writeln("<question>Enter another answer</question>");
                }
            } while (true);
            $output->writeln('');
        }

        $result = $this->listUseCase->listResults($session->getId());
        $output->writeln("<info>Test is completed! Your results are below</info>:");
        $output->writeln(
           $this->listResultPreenter->present($result)
        );

        return Command::SUCCESS;
    }
}