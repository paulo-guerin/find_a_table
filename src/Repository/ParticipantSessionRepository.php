<?php

namespace App\Repository;

use App\Entity\ParticipantSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ParticipantSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParticipantSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParticipantSession[]    findAll()
 * @method ParticipantSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipantSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParticipantSession::class);
    }
    public function find_participant($userID, $sessionID){
        $qb = $this->createQueryBuilder('p');
        $selection = $qb->select('p')
            ->Where('p.user = :userID')
            ->Andwhere('p.session = :sessionID')
            ->setParameter('userID', $userID)
            ->setParameter('sessionID', $sessionID)
            ->getQuery();
        $result = $selection->getOneOrNullResult();
        return $result;
    }

    public function mysessions($user){
        $qb = $this->createQueryBuilder('p');
        $selection = $qb->select('p')
            ->Where('p.user = :user')
            ->setParameter('user', $user)
            ->getQuery();
        $results = $selection->getResult();
        return $results;
    }
    // /**
    //  * @return ParticipantSession[] Returns an array of ParticipantSession objects
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
    public function findOneBySomeField($value): ?ParticipantSession
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
