<?php

namespace App\Inrastructure\DataProvider;

use App\Application\DataProvider\UserSessionIdDataProvider;
use Symfony\Component\Console\Output\OutputInterface;

class CliBasedUserSessionIdDataProvider implements UserSessionIdDataProvider
{
    public function __construct(
        private readonly OutputInterface $output
    ) {

    }

    public function getSessionId(): int
    {
        $this->output->writeln('Enter session id to resume or leave it empty to start new test');

        return (int)trim(fgets(STDIN));
    }
}