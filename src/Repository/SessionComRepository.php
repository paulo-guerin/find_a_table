<?php

namespace App\Repository;

use App\Entity\SessionCom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SessionCom|null find($id, $lockMode = null, $lockVersion = null)
 * @method SessionCom|null findOneBy(array $criteria, array $orderBy = null)
 * @method SessionCom[]    findAll()
 * @method SessionCom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionComRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SessionCom::class);
    }

    // /**
    //  * @return SessionCom[] Returns an array of SessionCom objects
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
    public function findOneBySomeField($value): ?SessionCom
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
