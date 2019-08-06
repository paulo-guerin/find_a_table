<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/index", name="admin_index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/add_game", name="admin_add_game")
     */
    public function add_game(Request $request, EntityManagerInterface $entityManager){
        $game=new Game();
        $gameForm=$this->createForm(GameType::class, $game);
        $formView=$gameForm->createView();

        if($request->isMethod('Post')){
            $gameForm->handleRequest($request);

            $entityManager->persist($game);
            $entityManager->flush();
            $this->addFlash('success', 'Le jeu a bien été crée!');
            return $this->redirectToRoute('admin_index');
        };

        return $this->render("admin/add_game.html.twig", ["gameForm"=>$formView]);
    }

    /**
     * @Route("/admin/update_game/{id}", name="admin_update_game")
     */
    public function update_game($id, Request $request, EntityManagerInterface $entityManager, GameRepository $gameRepository){
        $game = $gameRepository->find($id);
        $updateGameForm=$this->createForm(GameType::class, $game);
        $formView=$updateGameForm->createView();

        if($request->isMethod('Post')){
            $updateGameForm->handleRequest($request);
            if($updateGameForm->isValid()) {
                $entityManager->persist($game);
                $entityManager->flush();
                $this->addFlash('success', 'Le jeu a bien été modifié!');
                return $this->redirectToRoute('game_game', ['id' => $id]);
            }
        };

        return $this->render("admin/update_game.html.twig", ["updateGameForm"=>$formView]);
    }

    /**
     * @Route("/admin/hide_game/{id}", name="admin_hide_game")
     */
    public function hide_game($id, Request $request, EntityManagerInterface $entityManager, GameRepository $gameRepository){
        $game = $gameRepository->find($id);
        $game->setStatus(0);
        $entityManager->persist($game);
        $entityManager->flush();
        $this->addFlash('success', "Le jeu n'est plus visible par les utilisateurs standards" );
        return $this->redirectToRoute('game_game', ['id' => $id]);
    }

    /**
     * @Route("/admin/show_game/{id}", name="admin_show_game")
     */
    public function show_game($id, Request $request, EntityManagerInterface $entityManager, GameRepository $gameRepository){
        $game = $gameRepository->find($id);
        $game->setStatus(1);
        $entityManager->persist($game);
        $entityManager->flush();
        $this->addFlash('success', "Le jeu est visible par les utilisateurs standards" );
        return $this->redirectToRoute('game_game', ['id' => $id]);
    }
}
