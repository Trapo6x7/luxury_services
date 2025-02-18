<?php

namespace App\Controller;

use App\Repository\JobCategoryRepository;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    private JobRepository $jobRepository;
    private JobCategoryRepository $jobCategoryRepository;
    private EntityManagerInterface $entityManager;
    private Security $security;

    public function __construct(
        JobRepository $jobRepository,
        JobCategoryRepository $jobCategoryRepository,
        EntityManagerInterface $entityManager,
        Security $security
    ) {
        $this->jobRepository = $jobRepository;
        $this->jobCategoryRepository = $jobCategoryRepository;
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    #[Route('/', name: 'app_ls_home')]
    public function index(): Response
    {
                // Paramètres pour limiter à 10 derniers jobs
                $criteria = [];  // Pas de critères spécifiques
                $orderBy = ['createdAt' => 'DESC'];  // Tri par la date de création, décroissant
                $limit = 10;  // Limiter à 10 résultats
                $offset = 0;  // Pas d'offset, on commence à partir du début
        
                $jobs = $this->jobRepository->findBy($criteria, $orderBy, $limit, $offset);
                $jobCategories = $this->jobCategoryRepository->findAll();

        return $this->render('pages/index.html.twig', [
            'controller_name' => 'PagesController',
            'jobCategories' => $jobCategories,
            'jobs' => $jobs,
        ]);
    }

}
