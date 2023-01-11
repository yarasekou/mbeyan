<?php

namespace App\Repository;

use App\Entity\TypeAcquisition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeAcquisition|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeAcquisition|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeAcquisition[]    findAll()
 * @method TypeAcquisition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeAcquisitionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeAcquisition::class);
    }

    // /**
    //  * @return TypeAcquisition[] Returns an array of TypeAcquisition objects
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
    public function findOneBySomeField($value): ?TypeAcquisition
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
