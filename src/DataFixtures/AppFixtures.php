<?php

namespace App\DataFixtures;

use App\Entity\Activities;
use App\Entity\Evaluation;
use App\Entity\ProfessorUser;
use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }
    const NB_PROFESSEURS = 15;
    const NB_ACTIVITIES = 63;
    const NB_THEME = 10;
    const NB_EVALUATION = 74;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        //Professor
        $professors = [];
        for ($i = 0; $i < self::NB_PROFESSEURS; $i++) {
            $professor = new ProfessorUser();
            $siret = $faker->randomNumber(9, true);
            $formatedSiret = preg_replace('/(\d{3})(\d{3})(\d{3})/', '$1 $2 $3', $siret);

            $professor
                ->setName($faker->lastname())
                ->setFirstname($faker->firstName())
                ->setEmail($faker->email())
                ->setPhone($faker->phoneNumber())
                ->setProfilPicture($faker->imageUrl(null, null, null, true, 'profil picture'))
                ->setAdress($faker->streetAddress())
                ->setCity($faker->city())
                ->setPresentation($faker->realText(250))
                ->setCompanyIdentificationNumber($formatedSiret)
                ->setPassword($this->hasher->hashPassword($professor, 'toto'))
                ->setRoles(['ROLE_PROFESSOR']);

            $professors[] = $professor;
            $manager->persist($professor);
        }
        $manager->flush();
        //Theme
        $themes = [];
        for ($i = 0; $i < self::NB_THEME; $i++) {
            $theme = new Theme();

            $theme
                ->setName($faker->unique()->word())
                ->setImageUrl($faker->imageUrl(640, 480, null, true, 'activity'));

            $themes[] = $theme;
            $manager->persist($theme);

        }
        $manager->flush();

        //Activity
        for ($i = 0; $i < self::NB_ACTIVITIES; $i++) {
            $activity = new Activities();

            $fullcostPrice = $faker->randomFloat(2, 10, 300);
            $availabilityFullcost = $faker->numberBetween(1, 50);
            $availabilityDiscountPrice = $faker->numberBetween(1, 10);



            $activity
                ->setTitle($faker->realText(58))
                ->setDescription($faker->realText(255, 3))
                ->setImageUrl($faker->imageUrl(800, 600, 'nature', true, 'activity'))
                ->setOutside($faker->boolean(40))
                ->setHomeBased($faker->boolean(20))
                ->setStartTime($faker->dateTimeBetween('+1 days', '+1 month'))
                ->setEndTime($faker->dateTimeBetween('+1 month', '+2 months'))
                ->setFullcost($fullcostPrice)
                ->setAvailabilityFullcost($availabilityFullcost)
                ->setRemainingAvailabilityFullcost($faker->numberBetween(0, $availabilityFullcost))
                ->setLocation($faker->address())
                ->setRecurrence($faker->optional()->word())
                ->setSpecificNote($faker->optional()->realText(150, 2))
                ->setProfessorUser($faker->randomElement($professors))
                ->setTheme($faker->randomElement($themes));

            // Pour maintenir la cohérence des données j'ai fais ce if. 
            // Il permet que si on établie un prix réduit, alors on établis des places disponibles, et des place restantes.
            //Sinon c'était le bordel et c'était pas logique.

            if ($faker->boolean(35)) {
                $activity
                    ->setDiscountedPrice($faker->randomFloat(2, 7, $fullcostPrice * 0.9))
                    ->setAvailabilityDiscountedPrice($availabilityDiscountPrice)
                    ->setRemainingAvailabilityDiscountedPrice($faker->numberBetween(0, $availabilityDiscountPrice));

            } else {
                $activity
                    ->setDiscountedPrice(null)
                    ->setAvailabilityDiscountedPrice(null)
                    ->setRemainingAvailabilityDiscountedPrice(null);
            }

            $manager->persist($activity);
        }
        $manager->flush();

        //Review
        for ($i = 0; $i < self::NB_EVALUATION; $i++) {
            $evaluation = new Evaluation();
            $evaluation
                ->setNbStarOn5($faker->numberBetween(0, 5))
                ->setReview($faker->realText(120, 2))
                ->setProfessorUser($faker->randomElement($professors));


            $manager->persist($evaluation);
        }
        $manager->flush();
    }
}
