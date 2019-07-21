<?php

    namespace App\Controller;
    use App\Entity\Game;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    class GameController extends AbstractController{
        /**
         * @Route("game/games_index", name="games_index")
         */
        public function games_index(EntityManagerInterface $entityManager){
            $gameRepository = $entityManager->getRepository(Game::class);
            $games = $gameRepository -> findAll();
            return $this->render("game/games_index.html.twig", ["games" => $games]);
        }
    }

