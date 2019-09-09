<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\GameRepository;
use App\Repository\SessionRepository;
use App\Repository\TownRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    /**
     * @Route("/session/my_sessions", name="my_sessions")
     */
    public function my_sessions(EntityManagerInterface $entityManager)
    {
        if( $this->getUser() ) {
            return $this->render('session/my_sessions.html.twig', [
                'controller_name' => 'SessionController',
            ]);
        } else {
            $this->addFlash('authentify', 'Vous devez vous connecter pour accéder à cette page =)');
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/session/session/{id}", name="session_session")
     */
    public function session($id, EntityManagerInterface $entityManager){
        $sessionRepository = $entityManager->getRepository(Session::class);
        $session = $sessionRepository -> find($id);
        return $this->render("session/session.html.twig", ["session" => $session]);
    }

    /**
     * @Route("/session/new_session", name="new_session")
     */
    public function new_session(Request $request, EntityManagerInterface $entityManager, TownRepository $townRepository)
    {
        if( $this->getUser() ) {
            $user = $this->getUser();
            $userID = $user->getId();
            $session = new Session();
            $sessionForm = $this->createForm(SessionType::class, $session);
            $formView = $sessionForm->createView();
            if ($request->isMethod('Post')) {
                $query=$request->request->all();
                $city = $query["session"]["city"];
                $result = $townRepository->searchTown($city);
                if(is_null($result)){
                    $this->addFlash('wrongcity', "Le nom de ville que vous avez entré n'éxiste pas");
                    return $this->redirectToRoute('new_session');
                } else {
                    $sessionForm->handleRequest($request);
                    $session->setHost($user);
                    $session->setTown($result);
                    $entityManager->persist($session);
                    $entityManager->flush();
                    $this->addFlash('success_new_session', 'La session a bien été crée!');
                    return $this->redirectToRoute('my_sessions');
                }
            };

            return $this->render("session/new_session.html.twig", ["form" => $formView]);
        } else {
            $this->addFlash('authentify', 'Vous devez vous connecter pour accéder à cette page =)');
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/session/session_index", name="session_index")
     */
    public function session_index(SessionRepository $sessionRepository, GameRepository $gameRepository, TownRepository $townRepository, Request $request){
        $sessions = $sessionRepository -> findAll();
        $games = $gameRepository->findAll();
        return $this->render("session/session_index.html.twig", [
            'sessions' => $sessions,
            'games' => $games
        ]);
    }

    /**
     * @Route("/session/advanced_session_search.html.twig", name="advanced_session_search")
     */
    public function advancedGameSearch(SessionRepository $sessionRepository, GameRepository $gameRepository, TownRepository $townRepository, Request $request){
        $query=$request->query->all();
        $games = $gameRepository->findAll();
        $sessions = $sessionRepository -> findAll();
        $results= $sessionRepository->searchSession($query);
        return $this->render('session/advanced_session_search.html.twig', [
            'results' => $results,
            'query' => $query,
            'sessions' => $sessions,
            'games' => $games
        ]);
    }
}
