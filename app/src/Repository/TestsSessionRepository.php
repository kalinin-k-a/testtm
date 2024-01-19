<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TestsSession;
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
class TestsSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestsSession::class);
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
