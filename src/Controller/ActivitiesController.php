<?php

namespace App\Controller;


use App\Entity\Activities;
use App\Repository\ActivitiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ActivitiesController extends AbstractController
{
    #[Route('/activities', name: 'app_activities')]
    public function index(ActivitiesRepository $repo): Response
    {

        $activities = $repo->findAll();

        return $this->render('activities/index.html.twig', [
            'controller_name' => 'ActivitiesController',
            'activities' => $activities
        ]);
    }

    #[Route('/activities/{id}', name: 'app_activities_show')]
    public function show(Activities $activity): Response
    {
        return $this->render('activities/show.html.twig', [
            'activity' => $activity,
        ]);
    }

}
