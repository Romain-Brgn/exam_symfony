<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ExceptionListenerController extends AbstractController
{
    #[Route('/exception/listener', name: 'app_exception_listener')]
    public function index(): Response
    {
        return $this->render('exception_listener/index.html.twig', [
            'controller_name' => 'ExceptionListenerController',
        ]);
    }
}
