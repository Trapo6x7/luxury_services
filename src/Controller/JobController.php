<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\Candidate;
use App\Entity\Recruiter;
use App\Entity\User;
use App\Repository\JobCategoryRepository;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;

final class JobController extends AbstractController
{
    private JobRepository $jobRepository;
    private JobCategoryRepository $jobCategoryRepository;
    private EntityManagerInterface $entityManager;
    private Security $security;
    private PaginatorInterface $paginator;

    public function __construct(
        JobRepository $jobRepository,
        JobCategoryRepository $jobCategoryRepository,
        EntityManagerInterface $entityManager,
        Security $security,
       
    ) {
        $this->jobRepository = $jobRepository;
        $this->jobCategoryRepository = $jobCategoryRepository;
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    #[Route('/job', name: 'app_ls_job')]
    public function jobs( Request $request, PaginatorInterface $paginator): Response
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

        $pagination = $paginator->paginate(
            $jobs,
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('job/index.html.twig', [
            'controller_name' => 'JobController',
            'jobs' => $pagination,
            'jobCategories' => $jobCategories,
        ]);
    }

    #[Route('/job/{name}', name: 'app_ls_job_show')]
    public function jobsShow(string $name, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // Récupérer l'emploi correspondant au nom
        $job = $this->jobRepository->findOneBy(['name' => $name]);

        if (!$job) {
            throw $this->createNotFoundException('Job not found');
        }

    // Récupérer l'offre précédente et suivante en fonction de l'ID
    $previousJob = $entityManager->getRepository(Job::class)
        ->createQueryBuilder('j')
        ->where('j.id < :currentId')
        ->orderBy('j.id', 'DESC')
        ->setParameter('currentId', $job->getId())
        ->setMaxResults(1)
        ->getQuery()
        ->getOneOrNullResult();

    $nextJob = $entityManager->getRepository(Job::class)
        ->createQueryBuilder('j')
        ->where('j.id > :currentId')
        ->orderBy('j.id', 'ASC')
        ->setParameter('currentId', $job->getId())
        ->setMaxResults(1)
        ->getQuery()
        ->getOneOrNullResult();

    // Passer les résultats au template
    return $this->render('job/show.html.twig', [
        'job' => $job,
        'previousJob' => $previousJob,
        'nextJob' => $nextJob
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
