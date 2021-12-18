<?php

namespace App\Repository;

use App\Entity\Ouvier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ouvier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ouvier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ouvier[]    findAll()
 * @method Ouvier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OuvierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ouvier::class);
    }

    // /**
    //  * @return Ouvier[] Returns an array of Ouvier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ouvier
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
