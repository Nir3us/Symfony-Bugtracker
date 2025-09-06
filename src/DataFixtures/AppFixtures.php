<?php

namespace App\DataFixtures;

use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Project;
use App\Entity\Bug;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {


        // Użytkownicy
        $thorgrim = new User();
        $thorgrim->setEmail('thorgrim.grudgebearer@dwarfs.wh');
        $thorgrim->setPassword('grudgebearer'); // w praktyce -> zahashuj
        $thorgrim->setRoles(null);
        $thorgrim->setCreatedAt(new DateTime());
        $thorgrim->setName('Thorgrim Grudgebearer');
        $manager->persist($thorgrim);

        $ungrim = new User();
        $ungrim->setEmail('ungrim.ironfist@dwarfs.wh');
        $ungrim->setPassword('slayerking');
        $ungrim->setRoles(null);
        $ungrim->setCreatedAt(new DateTime());
        $ungrim->setName('Ungrim Ironfist');
        $manager->persist($ungrim);

        $gotrek = new User();
        $gotrek->setEmail('gotrek.gurnisson@dwarfs.wh');
        $gotrek->setPassword('felixJeager');
        $gotrek->setRoles(null);
        $gotrek->setCreatedAt(new DateTime());
        $gotrek->setName('Gotrek Gurnisson');
        $manager->persist($gotrek);

        $snorri = new User();
        $snorri->setEmail('snorri.nosebitter@dwarfs.wh');
        $snorri->setPassword('bittingnoses');
        $snorri->setRoles(null);
        $snorri->setCreatedAt(new DateTime());
        $snorri->setName('Snorri Nosebitter');
        $manager->persist($snorri);

        // Projekt
        $project = new Project();
        $project->setName('Cheese Mine');
        $project->setDescription('Its a game about mining cheese!');
        $manager->persist($project);

        // Bug 1
        $bug1 = new Bug();
        $bug1->setTitle('Bugger20');
        $bug1->setDescription('While mining cheese you can spot strange creature');
        $bug1->setStatus('open');
        $bug1->setCreatedAt(new DateTime());
        $bug1->setUpdatedAt(new DateTime());
        $bug1->setReporter($thorgrim);
        $bug1->setProject($project);
        $project->addBug($bug1);
        $manager->persist($bug1);

        // Bug 2
        $bug2 = new Bug();
        $bug2->setTitle('Digger');
        $bug2->setDescription('You cant stop digging');
        $bug2->setStatus('closed');
        $bug2->setCreatedAt(new DateTime());
        $bug2->setUpdatedAt(new DateTime());
        $bug2->setReporter($ungrim);
        $bug2->setProject($project);
        $project->addBug($bug2);
        $manager->persist($bug2);

        // Bug 3
        $bug3 = new Bug();
        $bug3->setTitle('Ungrudged');
        $bug3->setDescription('You cant complete quest while you are in combat');
        $bug3->setStatus('open');
        $bug3->setCreatedAt(new DateTime());
        $bug3->setUpdatedAt(new DateTime());
        $bug3->setReporter($gotrek);
        $bug3->setProject($project);
        $project->addBug($bug3);
        $manager->persist($bug3);

        // Bug 4
        $bug4 = new Bug();
        $bug4->setTitle('Immortality');
        $bug4->setDescription('You cant die');
        $bug4->setStatus('open');
        $bug4->setCreatedAt(new DateTime());
        $bug4->setUpdatedAt(new DateTime());
        $bug4->setReporter($snorri);
        $bug4->setProject($project);
        $project->addBug($bug4);
        $manager->persist($bug4);

        // Zapisujemy wszystko
        $manager->flush();


        /*
        //tworzymy usera
        $user = new user;

        $user->setEmail('thorgrim.grudgebearer@dwarfs.wh');
        $user->setPassword('grudgebearer');
        $user->setRoles(null);
        $user->setCreatedAt(new DateTime());
        $user->setName('Thorgrim Grudgebearer');
        //$user->addReport($Bug);

        $manager->persist($user);

        $user = new user;

        $user->setEmail('ungrim.ironfist@dwarfs.wh');
        $user->setPassword('slayerking');
        $user->setRoles(null);
        $user->setCreatedAt(new DateTime());
        $user->setName('Ungrim Ironfist');
        //$user->addReport($Bug);

        $manager->persist($user);

        $user = new user;

        $user->setEmail('gotrek.gurnisson@dwarfs.wh');
        $user->setPassword('felixJeager');
        $user->setRoles(null);
        $user->setCreatedAt(new DateTime());
        $user->setName('Gotrek Gurnisson');
        //$user->addReport($Bug);

        $manager->persist($user);

        $user = new user;

        $user->setEmail('snorri.nosebitter@dwarfs.wh');
        $user->setPassword('bittingnoses');
        $user->setRoles(null);
        $user->setCreatedAt(new DateTime());
        $user->setName('Snorri Nosebitter');
        //$user->addReport($Bug);

        $manager->persist($user);

        $project = new project;

        $project->setName('Cheese Mine');
        $project->setDescription('Its a game about mining cheese!');
        //$project->addBug($Bug);

        $manager->persist($project);

        //tworzymy przykładowe dane dla naszej encji bug
        $bug = new bug;

        $bug->setTitle('Bugger20');
        $bug->setProject(null);
        $bug->setDescription('While mining cheese you can spot strange creature');
        $bug->setCreatedAt(new DateTime());
        $bug->setReporter(null);
        $bug->setStatus('open');
        $bug->setUpdatedAt(new DateTime());
        $bug->setReporter($user);
        $bug->setProject($project);

        $manager->persist($bug);

        $bug = new bug;

        $bug->setTitle('Digger');
        $bug->setProject(null);
        $bug->setDescription('You cant stop digging');
        $bug->setCreatedAt(new DateTime());
        $bug->setReporter(null);
        $bug->setStatus('closed');
        $bug->setUpdatedAt(new DateTime());
        $bug->setReporter($user);
        $bug->setProject($project);

        $manager->persist($bug);

        $bug = new bug;

        $bug->setTitle('Ungrudged');
        $bug->setProject(null);
        $bug->setDescription('You cant complete quest while you are in combat');
        $bug->setCreatedAt(new DateTime());
        $bug->setReporter(null);
        $bug->setStatus('open');
        $bug->setUpdatedAt(new DateTime());
        $bug->setReporter($user);
        $bug->setProject($project);

        $manager->persist($bug);

        $bug = new bug;

        $bug->setTitle('Immortality');
        $bug->setProject(null);
        $bug->setDescription('You cant die');
        $bug->setCreatedAt(new DateTime());
        $bug->setReporter(null);
        $bug->setStatus('open');
        $bug->setUpdatedAt(new DateTime());
        $bug->setReporter($user);
        $bug->setProject($project);

        $manager->persist($bug);
        //Tworzymy 4 przykładowe błędy żeby zobaczyć czy działają nam podstrony

        //to samo możemy zrobić dla pozostałych encji

        $manager->flush();
        */
    }
}
