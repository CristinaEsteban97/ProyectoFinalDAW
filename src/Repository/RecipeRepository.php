<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

  
     public function findRecipesByCategory($category)
     {
         return $this->createQueryBuilder('r')
            ->innerJoin('r.categories','categories')
            ->andWhere('r.visible = 1')
            ->andWhere('categories.name = :cat')
            ->setParameter('cat', $category)
            ->getQuery()
            ->getResult();
     }

     public function findRecipesBySearch($text)
     {
         return $this->createQueryBuilder('r')
            ->andWhere('r.visible = 1')
            ->andWhere('r.title LIKE :text')
            ->setParameter('text', '%'.$text.'%')
            ->orderBy('r.id','DESC')
            ->getQuery()
            ->getResult();
     }


}
