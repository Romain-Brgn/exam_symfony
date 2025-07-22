<?php

namespace App\Controller;

use App\Entity\ProfessorUser;
use App\Form\ProfessorForm;
use App\Mail\Mail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;


final class ProfSubscriptionController extends AbstractController
{
    #[Route('/prof/subscription', name: 'app_prof_subscription')]


    public function index(Request $request, EntityManagerInterface $em, SluggerInterface $slugger, Mail $confirmationMail, UserPasswordHasherInterface $hasher): Response
    {
        $prof = new ProfessorUser();
        $subForm = $this->createForm(ProfessorForm::class, $prof);

        $subForm->handleRequest($request);



        if ($subForm->isSubmitted() && $subForm->isValid()) {

            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $profilePic */
            $profilePic = $subForm->get('profile_picture')->getData();

            if ($profilePic) {
                $originalFilename = pathinfo($profilePic->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $finalFilename = $safeFilename . uniqid() . '.' . $profilePic->guessExtension();
                try {
                    $profilePic->move('uploads/professors/', $finalFilename);

                    if ($prof->getProfilPicture() !== null) {
                        unlink(__DIR__ . "/../../public/uploads/professors/" . $prof->getProfilPicture());
                    }
                    $prof->setProfilPicture($finalFilename);
                } catch (FileException $th) {
                    $subForm->addError(new FormError("Erreur lors de l'upload du fichier"));
                }
            }

            $plainPassword = $subForm->get('password')->getData();
            $hashedPassword = $hasher->hashPassword($prof, $plainPassword);
            $prof->setPassword($hashedPassword);


            $em->persist($prof);
            $em->flush();


            $confirmationMail->sendMail($prof);

            $this->addFlash('success', 'Inscription réussie !');


            return $this->redirectToRoute('app_login');
        }


        return $this->render('prof_subscription/index.html.twig', [
            'controller_name' => 'ProfSubscriptionController',
            'form' => $subForm->createView(),
        ]);


    }
}
