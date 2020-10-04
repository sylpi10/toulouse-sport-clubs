<?php

namespace App\Repository;

use App\Entity\SportClub;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SportClub|null find($id, $lockMode = null, $lockVersion = null)
 * @method SportClub|null findOneBy(array $criteria, array $orderBy = null)
 * @method SportClub[]    findAll()
 * @method SportClub[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SportClubRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SportClub::class);
    }

    // /**
    //  * @return SportClub[] Returns an array of SportClub objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SportClub
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
