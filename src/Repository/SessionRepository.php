<?php

namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function findAllArray(){

        $qb = $this->createQueryBuilder('s');
        $selection = $qb->select('s')
            ->getQuery();
        $results = $selection->getArrayResult();
        return $results;

    }

    public function searchSession($query){

        if(isset($query["gameID"]) && isset($query["townID"]) && $query["townID"] != "all" && $query["gameID"] != "all"){
            $qb = $this->createQueryBuilder('s');
            $selection = $qb->select('s')
                ->Where('s.game = :gameID')
                ->andWhere('s.town = :townID')
                ->setParameter('gameID', $query["gameID"])
                ->setParameter('townID', $query["townID"])
                ->getQuery();
            $results = $selection->getResult();
            return $results;
        }
        elseif(isset($query["gameID"]) && $query["townID"] == "all"){
            $qb = $this->createQueryBuilder('s');
            $selection = $qb->select('s')
                ->Where('s.game = :gameID')
                ->setParameter('gameID', $query["gameID"])
                ->getQuery();
            $results = $selection->getResult();
            return $results;
        }

        elseif(isset($query["townID"]) && $query["gameID"] == "all"){
            $qb = $this->createQueryBuilder('s');
            $selection = $qb->select('s')
                ->Where('s.town = :townID')
                ->setParameter('townID', $query["townID"])
                ->getQuery();
            $results = $selection->getResult();
            return $results;
        }
        elseif($query["townID"] == "all" && $query["gameID"] == "all"){
            return $results = 0;
        };

    }

    // /**
    //  * @return Session[] Returns an array of Session objects
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
    public function findOneBySomeField($value): ?Session
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
