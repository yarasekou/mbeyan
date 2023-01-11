<?php

namespace App\Repository;

use App\Entity\DocumentImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocumentImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocumentImage[]    findAll()
 * @method DocumentImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocumentImage::class);
    }

    // /**
    //  * @return DocumentImage[] Returns an array of DocumentImage objects
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
    public function findOneBySomeField($value): ?DocumentImage
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
