<?php

declare(strict_types=1);

namespace App\Inrastructure\Repository;

use App\Domain\Entity\TestsSessionAnswer;
use App\Domain\Repository\TestsSessionAnswerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TestsSessionAnswer>
 *
 * @method TestsSessionAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestsSessionAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestsSessionAnswer[]    findAll()
 * @method TestsSessionAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestsSessionAnswerRepository extends ServiceEntityRepository implements TestsSessionAnswerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestsSessionAnswer::class);
    }

    public function findBySession(int $sessionId): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.session = :sessionId')
            ->setParameter('sessionId', $sessionId)
            ->getQuery()
            ->getResult();
    }

    public function existsBySessionAndQuestion(int $sessionId, int $questionId): bool
    {
        return (bool)$this->createQueryBuilder('t')
            ->select('t.id')
            ->andWhere('t.session = :sessionId')
            ->andWhere('t.question = :questionId')
            ->setMaxResults(1)
            ->setParameter('sessionId', $sessionId)
            ->setParameter('questionId', $questionId)
            ->getQuery()
            ->getResult();
    }
}
