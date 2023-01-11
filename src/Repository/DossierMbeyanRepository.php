<?php

namespace App\Repository;

use App\Entity\DossierMbeyan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DossierMbeyan|null find($id, $lockMode = null, $lockVersion = null)
 * @method DossierMbeyan|null findOneBy(array $criteria, array $orderBy = null)
 * @method DossierMbeyan[]    findAll()
 * @method DossierMbeyan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DossierMbeyanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DossierMbeyan::class);
    }

    // /**
    //  * @return DossierMbeyan[] Returns an array of DossierMbeyan objects
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
    public function findOneBySomeField($value): ?DossierMbeyan
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
