<?php

namespace App\Repository;

use App\Entity\RemarqueBien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RemarqueBien|null find($id, $lockMode = null, $lockVersion = null)
 * @method RemarqueBien|null findOneBy(array $criteria, array $orderBy = null)
 * @method RemarqueBien[]    findAll()
 * @method RemarqueBien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RemarqueBienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RemarqueBien::class);
    }

    // /**
    //  * @return RemarqueBien[] Returns an array of RemarqueBien objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RemarqueBien
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
