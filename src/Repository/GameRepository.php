<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
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

    /**
     * @return Query
     */
    public function searchGames($search): Query
    {
        $query = $this->createQueryBuilder('g');
        
        if(isset($search["entry"])) {
            $query = $query
                ->andWhere('g.title LIKE :entry')
                ->setParameter('entry', "%" . $search["entry"] . "%");
        }

        if(isset($search["players"])){
            if ($search["players"] != "empty"){
                $query = $query
                    ->andWhere('g.maxplayer <= :players')
                    ->setParameter('players', $search["players"]);
            }
        }

       if(isset($search["category"])){
            if ($search["category"] != "all"){
                $query = $query
                    ->andWhere('g.categoryID = :category')
                    ->setParameter('category', $search["category"]);
            }
        }
        return $query->getQuery();
    }

    public function maxPlayer(){
        $query = $this->createQueryBuilder('g');
        $query->select('g, MAX(g.maxplayer) AS max_player');
        return $query->getQuery()->getResult();
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
