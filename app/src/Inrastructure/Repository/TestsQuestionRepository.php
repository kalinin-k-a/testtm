<?php

declare(strict_types=1);

namespace App\Inrastructure\Repository;

use App\Domain\Entity\TestsQuestion;
use App\Domain\Repository\TestQuestionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TestsQuestion>
 *
 * @method TestsQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestsQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestsQuestion[]    findAll()
 * @method TestsQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestsQuestionRepository extends ServiceEntityRepository implements TestQuestionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestsQuestion::class);
    }


//    /**
//     * @return TestsQuestion[] Returns an array of TestsQuestion objects
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

//    public function findOneBySomeField($value): ?TestsQuestion
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
