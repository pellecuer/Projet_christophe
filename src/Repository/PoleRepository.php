<?php

namespace App\Repository;

use App\Entity\Pole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Pole|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pole|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pole[]    findAll()
 * @method Pole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PoleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pole::class);
    }



    /**
     * @return Pole[] Returns an array of Pole objects
     */    
    public function findAllAsc()
    {
        return $this->createQueryBuilder('p')                        
            ->orderBy('p.name', 'ASC')            
            ->getQuery()
            ->getResult()
        ;
    }

    
    
    // /**
    //  * @return Pole[] Returns an array of Pole objects
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
    public function findOneBySomeField($value): ?Pole
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
