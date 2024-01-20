<?php

declare(strict_types=1);

namespace App\Inrastructure\Repository;

use App\Domain\Entity\Test;
use App\Domain\Repository\TestRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Test>
 *
 * @method Test|null find($id, $lockMode = null, $lockVersion = null)
 * @method Test|null findOneBy(array $criteria, array $orderBy = null)
 * @method Test[]    findAll()
 * @method Test[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestRepository extends ServiceEntityRepository implements TestRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Test::class);
    }
}
