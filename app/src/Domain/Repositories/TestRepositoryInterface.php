<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Test;

interface TestRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return ?Test
     */
    public function find($id);
}
