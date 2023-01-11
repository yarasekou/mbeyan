<?php

namespace App\Repository;

use App\Entity\DocumentExpertise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocumentExpertise|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentExpertise|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocumentExpertise[]    findAll()
 * @method DocumentExpertise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentExpertiseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocumentExpertise::class);
    }

    // /**
    //  * @return DocumentExpertise[] Returns an array of DocumentExpertise objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DocumentExpertise
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
