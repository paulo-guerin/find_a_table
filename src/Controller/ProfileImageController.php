<?php

namespace App\Controller;

use App\Form\ProfileImageFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
        if($user->getId() == $id) {
            $updateImageForm=$this->createForm(ProfileImageFormType::class, $user);
            $form=$updateImageForm->createView();

            if($request->isMethod('Post')){
                $updateImageForm->handleRequest($request);
                if($updateImageForm->isValid()) {
                    /** @var UploadedFile $imageFile */
                    $imageFile = $updateImageForm['image']->getData();
                    // this condition is needed because the 'image' field is not required
                    // so the image file must be processed only when a file is uploaded
                    if ($imageFile) {
                        $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                        // this is needed to safely include the file name as part of the URL
                        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                        $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                        // Move the file to the directory where brochures are stored
                        try {
                            $imageFile->move(
                                $this->getParameter('image_directory'),
                                $newFilename
                            );
                        } catch (FileException $e) {
                            // ... handle exception if something happens during file upload
                        }

                        // updates the 'brochureFilename' property to store the PDF file name
                        // instead of its contents
                        $user->setProfilepicture($newFilename);
                        $entityManager->persist($user);
                        $entityManager->flush();
                        $this->addFlash('success', 'Votre image de profil a bien été modifiée');
                        return $this->redirectToRoute('fos_user_profile_show', ['id' => $id]);
                    }

                }
            };

            return $this->render('profile_image/uploadImageForm.html.twig', ["form"=>$form]);
        }
        else{
            return $this->render('home/home.html.twig');
        }
    }
}
