<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\User;
use App\Form\CandidateFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
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
            $entityManager->persist($candidate);
            $entityManager->flush();
            // Redirige l'utilisateur vers la page de profil après une soumission réussie

            $this->addFlash('success', 'Profile updated successfully');
        }

        return $this->render('profile/index.html.twig', [
            'candidateForm' => $form,
        ]);
    }
}
