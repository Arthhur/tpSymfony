<?php

namespace App\Repository;

use App\Entity\Catalogues;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Catalogues|null find($id, $lockMode = null, $lockVersion = null)
 * @method Catalogues|null findOneBy(array $criteria, array $orderBy = null)
 * @method Catalogues[]    findAll()
 * @method Catalogues[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CataloguesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Catalogues::class);
    }

    // /**
    //  * @return Catalogues[] Returns an array of Catalogues objects
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
    public function findOneBySomeField($value): ?Catalogues
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
