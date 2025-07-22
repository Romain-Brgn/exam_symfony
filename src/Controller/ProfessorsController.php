<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfessorsController extends AbstractController
{
    #[Route('/professors', name: 'app_professors')]
    public function index(): Response
    {
        return $this->render('professors/index.html.twig', [
            'controller_name' => 'ProfessorsController',
        ]);
    }
}
