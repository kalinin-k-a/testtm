<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\TestsSession;

interface TestsSessionRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return ?TestsSession
     */
    public function find($id);
}
