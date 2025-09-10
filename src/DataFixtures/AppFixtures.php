<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Bug;
use App\Entity\Project;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('pl_PL');

        // tworzymy przykładowego admina
        $admin = new Admin();
        $admin->setEmail('admin@test.pl');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(password_hash('qwerty', PASSWORD_DEFAULT));
        $manager->persist($admin);

        // Projekt
        $project = new Project();
        $project->setName('Cheese Mine');
        $project->setDescription('Its a game about mining cheese!');
        $manager->persist($project);

        // urzytkownicy serwisu
        for ($i = 0; $i < 13; ++$i) {
            $user = new User();
            $user->setEmail($faker->email);
            $user->setPassword($faker->password(4, 12));
            $user->setRoles($faker->randomElement(['user', 'chat moderator', 'admin', 'banned']));
            $user->setCreatedAt($faker->dateTimeBetween('-84 years', 'now'));
            $user->setName($faker->firstName());
            $manager->persist($user);
            $users[] = $user;
        }

        // tworzymy przykładowe bugi
        for ($i = 0; $i < 35; ++$i) {
            $bug = new Bug();
            $bug->setTitle($faker->title());
            $bug->setDescription($faker->text());
            $bug->setStatus($faker->randomElement(['Open', 'Closed']));
            $bug->setCreatedAt($faker->dateTimeBetween('-4 years', 'now'));
            $bug->setUpdatedAt(new \DateTime());
            $bug->setReporter($faker->randomElement($users));
            $bug->setProject($project);
            $manager->persist($bug);
        }

        // Zapisujemy wszystko
        $manager->flush();
    }
}
