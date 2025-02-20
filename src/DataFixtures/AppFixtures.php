<?php

namespace App\DataFixtures;

use App\Entity\Person;
use App\Entity\Project;
use App\Entity\Participation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // ✅ Générer des utilisateurs
        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $user = new Person();
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setPseudonyme($faker->userName);
            $user->setEmail($faker->email);
            $user->setCountry($faker->country);

            // Hashage du mot de passe
            $password = $this->passwordHasher->hashPassword($user, 'password123');
            $user->setPassword($password);

            $manager->persist($user);
            $users[] = $user;
        }

        // ✅ Générer des projets
        $projects = [];
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->setTitle($faker->sentence(3));
            $project->setDescription($faker->paragraph(5));
            $project->setAmount($faker->numberBetween(1000, 100000));
            $project->setOpeningDate($faker->dateTimeBetween('-1 year', 'now'));
            $project->setClosingDate($faker->dateTimeBetween('now', '+1 year'));
            $project->setCreator($faker->randomElement($users));

            $manager->persist($project);
            $projects[] = $project;
        }

        // ✅ Générer des dons
        for ($i = 0; $i < 30; $i++) {
            $participation = new Participation();
            $participation->setAmount($faker->randomFloat(2, 10, 1000));
            $participation->setParticipantDate($faker->dateTimeBetween('-6 months', 'now'));
            $participation->setProject($faker->randomElement($projects));
            $participation->setDonator($faker->randomElement($users));

            $manager->persist($participation);
        }

        $manager->flush();
    }
}
