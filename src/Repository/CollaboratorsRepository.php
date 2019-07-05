<?php

namespace App\Repository;

use App\Entity\Collaborators;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Collaborators|null find($id, $lockMode = null, $lockVersion = null)
 * @method Collaborators|null findOneBy(array $criteria, array $orderBy = null)
 * @method Collaborators[]    findAll()
 * @method Collaborators[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollaboratorsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Collaborators::class);
    }

    // /**
    //  * @return Collaborators[] Returns an array of Collaborators objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Collaborators
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
