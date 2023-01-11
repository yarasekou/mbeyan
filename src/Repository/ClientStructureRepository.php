<?php

namespace App\Repository;

use App\Entity\ClientStructure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClientStructure|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientStructure|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientStructure[]    findAll()
 * @method ClientStructure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientStructureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientStructure::class);
    }

    // /**
    //  * @return ClientStructure[] Returns an array of ClientStructure objects
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
    public function findOneBySomeField($value): ?ClientStructure
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
