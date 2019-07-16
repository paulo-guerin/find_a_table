<?php

namespace App\Repository;

use App\Entity\Towns;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Towns|null find($id, $lockMode = null, $lockVersion = null)
 * @method Towns|null findOneBy(array $criteria, array $orderBy = null)
 * @method Towns[]    findAll()
 * @method Towns[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TownsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Towns::class);
    }

    // /**
    //  * @return Towns[] Returns an array of Towns objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Towns
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
