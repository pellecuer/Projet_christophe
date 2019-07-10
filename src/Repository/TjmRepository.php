<?php

namespace App\Repository;

use App\Entity\Tjm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tjm|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tjm|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tjm[]    findAll()
 * @method Tjm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TjmRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tjm::class);
    }


     /**
    * @return Tjm[][] Returns an array of Tjm objects
    */    
    public function findPolesByProject($project)
    {
        return $this->createQueryBuilder('t')            
            ->andWhere('t.project = :project')
            ->innerJoin('t.pole', 'pole')
            ->addSelect('pole')
            ->setParameter('project', $project)
            ->distinct()
            ->orderBy('pole.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }





    // /**
    //  * @return Tjm[] Returns an array of Tjm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tjm
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
