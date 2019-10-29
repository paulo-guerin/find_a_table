<?php

    namespace App\Controller;
    use App\Entity\Game;
    use App\Repository\CategoryRepository;
    use App\Repository\GameRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;

    class GameController extends AbstractController{

        public function addTwigGlobals(){

            //Add registration form to twig template as a global variable

            $this->container->get('twig')->addGlobal('available_languages', $this->container->get('get_available_languages'));

        }

        /**
         * @Route("/game/games_index", name="games_index")
         */
        public function games_index(EntityManagerInterface $entityManager){
            $gameRepository = $entityManager->getRepository(Game::class);
            $games = $gameRepository -> findAll();
            return $this->render("game/games_index.html.twig", ["games" => $games]);
        }

        /**
         * @Route("/game/game/{id}", name="game_game")
         */
        public function game($id, EntityManagerInterface $entityManager){
            $gameRepository = $entityManager->getRepository(Game::class);
            $game = $gameRepository -> find($id);
            return $this->render("game/game.html.twig", ["game" => $game]);
        }

        /**
         * @Route("/game/advanced_game_search.html.twig", name="advanced_game_search")
         */
        public function advancedGameSearch(GameRepository $gameRepository, CategoryRepository $categoryRepository, Request $request){
            $query=$request->query->all();
            $maxplayer= $gameRepository->maxPlayer();
            $results = $gameRepository->searchGame($query);
            $categories = $categoryRepository->findAll();
            return $this->render('game/advanced_game_search.html.twig', [
                'games' => $results,
                'categories' => $categories,
                'maxplayer' => $maxplayer,
                'query' => $query
            ]);
        }
    }

