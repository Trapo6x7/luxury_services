<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\Candidate;
use App\Entity\Recruiter;
use App\Entity\User;
use App\Repository\JobCategoryRepository;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;

final class JobController extends AbstractController
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


    #[Route('/job/{name}/apply', name: 'app_job_apply')]
    public function apply(string $name, EntityManagerInterface $entityManager): Response
    {
        $user= $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
        $job = $this->jobRepository->findOneBy(['name' => $name]);
        
        if (!$job) {
            throw $this->createNotFoundException('Job not found');
        }
        // Vérifie si le candidat a déjà postulé
        /** @var User $user */
        $userId = $entityManager->getRepository(User::class)->findOneBy(['email' => $user->getEmail()])->getId();
        $candidate = $entityManager->getRepository(Candidate::class)->findOneBy(['user' => $userId]);
        if (!$candidate) {
            $this->addFlash('error', 'You must be a candidate to apply.');
            return $this->redirectToRoute('app_ls_job_show', ['name' => $name]);
        }
        
        // Ajouter le candidat à l'offre
        $job->addCandidate($candidate);
        $entityManager->persist($job);
        $entityManager->flush();

        $this->addFlash('success', 'Your application has been submitted!');
        return $this->redirectToRoute('app_ls_job_show', ['name' => $name]);
    }
}
