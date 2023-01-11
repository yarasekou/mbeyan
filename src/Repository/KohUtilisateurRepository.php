<?php

namespace App\Repository;

use App\Entity\KohUtilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method KohUtilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method KohUtilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method KohUtilisateur[]    findAll()
 * @method KohUtilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KohUtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KohUtilisateur::class);
    }

    /**
     * @return Query
     */
    public function allKohUtilisateurQuery(): Query
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.isKohUser = true')
            ->orderBy('k.id', 'ASC')
            ->getQuery();
    }

    /**
     * @return KohUtilisateur[]
     */
    public function koh_clients(): array
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.isKohUser = false')
            ->andWhere('k.isAdmin = true')
            ->orderBy('k.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByStructure($value)
    {
        return $this->createQueryBuilder('k')
            ->join('k.structure', 'structure')
            ->andWhere('structure.name = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }


    // /**
    //  * @return KohUtilisateur[] Returns an array of KohUtilisateur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?KohUtilisateur
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
