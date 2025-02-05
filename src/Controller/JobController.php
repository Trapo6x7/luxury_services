<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JobController extends AbstractController
{
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
