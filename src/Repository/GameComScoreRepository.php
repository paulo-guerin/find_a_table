<?php

namespace App\Repository;

use App\Entity\GameComScore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GameComScore|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameComScore|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameComScore[]    findAll()
 * @method GameComScore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameComScoreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GameComScore::class);
    }

    // /**
    //  * @return GameComScore[] Returns an array of GameComScore objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GameComScore
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
