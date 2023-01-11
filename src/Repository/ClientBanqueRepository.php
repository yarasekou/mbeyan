<?php

namespace App\Repository;

use App\Entity\ClientBanque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClientBanque|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientBanque|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientBanque[]    findAll()
 * @method ClientBanque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientBanqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientBanque::class);
    }

    // /**
    //  * @return ClientBanque[] Returns an array of ClientBanque objects
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
    public function findOneBySomeField($value): ?ClientBanque
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
