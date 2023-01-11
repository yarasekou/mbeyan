<?php

namespace App\Repository;

use App\Entity\Cercle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cercle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cercle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cercle[]    findAll()
 * @method Cercle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CercleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cercle::class);
    }

    // /**
    //  * @return Cercle[] Returns an array of Cercle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cercle
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
