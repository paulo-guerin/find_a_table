<?php

    namespace App\Controller;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    class GamesController extends AbstractController{
        /**
         * @Route("games/games_index", name="games_index")
         */
        public function games_index(){
            return $this->render("games/games_index.html.twig");
        }
    }

