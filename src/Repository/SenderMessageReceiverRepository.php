<?php

namespace App\Repository;

use App\Entity\SenderMessageReceiver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SenderMessageReceiver|null find($id, $lockMode = null, $lockVersion = null)
 * @method SenderMessageReceiver|null findOneBy(array $criteria, array $orderBy = null)
 * @method SenderMessageReceiver[]    findAll()
 * @method SenderMessageReceiver[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SenderMessageReceiverRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SenderMessageReceiver::class);
    }

    // /**
    //  * @return SenderMessageReceiver[] Returns an array of SenderMessageReceiver objects
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
    public function findOneBySomeField($value): ?SenderMessageReceiver
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
