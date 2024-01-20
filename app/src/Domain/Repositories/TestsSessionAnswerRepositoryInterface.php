<?php

declare(strict_types=1);

namespace App\Domain\Repository;

interface TestsSessionAnswerRepositoryInterface
{
    public function findBySession(int $sessionId): array;

    public function existsBySessionAndQuestion(int $sessionId, int $questionId): bool;
}
