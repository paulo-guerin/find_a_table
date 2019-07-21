<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    /**
     * @Route("/session/sessions_index", name="sessions_index")
     */
    public function sessions_index(EntityManagerInterface $entityManager)
    {

        return $this->render('session/sessions_index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }
}
