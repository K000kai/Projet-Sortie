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
                ->orWhere('outing.name LIKE :zoneRecherche')
                ->setParameter('zoneRecherche', "%{$searchFilterData->zoneRecherche}%")
            ;
        }
        if (!empty($searchFilterData->Campus)) {
            $query =$query
                ->orWhere(' outing.campus = :Campus')
                ->setParameter('Campus', $searchFilterData->Campus)
            ;
        }
        if (!empty($searchFilterData->min)) {
            $query =$query
                ->orWhere(' outing.dateTimeStart >= :min')
                ->setParameter('min', $searchFilterData->min)
            ;
        }
        if (!empty($searchFilterData->max)) {
            $query =$query
                ->orWhere(' outing.dateTimeStart <= :max')
                ->setParameter('max', $searchFilterData->max)
            ;
        }
        if (!empty($searchFilterData->organisateur)) {
            $query =$query
                ->orWhere(' outing.Organizer = :organisateur')
                ->setParameter('organisateur', $searchFilterData->organisateur);
        }
        if (!empty($searchFilterData->inscrit)) {
            $query =$query
                ->orWhere('user.id = :inscrit')
                ->setParameter('inscrit', $searchFilterData->inscrit);
        }
        if (($searchFilterData->nonInscrit)) {
            $query =$query
                ->orWhere(':nonInscrit NOT MEMBER OF outing.User')
                ->setParameter('nonInscrit', $searchFilterData->nonInscrit);
        }

        if (($searchFilterData->pastOutings)) {
            $date = new \DateTime();
            $query =$query
                ->orWhere('outing.dateTimeStart <= :pastOutings')
                ->setParameter('pastOutings', $date
                );
        }

        return $query->getQuery()->getResult();
    }


    public function countUserInOuting($outing): int
    {
        $countParticipants = $this->createQueryBuilder('o')
            ->select('COUNT(u.id)')
            ->leftJoin('o.User', 'u')
            ->where('o.id = :outingId')
            ->setParameter('outingId', $outing)
            ->getQuery()
            ->getSingleScalarResult();
        return $countParticipants;
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
