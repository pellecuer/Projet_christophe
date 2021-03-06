<?php

namespace App\Repository;

use App\Entity\Activity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Activity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activity[]    findAll()
 * @method Activity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Activity::class);
    }





    /**
    * @return Activity[] Returns an array of Activity objects
    */    
    public function findOneByDateByProjectByProfile($date, $project, $profile)
    {
        $thisMonth = $date->format('F');
        $thisyear = $date->format('Y');
        $startOfMonth = new \dateTime('first day of' . $thisMonth . $thisyear);        
        $endOfMonth = new \dateTime('last day of' . $thisMonth. $thisyear);

        return $this->createQueryBuilder('a')

            ->andWhere('a.date BETWEEN :start AND :end')
            ->andWhere('a.project = :project')
            ->andwhere('a.profile = :profile')  
            ->setParameter('start', $startOfMonth)
            ->setParameter('end', $endOfMonth)
            ->setParameter('project', $project)
            ->setParameter('profile', $profile)
            ->orderBy('a.date', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
    /**
    * @return Activity[] Returns an array of Activity objects
    */    
    public function findOneByDateByProjectByProfileByPole($date, $project, $profile, $pole)
    {
        $thisMonth = $date->format('F');
        $thisyear = $date->format('Y');
        $startOfMonth = new \dateTime('first day of' . $thisMonth . $thisyear);      
        $endOfMonth = new \dateTime('last day of' . $thisMonth. $thisyear);
        // dump($startOfMonth, $endOfMonth);die;

        return $this->createQueryBuilder('a')

            ->andWhere('a.date BETWEEN :start AND :end')
            ->andWhere('a.project = :project')
            ->andwhere('a.profile = :profile')
            ->andwhere('a.pole = :pole') 
            ->setParameter('start', $startOfMonth)
            ->setParameter('end', $endOfMonth)
            ->setParameter('project', $project)
            ->setParameter('profile', $profile)
            ->setParameter('pole', $pole)
            ->orderBy('a.date', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }



     /**
    * @return Activity[] Returns an array of Activity objects
    */    
    public function findProfilesByProjectByPole($project, $pole)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.project = :project')
            ->andWhere('a.pole = :pole')
            ->innerJoin('a.profile', 'profile')
            ->addSelect('profile')
            ->setParameter('project', $project)
            ->setParameter('pole', $pole)
            ->distinct()
            ->orderBy('profile.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    //  /**
    // * @return Activity[] Returns an array of Activity objects
    // */    
    // public function findPolesByProject($project)
    // {
    //     return $this->createQueryBuilder('a')            
    //         ->andWhere('a.project = :project')
    //         ->innerJoin('a.pole', 'pole')
    //         ->addSelect('pole')
    //         ->setParameter('project', $project)
    //         ->distinct()
    //         ->orderBy('pole.name', 'ASC')
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
    
    
    /**
     * @return Activity[] Returns an array of Activity objects
     */    
    public function findByProjectByPole($project, $pole)
    {
        return $this->createQueryBuilder('a')            
            ->andWhere('a.project = :project')
            ->andWhere('a.pole = :pole')
            ->setParameter('project', $project)
            ->setParameter('pole', $pole)
            ->getQuery()
            ->getResult()
        ;
    }
    



    // /**
    //  * @return Activity[] Returns an array of Activity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Activity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
