<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class TaskFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $task = new Task();
        $task->setTitre('Sample Task');
        $task->setDescription('This is a sample task');
        $task->setDateCreation(new \DateTime());
        $task->setEtat('en cours');

        $manager->persist($task);

        $task1 = new Task();
        $task1->setTitre('Sample Task 1');
        $task1->setDescription('This is a sample task 1');
        $task1->setDateCreation(new \DateTime());
        $task1->setEtat('terminee');

        $manager->persist($task1);

        $task2 = new Task();
        $task2->setTitre('Sample Task 2');
        $task2->setDescription('This is a sample task 2');
        $task2->setDateCreation(new \DateTime());
        $task2->setEtat('en cours');

        $manager->persist($task2);

        $task3 = new Task();
        $task3->setTitre('Sample Task');
        $task3->setDescription('This is a sample task');
        $task3->setDateCreation(new \DateTime());
        $task3->setEtat('en cours');

        $manager->persist($task3);

        $task4 = new Task();
        $task4->setTitre('Sample Task 1');
        $task4->setDescription('This is a sample task 1');
        $task4->setDateCreation(new \DateTime());
        $task4->setEtat('terminee');

        $manager->persist($task4);

        $task5 = new Task();
        $task5->setTitre('Sample Task 2');
        $task5->setDescription('This is a sample task 2');
        $task5->setDateCreation(new \DateTime());
        $task5->setEtat('en cours');

        $manager->persist($task5);
        $manager->flush();
    }
}
