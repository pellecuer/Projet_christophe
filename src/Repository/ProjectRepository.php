<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Project::class);
    }


    /**
    * @return Project[] Returns an array of Project objects
    */    
    public function findOneByDateByProfile($date, $profile)
    {
        $thisMonth = $date->format('F');
        $startOfMonth = new \dateTime('first day of' . $thisMonth);
        $dt =clone $date; 
        $endOfMonth = new \dateTime('last day of' . $thisMonth);

        return $this->createQueryBuilder('p')

            ->andWhere('p.date BETWEEN :start AND :end')
            ->andWhere('p.profile = :profile')  
            ->setParameter('start', $startOfMonth)
            ->setParameter('end', $endOfMonth)
            ->setParameter('profile', $profile)
            ->orderBy('p.date', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }    

     /**
    * @return Project[] Returns an array of Project objects
    */    
    public function findProfiles()
    {
        return $this->createQueryBuilder('p')
            ->select ('p.profile') 
            ->distinct('p.profile')
            ->getQuery()
            ->getResult()
        ;
    }   



    // /**
    //  * @return Project[] Returns an array of Project objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Project
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
