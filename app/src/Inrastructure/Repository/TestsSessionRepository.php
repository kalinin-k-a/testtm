<?php

declare(strict_types=1);

namespace App\Inrastructure\Repository;

use App\Domain\Entity\TestsSession;
use App\Domain\Repository\TestsSessionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TestsSession>
 *
 * @method TestsSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestsSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestsSession[]    findAll()
 * @method TestsSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestsSessionRepository extends ServiceEntityRepository implements TestsSessionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestsSession::class);
    }
}
