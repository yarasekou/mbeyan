<?php

namespace App\Repository;

use App\Entity\OtherDocument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OtherDocument|null find($id, $lockMode = null, $lockVersion = null)
 * @method OtherDocument|null findOneBy(array $criteria, array $orderBy = null)
 * @method OtherDocument[]    findAll()
 * @method OtherDocument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OtherDocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OtherDocument::class);
    }

    // /**
    //  * @return OtherDocument[] Returns an array of OtherDocument objects
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
    public function findOneBySomeField($value): ?OtherDocument
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
