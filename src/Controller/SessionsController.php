<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SessionsController extends AbstractController
{
    /**
     * @Route("/sessions/sessions_index", name="sessions_index")
     */
    public function sessions_index()
    {
        return $this->render('sessions/sessions_index.html.twig', [
            'controller_name' => 'SessionsController',
        ]);
    }
}
