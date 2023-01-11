<?php

namespace App\Repository;

use App\Entity\TypeUsageBien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeUsageBien|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeUsageBien|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeUsageBien[]    findAll()
 * @method TypeUsageBien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeUsageBienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeUsageBien::class);
    }

    // /**
    //  * @return TypeUsageBien[] Returns an array of TypeUsageBien objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeUsageBien
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
