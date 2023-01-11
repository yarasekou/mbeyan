<?php

namespace App\Repository;

use App\Entity\TypeBien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeBien|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeBien|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeBien[]    findAll()
 * @method TypeBien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeBienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeBien::class);
    }
}
