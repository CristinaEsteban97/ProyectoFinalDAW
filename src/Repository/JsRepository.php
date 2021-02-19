<?php

namespace App\Repository;

use App\Entity\Js;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Js|null find($id, $lockMode = null, $lockVersion = null)
 * @method Js|null findOneBy(array $criteria, array $orderBy = null)
 * @method Js[]    findAll()
 * @method Js[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Js::class);
    }

    // /**
    //  * @return Js[] Returns an array of Js objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Js
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
