<?php

/**
 * This file is part of the Symfony Bugtracker project.
 *
 * Service class for handling Admin-related business logic.
 *
 * (c)Norbert Białek <mlodszy.bialek@gmail.com>
 */

namespace App\Service;

use App\Entity\Admin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminService
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function updateProfile(Admin $admin): void
    {
        $this->em->flush();
    }

    public function changePassword(Admin $admin, string $plainPassword): void
    {
        $hashedPassword = $this->passwordHasher->hashPassword($admin, $plainPassword);
        $admin->setPassword($hashedPassword);

        $this->em->flush();
    }
}
