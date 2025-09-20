<?php

/**
 * This file is part of the Symfony Bugtracker project.
 *
 * Service class for handling Registration of a new Admin business logic.
 *
 * (c)Norbert Białek <mlodszy.bialek@gmail.com>
 */

namespace App\Service;

use App\Entity\Admin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationService
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function register(Admin $admin, string $plainPassword): void
    {
        // Hashowanie hasła
        $hashedPassword = $this->passwordHasher->hashPassword($admin, $plainPassword);
        $admin->setPassword($hashedPassword);

        // Zapis do bazy
        $this->em->persist($admin);
        $this->em->flush();
    }
}
