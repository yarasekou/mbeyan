<?php

namespace App\Repository;

use App\Entity\OtherInfoBien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OtherInfoBien|null find($id, $lockMode = null, $lockVersion = null)
 * @method OtherInfoBien|null findOneBy(array $criteria, array $orderBy = null)
 * @method OtherInfoBien[]    findAll()
 * @method OtherInfoBien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OtherInfoBienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OtherInfoBien::class);
    }

    // /**
    //  * @return OtherInfoBien[] Returns an array of OtherInfoBien objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OtherInfoBien
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
