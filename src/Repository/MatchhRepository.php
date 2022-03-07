<?php

namespace App\Repository;

use App\Entity\Matchh;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Matchh|null find($id, $lockMode = null, $lockVersion = null)
 * @method Matchh|null findOneBy(array $criteria, array $orderBy = null)
 * @method Matchh[]    findAll()
 * @method Matchh[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchhRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Matchh::class);
    }

    // /**
    //  * @return Matchh[] Returns an array of Matchh objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Matchh
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
