<?php

namespace App\Controller\Admin;

use App\Entity\Evaluation;
use App\Entity\ProfessorUser;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class EvaluationCrudController extends AbstractCrudController
{
    private UrlGeneratorInterface $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public static function getEntityFqcn(): string
    {
        return Evaluation::class;
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $user = $this->getUser();

        if (!$user instanceof ProfessorUser) {
            $loginUrl = $this->urlGenerator->generate('app_login');
            throw new HttpException(302, '', null, [], $loginUrl);
        }

        $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $qb->andWhere('entity.professorUser = :user')
            ->setParameter('user', $user);

        return $qb;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('nb_star_on_5', 'Note sur 5'),
            TextEditorField::new('review', 'Avis'),
            AssociationField::new('professorUser')->hideOnForm(),
        ];
    }
}
