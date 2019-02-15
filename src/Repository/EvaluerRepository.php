<?php

namespace App\Repository;

use App\Entity\Evaluer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Evaluer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evaluer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evaluer[]    findAll()
 * @method Evaluer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvaluerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Evaluer::class);
    }

    // /**
    //  * @return Evaluer[] Returns an array of Evaluer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Evaluer
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
