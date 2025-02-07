<?php

namespace App\Controller;

use App\Entity\User;
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

        $user = $this->getUser();
  
        // $form = $this->createForm(ProfileFormType::class, $user);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
      
            

            $entityManager->persist($user);
            $entityManager->flush();
      // Redirige l'utilisateur vers la page de profil après une soumission réussie
    //   return $this->redirectToRoute('app_profile');
    // }

    return $this->render('profile/index.html.twig', [
        // 'profileForm' => $form,
    ]);
    }
}
