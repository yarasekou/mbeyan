<?php

namespace App\Repository;

use App\Entity\SysAdminOperation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SysAdminOperation|null find($id, $lockMode = null, $lockVersion = null)
 * @method SysAdminOperation|null findOneBy(array $criteria, array $orderBy = null)
 * @method SysAdminOperation[]    findAll()
 * @method SysAdminOperation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SysAdminOperationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SysAdminOperation::class);
    }


    public function getSysOperationQuery()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.createdAt', 'DESC')
            ->getQuery();
    }

    // /**
    //  * @return SysAdminOperation[] Returns an array of SysAdminOperation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SysAdminOperation
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
