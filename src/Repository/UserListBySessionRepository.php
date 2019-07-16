<?php

namespace App\Repository;

use App\Entity\UserListBySession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserListBySession|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserListBySession|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserListBySession[]    findAll()
 * @method UserListBySession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserListBySessionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserListBySession::class);
    }

    // /**
    //  * @return UserListBySession[] Returns an array of UserListBySession objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserListBySession
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
