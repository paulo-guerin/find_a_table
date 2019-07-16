<?php

namespace App\Repository;

use App\Entity\IntraMessages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IntraMessages|null find($id, $lockMode = null, $lockVersion = null)
 * @method IntraMessages|null findOneBy(array $criteria, array $orderBy = null)
 * @method IntraMessages[]    findAll()
 * @method IntraMessages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntraMessagesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, IntraMessages::class);
    }

    // /**
    //  * @return IntraMessages[] Returns an array of IntraMessages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IntraMessages
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
