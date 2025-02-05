<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CompagnyController extends AbstractController
{
    #[Route('/compagny', name: 'app_ls_compagny')]
    public function compagny(): Response
    {
        return $this->render('pages/compagny.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

}
