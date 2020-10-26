<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\PostalCode;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\AST\NullIfExpression;
use Symfony\Component\Validator\Constraints\IsNull;

/**
 * @method PostalCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostalCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostalCode[]    findAll()
 * @method PostalCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostalCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostalCode::class);
    }
    // select * from postal_code join sport_club where sport_club.postal_codes_id = 2 
    //and sport_club.discipline = 'football' 

    /**
     * @return PostalCode[]; 
     */
    public function filterClubs(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder("postal")
            ->select('postal', 'club')
            ->join('postal.sportClubs', 'club');
            // ->select('club', 'categ')
            // ->join('postal.sportClubs.categories', 'categ');
 
        if (!empty($search->postals)){
            $query = $query
            ->andWhere('club.postalCodes in (:postalCodes)')
            ->setParameter('postalCodes', $search->postals);
        }

        if (!empty($search->q)){
            $query = $query
            ->andWhere('club.discipline LIKE :q')
            ->setParameter('q', "%{$search->q}%");
        }

        // if (!empty($search->categories)) {
        //         $query = $query
        //             ->andWhere('categ.id in (:categories)')
        //             ->setParameter('categories', $search->categories);
        //     }

        // dd($query);

                    return $query->getQuery()->getResult();
    }


    // /**
    //  * @return PostalCode[] Returns an array of PostalCode objects
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
    public function findOneBySomeField($value): ?PostalCode
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
