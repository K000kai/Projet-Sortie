<?php

namespace App\Repository;

use App\Entity\Outing;
use App\Entity\Campus;
use App\Entity\User;
use App\Model\SearchFilterData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    public function findSearch (SearchFilterData $searchFilterData): array
    {
        $query = $this
            ->createQueryBuilder('outing')
            ->select ('outing', 'campus', 'user')
            ->leftJoin('outing.campus', 'campus')
            ->leftJoin('outing.User', 'user');

       // $user = $entityManager->getRepository(User::class)->find($this->getUser()->getId());

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
        if (!empty($searchFilterData->min)) {
            $query =$query
                ->andWhere(' outing.dateTimeStart >= :min')
                ->setParameter('min', $searchFilterData->min)
            ;
        }
        if (!empty($searchFilterData->max)) {
            $query =$query
                ->andWhere(' outing.dateTimeStart <= :max')
                ->setParameter('max', $searchFilterData->max)
            ;
        }
        if (!empty($searchFilterData->organisateur)) {
            $query =$query
                ->andWhere(' outing.Organizer = :organisateur')
                ->setParameter('organisateur', $searchFilterData->organisateur);
        }
        if (!empty($searchFilterData->inscrit)) {
            $query =$query
                ->andWhere('user.id = :inscrit')
                ->setParameter('inscrit', $searchFilterData->inscrit);
        }
        if (($searchFilterData->nonInscrit)) {
            $query =$query
                ->andWhere(':nonInscrit NOT MEMBER OF outing.User')
                ->setParameter('nonInscrit', $searchFilterData->nonInscrit);
        }

        /*if (!empty($searchFilterData->pastOutings)) {
            $query =$query
                ->andWhere('outing.dateTimeStart <= :pastOutings')
                ->setParameter('pastOutings', $searchFilterData->pastOutings);
        }*/

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
