<?php

namespace App\Controller;

use App\Repository\JobCategoryRepository;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JobController extends AbstractController
{
    private JobRepository $jobRepository;
    private JobCategoryRepository $jobCategoryRepository;

    public function __construct(JobRepository $jobRepository, JobCategoryRepository $jobCategoryRepository)
    {
        $this->jobRepository = $jobRepository;
        $this->jobCategoryRepository = $jobCategoryRepository;
    }

    #[Route('/job', name: 'app_ls_job')]
    public function jobs(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // Paramètres pour limiter à 10 derniers jobs
        $criteria = [];  // Pas de critères spécifiques
        $orderBy = ['createdAt' => 'DESC'];  // Tri par la date de création, décroissant
        $limit = 10;  // Limiter à 10 résultats
        $offset = 0;  // Pas d'offset, on commence à partir du début

        $jobs = $this->jobRepository->findBy($criteria, $orderBy, $limit, $offset);
        $jobCategories = $this->jobCategoryRepository->findAll();

        return $this->render('job/index.html.twig', [
            'controller_name' => 'JobController',
            'jobs' => $jobs,
            'jobCategories' => $jobCategories,
        ]);
    }

    #[Route('/job/{name}', name: 'app_ls_job_show')]
    public function jobsShow(string $name): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
    
        // Récupérer l'emploi correspondant au nom
        $job = $this->jobRepository->findOneBy(['name' => $name]);
    
        if (!$job) {
            throw $this->createNotFoundException('Job not found');
        }
    
        return $this->render('job/show.html.twig', [
            'job' => $job,
        ]);
    }
}
