<?php

namespace App\Controller\Admin;

use App\Entity\Activities;
use App\Entity\ProfessorUser;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Doctrine\ORM\QueryBuilder;

class ActivitiesCrudController extends AbstractCrudController
{
    private Security $security;
    private UrlGeneratorInterface $urlGenerator;

    public function __construct(Security $security, UrlGeneratorInterface $urlGenerator)
    {
        $this->security = $security;
        $this->urlGenerator = $urlGenerator;
    }

    public static function getEntityFqcn(): string
    {
        return Activities::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Titre'),
            TextEditorField::new('description', 'Description'),
            TextField::new('imageUrl', 'Image URL')->hideOnIndex(),
            BooleanField::new('outside', 'En extérieur'),
            BooleanField::new('home_based', 'À domicile'),
            DateTimeField::new('start_time', 'Début de l\'activité'),
            DateTimeField::new('end_time', 'Fin de l\'activité'),
            NumberField::new('fullcost', 'Tarif plein'),
            NumberField::new('discounted_price', 'Tarif réduit'),
            NumberField::new('availability_fullcost', 'Places tarif plein'),
            NumberField::new('availability_discounted_price', 'Places tarif réduit'),
            NumberField::new('remaining_availability_fullcost', 'Places restantes (plein)'),
            NumberField::new('remaining_availability_discounted_price', 'Places restantes (réduit)'),
            TextField::new('location', 'Lieu'),
            TextField::new('recurrence', 'Récurrence')->hideOnIndex(),
            TextEditorField::new('specific_note', 'Note spécifique')->hideOnIndex(),
            AssociationField::new('theme', 'Thème')
        ];
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

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Activities) {
            return;
        }

        $user = $this->getUser();

        if ($user instanceof ProfessorUser) {
            $entityInstance->setProfessorUser($user);
        }

        parent::persistEntity($entityManager, $entityInstance);
    }
}
