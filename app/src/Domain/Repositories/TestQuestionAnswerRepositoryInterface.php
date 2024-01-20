<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\TestQuestionsAnswer;

interface TestQuestionAnswerRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return TestQuestionsAnswer[]
     */
    public function findOrderedByIds(int ...$ids): array;
}
