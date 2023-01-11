<?php

namespace App\Repository;

use App\Entity\DocumentPdf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocumentPdf|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentPdf|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocumentPdf[]    findAll()
 * @method DocumentPdf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentPdfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocumentPdf::class);
    }

    // /**
    //  * @return DocumentPdf[] Returns an array of DocumentPdf objects
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
    public function findOneBySomeField($value): ?DocumentPdf
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
