<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\ParticipantSession;
use App\Entity\Session;
use App\Entity\SessionCom;
use App\Form\GameType;
use App\Form\SessionComType;
use App\Form\SessionType;
use App\Repository\GameRepository;
use App\Repository\ParticipantSessionRepository;
use App\Repository\SessionComRepository;
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
    public function my_sessions(EntityManagerInterface $entityManager, ParticipantSessionRepository $participantSessionRepository)
    {
        if( $this->getUser() ) {
            $participantsessions = $participantSessionRepository->mysessions($this->getUser());
            return $this->render('session/my_sessions.html.twig', [
                'participantsessions' => $participantsessions,
            ]);
        } else {
            $this->addFlash('authentify', 'Vous devez vous connecter pour accéder à cette page =)');
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/session/session/{id}", name="session_session")
     */
    public function session($id, EntityManagerInterface $entityManager, SessionComRepository $sessionComRepository, Request $request){
        $sessionRepository = $entityManager->getRepository(Session::class);
        $sessioncom = new SessionCom();
        $sessionComForm = $this->createForm(SessionComType::class, $sessioncom);
        $formView = $sessionComForm->createView();
        $user = $this->getUser();
        $session = $sessionRepository -> find($id);
        if ($request->isMethod('Post')) {
            $sessionComForm->handleRequest($request);
            $sessioncom->setUser($user);
            $sessioncom->setStatus(1);
            $sessioncom->setSession($session);
            $entityManager->persist($sessioncom);
            $entityManager->flush();
            $this->addFlash('success_new_com', 'Commentaire ajouté');
            return $this->redirectToRoute('session_session', ['id' => $id]);
        };

        return $this->render("session/session.html.twig", [
            "session" => $session,
            "form" => $formView
        ]);
    }

    /**
     * @Route("/session/new_session", name="new_session")
     */
    public function new_session(Request $request, EntityManagerInterface $entityManager, TownRepository $townRepository)
    {
        if( $this->getUser() ) {
            $user = $this->getUser();
            $session = new Session();
            $participantsession = new ParticipantSession();
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
                    $participantsession->setUser($user);
                    $participantsession->setSession($session);
                    $participantsession->setStatus(2);
                    $entityManager->persist($participantsession);
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
            'games' => $games,
        ]);
    }

    /**
     * @Route("/session/advanced_session_search", name="advanced_session_search")
     */
    public function advancedSessionSearch(SessionRepository $sessionRepository, GameRepository $gameRepository, TownRepository $townRepository, Request $request){
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

    /**
     * @Route("/session/update_session/{id}", name="update_session")
     */
    public function update_session($id, Request $request, EntityManagerInterface $entityManager, SessionRepository $sessionRepository, TownRepository $townRepository){
        $session = $sessionRepository->find($id);
        if( $this->getUser() ) {
            $user = $this->getUser();
            $userID = $user->getId();
            $updateSessionForm = $this->createForm(SessionType::class, $session);
            $formView = $updateSessionForm->createView();

            if ($request->isMethod('Post')) {
                $query=$request->request->all();
                $city = $query["session"]["city"];
                $result = $townRepository->searchTown($city);
                if(is_null($result)){
                    $this->addFlash('wrongcityupdate', "Le nom de ville que vous avez entré n'éxiste pas");
                    return $this->redirectToRoute('update_session');
                } else {
                    $updateSessionForm->handleRequest($request);
                    $session->setTown($result);
                    $entityManager->persist($session);
                    $entityManager->flush();
                    $this->addFlash('success_update_session', 'La session a bien été modifiée!');
                    return $this->redirectToRoute('my_sessions');
                }
            };
        };

        return $this->render("session/update_session.html.twig", ["form"=>$formView]);
    }

    /**
     * @Route("/session/hide_session/{id}", name="hide_session")
     */
    public function hide_session($id, Request $request, EntityManagerInterface $entityManager, SessionRepository $sessionRepository){
        $session = $sessionRepository->find($id);
        $session->setStatus(0);
        $entityManager->persist($session);
        $entityManager->flush();
        $this->addFlash('success_hide', "La session n'est plus visible par les utilisateurs standards" );
        return $this->redirectToRoute('session_session', ['id' => $id]);
    }

    /**
     * @Route("/session/show_session/{id}", name="show_session")
     */
    public function show_session($id, Request $request, EntityManagerInterface $entityManager, SessionRepository $sessionRepository){
        $session = $sessionRepository->find($id);
        $session->setStatus(1);
        $entityManager->persist($session);
        $entityManager->flush();
        $this->addFlash('success', "La session est visible par les utilisateurs standards" );
        return $this->redirectToRoute('session_session', ['id' => $id]);
    }

    /**
     * @Route("/session/delete_com/{id}{sessionID}", name="delete_com")
     */
    public function delete_com($id, $sessionID, EntityManagerInterface $entityManager, SessionComRepository $sessionComRepository){
        $com = $sessionComRepository->find($id);
        $entityManager->remove($com);
        $entityManager->flush();
        $this->addFlash('delete_com', "Votre commentaire a bien été supprimé" );
        return $this->redirectToRoute('session_session', ['id' => $sessionID]);
    }

    /**
     * @Route("/session/new_participantsession/{id}", name="new_participantsession")
     */
    public function new_participantsession($id, Request $request, EntityManagerInterface $entityManager, SessionRepository $sessionRepository){
        $session = $sessionRepository->find($id);
        $user = $this->getUser();
        $participantsession = new ParticipantSession();
        $participantsession->setStatus(0);
        $participantsession->setUser($user);
        $participantsession->setSession($session);
        $entityManager->persist($participantsession);
        $entityManager->flush();
        $this->addFlash('success_new_participant', "Il n'y a plus qu'à attendre la décision de l'hôte!" );
        return $this->redirectToRoute('session_session', ['id' => $id]);
    }

    /**
     * @Route("/session/accept_refuse_participant/{sessionID}{userID}{action}", name="accept_refuse_participant")
     */
    public function accept_refuse_participant($sessionID, $userID, $action, Request $request, EntityManagerInterface $entityManager, SessionRepository $sessionRepository, ParticipantSessionRepository $participantSessionRepository){
        $session = $sessionRepository->find($sessionID);
        $accepted_or_refused_user = $participantSessionRepository->find_participant($userID, $sessionID);
        if($action == 1) {
            $session->setMaxplayer(  $session->getMaxplayer() - 1);
            $entityManager->persist($session);
            $accepted_or_refused_user->setStatus(1);
            $entityManager->persist($accepted_or_refused_user);
            $entityManager->flush();
            $this->addFlash('success_accept_participant', 'Vous avez bien accepté le participant');
            return $this->redirectToRoute('session_session', ['id' => $sessionID]);
        } elseif($action== 0){
            $session->setMaxplayer($session->getMaxplayer() + 1);
            $entityManager->persist($session);
            $accepted_or_refused_user->setStatus(0);
            $entityManager->persist($accepted_or_refused_user);
            $entityManager->flush();
            $this->addFlash('success_accept_participant', 'Vous avez refusé le participant');
            return $this->redirectToRoute('session_session', ['id' => $sessionID]);
        };
    }

}
