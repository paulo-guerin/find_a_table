<?php

namespace App\Controller;

use App\Form\ProfileImageFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileImageController extends AbstractController
{
    /**
     * @Route("/profile/image/{id}", name="profile_image")
     */
    public function uploadImageForm($id, Request $request, EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();
     /*   dump($user);die;*/
        if($user->getId() == $id) {
            $updateImageForm=$this->createForm(ProfileImageFormType::class, $user);
            $formView=$updateImageForm->createView();

            if($request->isMethod('Post')){
                $updateImageForm->handleRequest($request);
                if($updateImageForm->isValid()) {
                    $entityManager->persist($user);
                    $entityManager->flush();
                    $this->addFlash('success', 'Votre image de profil a bien été modifiée');
                    return $this->redirectToRoute('fos_user_profile_show', ['id' => $id]);
                }
            };

            return $this->render('profile_image/uploadImageForm.html.twig', ["formView"=>$formView]);
        }
        else{
            return $this->render('home/home.html.twig');
        }
    }
}
