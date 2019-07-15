<?php

namespace App\Repository;

use App\Entity\Project;
use App\Entity\ProjectSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

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
     * findAllVisibleQuery
     *
     * @return Project[] Returns an array of Project objects
     */
    public function findAllVisibleQuery(ProjectSearch $search)
    {
        $query = $this->findAllDescQuery();        

        if ($search->getDate()) {
            $query = $query
                ->andWhere(':date BETWEEN p.startDate AND p.endDate')                
                ->setParameter('date', $search->getDate());
        }
        
        if ($search->getName()) {
            $query = $query
                ->andWhere('p.name LIKE :name')
                ->setParameter('name', '%'.$search->getName().'%' );
        } 
        
        return $query->getQuery()->getResult();
    }

        
    private function findAllDescQuery():QueryBuilder
    {
        return $this->createQueryBuilder('p')            
            ->orderBy('p.startDate', 'DESC');
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
