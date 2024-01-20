<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\TestsQuestion;

interface TestQuestionRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return ?TestsQuestion
     */
    public function find($id);
}
