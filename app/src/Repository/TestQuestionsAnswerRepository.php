<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TestQuestionsAnswer;
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
class TestQuestionsAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestQuestionsAnswer::class);
    }

//    /**
//     * @return TestQestionsAnswer[] Returns an array of TestQestionsAnswer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TestQestionsAnswer
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
