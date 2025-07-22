<?php

namespace App\Form;

use App\Entity\ProfessorUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class ProfessorForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Professeur' => 'ROLE_PROFESSOR',
                    'Utilisateur' => 'ROLE_USER',
                    'Organisation' => 'ROLE_ORGANISATION',
                ],
                'multiple' => true,
                'expanded' => true,
                'label' => 'Vous êtes',
                'required' => true,
            ])
            ->add('password', PasswordType::class)

            ->add('company_identification_number', IntegerType::class)
            ->add('name', TextType::class)
            ->add('firstname', TextType::class)
            ->add('phone', TelType::class)
            ->add('profile_picture', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image()
                ]
            ])
            ->add('presentation', TextareaType::class)
            ->add('adress', TextType::class)
            ->add('city', TextType::class)
            ->add('Souscrire', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProfessorUser::class,
        ]);
    }
}