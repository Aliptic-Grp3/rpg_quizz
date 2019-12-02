<?php

namespace App\Repository;

use App\Entity\Bidon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Bidon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bidon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bidon[]    findAll()
 * @method Bidon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BidonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bidon::class);
    }

    // /**
    //  * @return Bidon[] Returns an array of Bidon objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bidon
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
