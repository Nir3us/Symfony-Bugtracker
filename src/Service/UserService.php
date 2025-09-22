<?php

/**
 * This file is part of the Symfony Bugtracker project.
 *
 * Service class for handling User-related business logic.
 *
 * (c)Norbert Białek <mlodszy.bialek@gmail.com>
 */

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(private EntityManagerInterface $em, private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function create(User $user, string $plainPassword): void
    {
        $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashedPassword);
        $this->em->persist($user);
        $this->em->flush();
    }

    public function update(User $user, ?string $plainPassword = null): void
    {
        if ($plainPassword) {
            $user->setPassword($this->passwordHasher->hashPassword($user, $plainPassword));
        }

        $this->em->persist($user);
        $this->em->flush();
    }

    public function delete(User $user): void
    {
        $this->em->remove($user);
        $this->em->flush();
    }

    public function getUserListQuery(): Query
    {
        return $this->em->getRepository(User::class)
            ->createQueryBuilder('u')
            ->orderBy('u.id', 'DESC')
            ->getQuery();
    }

    public function changePassword(User $user, string $plainPassword, UserPasswordHasherInterface $passwordHasher): void
    {
        $hashed = $passwordHasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashed);

        $this->em->persist($user);
        $this->em->flush();
    }
}
