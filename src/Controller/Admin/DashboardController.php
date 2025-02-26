<?php

namespace App\Controller\Admin;

use App\Entity\Candidate;
use App\Entity\Experience;
use App\Entity\Gender;
use App\Entity\Job;
use App\Entity\JobCategory;
use App\Entity\Recruiter;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/admin')]
    public function index(): Response
    {


        if (!$this->getUser()->getRoles() == "ROLE_ADMIN") {
            return $this->redirectToRoute('app_ls_home');
        }

        // $this->denyAccessUnlessGranted("ROLE_ADMIN");
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        // return $this->redirectToRoute('admin_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Luxury Services')
            ->setFaviconPath('img/luxury-services-logo.png');
    }

    public function configureMenuItems(): iterable
    {
        $user = $this->security->getUser();
        $roles = $user->getRoles();

        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-tachometer-alt');

        /** @var User $user */
        if (in_array('ROLE_ADMIN', $roles)) {
            
            yield MenuItem::section('Candidates');
            yield MenuItem::linkToCrud('Genders', 'fas fa-venus-mars', Gender::class);
            yield MenuItem::linkToCrud('Experience', 'fas fa-briefcase', Experience::class);
            yield MenuItem::linkToCrud('Job Category', 'fas fa-ship', JobCategory::class);

            yield MenuItem::section('Users');
            yield MenuItem::linkToCrud('User', 'fas fa-user-tie', User::class);
            yield MenuItem::linkToCrud('Candidate', 'fas fa-user-tie', Candidate::class);

            yield MenuItem::section('Recruters');
            yield MenuItem::linkToCrud('Company', 'fas fa-user-tie', Recruiter::class);

            yield MenuItem::section('Jobs');
            yield MenuItem::linkToCrud('Category', 'fas fa-user-tie', JobCategory::class);
            yield MenuItem::linkToCrud('Offer', 'fas fa-user-tie', Job::class);

        } else if (in_array('ROLE_RECRUITER', $roles)) {
            
            yield MenuItem::section('Recruters');
            yield MenuItem::linkToCrud('Company', 'fas fa-user-tie', Recruiter::class);

            yield MenuItem::section('Jobs');
            yield MenuItem::linkToCrud('Offer', 'fas fa-user-tie', Job::class);

        }
    }
}
