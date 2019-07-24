<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function searchGame($query){

        if(isset($query["category"])){
            if($query["category"] == "all"){
                unset($query["category"]);
            };
        };

        if(count($query)==null){
            return $results=[];
        }
        elseif(count($query)==1 && isset($query["query"])) {
            $qb = $this->createQueryBuilder('g');
            $selection = $qb->select('g')
                ->Where('g.title LIKE :query')
                ->setParameter('query', "%" . $query["query"] . "%")
                ->getQuery();
            $results = $selection->getResult();
            return $results;
        }
        elseif(count($query)==2 && isset($query["query"]) && isset($query["category"]) ) {
            $qb = $this->createQueryBuilder('g');
            $selection = $qb->select('g')
                ->Where('g.title LIKE :query')
                ->andWhere('g.categoryID = :category')
                ->setParameter('query', "%" . $query["query"] . "%")
                ->setParameter('category',  $query["category"] )
                ->getQuery();
            $results = $selection->getResult();
            return $results;
        }
        elseif(count($query)==1 && isset($query["category"]) ) {
            $qb = $this->createQueryBuilder('g');
            $selection = $qb->select('g')
                ->Where('g.categoryID = :category')
                ->setParameter('category',  $query["category"] )
                ->getQuery();
            $results = $selection->getResult();
            return $results;
        }

    }

    // /**
    //  * @return Game[] Returns an array of Game objects
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
    public function findOneBySomeField($value): ?Game
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
