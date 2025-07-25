<?php

namespace App\Controller;


use App\Entity\ProfessorUser;
use App\Repository\ProfessorUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Knp\Component\Pager\PaginatorInterface;

final class ProfessorsController extends AbstractController
{
    #[Route('/professors', name: 'app_professors')]
    public function index(
        ProfessorUserRepository $profRepo,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $query = $profRepo->createQueryBuilder('p')
            ->orderBy('p.name', 'ASC')
            ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            8
        );

        return $this->render('professors/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/professors/{id}', name: 'app_professors_show')]
    public function show(ProfessorUser $prof): Response
    {
        return $this->render('professors/show.html.twig', [
            'professorUser' => $prof,
        ]);
    }
}
