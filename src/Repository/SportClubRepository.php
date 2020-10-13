<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use App\Data\SearchData;
use App\Entity\SportClub;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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

 /**
  *@return SportClub[]; 
  */  
public function findSearch(SearchData $search): array
{
   $query = $this
    ->createQueryBuilder("club")
    ->select('club', 'categ')
    ->join('club.categories', 'categ')
    ->select('club', 'postal')
    ->join('club.postalCodes', 'postal');

    if (!empty($search->q)) {
        $query = $query
            ->andWhere('club.discipline LIKE :q')
            ->setParameter('q', "%{$search->q}%");
    }

    if (!empty($search->categories)) {
        $query = $query
            ->andWhere('categ.id in (:categories)')
            ->setParameter('categories', $search->categories);
    }

    // not working ... -> value not set in the map ??
    if (!empty($search->postals)) {
        $query = $query
            ->andWhere('postal.id in (:postalCodes)')
            ->setParameter('postalCodes', $search->postals);
    }
   

   return $query->getQuery()->getResult();

    // return $this->findAll();
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
