<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PagesController extends AbstractController
{
    #[Route('/home', name: 'app_ls_home')]
    public function index(): Response
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

    #[Route('/contact', name: 'app_ls_contact')]
    public function contact(): Response
    {
        return $this->render('pages/contact.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

    #[Route('/compagny', name: 'app_ls_compagny')]
    public function compagny(): Response
    {
        return $this->render('pages/compagny.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

    #[Route('/jobs', name: 'app_ls_jobs')]
    public function jobs(): Response
    {
        return $this->render('jobs/index.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

    #[Route('/jobs/{slug}', name: 'app_ls_jobs_show')]
    public function jobsShow(): Response
    {
        return $this->render('jobs/show.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }
}
