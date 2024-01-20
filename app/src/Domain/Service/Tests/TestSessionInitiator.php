<?php

declare(strict_types=1);

namespace App\Domain\Service\Tests;

use App\Domain\Entity\TestsSession;
use App\Domain\Repository\TestRepositoryInterface;
use App\Domain\Repository\TestsSessionRepositoryInterface;
use App\Domain\Service\Exceptions\SessionNotFoundException;
use App\Domain\Service\Exceptions\TestNotFoundException;

class TestSessionInitiator
{
    private const DEFAULT_TEST_ID = 1;

    public function __construct(
        private readonly TestsSessionRepositoryInterface $testSessionsRepository,
        private readonly TestRepositoryInterface $testsRepository,
    ) {
    }

    public function start(int $testId = self::DEFAULT_TEST_ID): TestsSession
    {
        $test = $this->testsRepository->find($testId);
        if ($test === null) {
            throw new TestNotFoundException();
        }

        $session = TestsSession::createFromTest($test);

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
}