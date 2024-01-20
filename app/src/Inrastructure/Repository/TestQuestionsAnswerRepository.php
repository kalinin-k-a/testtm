<?php

declare(strict_types=1);

namespace App\Inrastructure\Repository;

use App\Domain\Entity\TestQuestionsAnswer;
use App\Domain\Repository\TestQuestionAnswerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TestQuestionsAnswer>
 *
 * @method TestQuestionsAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestQuestionsAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestQuestionsAnswer[]    findAll()
 * @method TestQuestionsAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestQuestionsAnswerRepository extends ServiceEntityRepository implements TestQuestionAnswerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestQuestionsAnswer::class);
    }

    public function findOrderedByIds(int ...$ids): array
    {
        $result = $this->createQueryBuilder('t')
            ->andWhere('t.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();

        $indexedResult = [];
        foreach ($result as $answer) {
            $indexedResult[$answer->getId()] = $answer;
        }

        $orderedResult = [];
        foreach ($ids as $id) {
            $orderedResult[] = $indexedResult[$id];
        }

        return $orderedResult;
    }
}
