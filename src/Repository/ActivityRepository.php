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
    public function findOneByDateByProfile($date, $profile)
    {
        $thisMonth = $date->format('F');
        $thisyear = $date->format('Y');
        $startOfMonth = new \dateTime('first day of' . $thisMonth . $thisyear);        
        $endOfMonth = new \dateTime('last day of' . $thisMonth. $thisyear);

        return $this->createQueryBuilder('a')

            ->andWhere('a.date BETWEEN :start AND :end')
            ->andWhere('a.profile = :profile')  
            ->setParameter('start', $startOfMonth)
            ->setParameter('end', $endOfMonth)
            ->setParameter('profile', $profile)
            ->orderBy('a.date', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }    

     /**
    * @return Activity[] Returns an array of Activity objects
    */    
    public function findProfiles()
    {
        return $this->createQueryBuilder('a')
            ->select ('a.profile') 
            ->distinct('a.profile')
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
