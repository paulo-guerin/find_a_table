<?php

    namespace App\Controller;
    use App\Entity\Game;
    use App\Repository\CategoryRepository;
    use App\Repository\GameRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Knp\Component\Pager\PaginatorInterface;

    class GameController extends AbstractController{

        public function addTwigGlobals(){

            //Add registration form to twig template as a global variable

            $this->container->get('twig')->addGlobal('available_languages', $this->container->get('get_available_languages'));

        }

        /**
         * @Route("/game/games_index", name="games_index")
         */
        public function gamesIndex(PaginatorInterface $paginator, GameRepository $gameRepository, CategoryRepository $categoryRepository, Request $request){
            $search=$request->query->all();
            $results = $paginator->paginate(
                $gameRepository->searchGames($search),
                $request->query->getInt('page', 1),
                12
            );
            $categories = $categoryRepository->findAll();
            return $this->render('game/games_index.html.twig', [
                'games' => $results,
                'categories' => $categories,
            ]);
        }

        /**
         * @Route("/game/game/{id}", name="game_game")
         */
        public function game($id, EntityManagerInterface $entityManager){
            $gameRepository = $entityManager->getRepository(Game::class);
            $game = $gameRepository -> find($id);
            return $this->render("game/game.html.twig", ["game" => $game]);
        }
    }

