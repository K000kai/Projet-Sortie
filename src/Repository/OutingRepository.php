<?php

namespace App\Repository;

use App\Entity\Outing;
use App\Entity\Campus;
use App\Model\SearchFilterData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

/**
 * @extends ServiceEntityRepository<Outing>
 *
 * @method Outing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Outing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Outing[]    findAll()
 * @method Outing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OutingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Outing::class);
    }

    public function findSearch (SearchFilterData $searchFilterData, Request $request): array
    {
        $query = $this
            ->createQueryBuilder('outing')
            ->select ('outing', 'campus')
            ->leftJoin('outing.campus', 'campus');


        if (!empty($searchFilterData->zoneRecherche)) {
            $query =$query
                ->andWhere('outing.name LIKE :zoneRecherche')
                ->setParameter('zoneRecherche', "%{$searchFilterData->zoneRecherche}%")
            ;
        }
        if (!empty($searchFilterData->Campus)) {
            $query =$query
                ->andWhere(' outing.campus = :Campus')
                ->setParameter('Campus', $searchFilterData->Campus)
            ;
        }

        //return $this->$request->getCurrentRequest()->query->get('zoneRecherche');
        return $query->getQuery()->getResult();
    }

    //    /**
    //     * @return Outing[] Returns an array of Outing objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Outing
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
