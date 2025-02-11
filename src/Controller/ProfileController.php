<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\User;
use App\Form\CandidateFormType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request,  FileUploader $fileUploader, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }


        /** @var User */
        $user = $this->getUser();

        $candidate = $user->getCandidate();
 
        if (!$candidate) {
            $candidate = new Candidate();
            $candidate->setUser($user);
            $entityManager->persist($candidate);
            $entityManager->flush();
        }

        if (!$user->isVerified()) {
            return $this->render('errors/not-verified.html.twig', []);
        }

        $form = $this->createForm(CandidateFormType::class, $candidate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form);
            /** @var UploadedFile $profilePictureFile */
            $profilePictureFile = $form->get('profilePictureFile')->getData();

            /** @var UploadedFile $passportFile */
            $passportFile = $form->get('passportFile')->getData();

            /** @var UploadedFile $cvFile */
            $cvFile = $form->get('cvFile')->getData();

             // this condition is needed because the 'profilePicture' field is not required
            // so the file must be processed only when a file is uploaded
            if ($profilePictureFile) {
                $profilePictureName = $fileUploader->upload($profilePictureFile, $candidate, 'profilePicture', 'profiles');
                $candidate->setProfilePicture($profilePictureName);
            }

            // this condition is needed because the 'passportFile' field is not required
            // so the file must be processed only when a file is uploaded
            if ($passportFile) {
                $passportName = $fileUploader->upload($passportFile, $candidate, 'passport', 'passports');
                $candidate->setPassport($passportName);
            }

            // this condition is needed because the 'cvFile' field is not required
            // so the file must be processed only when a file is uploaded
            if ($cvFile) {
                $cvName = $fileUploader->upload($cvFile, $candidate, 'cv', 'cvs');
                $candidate->setCv($cvName);
            }

            $entityManager->persist($candidate);
            $entityManager->flush();
            // Redirige l'utilisateur vers la page de profil après une soumission réussie
            $this->addFlash('success', 'Profile updated successfully');
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/index.html.twig', [
            'candidateForm' => $form,
            'candidate' => $candidate,
        ]);
    }
    
}
